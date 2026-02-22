<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurgicalAssistance extends Model
{
    protected $fillable = [
        'user_id',
        'patient_name',
        'patient_mobile',
        'patient_city',
        'patient_disease',
        'status',
    ];
}
