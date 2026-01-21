<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Srlorder extends Model
{
    protected $fillable = [
        "user_id",
        "nht_order_id",
        "package_ids",
        "title",
        "first_name",
        "last_name",
        "gender",
        "dob",
        "email",
        "mobile",
        "alternate_mobile",
        "state",
        "city",
        "location",
        "pincode",
        "dobFlag",
        "address",
        "booking_date",
        "collection_date",
        "status",
        "is_payment",
        "order_reference_no",
        "is_cancel_order",
        "is_phelbo_assigned",
        "is_download_report",
    ];
}
