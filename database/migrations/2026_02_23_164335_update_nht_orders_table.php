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
        Schema::table('nht_orders', function (Blueprint $table) {
            $table->dropColumn('customer_id');
            $table->json('customer_ids')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('nht_orders', function (Blueprint $table) {
            $table->dropColumn('customer_ids');
            $table->integer('customer_id')->nullable();
        });
    }
};
