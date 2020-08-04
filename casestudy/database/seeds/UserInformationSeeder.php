<?php

use App\Models\UserInformation;
use Illuminate\Database\Seeder;

class UserInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserInformation::class, 5)->create();
    }
}
