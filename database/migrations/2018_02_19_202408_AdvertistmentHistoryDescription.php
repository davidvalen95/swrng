<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdvertistmentHistoryDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertistment_history_description', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('advertistment_id')->unsigned()->nullable();
            $table->foreign('advertistment_id')
                ->references('id')
                ->on('advertistment')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('description');
            $table->string('status');
            $table->string('invoice');
            $table->string('price');
            $table->boolean("isPaid")->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertistment_history_description');
    }
}
