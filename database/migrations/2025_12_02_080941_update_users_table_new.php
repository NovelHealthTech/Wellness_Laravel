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

            // Add role_id only if not exists
            if (!Schema::hasColumn('users', 'role_id')) {
                $table->foreignId('role_id')
                    ->nullable()
                    ->after('email')
                    ->constrained('roles')
                    ->onDelete('set null');
            }

            // Add bank_id only if not exists
            if (!Schema::hasColumn('users', 'bank_id')) {
                $table->foreignId('bank_id')
                    ->nullable()
                    ->after('role_id')
                    ->constrained('bankdetails')
                    ->onDelete('set null');
            }

            // Add is_active only if not exists
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->integer("is_active")->after('image')->nullable();
            }
        });
    }

};
