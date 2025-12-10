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
        Schema::table('users', function (Blueprint $table) {
            // Make password nullable
            $table->string('password')->nullable()->change();
            
            // Add role_id column referencing roles table
            $table->foreignId('role_id')
                ->nullable()
                ->after('email')
                ->constrained('roles')
                ->onDelete('set null');

            // Add bank_id column referencing bankdetails table
            $table->foreignId('bank_id')
                ->nullable()
                ->after('role_id')
                ->constrained('bankdetails')
                ->onDelete('set null');

            $table->integer("is_active")->after('image')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Safely drop foreign keys + columns
            $table->dropConstrainedForeignId('role_id');
            $table->dropConstrainedForeignId('bank_id');
            // Make password NOT NULL again
            $table->string('password')->nullable(false)->change();
            // Drop is_active column
            $table->dropColumn('is_active');
            

        });
    }
};
