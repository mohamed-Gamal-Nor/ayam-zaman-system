<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_pays', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->double('value');
            $table->bigInteger('number_recipet')->nullable();
            $table->bigInteger('number_check')->nullable();
            $table->date('date_check')->nullable();
            $table->text('note')->nullable();
            $table->text("document")->nullable();
            $table->date("date_pay");
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
        Schema::dropIfExists('supplier_pays');
    }
}