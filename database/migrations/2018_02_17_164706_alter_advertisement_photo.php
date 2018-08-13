<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdvertisementPhoto extends Migration
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

            $table->integer("advertistment_id")->unsigned()->nullable();

            $table->foreign("advertistment_id")
                ->references('id')
                ->on('advertistment')
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

            $table->dropForeign(["advertistment_id"]);
            $table->dropColumn("advertistment_id");
        });
    }
}
