<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['draft', 'active', 'fulfilled', 'cancelled'])->default('draft');
	    $table->unsignedInteger('user_id');
            $table->timestamps();

	    $table->foreign('user_id')->references('id')->on('users');
        });


	Schema::create('order_products', function (Blueprint $table) {
		$table->unsignedInteger('order_id');
		$table->unsignedInteger('product_id');
		$table->double('quantity');

		$table->foreign('order_id')->references('id')->on('orders');
		$table->foreign('product_id')->references('id')->on('products');

	});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('orders');
    }
}
