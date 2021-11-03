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
            $table->unsignedBigInteger('order_id');
            $table->integer('total_order')->nullable();;
            $table->timestamps('order_date');
            $table->integer('order_item_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity')->nullable();
            $table->foreign('order_id')->references('id')->on('order_donations')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('order_items')->onDelete('cascade');
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
