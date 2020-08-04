<?php

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
        $this->call(AddressSeeder::class);
        $this->call(AddressDetailsSeeder::class);        
        $this->call(UserSeeder::class);
        $this->call(UserInformationSeeder::class);
        $this->call(BusinessTypeImageSeeder::class);
        $this->call(HouseTypeSeeder::class);
        $this->call(HomePhotoSeeder::class);
        $this->call(HomeInformationSeeder::class);
        
        $this->call(HouseSeeder::class);       
        $this->call(CommentSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(EmployeeInformationSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(VoteSeeder::class);
        
    }
}
