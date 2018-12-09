<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('product_ratings', function (Blueprint $table) {
            
            $table->unique(['user_id', 'product_id'], 'unique_user_product_rating');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('product_ratings', function (Blueprint $table) {
            
            $table->dropUnique('unique_user_product_rating');

        });

    }
}
