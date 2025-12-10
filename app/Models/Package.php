<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table="packages";

    protected $fillable = ["name","description","package_company_id","price","vendor_price","type","note","package_code"];

}
