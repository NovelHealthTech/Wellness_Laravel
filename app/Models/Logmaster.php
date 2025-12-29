<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logmaster extends Model
{
    protected $fillable = [
        'table_name',
        'main_id_number',
        'data_before_updation',
        'data_after_updation',
    ];
}
