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
        Schema::create('poster_collection', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poster_id')->constrained();
            $table->string('name', 100);
            $table->date('when');

            $table->integer('white_player')->unsigned(); 
            $table->foreign('white_player')->references('id')->on('players'); 
            
            $table->integer('black_player')->unsigned();
            $table->foreign('black_player')->references('id')->on('players');

            $table->boolean('world_championship_game');

            $table->integer('opening')->unsigned(); 
            $table->foreign('opening')->references('id')->on('openings'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poster_collection');
    }
};
