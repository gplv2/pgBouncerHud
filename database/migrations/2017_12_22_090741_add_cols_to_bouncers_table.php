<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToBouncersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bouncers', function (Blueprint $table) {
            $table->string('tag')->nullable($value = true);
            $table->integer('cluster_id')->unsigned()->nullable($value = true);
            $table->string('role')->nullable($values = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bouncers', function (Blueprint $table) {
            //
        });
    }
}
