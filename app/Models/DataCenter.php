<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCenter extends Model
{
    use HasFactory;

    protected $table = 'crm_data_center';
    protected $primaryKey = 'id_data_center';
    public $incrementing = true;

    protected $fillable = [
        'key_events',
        'name_events',
        'salutation',
        'fullname',
        'email',
        'phone',
        'institution',
        'position',
        'sector',
        'field',
        'country',
        'qrcode_registration',
        'presence',
        'send_mail',
        'status',
        'status_users',
        'condition_at',
        'updated_at',
        'created_at',
    ];
}
