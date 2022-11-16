<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBenefitDonatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('benefit_donating', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('details')->default('N/A');
            $table->timestamps();
        });

        Schema::create('donation_details', function (Blueprint $table) {
            $table->id();
            $table->string('points')->nullable();
            $table->bigInteger('benefit_id');
            $table->foreign('benefit_id')->references('id')->on('benefit_donating')->onDelete('cascade');
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
        Schema::dropIfExists('donation_details');
        Schema::dropIfExists('benefit_donating');
    }
}
