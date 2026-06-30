<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChecklistController extends Model
{
    use HasFactory;

    protected $table = 'crm_checklist';
    protected $primaryKey = 'id_checklist';
    public $incrementing = true;

    protected $fillable = [
        'name_field',
        'required_field',
        'width_box',
        'order_by',
    ];
}
