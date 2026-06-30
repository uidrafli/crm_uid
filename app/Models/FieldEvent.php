<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldEvent extends Model
{
    use HasFactory;

    protected $table = 'crm_event_fields';
    protected $primaryKey = 'id_event_fields';
    public $incrementing = true;

    protected $fillable = ['events_form_id', 'label', 'name', 'type', 'options', 'required'];
    protected $casts = ['options' => 'array'];
    public function event()
    {
        return $this->belongsTo(RegistrationForm::class);
    }
}
