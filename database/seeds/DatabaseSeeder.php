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
        $this->call(HouseSeeder::class); 
        $this->call(HomeInformationSeeder::class);   
        $this->call(HomePhotoSeeder::class);   
        // $this->call(CommentSeeder::class);
        $this->call(PostSeeder::class);
        // $this->call(VoteSeeder::class);
        $this->call(BannerImageSeeder::class);
    }
}
