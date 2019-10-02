<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charas', function (Blueprint $table) {
            $table->bigIncrements('chara_id');
            $table->string('chara_name',100);
            $table->text('chara_profile');
            $table->integer('register_id');
            $table->string('chara_birthday',100);
            $table->string('chara_picture',100);
            $table->string('chara_castingtitle',100);
            $table->string('chara_parent',100);
            $table->string('chara_gender',100);
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
        Schema::dropIfExists('charas');
    }
}
