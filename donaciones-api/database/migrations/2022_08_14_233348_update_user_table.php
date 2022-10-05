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


        Schema::create('rols', function (Blueprint $table) {

            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();

        });

        Schema::create('rol_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('rol_id');
            $table->foreign('rol_id')->references('id')->on('rols')->onDelete('cascade');

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
            $table->dropColumn('date_birth');
            $table->dropColumn('address');
            $table->dropColumn('country');
            $table->dropColumn('city');
            $table->dropColumn('phone');
            $table->dropColumn('profile_picture');

            $table->dropColumn('overview');
        });

        Schema::dropIfExists('rol_user');
        Schema::dropIfExists('rols');

    }
}
