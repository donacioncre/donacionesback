<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnDonationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('donation_points', function (Blueprint $table) {
            $table->boolean('blood')->default(true);
            $table->boolean('platelet')->default(false);
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
            $table->dropColumn('blood');
            $table->dropColumn('platelet');
        });
    }
}
