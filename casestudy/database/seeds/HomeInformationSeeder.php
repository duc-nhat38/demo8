<?php

use App\Models\HomeInformation;
use Illuminate\Database\Seeder;

class HomeInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(HomeInformation::class, 20)->create();
    }
}
