<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newpackage extends Model
{
    protected $fillable = [
        'packagename',
        'price',
        'discount',
        'image',
        'package_code',
        'status',
        'vendor_id',
        'description',
        'note',
        'type',
        "vendor_price"
    ];

    public function vendor(){


        return $this->belongsTo(Vendor::class,"vendor_id");




    }

}
