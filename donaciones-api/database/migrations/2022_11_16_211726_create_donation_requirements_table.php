<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donation_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('details')->default('N/A');
            $table->timestamps();
        });

        Schema::create('requirement_details', function (Blueprint $table) {
            $table->id();
            $table->string('points')->nullable();
            $table->string('points_details')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('requirement_id');
            $table->foreign('requirement_id')->references('id')->on('donation_requirements')->onDelete('cascade');
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
        Schema::dropIfExists('requirement_details');
        Schema::dropIfExists('donation_requirements');
    }
}
