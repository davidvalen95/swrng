<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoomYpe extends Migration
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

            $table->string('facility')->nullable()->change();
            $table->string('areaUnit')->nullable()->change();
            $table->integer('area')->nullable()->change();
            $table->text('description')->change();
            $table->integer('capacity')->nullable()->change();
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

            $table->string('facility')->nullable()->change();
            $table->string('areaUnit')->nullable()->change();
            $table->integer('area')->nullable()->change();
            $table->text('description')->change();
            $table->integer('capacity')->nullable()->change();
        });
    }
}
