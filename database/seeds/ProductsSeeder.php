<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\Producer;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Producer::create(["name"=> "Gorenje", "description"=>"Gorenje je slovensko podjetje, ki izdeluje in prodaja gospodinjske aparate ter belo tehniko. Podjetje je med največjimi slovenskimi neto izvozniki – izvozi 90 % konsolidiranih čistih prihodkov od prodaje. Spada med osem največjih proizvajalcev gospodinjskih aparatov v Evropi s 4 % tržnim deležem. Letna proizvodnja in prodaja znaša 3,7 milijona velikih gospodinjskih aparatov - podjetje prodaja v več kot 70 državah sveta."]);
        Producer::create(["name"=> "Electrolux", "description"=>"Electrolux shapes living for the better by reinventing taste, care and wellbeing experiences, making life more enjoyable and sustainable for millions of people."]);

        $p = new Product();
        $p->name = "Test";
        $p->description = "Test test";
        $p->producer_id = 1;
        $p->price = 12.02;
        $p->save();

    }
}