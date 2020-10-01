<?php

use App\ClassCar;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(MakerSeeder::class);
        $this->call(ClassCarSeeder::class);
        $this->call(CarSeeder::class);
    }
}
