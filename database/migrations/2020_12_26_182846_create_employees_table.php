<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('id');
            $table->integer('employees_finger');
            $table->string('employees_name');
            $table->string('email')->unique()->nullable();
            $table->string("employees_phone")->unique();
            $table->string("employees_nationalID")->unique();
            $table->string("employees_address");
            $table->string("employees_gender");
            $table->string("employees_jopName");
            $table->integer("employees_salary");
            $table->string("date_salary");
            $table->date("employees_birth")->nullable();
            $table->date("employees_work");
            $table->string("stauts");
            $table->softDeletes();
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('section_u_sers')->onDelete('cascade');
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
        Schema::dropIfExists('employees');
    }
}