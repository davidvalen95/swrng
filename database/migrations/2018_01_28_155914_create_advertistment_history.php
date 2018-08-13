<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertistmentHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertistment_history', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('advertistment_id')->unsigned();
            $table->foreign('advertistment_id')
                ->references('id')
                ->on('advertistment')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->dateTime('applyDate')->nullable();
            $table->dateTime('confirmedDate')->nullable();
            $table->integer('duration')->nullable();
            $table->string('invoiceNumber')->nullable();

            $table->index('confirmedDate')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertistment_history');
    }
}
