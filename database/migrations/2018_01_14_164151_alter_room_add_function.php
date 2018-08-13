<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRoomAddFunction extends Migration
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
            $table->dropForeign(['fungsi_ruang_id']);
            $table->dropColumn('fungsi_ruang_id');

            $table->string('function')->nullable();
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
            $table->integer('fungsi_ruang_id')->unsigned();
            $table->foreign('fungsi_ruang_id')
                ->references('id')
                ->on('fungsi_ruang')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->dropColumn('function');


        });
    }
}
