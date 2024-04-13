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
        Schema::table('posters', function (Blueprint $table) {
            $table->string('to')->after('fen')->nullable();
            $table->string('from')->after('to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poster', function (Blueprint $table) {
            $table->dropColumn('to');
            $table->dropColumn('from');
        });
    }
};
