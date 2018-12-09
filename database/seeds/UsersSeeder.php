<?php

use Illuminate\Database\Seeder;

use App\User;

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
        $u->password = $u->password = Hash::make("admin");
        $u->role_id = 1; // Administrator
        $u->save();

        $u = new User();
        $u->name = 'Petra';
        $u->surname = 'Kramar';
        $u->address = '--';
        $u->email = "petra@ep.si";
        $u->phone = "--";
        $u->password = $u->password = Hash::make("petra");
        $u->role_id = 2; // Prodajalec
        $u->save();

        $u = new User();
        $u->name = 'Albert';
        $u->surname = 'Gostiša';
        $u->address = '--';
        $u->email = "albert@ep.si";
        $u->phone = "--";
        $u->password = $u->password = Hash::make("albert");
        $u->role_id = 2; // Prodajalec
        $u->save();

        $u = new User();
        $u->name = 'Janez';
        $u->surname = 'Brodarič';
        $u->address = 'Janezova 16\n1000 Ljubljana';
        $u->email = "janez@ep.si";
        $u->phone = "031442546";
        $u->password = $u->password = Hash::make("janez");
        $u->role_id = 3; // Administrator
        $u->save();

    }
}
