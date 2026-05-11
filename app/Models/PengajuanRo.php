<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanRo extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_ro';

    protected $fillable = [
        'user_id',
        'user_name',
        'subject',
        'nama_acara',
        'tanggal_acara',
        'lokasi',
        'durasi',
        'deskripsi',
        'approval_status',
        'approval_id',
        'approval_name',
    ];
}
