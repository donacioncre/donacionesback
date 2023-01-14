<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDonationCenterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_donation_center', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->bigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('donation_id');
            $table->foreign('donation_id')->references('id')->on('donation_points')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('blood_donor_appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->bigInteger('donation_hours_id');
            $table->foreign('donation_hours_id')->references('id')->on('blood_donation_hours')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('platelet_donor_appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->bigInteger('donation_hours_id');
            $table->foreign('donation_hours_id')->references('id')->on('platelet_donation_hours')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('platelet_donation_hours', function (Blueprint $table) {

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
        Schema::dropIfExists('user_donation_center');
    }
}
