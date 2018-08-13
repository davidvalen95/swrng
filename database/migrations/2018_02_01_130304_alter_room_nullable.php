<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRoomNullable extends Migration
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

            $table->string('city')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('priceHalfDay')->nullable()->change();
            $table->string('locationMap')->nullable()->change();
            $table->string('description')->nullable()->change();
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
            $table->string('city')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('priceFullDay')->nullable()->change();
            $table->string('priceHalfDay')->nullable()->change();
            $table->string('locationMap')->nullable()->change();

            $table->string('description')->nullable()->change();

        });
    }
}
