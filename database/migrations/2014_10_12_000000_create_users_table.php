<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname')->nullable();
            $table->text('address')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->enum('status', ['active', 'disabled'])->default('active');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

	    $table->unsignedInteger('role_id');
	    $table->foreign('role_id')->references('id')->on('roles');

        });

	Schema::create('logins', function (Blueprint $table) {


		$table->increments('id');
		$table->timestamps();	
		$table->enum('type', ['login', 'logout']);
		$table->unsignedInteger('user_id');

		$table->foreign('user_id')->references('id')->on('users');

	});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	Schema::dropIfExists('logins');
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');

    }
}
