<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Illuminate\Support\Facades\DB;

class CreateProductsFulltextIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement('ALTER TABLE products  ADD FULLTEXT products_fulltext_index  (name, description)');
        DB::statement('ALTER TABLE producers ADD FULLTEXT producers_fulltext_index (name)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE products  DROP FULLTEXT products_fulltext_index');
        DB::statement('ALTER TABLE producers DROP FULLTEXT producers_fulltext_index');
    }
}
