<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderRequestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_request_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->foreign('order_id')->references('id')->on('order_requests')->onDelete('cascade');
            $table->integer('order_item_id')->nullable();
            $table->unsignedBigInteger('item_id')->foreign('item_id')->references('id')->on('order_items')->onDelete('cascade');
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
        Schema::dropIfExists('order_request_items');
    }
}
