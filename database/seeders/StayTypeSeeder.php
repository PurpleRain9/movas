<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StayType;

class StayTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StayType::create([
            'StayTypeName' => '3 Month',
            'StayTypeNameMM' => '၃ လ',
        ]);

        StayType::create([
            'StayTypeName' => '6 Month',
            'StayTypeNameMM' => '၆ လ',
        ]);

        StayType::create([
            'StayTypeName' => '1 Year',
            'StayTypeNameMM' => '၁ နှစ်',
        ]);
    }
}
