<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {

            $table->boolean('status')->default(true);

        });

        Schema::table('donation_points', function (Blueprint $table) {

            $table->string('whatsapp_number')->default('N/A');

        });

        Schema::table('users', function (Blueprint $table) {

            $table->string('country')->nullable();
            $table->string('city')->nullable();

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedules', function($table) {
            $table->dropColumn('status');

        });
        Schema::table('donation_points', function($table) {
            $table->dropColumn('whatsapp_number');

        });
        Schema::table('users', function($table) {
            $table->dropColumn('country');
            $table->dropColumn('city');

        });

    }
}
