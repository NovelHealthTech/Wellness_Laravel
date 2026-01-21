<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendorpricenht extends Model
{
    protected $fillable = ['package_id',"vendor_id","nht_price","vendor_price","package_code"];


   public function package(){

    return $this->belongsTo(Newpackage::class,"package_id");


   }


}
