<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redcliffcart extends Model
{
    protected $fillable = ["package_id", "vendor_id", "user_id","price"];

    public function vendor()
    {


        return $this->belongsTo(Vendor::class, "vendor_id");
    }

    public function package()
    {

        return $this->belongsTo(Newpackage::class, "package_id");
    }

}
