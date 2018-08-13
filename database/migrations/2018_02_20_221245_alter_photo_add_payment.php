<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPhotoAddPayment extends Migration
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

            $table->integer('advertistment_payment_id')->unsigned()->nullable();

            $table->foreign('advertistment_payment_id')
                ->references('id')
                ->on('advertistment_payment')
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

            $table->dropForeign(['advertistment_payment_id']);
            $table->dropColumn('advertistment_payment_id');
        });
    }
}
