<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationForm extends Model
{
    use HasFactory;

    protected $table = 'events_form';
    protected $primaryKey = 'id_events_form';
    public $incrementing = true;

    protected $fillable = [
        'user_id',
        'users_role',
        'key_events',
        'title',
        'location',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'logo',
        'logo_size',
        'logo_size_mobile',
        'type_event',
        'custome_link',
        'qrcode_link',
        'description',
        'salutation',
        'salutation_required',
        'fullname',
        'fullname_required',
        'email',
        'email_required',
        'phone',
        'phone_required',
        'institution',
        'institution_required',
        'position',
        'position_required',
        'sector',
        'sector_required',
        'field',
        'field_required',
        'country',
        'country_required',
        'status',
        'condition_at',
        'updated_at',
        'created_at',
    ];
}
