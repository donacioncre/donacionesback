<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBloodDonationHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        

        Schema::table('blood_donation_hours', function (Blueprint $table) {

            $table->time('start_time_1')->nullable();
            $table->time('end_time_1')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blood_donation_hours', function($table) {
            $table->dropColumn('start_time_1');
            $table->dropColumn('end_time_1');
        });
    }
}
