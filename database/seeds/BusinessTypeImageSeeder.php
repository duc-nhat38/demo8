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
            ],
            [
                'typeName' => 'Nhà trọ',
            ],
            [
                'typeName' => 'Văn Phòng',
            ],
            
        ]);
    }
}
