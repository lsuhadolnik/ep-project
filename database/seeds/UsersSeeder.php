<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $r = new Role(); $r->id = 1; $r->name = "Administrator"; $r->save();
        $r = new Role(); $r->id = 2; $r->name = "Prodajalec";    $r->save();
        $r = new Role(); $r->id = 3; $r->name = "Stranka";       $r->save();

        $u = new User();
        $u->name = 'Administrator';
        $u->surname = '--';
        $u->address = '--';
        $u->email = "admin@ep.si";
        $u->phone = "--";
        $u->password = "hello!";
        $u->role_id = 1; // Administrator
        $u->save();

        $u = new User();
        $u->name = 'Petra';
        $u->surname = 'Kramar';
        $u->address = '--';
        $u->email = "prod@ep.si";
        $u->phone = "--";
        $u->password = "hello!";
        $u->role_id = 2; // Prodajalec
        $u->save();

        $u = new User();
        $u->name = 'Albert';
        $u->surname = 'Gostiša';
        $u->address = '--';
        $u->email = "albert@ep.si";
        $u->phone = "--";
        $u->password = "albert";
        $u->role_id = 2; // Prodajalec
        $u->save();

        $u = new User();
        $u->name = 'Janez';
        $u->surname = 'Brodarič';
        $u->address = 'Janezova 16';
        $u->email = "janez@ep.si";
        $u->phone = "031442546";
        $u->password = "janez";
        $u->role_id = 3; // Stranka
        $u->save();

        $u->rateProduct(1, 5, $u->id);
        $u->rateProduct(2, 4, $u->id);
        $u->rateProduct(3, 3, $u->id);
        $u->rateProduct(4, 1, $u->id);
        $u->rateProduct(6, 1, $u->id);
        $u->rateProduct(5, 1, $u->id);

    }
}
