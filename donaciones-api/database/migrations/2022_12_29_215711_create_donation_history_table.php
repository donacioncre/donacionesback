<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_histories', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('hemoglobin')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('note')->nullable();
            $table->boolean('status')->default(false);
            $table->bigInteger('schedule_id');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('schedules', function (Blueprint $table) {

            $table->string('type_donation')->nullable();
           

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donation_histories');

        Schema::table('schedules', function($table) {
            $table->dropColumn('type_donation');
           
        });
    }
}
