<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


        Schema::table('users', function (Blueprint $table) {

            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('identification')->nullable();
            $table->string('blood_type')->nullable();

            $table->string('phone_number')->nullable();
            $table->string('conventional_number')->nullable();

            $table->date('date_birth')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('profile_picture');
            $table->dropColumn('identification');
            $table->dropColumn('blood_type');
            $table->dropColumn('phone_number');
            $table->dropColumn('conventional_number');
            $table->dropColumn('date_birth');
        });

    }
}
