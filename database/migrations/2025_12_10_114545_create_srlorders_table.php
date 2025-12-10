<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('srlorders', function (Blueprint $table) {

            $table->id();
            $table->foreignId("user_id")->constained("users")->onDelete("cascade");
            $table->string("nht_order_id")->nullable();
            $table->foreignId("package_id")->constrained("newpackages")->onDelete("cascade");
            $table->string("title");
            $table->string("first_name");
            $table->string("last_name");
            $table->string("gender");
            $table->date("dob");
            $table->string("email");
            $table->string("mobile");
            $table->string("alternate_mobile");
            $table->string("state");
            $table->string("city");
            $table->string("location");
            $table->string("pincode");
            $table->string("dobFlag");
            $table->string("address");
            $table->date("booking_date");
            $table->string("collection_date")->nullable();
            $table->integer("status")->nullable();
            $table->string("is_payment")->nullable();
            $table->string("order_reference_no")->nullable();
            $table->integer("is_cancel_order")->nullable();
            $table->longText("is_phelbo_assigned")->nullable();
            $table->integer("is_download_report")->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('srlorders');
    }
};
