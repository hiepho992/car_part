<?php

use App\ClassCar;
use Illuminate\Database\Seeder;

class ClassCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $classCars = new ClassCar();
        $classCars->id = 1;
        $classCars->name = "Fadil";
        $classCars->maker_id = 1;
        $classCars->save();

        $classCars = new ClassCar();
        $classCars->id = 2;
        $classCars->name = "Audi A";
        $classCars->maker_id = 2;
        $classCars->save();

        $classCars = new ClassCar();
        $classCars->id = 3;
        $classCars->name = "C-Class";
        $classCars->maker_id = 3;
        $classCars->save();
    }
}
