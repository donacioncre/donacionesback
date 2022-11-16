<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMythsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myths', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('details')->default('N/A');
            $table->timestamps();
        });

        Schema::create('myth_details', function (Blueprint $table) {
            $table->id();
            $table->string('ask')->nullable();
            $table->string('answer')->nullable();
            $table->string('image')->nullable();
            $table->bigInteger('myths_id');
            $table->foreign('myths_id')->references('id')->on('myths')->onDelete('cascade');
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
        Schema::dropIfExists('myth_details');
        Schema::dropIfExists('myths');
    }
}
