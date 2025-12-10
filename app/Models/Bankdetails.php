<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bankdetails extends Model
{
   protected $fillable = ["beneficiary_name","branch_name","account_no","ifsc_code","cancelcheckpdf"];



   public function user(){
    return $this->belongsTo(User::class,"bank_id");
   }
   
}
