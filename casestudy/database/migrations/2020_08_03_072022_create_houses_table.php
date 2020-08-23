<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();    
            $table->integer('district_id')->unsigned();   
            $table->integer('business_type_id')->unsigned();     
            $table->integer('price');
            $table->integer('view')->default(0);
            $table->string('expired')->default(0);

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
        Schema::dropIfExists('houses');
    }
}
