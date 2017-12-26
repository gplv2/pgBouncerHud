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
            $table->integer('bouncer_id')->unsigned()->unique()->nullable($value = false);
            $table->string('label')->unique();
            $table->integer('category_id')->unsigned();
            $table->string('dsn')->unique();
            $table->integer('priority')->unsigned()->default(0);
            $table->string('description');
            $table->boolean('enabled')->default(0)->nullable($value = false);
            $table->string('tag')->nullable($value = true);
            $table->string('role')->nullable($values = true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bouncers');
    }
}
