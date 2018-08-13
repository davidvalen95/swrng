<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdvertistmentNoRef extends Migration
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
            $table->string('noRef')->nullable();
            $table->string('targetCity')->nullable();
            $table->integer('viewed')->nullable();
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
            $table->dropColumn(['noRef','targetCity','viewed']);

        });
    }
}
