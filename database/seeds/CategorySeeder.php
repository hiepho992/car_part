<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = new Category();
        $categories->id = 1;
        $categories->name = "đèn";
        $categories->save();

        $categories = new Category();
        $categories->id = 2;
        $categories->name = "Lốp";
        $categories->save();

        $categories = new Category();
        $categories->id = 3;
        $categories->name = "Phanh";
        $categories->save();

    }
}
