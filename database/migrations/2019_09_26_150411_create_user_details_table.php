<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('pass');
            $table->string('l_kana',100);
            $table->string('l_name',100);
            $table->string('f_kana',100);
            $table->string('f_name',100);
            $table->text('u_profile',100)->nullable();
            $table->date('birthday');
            $table->string('gender');
            $table->string('u_img', 100)->nullable();
            $table->string('u_back_img', 100)->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
