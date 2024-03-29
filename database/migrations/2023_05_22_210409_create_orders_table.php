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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->startingValue(1200);
            $table->enum('status', ['pending', 'recieved', 'fulfilling', 'shipped', 'completed', 'declined'])->default('pending');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('cart_id')->unique()->nullable()->constrained();
            $table->foreignId('recipient_id')->nullable()->constrained();
            $table->string('payment_intent')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
