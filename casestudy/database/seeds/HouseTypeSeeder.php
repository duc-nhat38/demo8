<?php

use App\Models\HouseType;
use Illuminate\Database\Seeder;

class HouseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(HouseType::class, 3)->create();
    }
}
