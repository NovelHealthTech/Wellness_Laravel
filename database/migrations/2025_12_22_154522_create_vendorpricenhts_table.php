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
        Schema::create('vendorpricenhts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("package_id")->constrained("newpackages")->onDelete("cascade");
            $table->foreignId("vendor_id")->constrained("vendors")->onDelete("cascade");
            $table->longText("package_code")->nullable();
            $table->integer("vendor_price")->nullable();
            $table->integer("nht_price")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendorpricenhts');
    }
};
