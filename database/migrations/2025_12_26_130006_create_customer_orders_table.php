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
        Schema::create('customer_orders', function (Blueprint $table) {
           
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('collection_slot_id');
            $table->unsignedBigInteger('booking_id');
            $table->integer('nht_order_id')->nullable();
            $table->unsignedBigInteger('pk');
            $table->string('customer_name');
            $table->string('customer_gender', 20);
            $table->string('customer_phonenumber', 20);
            $table->string('customer_whatsappnumber', 20);
            $table->integer('customer_age')->nullable();
            $table->json("customer_packages");
            $table->date('booking_date');
            $table->date('collection_date');
            $table->string('pincode', 20);
            $table->text('customer_address');
            $table->string('customer_landmark');
            $table->double('customer_latitude')->nullable();
            $table->double('customer_longitude')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_payment')->default(0);
            $table->boolean('is_credit')->default(true);
            $table->timestamps();
            $table->json('rescheduled')->nullable();
            $table->json('cancelled')->nullable();
            $table->json('phleboassigned')->nullable();
            $table->json('pickup')->nullable();
            $table->json('samplesync')->nullable();
            $table->json('consolidatereport')->nullable();
            $table->string('order_status')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_orders');
    }
};
