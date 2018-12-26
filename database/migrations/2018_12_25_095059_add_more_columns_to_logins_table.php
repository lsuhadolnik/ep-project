<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreColumnsToLoginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logins', function (Blueprint $table) {
            $table->ipAddress('ip_address');
            $table->string('user_agent');

            $table->string('api_location')->nullable();

            DB::statement("ALTER TABLE logins MODIFY COLUMN `type` 
                ENUM('login', 'logout', 'api_request') 
            NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logins', function (Blueprint $table) {
            $table->dropColumn('ip_address');
            $table->dropColumn('user_agent');

            $table->dropColumn('api_location');

            DB::statement("ALTER TABLE logins MODIFY COLUMN `type` ENUM('login', 'logout') NOT NULL");
        });
    }
}
