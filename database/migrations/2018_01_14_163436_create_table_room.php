<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('fungsi_ruang_id')->unsigned();
            $table->foreign('fungsi_ruang_id')
                ->references('id')
                ->on('fungsi_ruang')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('city');
            $table->string('name');
            $table->integer('capacity');
            $table->integer('area');
            $table->string('areaUnit');
            $table->string('facility');
            $table->integer('priceHalfDay');
            $table->integer('priceFullDay');
            $table->string('locationMap');
            $table->string('address');
            $table->string('status');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room');
    }
}
