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
        Schema::create('newpackages', function (Blueprint $table) {
            $table->id();
           $table->string("packagename");
           $table->string("price");  
           $table->string("discount");
           $table->string("image");
           $table->boolean("status");
           $table->foreignId("vendor_id")->constrained("vendors");
           $table->string("description")->nullable();
           $table->string("note")->nullable();
           $table->string("type")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newpackages');
    }
};
