<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBouncersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bouncers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label')->unique();
            $table->integer('category_id')->unsigned();
            $table->string('dsn')->unique();
            $table->integer('priority')->unsigned()->default(0);
            $table->string('description');
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
        Schema::drop('bouncers');
    }
}
