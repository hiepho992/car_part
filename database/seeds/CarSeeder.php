<?php

use App\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = new Car();
        $cars->id = 1;
        $cars->name = "Fadil";
        $cars->classcar_id = 1;
        $cars->save();

        $cars = new Car();
        $cars->id = 2;
        $cars->name = "A7";
        $cars->classcar_id = 2;
        $cars->save();

        $cars = new Car();
        $cars->id = 3;
        $cars->name = "C300";
        $cars->classcar_id = 3;
        $cars->save();


    }
}
