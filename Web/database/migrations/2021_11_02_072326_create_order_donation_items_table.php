<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDonationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_donation_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->foreign('order_id')->references('id')->on('order_donations')->onDelete('cascade');
            $table->integer('order_item_id')->nullable();
            $table->unsignedBigInteger('item_id')->foreign('item_id')->references('id')->on('order_items')->onDelete('cascade');
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('order_donation_items');
    }
}
