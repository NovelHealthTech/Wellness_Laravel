<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration {
    public function up(): void
    {
        Schema::table('newpackages', function (Blueprint $table) {
            // Add vendor_price column if not exists
            if (!Schema::hasColumn('newpackages', 'vendor_price')) {
                $table->integer('vendor_price')->nullable()->after('price');
            }

            // Make discount nullable
            $table->string('discount')->nullable()->change();

            // Change columns to longText
            $table->longText("description")->change();
            $table->longText("note")->nullable()->change();
            $table->longText("type")->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newpackages', function (Blueprint $table) {
            // Drop vendor_price if exists
            if (Schema::hasColumn('newpackages', 'vendor_price')) {
                $table->dropColumn('vendor_price');
            }

            // Fill NULL discount values before making NOT NULL
            DB::table('newpackages')->whereNull('discount')->update(['discount' => '']);

            // Revert discount to NOT NULL
            $table->string('discount')->nullable(false)->change();

            // Revert other columns back to string
            $table->string('description')->change();
            $table->string('note')->change();
            $table->string("type")->change();
        });
    }


};
