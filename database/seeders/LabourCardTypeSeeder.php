<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LabourCardType;

class LabourCardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LabourCardType::create([
            'LabourCardTypeName' => 'New',
            'LabourCardTypeMM' => 'အသစ်လျှောက်',
        ]);

        LabourCardType::create([
            'LabourCardTypeName' => 'Renew',
            'LabourCardTypeMM' => 'သက်တမ်းတိုး',
        ]);
    }
}
