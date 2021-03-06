<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\Producer;
use App\Image;

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
        $p->name = "Pečica";
        $p->description = "To je super pečica";
        $p->producer_id = 1;
        $p->price = 112.02;
        $p->save();

        $p = new Product();
        $p->name = "Mikrovalovka";
        $p->description = "To je super mikrovalovka";
        $p->producer_id = 1;
        $p->price = 102.02;
        $p->save();

        $p = new Product();
        $p->name = "Pralni stroj";
        $p->description = "To je super pralni stroj";
        $p->producer_id = 2;
        $p->price = 120.02;
        $p->save();

        $p = new Product();
        $p->name = "Pomivalni stroj";
        $p->description = "To je super pomivalni stroj";
        $p->producer_id = 2;
        $p->price = 125.02;
        $p->save();

        $p = new Product();
        $p->name = "Parna pečica";
        $p->description = "To je super parna pečica";
        $p->producer_id = 1;
        $p->price = 123.02;
        $p->save();

        $p = new Product();
        $p->name = "Štedilnik";
        $p->description = "To je super štedilnik";
        $p->producer_id = 1;
        $p->price = 129.02;
        $p->save();

        $i = new Image();
        $i->name = "Slika pečice";
        $i->description =  "To je slika super pečice";
        $i->path = "/slike/pecica1.jpg";
        $i->save();

        $i = new Image();
        $i->name = "Slika pečice";
        $i->description =  "To je še ena slika super pečice";
        $i->path = "/slike/pecica2.jpg";
        $i->save();

        $i = new Image();
        $i->name = "Slika pečice";
        $i->description =  "To je še ena slika super pečice";
        $i->path = "/slike/pecica3.jpg";
        $i->save();

        Product::find(1)->images()->attach(1);
        Product::find(1)->images()->attach(2);
        Product::find(1)->images()->attach(3);
        

    }
}