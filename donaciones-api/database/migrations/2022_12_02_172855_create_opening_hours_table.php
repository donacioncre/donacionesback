<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpeningHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_donation_hours', function (Blueprint $table) {
            $table->id();
            $table->integer('days');
            $table->time('start_time');
            $table->time('end_time');
            $table->bigInteger('donation_id');
            $table->foreign('donation_id')->references('id')->on('donation_points')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('platelet_donation_hours', function (Blueprint $table) {
            $table->id();
            $table->integer('days');
            $table->time('start_time');
            $table->time('end_time');
            $table->bigInteger('donation_id');
            $table->foreign('donation_id')->references('id')->on('donation_points')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opening_hours');
    }
}
