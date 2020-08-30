<?php

use App\Models\BusinessType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTypeImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_types')->insert([
            [
                'typeName' => 'Nhà ở',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],
            [
                'typeName' => 'Nhà trọ',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],
            [
                'typeName' => 'Văn Phòng',
                'created_at' => '2020-08-13 05:48:14',
                'updated_at' => '2020-08-13 05:48:14',
            ],
            
        ]);
    }
}
