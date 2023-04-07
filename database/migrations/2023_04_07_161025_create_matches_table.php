<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teamHomeId');
            $table->unsignedBigInteger('teamAwayId');
            $table->dateTime('date');
            $table->string('season', 9);
            $table->timestamps();

            $table->foreign('teamHomeId')->references('id')->on('teams');
            $table->foreign('teamAwayId')->references('id')->on('teams');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
};
