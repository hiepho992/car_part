<?php

use App\Maker;
use Illuminate\Database\Seeder;

class MakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $makers = new Maker();
        $makers->id = 1;
        $makers->name = "VinFast";
        $makers->save();

        $makers = new Maker();
        $makers->id = 2;
        $makers->name = "Audi";
        $makers->save();

        $makers = new Maker();
        $makers->id = 3;
        $makers->name = "Mercedes-Benz";
        $makers->save();
    }
}
