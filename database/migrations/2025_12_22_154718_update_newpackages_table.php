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
        /**
         * STEP 1: DROP OLD FOREIGN KEYS FIRST
         */

       
        Schema::table('newpackages', function (Blueprint $table) {

            if (Schema::hasColumn('newpackages', 'vendor_id')) {
                $table->dropForeign(['vendor_id']);
            }

            $table->longText('description')->change();


        });

        /**
         * STEP 2: DROP OLD COLUMNS
         */
        Schema::table('newpackages', function (Blueprint $table) {

            if (Schema::hasColumn('newpackages', 'vendor_id')) {
                $table->dropColumn('vendor_id');
            }

            if (Schema::hasColumn('newpackages', 'price')) {
                $table->dropColumn('price');
            }

            if (Schema::hasColumn('newpackages', 'vendor_price')) {
                $table->dropColumn('vendor_price');
            }


            if (Schema::hasColumn('newpackages', 'image')) {
                $table->dropColumn('image');
            }
        });

        /**
         * STEP 3: ADD NEW FK
         */

    }

    public function down(): void
    {
        /**
         * STEP 1: DROP NEW FK
         */


        /**
         * STEP 2: RESTORE OLD COLUMNS
         */
        Schema::table('newpackages', function (Blueprint $table) {

            

            $table->string('description')->change();

            if (!Schema::hasColumn('newpackages', 'price')) {
                $table->decimal('price', 10, 2)->nullable();
            }

            if (!Schema::hasColumn('newpackages', 'vendor_price')) {
                $table->decimal('vendor_price', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('newpackages', 'image')) {
                $table->longText('image')->nullable();
            }

           


            if (!Schema::hasColumn('newpackages', 'package_code')) {
                $table->decimal('package_code')->nullable();
            }

            if (!Schema::hasColumn('newpackages', 'vendor_id')) {
                $table->foreignId('vendor_id')
                    ->nullable()
                    ->constrained('vendors')
                    ->nullOnDelete();
            }
        });
    }
};
