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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poster_id')->constrained();
            $table->string('name', 75);
            $table->text('description', 250)->nullabel(); 
            $table->date('date');
            $table->bigInteger('white_player')->unsigned()->nullable()->index();
            $table->bigInteger('black_player')->unsigned()->nullable()->index();
            $table->boolean('world_championship_game');
            $table->foreignId('opening_id')->constrained();
            $table->timestamps();

            $table->foreign('white_player')->references('id')->on('players');
            $table->foreign('black_player')->references('id')->on('players');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
