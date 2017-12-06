<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnabledToBouncersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bouncers', function (Blueprint $table) {
            $table->boolean('enabled')->default(0)->nullable($value = false);
            //
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
