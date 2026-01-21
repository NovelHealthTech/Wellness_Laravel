<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('srlorders', function (Blueprint $table) {

            // ❌ Drop foreign key constraint
            $table->dropForeign(['package_id']);

            // ❌ Drop old column
            $table->dropColumn('package_id');
        });

        Schema::table('srlorders', function (Blueprint $table) {

            // ✅ Add new JSON column
            $table->json('package_ids')->after('nht_order_id');
        });
    }

    public function down(): void
    {
        Schema::table('srlorders', function (Blueprint $table) {

            // ❌ Drop new column
            $table->dropColumn('package_ids');
        });

        Schema::table('srlorders', function (Blueprint $table) {

            // ✅ Restore old column with FK
            $table->foreignId('package_id')
                ->constrained('newpackages')
                ->onDelete('cascade')
                ->after('nht_order_id');
        });
    }
};
