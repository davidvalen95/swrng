<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPhotoName extends Migration
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
            $table->string('nameLg')->nullable();
            $table->string('nameSm')->nullable();

            $table->integer("room_id")->unsigned();
            $table->boolean('isMain')->nullable()->change();
            $table->foreign('room_id')
                ->references('id')
                ->on('room')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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

            $table->dropColumn('nameLg');
            $table->dropColumn('nameSm');
            $table->boolean('isMain')->nullable()->change();

            $table->dropForeign(['room_id']);
            $table->dropColumn('room_id');
        });
    }
}
