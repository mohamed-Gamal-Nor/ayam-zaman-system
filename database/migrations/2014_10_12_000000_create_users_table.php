<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('id');
            $table->string('user_fname');
            $table->string('user_lname');
            $table->string('email')->unique();
            $table->string("user_phone")->unique();
            $table->string("user_phoneOther")->unique()->nullable();
            $table->string("user_nationalID")->unique();
            $table->string("user_address1");
            $table->string("user_address2")->nullable();
            $table->string("user_gender");
            $table->date("user_birth")->nullable();
            $table->date("user_work")->nullable();
            $table->text("user_image")->nullable();
            $table->string("user_jopName");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('roles_name');
            $table->string("status",10);
            $table->text("user_bio")->nullable();
            $table->text("user_Github")->nullable();
            $table->text("user_Twitter")->nullable();
            $table->text("user_Linkedin")->nullable();
            $table->text("user_FaceBook")->nullable();
            $table->text("user_Portfolio")->nullable();
            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('section_u_sers')->onDelete('cascade');
            $table->softDeletes();
            $table->tinyInteger("theme_mode");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}