<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nht_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");
            $table->foreignId("package_id")->constrained("newpackages")->onDelete("cascade");
            $table->integer('customer_id')->nullable();
            $table->string('user_id_on_phonepe', 255);
            $table->string('phone_pe_merchant_id', 255);
            $table->string('phone_pe_transaction_id', 255);
            $table->string('service_name', 255);
            $table->string('payment_status', 255);
            $table->integer('amount_in_paise');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nht_orders');
    }
};
