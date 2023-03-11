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
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->foreignId('user_id')->nullable()->constrained();
            $table->unsignedTinyInteger('theme');
            $table->boolean('orientation');
            $table->text('pgn', 500)->nullable();;
            $table->unsignedTinyInteger('diagram_position');
            $table->string('title', 50)->nullable();;
            $table->string('white_name', 50)->nullable();;
            $table->string('black_name', 50)->nullable();;
            $table->unsignedSmallInteger('white_rating')->nullable();;
            $table->unsignedSmallInteger('black_rating')->nullable();;
            $table->string('white_title')->nullable();;
            $table->string('black_title')->nullable();;
            $table->text('when', 50)->nullable();
            $table->text('where', 50)->nullable();;
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
        Schema::dropIfExists('posters');
    }
};
