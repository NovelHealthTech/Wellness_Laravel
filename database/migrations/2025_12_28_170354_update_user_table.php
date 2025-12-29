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

            $table->integer('otp')->after("mobile")->nullable();
            $table->boolean("is_loggedin")->after("otp")->nullable();
            $table->date("dob")->after("otp")->nullable();
            $table->string("gender")->after("dob")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
     Schema::table("users",function(Blueprint $table){

        $table->dropColumn("otp");
        $table->dropColumn("is_loggedin");
        $table->dropColumn("dob");
        $table->dropColumn("gender");
    
     });



    }
};
