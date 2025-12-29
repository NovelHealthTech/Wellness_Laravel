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
        Schema::create('redcliffcarts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("package_id")->constrained("newpackages")->nullable()->onDelete("cascade");
            $table->foreignId("vendor_id")->constrained("vendors")->nullable()->onDelete("cascade");
            $table->foreignId("user_id")->constrained("users")->nullable()->onDelete("cascade");
            $table->bigInteger("price");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redcliffcarts');
    }
};
