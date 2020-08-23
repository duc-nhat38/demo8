<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignkeyHomeInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('home_photos', function (Blueprint $table) {
            $table->foreign('house_id')->references('id')->on('houses');
        });
        Schema::table('home_information', function (Blueprint $table) {
            $table->foreign('house_id')->references('id')->on('houses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home_photos', function (Blueprint $table) {
            //
        });
        Schema::table('home_information', function (Blueprint $table) {
            //
        });
    }
}
