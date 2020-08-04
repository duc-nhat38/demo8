<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employeeCode')->unique();
            $table->string('fullName');
            $table->string('address');
            $table->string('phone');
            $table->string('work');

            $table->integer('employee_id')->unsigned();
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
        Schema::dropIfExists('employee_information');
    }
}
