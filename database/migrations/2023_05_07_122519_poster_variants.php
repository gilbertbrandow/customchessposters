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
        Schema::create('poster_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poster_size_id')->constrained();
            $table->foreignId('poster_frame_id')->nullable()->constrained();
            $table->string('description');
            $table->integer('price');
            $table->integer('variant_id');
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
        Schema::dropIfExists('poster_variants');
    }
};
