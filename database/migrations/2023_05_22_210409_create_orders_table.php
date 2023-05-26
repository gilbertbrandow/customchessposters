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
            $table->enum('status', ['pending', 'processing', 'completed', 'declined'])->default('pending');
            $table->foreignId('user_id')->nullable()->constrained();
            $table->string('session_token')->nullable();
            $table->foreignId('cart_id')->nullable()->constrained();
            $table->foreignId('shipping_addresses_id')->nullable()->constrained();
            $table->string('shipping')->nullable();
            $table->integer('shipping_cost')->default(0);
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
