<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanRo;
use App\Models\User;
use App\Models\Cuti;
use App\Events\NotifApproval;

class PengajuanRoController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $pengajuan = PengajuanRo::latest()->get();
        return view('pengajuan_ro.index', compact('pengajuan'));
    }

    public function dataROadmin()
    {
        date_default_timezone_set('Asia/Makassar');

        $user = User::find(auth()->user()->id);
        $id = request()->input('ro_id');
        $user->update([
            'is_admin' => 'admin'
        ]);

        $users = User::when(auth()->user()->hasRole('admin'), function ($query) {
            return $query->where('lokasi_id', auth()->user()->lokasi_id);
        })
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->orderBy('name')
            ->get();

        $user_id = request()->input('user_id');
        // $mulai = request()->input('mulai');
        // $akhir = request()->input('akhir');

        $PengajuanRo = PengajuanRo::when(auth()->user()->hasRole('admin'), function ($query) {})
            // ->when($mulai && $akhir, function ($query) use ($mulai, $akhir) {
            //     return $query->whereBetween('tanggal', [$mulai, $akhir]);
            // })
            ->when($user_id, function ($query) use ($user_id) {
                return $query->where('user_id', $user_id);
            })
            ->orderBy('id', 'desc')->paginate(10)->withQueryString();

        return view('ro.dataro', [
            'title' => 'List Pengajuan Penambahan RO',
            'data' => $PengajuanRo,
            'users' => $users,
        ]);
    }

    public function dataROapps()
    {
        date_default_timezone_set('Asia/Makassar');

        $user_id = auth()->user()->id;
        $id = request()->input('ro_id');

        $PengajuanRo = PengajuanRo::when($user_id, function ($query) use ($user_id) {
            return $query->where('user_id', $user_id);
        })
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->orderBy('id', 'desc')->paginate(10)->withQueryString();

        // dd($PengajuanRo);

        return view('ro.dataroApps', [
            'title' => 'List Pengajuan Penambahan RO',
            'PengajuanRo' => $PengajuanRo,
        ]);
    }

    // Form tambah data
    public function create()
    {
        return view('ro.tambahro', [
            'title' => 'Tambah Replace Off',
        ]);
    }

    // Simpan data baru
    public function store(Request $request)
    {
        date_default_timezone_set('Asia/Makassar');

        $request->validate([
            'nama_acara' => 'required|string|max:255',
            'tanggal_acara' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'durasi' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);

        function generateKodeRO($prefix = 'RO/HRD/', $length = 6)
        {
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }

            return $prefix . $randomString;
        }

        $request['user_id'] = auth()->user()->id;
        $request['subject'] = generateKodeRO() . '/' . date('Y') . ' - ' . $request->subject;
        $request['user_name'] = auth()->user()->name;
        $request['approval_status'] = 'Pending';

        $pengajuanRo = PengajuanRo::create($request->all());

        $user_roles = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
            // ->orWhere('name', auth()->user()->user_approval_2);
        });

        $users = $user_roles->get();

        foreach ($users as $user) {
            $isAdmin = $user->roles->contains('name', 'admin');

            $action = '';
            if ($isAdmin) {
                $action = '/data-ro?user_id=' . $pengajuanRo->user_id . '&ro_id=' . $pengajuanRo->id;
            } else {
                $action = '/data-ro-apps?user_id=' . $pengajuanRo->user_id . '&ro_id=' . $pengajuanRo->id;
            }
            $type = 'Approval';
            $notif = 'Pengajuan Penambahan RO Dari ' . auth()->user()->name;
            $url = url('/data-ro?user_id=' . $pengajuanRo->user_id);

            $user->messages = [
                'user_id'   =>  auth()->user()->id,
                'from'   =>  auth()->user()->name,
                'type' => 'tambah_ro',
                'validation' => 'to_leader',
                'message'   =>  $notif,
                'action'   => $action
            ];
            $user->notify(new \App\Notifications\UserNotification);

            NotifApproval::dispatch($type, $user->id, $notif, $url);
        }

        // return redirect()->route('pengajuan_ro.store')->with('success', 'Pengajuan RO berhasil disimpan!');
        $request->session()->flash('success', 'Pengajuan RO berhasil dibuat!');
        return redirect('/data-ro-apps');
    }

    // Detail data
    public function show($id)
    {
        $pengajuan = PengajuanRo::findOrFail($id);
        return view('pengajuan_ro.show', compact('pengajuan'));
    }

    // Form edit data
    public function edit($id)
    {
        $pengajuan = PengajuanRo::findOrFail($id);
        return view('ro.edit', [
            'title' => 'Approve Pengajuan Replace Off',
            'data' => $pengajuan
        ]);
    }

    // Update data
    public function update(Request $request, $id)
    {
        date_default_timezone_set('Asia/Makassar');

        $request['approval_status'] = 'Diterima';
        $request['approval_id'] = auth()->user()->id;
        $request['approval_name'] = auth()->user()->name;

        $pengajuan = PengajuanRo::findOrFail($id);
        $pengajuan->update($request->all());

        $user = User::find($pengajuan->user_id);

        $user->update([
            'izin_ro' => $user->izin_ro + $request->jumlah_ro
        ]);

        $type = 'Approved';
        $notif = 'RO Kamu Telah Ditambahkan';
        $url = url('/data-ro-apps?user_id=' . $pengajuan->user_id . '&ro_id=' . $pengajuan->id);

        $user->messages = [
            'user_id'   =>  auth()->user()->id,
            'from'   =>  'approve_ro',
            'type' => 'Replace Off',
            'amount' => $request->jumlah_ro,
            'validation' => 'to_user',
            'message'   =>  $notif,
            'action'   =>  '/data-ro-apps?user_id=' . $pengajuan->user_id . '&ro_id=' . $pengajuan->id,
        ];
        $user->notify(new \App\Notifications\UserNotification);

        NotifApproval::dispatch($type, $user->id, $notif, $url);

        return redirect('/data-ro')->with('success', 'Pengajuan RO berhasil diperbarui!');
    }

    // Hapus data
    public function destroy($id)
    {
        $pengajuan = PengajuanRo::findOrFail($id);
        $pengajuan->delete();

        return redirect()->route('pengajuan_ro.index')->with('success', 'Pengajuan RO berhasil dihapus!');
    }
}
