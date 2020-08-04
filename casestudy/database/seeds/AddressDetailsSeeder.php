<?php

use App\Models\AddressDetails;
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
        factory(AddressDetails::class, 20)->create();
    }
}
