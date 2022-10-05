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
            $table->date('date_birth')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('overview')->nullable();
            //$table->string('languague')->nullable();
            $table->string('app_language')->nullable();
            //$table->string('spoken_language')->nullable();
            //$table->boolean('public_profile')->nullable();
            //$table->bigInteger('languague_id')->nullable();
            //$table->foreign('languague_id')->references('id')->on('spoken_languages')->onDelete('cascade');


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
            $table->dropColumn('app_language');
            $table->dropColumn('overview');
        });

        Schema::dropIfExists('rol_user');
        Schema::dropIfExists('rols');

    }
}
