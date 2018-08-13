<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRoomAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public $newColumnString = [
        "buildingName",
        "capacityType",
        "roomName",
        "caterings",
        "providerTelephone"

    ];

    public $newColumnInt = [
        "totalRoom",
        "mainPrice",

    ];

    public function up()
    {
        Schema::table('room', function (Blueprint $table) {
            //


            foreach ($this->newColumnString as $value){
                $table->string($value)->nullable();

            }
            foreach ($this->newColumnInt as $value){
                $table->integer($value)->nullable();

            }
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
            $table->dropColumn($this->newColumnInt);
            $table->dropColumn($this->newColumnString);
        });
    }
}
