<?php

use App\Models\District;
use Illuminate\Database\Seeder;

class AddressDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(District::class, 20)->create();
    }
}
