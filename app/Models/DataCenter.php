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
        'users_role',
        'key_events',
        'type_of_database',
        'fellows_program',
        'name_events',
        'date_events',
        'salutation',
        'fullname',
        'sex',
        'email',
        'phone',
        'institution',
        'position',
        'sector',
        'field',
        'socialmedia',
        'linkedin',
        'citylived',
        'country',
        'birthday',
        'latesteducation',
        'englishproficiency',
        'uploadfile',
        'fellowship',
        'essay',
        'roleworkshop',
        'attendance',
        'allergy',
        'meal',
        'disability',
        'language',
        'picture',
        'bio',
        'iconsent',
        'privacy',
        'availdoc',
        'custome_1',
        'custome_2',
        'custome_3',
        'custome_4',
        'custome_5',
        'custome_6',
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
