<?php

use App\Models\BusinessType;
use Illuminate\Database\Seeder;

class BusinessTypeImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BusinessType::class, 2)->create();
    }
}
