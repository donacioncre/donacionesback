<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumsDeleteActiveTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('convocations', function (Blueprint $table) {

            $table->softDeletes();

        });
        Schema::table('donation_points', function (Blueprint $table) {

            $table->boolean('status')->default(true);
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {

            $table->boolean('status')->default(true);
            $table->softDeletes();

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('donation_points', function($table) {
            $table->dropColumn('status');

        });

        Schema::table('users', function($table) {
            $table->dropColumn('status');

        });
    }
}
