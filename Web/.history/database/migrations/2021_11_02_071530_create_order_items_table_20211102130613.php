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
            $table->enum('type', ['user', 'donor', 'receiver'])->default('user');
            $table->string('name')->nullable();
            $table->string('expiry_period')->nullable();
            $table->integer('exp_min')->nullable();
            $table->integer('exp_max')->nullable();
            $table->string('exp_unit')->nullable();
            $table->enum('status', [''])->nullable();
            $table->enum('storage', [''])->nullable();
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
