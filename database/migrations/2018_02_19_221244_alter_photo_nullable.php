<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPhotoNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photo', function (Blueprint $table) {
            //

            $table->integer('room_id')
                ->unsigned()
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photo', function (Blueprint $table) {
            //
            $table->integer('room_id')
                ->unsigned()
                ->nullable()
                ->change();
        });
    }
}
