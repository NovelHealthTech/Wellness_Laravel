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
            $table->integer('user_id');
            $table->json('package_ids')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('user_id_on_phonepe');
            $table->string('phone_pe_merchant_id');
            $table->string('phone_pe_transaction_id');
           
            $table->string('payment_status');
            $table->integer('amount_in_paise');
            $table->timestamps();
            // Add indexes for better query performance
            $table->index('user_id');
            $table->index('phone_pe_transaction_id');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhtorders');
    }
};
