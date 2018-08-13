<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAdvertisementType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertistment', function (Blueprint $table) {
            //

            $table->integer('select_advertisement_type_id')->nullable()->unsigned();

            $table->foreign('select_advertisement_type_id')
                ->on('select_advertisement_type')
                ->references('id')
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
        Schema::table('advertistment', function (Blueprint $table) {
            //

            $table->dropForeign(['select_advertisement_type_id']);
            $table->dropColumn('select_advertisement_type_id');
        });
    }
}
