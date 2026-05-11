<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\User;
use App\Models\Lokasi;
use App\Models\settings;
use App\Models\MappingShift;
use Illuminate\Http\Request;
use App\Events\NotifApproval;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\CutiApprovalMail;

class CutiController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail(auth()->user()->id);

        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $cuti = Cuti::where('user_id', $user_id)
            ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                return $query->whereBetween('tanggal', [$mulai, $akhir]);
            })
            ->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('cuti.buatcuti', [
            'title' => 'Ajukan Permintaan Cuti',
            'data_user' => $user,
            'data_cuti_user' => $cuti
        ]);
    }

    public function cutiDataApps()
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail(auth()->user()->id);

        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $cuti = Cuti::where('user_id', $user_id)
            ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                return $query->whereBetween('tanggal', [$mulai, $akhir]);
            })
            ->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('cuti.datacutiApps', [
            'title' => 'List Pengajuan Cuti',
            'data_user' => $user,
            'data_cuti_user' => $cuti
        ]);
    }

    public function tambahRO()
    {
        return view('cuti.tambahro', [
            'title' => 'Tambah Replace Off',
        ]);
    }

    public function tambah(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');

        if ($request["tanggal_mulai"] == null) {
            $request["tanggal_mulai"] = $request["tanggal_akhir"];
        } else {
            $request["tanggal_mulai"] = $request["tanggal_mulai"];
        }

        if ($request["tanggal_akhir"] == null) {
            $request["tanggal_akhir"] = $request["tanggal_mulai"];
        } else {
            $request["tanggal_akhir"] = $request["tanggal_akhir"];
        }

        // Validasi data sekali saja
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nama_cuti' => 'required',
            'alasan_cuti' => 'nullable',
            'foto_cuti' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        // Tambahkan field tambahan
        $validatedData['status_cuti'] = "Pending";
        $validatedData['lokasi_id'] = auth()->user()->lokasi_id;
        $validatedData['tanggal'] = $request["tanggal_mulai"];
        $validatedData['tanggal_mulai'] = $request["tanggal_mulai"];
        $validatedData['tanggal_akhir'] = $request["tanggal_akhir"];
        $validatedData['url_redirect'] = '/data-cuti-apps?user_id=' . $request['user_id'] .
            '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"];

        if (empty(auth()->user()->user_approval_2)) {
            $validatedData['leader_approval'] = 1;
            $validatedData['name_leader_approval'] = 'Sheila Hosea';
        } else {
            $validatedData['leader_approval'] = null;
            $validatedData['name_leader_approval'] = null;
        }

        if ($request->file('foto_cuti')) {
            $validatedData['foto_cuti'] = $request->file('foto_cuti')->store('foto_cuti');
        }

        // Simpan hanya 1 record
        $cuti = Cuti::create($validatedData);

        // Cari leader berdasarkan role user_approval_2
        $leaderRole = auth()->user()->user_approval_2;

        $leaders = User::whereHas('roles', function ($query) use ($leaderRole) {
            $query->where('name', $leaderRole);
        })->get();

        // Kirim email ke semua leader
        foreach ($leaders as $leader) {
            Mail::to($leader->email)->send(new \App\Mail\CutiApprovalMail($cuti));
        }

        // if ($request["tanggal_mulai"] == null) {
        //     $request["tanggal_mulai"] = $request["tanggal_akhir"];
        // } else {
        //     $request["tanggal_mulai"] = $request["tanggal_mulai"];
        // }

        // if ($request["tanggal_akhir"] == null) {
        //     $request["tanggal_akhir"] = $request["tanggal_mulai"];
        // } else {
        //     $request["tanggal_akhir"] = $request["tanggal_akhir"];
        // }

        // $begin = new \DateTime($request["tanggal_mulai"]);
        // $end = new \DateTime($request["tanggal_akhir"]);
        // $end = $end->modify('+1 day');

        // $interval = new \DateInterval('P1D');
        // $daterange = new \DatePeriod($begin, $interval, $end);

        // foreach ($daterange as $date) {
        //     $request["tanggal"] = $date->format("Y-m-d");

        //     $validatedData['status_cuti'] = "Pending";
        //     $validatedData = $request->validate([
        //         'user_id' => 'required',
        //         'nama_cuti' => 'required',
        //         'tanggal' => 'required',
        //         'alasan_cuti' => 'nullable',
        //         'foto_cuti' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        //     ]);

        //     $validatedData['lokasi_id'] = auth()->user()->lokasi_id;
        //     $validatedData['url_redirect'] = '/data-cuti-apps?user_id=' . $request['user_id'] . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"];

        //     if (empty(auth()->user()->user_approval_2)) {
        //         $validatedData['leader_approval'] = 1;
        //         $validatedData['name_leader_approval'] = 'Sheila Hosea';
        //     } else {
        //         $validatedData['leader_approval'] = null; // default
        //         $validatedData['name_leader_approval'] = null; // atau kosong
        //     }

        //     if ($request->file('foto_cuti')) {
        //         $validatedData['foto_cuti'] = $request->file('foto_cuti')->store('foto_cuti');
        //     }


        //     $cuti = Cuti::create($validatedData);
        // }

        // $user_roles = User::whereHas('roles', function ($query) {
        //     $query->where('name', auth()->user()->user_approval_1)
        //         ->orWhere('name', auth()->user()->user_approval_2);
        // });

        $user_roles = User::whereHas('roles', function ($query) {
            $query->where('name', auth()->user()->user_approval_1);

            if (!empty(auth()->user()->user_approval_2)) {
                $query->orWhere('name', auth()->user()->user_approval_2);
            }
        });

        $users = $user_roles->get();

        foreach ($users as $user) {
            $isAdmin = $user->roles->contains('name', 'admin');

            $action = '';
            if ($isAdmin) {
                $action = '/data-cuti?user_id=' . $cuti->user_id . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"];
            } else {
                $action = '/data-cuti-apps?user_id=' . $cuti->user_id . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"];
            }
            $type = 'Approval';
            $notif = 'Pengajuan ' . $cuti->nama_cuti . ' Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('/data-cuti?user_id=' . $cuti->user_id . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"]);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'type' => $cuti->nama_cuti,
                'amount' => 0,
                'validation' => 'to_leader',
                'message'   =>  $notif,
                'action'   => $action
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);
        }

        if ($isAdmin) {
            return redirect('/cuti-data')->with('success', 'Data Berhasil di Tambahkan');
        } else {
            return redirect('/cuti-data-apps')->with('success', 'Data Berhasil di Tambahkan');
        }
    }

    public function delete($id)
    {
        $delete = Cuti::find($id);
        $delete->delete();
        return redirect('/cuti')->with('success', 'Data Berhasil di Delete');
    }

    public function edit($id)
    {
        return view('cuti.edituser', [
            'title' => 'Edit Permintaan Cuti',
            'data_cuti_user' => Cuti::findOrFail($id)
        ]);
    }

    public function editProses(Request $request, $id)
    {
        $cuti = Cuti::find($id);
        $validatedData = $request->validate([
            'user_id' => 'required',
            'nama_cuti' => 'required',
            'tanggal' => 'required',
            'alasan_cuti' => 'required',
            'foto_cuti' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        $validatedData['lokasi_id'] = auth()->user()->lokasi_id;

        if ($request->file('foto_cuti')) {
            $validatedData['foto_cuti'] = $request->file('foto_cuti')->store('foto_cuti');
        }

        $cuti->update($validatedData);

        $user_roles = User::whereHas('roles', function ($query) {
            $query->where('name', auth()->user()->user_approval_1)
                ->orWhere('name', auth()->user()->user_approval_2);
        });

        // $kepala_cabang = User::whereHas('roles', function ($query) {
        //     $query->where('name', 'kepala_cabang');
        // })->where('lokasi_id', auth()->user()->lokasi_id);

        $users = $user_roles->get();

        foreach ($users as $user) {
            $isAdmin = $user->roles->contains('name', 'admin');

            $action = '';
            if ($isAdmin) {
                $action = '/data-cuti?user_id=' . $cuti->user_id . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"];
            } else {
                $action = '/data-cuti-apps?user_id=' . $cuti->user_id . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"];
            }
            $type = 'Approval';
            $notif = 'Pengajuan ' . $cuti->nama_cuti . ' Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('/data-cuti?user_id=' . $cuti->user_id . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"]);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'type' => $cuti->nama_cuti,
                'amount' => 0,
                'validation' => 'to_leader',
                'message'   =>  $notif,
                'action'   => $action
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);

            // $settings = settings::first();
            // if ($settings->wa_api_url) {
            //     Http::get($settings->wa_api_url, [
            //         'session' => $settings->wa_session,
            //         'to' => $user->whatsapp($user->telepon),
            //         'text' =>  $notif . "\n\n" . $url,
            //     ]);
            // }
        }

        $request->session()->flash('success', 'Data Berhasil di Update');
        return redirect('/cuti');
    }

    public function dataCuti()
    {
        $user = User::find(auth()->user()->id);
        $user->update([
            'is_admin' => 'admin'
        ]);

        $users = User::when(auth()->user()->hasRole('kepala_cabang'), function ($query) {
            return $query->where('lokasi_id', auth()->user()->lokasi_id);
        })
            ->orderBy('name')
            ->get();

        $user_id = request()->input('user_id');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $cuti = Cuti::when(auth()->user()->hasRole('kepala_cabang'), function ($query) {
            return $query->where('lokasi_id', auth()->user()->lokasi_id);
        })
            ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
                return $query->whereBetween('tanggal', [$mulai, $akhir]);
            })
            ->when($user_id, function ($query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('cuti.datacuti', [
            'title' => 'Data Cuti Karyawan',
            'data_cuti' => $cuti,
            'users' => $users,
        ]);
    }

    public function dataCutiApps()
    {
        // $user = User::find(auth()->user()->id);
        // $user->update([
        //     'is_admin' => 'admin'
        // ]);

        $users = User::when(auth()->user()->hasRole('admin'), function ($query) {
            return $query->where('lokasi_id', auth()->user()->lokasi_id);
        })
            ->orderBy('name')
            ->get();

        $user_id = request()->input('user_id');
        $mulai = request()->input('mulai');
        $akhir = request()->input('akhir');

        $cuti = Cuti::when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
            return $query->whereBetween('tanggal', [$mulai, $akhir]);
        })
            ->when($user_id, function ($query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('cuti.datacutiuser', [
            'title' => 'Approval',
            'data_cuti' => $cuti,
            'users' => $users,
        ]);
    }

    public function tambahAdmin()
    {
        $users = User::when(auth()->user()->hasRole('kepala_cabang'), function ($query) {
            return $query->where('lokasi_id', auth()->user()->lokasi_id);
        })
            ->orderBy('name')
            ->get();
        return view('cuti.tambahadmin', [
            'title' => 'Tambah Cuti Pegawai',
            'data_user' => $users
        ]);
    }

    public function getUserId(Request $request)
    {
        $id = $request["id"];
        $data_user = User::findOrfail($id);

        $izin_cuti = $data_user->izin_cuti;
        $izin_ro = $data_user->izin_ro;
        $izin_lainnya = $data_user->izin_lainnya;
        $izin_telat = $data_user->izin_telat;
        $izin_pulang_cepat = $data_user->izin_pulang_cepat;

        $data_cuti = array(
            [
                'nama' => 'Cuti',
                'nama_cuti' => 'Cuti (' . $izin_cuti . ')'
            ],
            [
                'nama' => 'Replace Off',
                'nama_cuti' => 'Replace Off (' . $izin_ro . ')'
            ],
            [
                'nama' => 'Izin Masuk',
                'nama_cuti' => 'Izin Masuk (' . $izin_lainnya . ')'
            ],
            [
                'nama' => 'Izin Telat',
                'nama_cuti' => 'Izin Telat (' . $izin_telat . ')'
            ],
            [
                'nama' => 'Izin Pulang Cepat',
                'nama_cuti' => 'Izin Pulang Cepat (' . $izin_pulang_cepat . ')'
            ],
            [
                'nama' => 'Sakit',
                'nama_cuti' => 'Sakit'
            ]
        );

        echo "<option value='' selected>Pilih Cuti</option>";
        foreach ($data_cuti as $dc) {
            echo "
                <option value='$dc[nama]'>$dc[nama_cuti]</option>
            ";
        }
    }

    public function tambahAdminProses(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');

        if ($request["tanggal_mulai"] == null) {
            $request["tanggal_mulai"] = $request["tanggal_akhir"];
        } else {
            $request["tanggal_mulai"] = $request["tanggal_mulai"];
        }

        if ($request["tanggal_akhir"] == null) {
            $request["tanggal_akhir"] = $request["tanggal_mulai"];
        } else {
            $request["tanggal_akhir"] = $request["tanggal_akhir"];
        }

        $begin = new \DateTime($request["tanggal_mulai"]);
        $end = new \DateTime($request["tanggal_akhir"]);
        $end = $end->modify('+1 day');

        $interval = new \DateInterval('P1D');
        $daterange = new \DatePeriod($begin, $interval, $end);

        foreach ($daterange as $date) {
            $request["tanggal"] = $date->format("Y-m-d");

            $request['status_cuti'] = "Pending";
            $validatedData = $request->validate([
                'user_id' => 'required',
                'nama_cuti' => 'required',
                'tanggal' => 'required',
                'alasan_cuti' => 'required',
                'foto_cuti' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
                'status_cuti' => 'required',
            ]);

            $validatedData['lokasi_id'] = auth()->user()->lokasi_id;
            $validatedData['url_redirect'] = '/data-cuti-apps?user_id=' . $request['user_id'] . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"];

            if ($request->file('foto_cuti')) {
                $validatedData['foto_cuti'] = $request->file('foto_cuti')->store('foto_cuti');
            }

            $cuti = Cuti::create($validatedData);
        }

        $user_roles = User::whereHas('roles', function ($query) {
            $query->where('name', auth()->user()->user_approval_1)
                ->orWhere('name', auth()->user()->user_approval_2);
        });

        $users = $user_roles->get();

        foreach ($users as $user) {
            $isAdmin = $user->roles->contains('name', 'admin');

            $action = '';
            if ($isAdmin) {
                $action = '/data-cuti?user_id=' . $cuti->user_id . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"];
            } else {
                $action = '/data-cuti-apps?user_id=' . $cuti->user_id . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"];
            }
            $type = 'Approval';
            $notif = 'Pengajuan ' . $cuti->nama_cuti . ' Dari ' . auth()->user()->name . ' Butuh Approval Anda';
            $url = url('/data-cuti?user_id=' . $cuti->user_id . '&mulai=' . $request["tanggal_mulai"] . '&akhir=' . $request["tanggal_akhir"]);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'type' => $cuti->nama_cuti,
                'amount' => 0,
                'validation' => 'to_leader',
                'message'   =>  $notif,
                'action'   => $action
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);
        }

        return redirect('/cuti')->with('success', 'Data Berhasil di Tambahkan');
    }

    public function deleteAdmin($id)
    {
        $delete = Cuti::find($id);
        // Storage::delete($delete->foto_cuti);
        $delete->delete();
        return redirect('/data-cuti')->with('success', 'Data Berhasil di Delete');
    }

    public function editAdmin($id)
    {
        return view('cuti.editadmin', [
            'title' => 'Edit Cuti Karyawan',
            'data_cuti_karyawan' => Cuti::findOrFail($id)
        ]);
    }

    public function editAdminProses(Request $request, $id)
    {
        date_default_timezone_set('Asia/Makassar');

        $cuti = Cuti::find($id);
        $validated = $request->validate([
            'nama_cuti' => 'required',
            // 'tanggal' => 'required',
            // 'status_cuti' => 'required',
            'catatan' => 'nullable',
        ]);
        $validated['user_approval'] = auth()->user()->id;
        $cuti->update($validated);

        $stat_cuti = '';
        if ($cuti->user_approval and $cuti->leader_approval) {
            $stat_cuti = 'Diterima';
        } else if (!$cuti->user_approval and !$cuti->leader_approval) {
            $stat_cuti = 'Pending';
        } else if (!$cuti->user_approval and $cuti->leader_approval) {
            $stat_cuti = 'Pending';
        } else if ($cuti->user_approval and !$cuti->leader_approval) {
            $stat_cuti = 'Pending';
        } else if ($cuti->status_cuti == 'Ditolak') {
            $stat_cuti = 'Ditolak';
        }

        $validated['status_cuti'] = $stat_cuti;
        $cuti->update($validated);

        $user = User::find($cuti->user_id);
        $mapping_shift = MappingShift::where('tanggal', $request['tanggal'])->where('user_id', $cuti->user_id)->first();

        $cutiValidasi = Cuti::find($id);

        if ($cutiValidasi->status_cuti == "Diterima") {
            if ($request["nama_cuti"] == "Cuti") {
                // Hitung jumlah hari cuti
                $startDate = Carbon::parse($cuti->tanggal_mulai);
                $endDate   = Carbon::parse($cuti->tanggal_akhir);

                // +1 karena inclusive (misal 10–13 = 4 hari)
                $jumlahHari = $startDate->diffInDays($endDate) + 1;

                // Update izin_cuti sesuai jumlah hari
                $user->update([
                    'izin_cuti' => $user->izin_cuti - $jumlahHari
                ]);

                // Loop semua tanggal dari mulai sampai akhir
                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    $mapping_shift_loop = MappingShift::where('tanggal', $date->format('Y-m-d'))
                        ->where('user_id', $cuti->user_id)
                        ->first();

                    if ($mapping_shift_loop) {
                        // Update jika sudah ada
                        $mapping_shift_loop->update([
                            'status_absen' => $request["nama_cuti"]
                        ]);
                    } else {
                        // Buat baru jika belum ada
                        MappingShift::create([
                            'user_id'     => $cuti->user_id,
                            'tanggal'     => $date->format('Y-m-d'),
                            'status_absen' => $request["nama_cuti"]
                        ]);
                    }
                }
            } else if ($request["nama_cuti"] == "Replace Off") {
                // Hitung jumlah hari cuti
                $startDate = Carbon::parse($cuti->tanggal_mulai);
                $endDate   = Carbon::parse($cuti->tanggal_akhir);

                // +1 karena inclusive (misal 10–13 = 4 hari)
                $jumlahHari = $startDate->diffInDays($endDate) + 1;

                // Update izin_ro sesuai jumlah hari
                $user->update([
                    'izin_ro' => $user->izin_ro - $jumlahHari
                ]);

                // Loop semua tanggal dari mulai sampai akhir
                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    $mapping_shift_loop = MappingShift::where('tanggal', $date->format('Y-m-d'))
                        ->where('user_id', $cuti->user_id)
                        ->first();

                    if ($mapping_shift_loop) {
                        // Update jika sudah ada
                        $mapping_shift_loop->update([
                            'status_absen' => $request["nama_cuti"]
                        ]);
                    } else {
                        // Buat baru jika belum ada
                        MappingShift::create([
                            'user_id'     => $cuti->user_id,
                            'tanggal'     => $date->format('Y-m-d'),
                            'status_absen' => $request["nama_cuti"]
                        ]);
                    }
                }
            } else if ($request["nama_cuti"] == "Sakit") {
                // Hitung jumlah hari cuti
                $startDate = Carbon::parse($cuti->tanggal_mulai);
                $endDate   = Carbon::parse($cuti->tanggal_akhir);

                // +1 karena inclusive (misal 10–13 = 4 hari)
                $jumlahHari = $startDate->diffInDays($endDate) + 1;

                // Update izin_ro sesuai jumlah hari
                // $user->update([
                //     'izin_ro' => $user->izin_ro - $jumlahHari
                // ]);

                // Loop semua tanggal dari mulai sampai akhir
                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    $mapping_shift_loop = MappingShift::where('tanggal', $date->format('Y-m-d'))
                        ->where('user_id', $cuti->user_id)
                        ->first();

                    if ($mapping_shift_loop) {
                        // Update jika sudah ada
                        $mapping_shift_loop->update([
                            'status_absen' => $request["nama_cuti"]
                        ]);
                    } else {
                        // Buat baru jika belum ada
                        MappingShift::create([
                            'user_id'     => $cuti->user_id,
                            'tanggal'     => $date->format('Y-m-d'),
                            'status_absen' => $request["nama_cuti"]
                        ]);
                    }
                }
            } else if ($request["nama_cuti"] == "Izin Masuk") {
                $user->update([
                    'izin_lainnya' => $user->izin_lainnya - 1
                ]);

                if ($mapping_shift) {
                    $mapping_shift->update([
                        'status_absen' => $request["nama_cuti"]
                    ]);
                } else {
                    MappingShift::create([
                        'user_id' => $cuti->user_id,
                        'tanggal' => $cuti->tanggal,
                        'status_absen' => $request["nama_cuti"]
                    ]);
                }
            } else if ($request["nama_cuti"] == "Izin Telat") {
                if ($mapping_shift) {
                    $user->update([
                        'izin_telat' => $user->izin_telat - 1
                    ]);
                    $mapping_shift->update([
                        'jam_absen' => $mapping_shift->Shift->jam_masuk,
                        'telat' => 0,
                        'lat_absen' => $user->Lokasi->lat_kantor,
                        'long_absen' => $user->Lokasi->long_kantor,
                        'jarak_masuk' => 0,
                        'foto_jam_absen' => $cuti->foto_cuti,
                        'status_absen' => $request["nama_cuti"],
                    ]);
                } else {
                    $cuti->update(['status_cuti' => 'Pending']);
                    Alert::error('Failed', 'Anda Belum Absen Masuk Pada Tanggal Tersebut');
                    return redirect('/data-cuti');
                }
            } else {
                if ($mapping_shift) {
                    $user->update([
                        'izin_pulang_cepat' => $user->izin_pulang_cepat - 1
                    ]);

                    $mapping_shift->update([
                        'jam_pulang' => $mapping_shift->Shift->jam_keluar,
                        'lat_pulang' => $user->Lokasi->lat_kantor,
                        'long_pulang' => $user->Lokasi->long_kantor,
                        'pulang_cepat' => 0,
                        'jarak_pulang' => 0,
                        'foto_jam_pulang' => $cuti->foto_cuti,
                        'status_absen' => $request["nama_cuti"],
                    ]);
                } else {
                    $cuti->update(['status_cuti' => 'Pending']);
                    Alert::error('Failed', 'Anda Belum Absen Masuk Pada Tanggal Tersebut');
                    return redirect('/data-cuti');
                }
            }

            $type = 'Approved';
            $notif = $cuti->nama_cuti . ' Kamu Sudah Disetujui';
            $url = url('/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  'Informasi',
                'type' => $cuti->nama_cuti,
                'amount' => $jumlahHari,
                'validation' => 'to_user',
                'message'   =>  $notif,
                'action'   =>  '/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal,
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);

            // $settings = settings::first();
            // if ($settings->wa_api_url) {
            //     Http::get($settings->wa_api_url, [
            //         'session' => $settings->wa_session,
            //         'to' => $user->whatsapp($user->telepon),
            //         'text' =>  $notif . "\n\n" . $url,
            //     ]);
            // }
        } else if ($cutiValidasi->status_cuti == "Ditolak") {
            $type = 'Rejected';
            $notif = $cuti->nama_cuti . ' Kamu Ditolak Oleh ' . auth()->user()->name;
            $url = url('/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'type' => $cuti->nama_cuti,
                'amount' => 0,
                'validation' => 'ditolak',
                'message'   =>  $notif,
                'action'   =>  '/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);

            // $settings = settings::first();
            // if ($settings->wa_api_url) {
            //     Http::get($settings->wa_api_url, [
            //         'session' => $settings->wa_session,
            //         'to' => $user->whatsapp($user->telepon),
            //         'text' =>  $notif . "\n\n" . $url,
            //     ]);
            // }
        }

        $request->session()->flash('success', 'Data Berhasil di Update');
        return redirect('/data-cuti');
    }

    public function approveLeader(Request $request, $id)
    {
        date_default_timezone_set('Asia/Makassar');

        $cuti = Cuti::find($id);
        $validated['leader_approval'] = auth()->user()->id;
        $validated['name_leader_approval'] = auth()->user()->name;
        $cuti->update($validated);

        $stat_cuti = '';
        if ($cuti->user_approval and $cuti->leader_approval) {
            $stat_cuti = 'Diterima';
        } else if (!$cuti->user_approval and !$cuti->leader_approval) {
            $stat_cuti = 'Pending';
        } else if (!$cuti->user_approval and $cuti->leader_approval) {
            $stat_cuti = 'Pending';
        } else if ($cuti->user_approval and !$cuti->leader_approval) {
            $stat_cuti = 'Pending';
        } else if ($cuti->status_cuti == 'Ditolak') {
            $stat_cuti = 'Ditolak';
        }

        $validated['status_cuti'] = $stat_cuti;
        $cuti->update($validated);

        $cutiValidasi = Cuti::find($id);
        $user = User::find($cuti->user_id);
        $mapping_shift = MappingShift::where('tanggal', $cutiValidasi->tanggal)->where('user_id', $cuti->user_id)->first();


        // dd($cutiValidasi->nama_cuti);
        $jumlahHari = 0;

        if ($cutiValidasi->status_cuti == "Diterima") {
            if ($cutiValidasi->nama_cuti == "Cuti") {
                // Hitung jumlah hari cuti
                $startDate = Carbon::parse($cuti->tanggal_mulai);
                $endDate   = Carbon::parse($cuti->tanggal_akhir);

                // +1 karena inclusive (misal 10–13 = 4 hari)
                $jumlahHari = $startDate->diffInDays($endDate) + 1;

                // Update izin_cuti sesuai jumlah hari
                $user->update([
                    'izin_cuti' => $user->izin_cuti - $jumlahHari
                ]);

                // Loop semua tanggal dari mulai sampai akhir
                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    $mapping_shift_loop = MappingShift::where('tanggal', $date->format('Y-m-d'))
                        ->where('user_id', $cuti->user_id)
                        ->first();

                    if ($mapping_shift_loop) {
                        // Update jika sudah ada
                        $mapping_shift_loop->update([
                            'status_absen' => $cutiValidasi->nama_cuti
                        ]);
                    } else {
                        // Buat baru jika belum ada
                        MappingShift::create([
                            'user_id'     => $cuti->user_id,
                            'tanggal'     => $date->format('Y-m-d'),
                            'status_absen' => $cutiValidasi->nama_cuti
                        ]);
                    }
                }
                // Batas
                // $user->update([
                //     'izin_cuti' => $user->izin_cuti - 1
                // ]);

                // if ($mapping_shift) {
                //     $mapping_shift->update([
                //         'status_absen' => $cutiValidasi->nama_cuti
                //     ]);
                // } else {
                //     MappingShift::create([
                //         'user_id' => $cuti->user_id,
                //         'tanggal' => $cuti->tanggal,
                //         'status_absen' => $cutiValidasi->nama_cuti
                //     ]);
                // }
            } else if ($cutiValidasi->nama_cuti == "Replace Off") {
                // Hitung jumlah hari cuti
                $startDate = Carbon::parse($cuti->tanggal_mulai);
                $endDate   = Carbon::parse($cuti->tanggal_akhir);

                // +1 karena inclusive (misal 10–13 = 4 hari)
                $jumlahHari = $startDate->diffInDays($endDate) + 1;

                // Update izin_ro sesuai jumlah hari
                $user->update([
                    'izin_ro' => $user->izin_ro - $jumlahHari
                ]);

                // Loop semua tanggal dari mulai sampai akhir
                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    $mapping_shift_loop = MappingShift::where('tanggal', $date->format('Y-m-d'))
                        ->where('user_id', $cuti->user_id)
                        ->first();

                    if ($mapping_shift_loop) {
                        // Update jika sudah ada
                        $mapping_shift_loop->update([
                            'status_absen' => $cutiValidasi->nama_cuti
                        ]);
                    } else {
                        // Buat baru jika belum ada
                        MappingShift::create([
                            'user_id'     => $cuti->user_id,
                            'tanggal'     => $date->format('Y-m-d'),
                            'status_absen' => $cutiValidasi->nama_cuti
                        ]);
                    }
                }
                // Batas
                // $user->update([
                //     'izin_ro' => $user->izin_ro - 1
                // ]);

                // if ($mapping_shift) {
                //     $mapping_shift->update([
                //         'status_absen' => $cutiValidasi->nama_cuti
                //     ]);
                // } else {
                //     MappingShift::create([
                //         'user_id' => $cuti->user_id,
                //         'tanggal' => $cuti->tanggal,
                //         'status_absen' => $cutiValidasi->nama_cuti
                //     ]);
                // }
            } else if ($request["nama_cuti"] == "Sakit") {
                // Hitung jumlah hari cuti
                $startDate = Carbon::parse($cuti->tanggal_mulai);
                $endDate   = Carbon::parse($cuti->tanggal_akhir);

                // +1 karena inclusive (misal 10–13 = 4 hari)
                $jumlahHari = $startDate->diffInDays($endDate) + 1;

                // Loop semua tanggal dari mulai sampai akhir
                for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                    $mapping_shift_loop = MappingShift::where('tanggal', $date->format('Y-m-d'))
                        ->where('user_id', $cuti->user_id)
                        ->first();

                    if ($mapping_shift_loop) {
                        // Update jika sudah ada
                        $mapping_shift_loop->update([
                            'status_absen' => $cutiValidasi->nama_cuti
                        ]);
                    } else {
                        // Buat baru jika belum ada
                        MappingShift::create([
                            'user_id'     => $cuti->user_id,
                            'tanggal'     => $date->format('Y-m-d'),
                            'status_absen' => $cutiValidasi->nama_cuti
                        ]);
                    }
                }
            }

            $type = 'Approved';
            $notif = $cuti->nama_cuti . ' Kamu Sudah Disetujui';
            $url = url('/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  'Informasi',
                'type' => $cuti->nama_cuti,
                'amount' => $jumlahHari,
                'validation' => 'to_user',
                'message'   =>  $notif,
                'action'   =>  '/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);

            // $settings = settings::first();
            // if ($settings->wa_api_url) {
            //     Http::get($settings->wa_api_url, [
            //         'session' => $settings->wa_session,
            //         'to' => $user->whatsapp($user->telepon),
            //         'text' =>  $notif . "\n\n" . $url,
            //     ]);
            // }
        } else if ($cutiValidasi->status_cuti == "Ditolak") {
            $type = 'Rejected';
            $notif = $cuti->nama_cuti . ' Kamu Ditolak Oleh ' . auth()->user()->name;
            $url = url('/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'type' => $cuti->nama_cuti,
                'amount' => 0,
                'validation' => 'ditolak',
                'message'   =>  $notif,
                'action'   =>  '/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);
        }

        // $cutiValidasi = Cuti::find($id);
        // $user = User::find($cuti->user_id);
        // if ($cutiValidasi->status_cuti == 'Diterima') {
        //     $type = 'Approved';
        //     $notif = $cuti->nama_cuti . ' Anda Telah Diterima';
        //     $url = url('/cuti?mulai='.$cuti->tanggal.'&akhir='.$cuti->tanggal);

        //     $user->messages = [
        //         'user_id'   =>  auth()->user()->id,
        //         'from'   =>  'Informasi',
        //         'message'   =>  $notif,
        //         'action'   =>  '/cuti?mulai='.$cuti->tanggal.'&akhir='.$cuti->tanggal
        //     ];
        //     $user->notify(new \App\Notifications\UserNotification);

        //     NotifApproval::dispatch($type, $user->id, $notif, $url);
        // }

        $request->session()->flash('success', 'Approval Success');
        return redirect($cuti->url_redirect);
    }

    public function rejectLeader(Request $request, $id)
    {
        date_default_timezone_set('Asia/Makassar');

        $cuti = Cuti::find($id);
        $validated['status_cuti'] = 'Ditolak';
        $cuti->update($validated);

        $cutiValidasi = Cuti::find($id);

        $user = User::find($cuti->user_id);
        $type = 'Rejected';
        $notif = $cuti->nama_cuti . ' Kamu Ditolak Oleh ' . auth()->user()->name;
        $url = url('/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal);

        $user->messages = [
            'user_id'   =>  auth()->user()->id,
            'from'   =>  'Ditolak',
            'type' => $cuti->nama_cuti,
            'amount' => 0,
            'validation' => 'ditolak',
            'message'   =>  $notif,
            'action'   =>  '/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal
        ];
        $user->notify(new \App\Notifications\UserNotification);

        NotifApproval::dispatch($type, $user->id, $notif, $url);

        $request->session()->flash('success', 'Reject Success');
        return redirect($cuti->url_redirect);
    }

    public function rejectAdmin(Request $request, $id)
    {
        date_default_timezone_set('Asia/Makassar');

        $cuti = Cuti::find($id);
        $validated['status_cuti'] = 'Ditolak';
        $cuti->update($validated);

        $cutiValidasi = Cuti::find($id);

        $user = User::find($cuti->user_id);
        $type = 'Rejected';
        $notif = $cuti->nama_cuti . ' Kamu Ditolak Oleh ' . auth()->user()->name;
        $url = url('/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal);

        $user->messages = [
            'user_id'   =>  auth()->user()->id,
            'from'   =>  'Ditolak',
            'type' => $cuti->nama_cuti,
            'amount' => 0,
            'validation' => 'ditolak',
            'message'   =>  $notif,
            'action'   =>  '/cuti-data-apps?cuti_id=' . $cutiValidasi->id . '&user_id=' . $cutiValidasi->user_id . '&mulai=' . $cuti->tanggal . '&akhir=' . $cuti->tanggal
        ];
        $user->notify(new \App\Notifications\UserNotification);

        NotifApproval::dispatch($type, $user->id, $notif, $url);

        $request->session()->flash('success', 'Reject Success');
        return redirect('/data-cuti');
    }

    public function downloadFile($id)
    {
        $cuti = Cuti::findOrFail($id);

        if ($cuti->foto_cuti && Storage::disk('public')->exists($cuti->foto_cuti)) {
            return Storage::disk('public')->download($cuti->foto_cuti);
        }

        return redirect()->back()->with('error', 'File surat sakit tidak ditemukan.');
    }
}
