<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('imageAddress');
            $table->integer('employee_id')->unsigned();
            $table->string('renter');
            $table->string('show')->default(0);
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
        Schema::dropIfExists('banner_images');
    }
}
