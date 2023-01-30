<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBloodDonorAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blood_donor_appointments', function (Blueprint $table) {
          
            $table->time('time');
           
        });

        Schema::table('platelet_donor_appointments', function (Blueprint $table) {
          
            $table->time('time');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blood_donor_appointments', function($table) {
            $table->dropColumn('time');
           
        });

        Schema::table('platelet_donor_appointments', function($table) {
            $table->dropColumn('time');
           
        });
    }
}
