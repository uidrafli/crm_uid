<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Shift;
use App\Models\MappingShift;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ShiftsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::where('username', $row['username_pegawai'])->first();
        $shift = Shift::where('nama_shift', $row['nama_shift'])->first();

        if ($user && $shift) {
            $cek = MappingShift::where('user_id', $user->id)->where('tanggal', $row['tanggal'])->first();
            if (!$cek) {
                if ($shift->nama_shift == 'Libur') {
                    $status_absen = "Libur";
                } else {
                    $status_absen = "Tidak Masuk";
                }

                MappingShift::create([
                    "user_id" => $user->id,
                    "shift_id" => $shift->id,
                    "tanggal" => $row['tanggal'],
                    "lock_location" => $row['kunci_lokasi'] == 'Y' ? 1 : null,
                    "status_absen" => $status_absen,
                    "telat" => 0,
                    "pulang_cepat" => 0,
                ]);
            }
        }
    }
}
