<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplier_name');
            $table->string('Beneficiary_name');
            $table->string("supllier_phone")->unique();
            $table->string("supllier_phoneOther")->unique()->nullable();
            $table->string("supllier_address1");
            $table->string("Commercial_Record")->unique()->nullable();
            $table->string("Tax_card")->unique()->nullable();
            $table->string("Type_of_supply");
            $table->string("status",10);
            $table->string("Type_of_pay",10);
            $table->softDeletes();
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
        Schema::dropIfExists('suppliers');
    }
}