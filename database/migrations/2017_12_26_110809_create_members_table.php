<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cluster_id')->unsigned()->nullable($value = false);
            $table->integer('bouncer_id')->unsigned()->nullable($value = false);
            $table->timestamps();

            $table->foreign('cluster_id')->references('cluster_id')->on('clusters')->onDelete('cascade');
            $table->foreign('bouncer_id')->references('bouncer_id')->on('bouncers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
