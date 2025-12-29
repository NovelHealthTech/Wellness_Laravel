<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhtOrder extends Model
{
      protected $fillable = [
        'user_id',
        'package_ids',
        'customer_id',
        'user_id_on_phonepe',
        'phone_pe_merchant_id',
        'phone_pe_transaction_id',
        'service_name',
        'payment_status',
        'amount_in_paise',
    ];

}
