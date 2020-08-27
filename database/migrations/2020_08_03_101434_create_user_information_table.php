<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullName')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('role')->default(0);      
            $table->string('locked')->default(0);     
            $table->string('avatar')->default('none.jpg');
            $table->timestamps();
            $table->softDeletes();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_information');
    }
}
