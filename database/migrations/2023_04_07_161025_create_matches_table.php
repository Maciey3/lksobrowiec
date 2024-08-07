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
            $table->integer('homeGoals')->nullable();
            $table->integer('awayGoals')->nullable();
            $table->enum('type', ['liga', 'puchar', 'sparing']);
            $table->dateTime('date');
            $table->string('season', 9)->nullable();
            $table->timestamps();

            $table->foreign('teamHomeId')->references('id')->on('teams');
            $table->foreign('teamAwayId')->references('id')->on('teams');
            $table->foreign('season')->references('season')->on('seasons_labels');

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
