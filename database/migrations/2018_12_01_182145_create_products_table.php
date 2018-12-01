<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description');
            $table->unsignedInteger('producer_id')->nullable();
            $table->enum('status', ['active', 'disabled'])->default('active');
            $table->double('price');
            $table->timestamps();


	    $table->foreign('producer_id')->references('id')->on('producers');
        });

        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->unsignedInteger('image_id');
            $table->unsignedInteger('product_id');
            $table->integer('place_index')->nullable();

	    $table->foreign('image_id')->references('id')->on('images');
	    $table->foreign('product_id')->references('id')->on('products');
        });

        Schema::create('product_ratings', function (Blueprint $table) {
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
            $table->integer('rating');

	    $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('images');
        Schema::dropIfExists('product_ratings');
        Schema::dropIfExists('products');
        Schema::dropIfExists('producers');
    }
}
