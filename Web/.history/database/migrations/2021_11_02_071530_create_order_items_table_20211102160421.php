<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['DIARY', 'SOY', 'PROCESSED_MEAT', 'FRUIT', 'VEGETABLES',
       'SHELF_ITEM', 'BAKERY', 'SMOKEDFISH', 'FRESH_POULTRY',
       'FROZEN_ITEM', 'PESTO', 'DELI_ITEM', 'CONDIMENTS', 'FRESH_MEAT',
       'CRACKERS', 'PROCESSED_POULTRY', 'DOUGH', 'FISH', 'SHELLFISH',
       'BAKING', 'BEVERAGES', 'COOKIES', 'PASTA', 'N/A']);
            $table->string('name')->nullable();
            $table->string('expiry_period')->nullable();
            $table->integer('exp_min')->nullable();
            $table->integer('exp_max')->nullable();
            $table->string('exp_unit')->nullable();
            $table->enum('status', [null, 'unopened', 'opened', 'Do not freeze', 'fresh', 'Whole', 'G',
       'Cooked and mashed', 'Balls', 'Whole peeled', 'Cooked', 'Shredded',
       'Sliced, lemon juice & sugar', 'Do not defrost. Cook frozen.',
       'vacuum pkg', 'skin will blacken', 'After baking',
       'Use entire can', 'Mix entire packet', 'Use all',
       'Cool, dark place', 'popped', 'N/A'])->nullable();
            $table->enum('storage', ['REFRIGERATED', 'FROZEN', 'SHELF', 'THAWED', 'N/A']);
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
        Schema::dropIfExists('order_items');
    }
}
