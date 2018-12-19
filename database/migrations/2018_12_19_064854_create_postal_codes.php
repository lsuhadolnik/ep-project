<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostalCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_codes', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('name');

        });

        Schema::table('users', function (Blueprint $table) {

            $table->unsignedInteger('postal_code')->nullable();
            $table->foreign('postal_code')->references('id')->on('postal_codes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('postal_code_id_foreign');
        });
        
        Schema::dropIfExists('postal_codes');
    }
}
