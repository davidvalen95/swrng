<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRoomCapacities2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('room', function (Blueprint $table) {
            //
            $table->integer('capacityClass')->nullable();
            $table->integer('capacityUShape')->nullable();
            $table->integer('capacityTheatre')->nullable();
            $table->string('roomFunction')->nullable();
            $table->dropColumn("function");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('room', function (Blueprint $table) {
            //
            $table->string("function");

            $table->dropColumn(["capacityClass","capacityUShape","capacityTheater","roomFunction"]);
        });
    }
}
