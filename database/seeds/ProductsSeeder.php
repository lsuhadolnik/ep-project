<?php

use Illuminate\Database\Seeder;

use App\Product;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $p = new Product();
        $p->name = "Test";
        $p->description = "Test test";
        $p->producer_id = 1;
        $p->price = 12.02;
        $p->save();

    }
}