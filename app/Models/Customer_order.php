<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer_order extends Model
{
    protected $fillable = [
        'user_id',
        'collection_slot_id',
        'booking_id',
        'nht_order_id',
        'pk',
        'customer_name',
        'customer_gender',
        'customer_phonenumber',
        'customer_whatsappnumber',
        'customer_age',
        'booking_date',
        'collection_date',
        'pincode',
        'customer_address',
        'customer_landmark',
        'customer_latitude',
        'customer_longitude',
        'package_id',
        'package_code',
        'status',
        'is_payment',
        'is_credit',
        'rescheduled',
        'cancelled',
        'phleboassigned',
        'pickup',
        'samplesync',
        'consolidatereport',
        'order_status',
        'customer_packages',
    ];


    protected $casts = [
        'customer_packages' => 'array',
    ];

}
