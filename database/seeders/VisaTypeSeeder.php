<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VisaType;

class VisaTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VisaType::create([
            'VisaTypeName' => 'Single',
            'VisaTypeNameMM' => 'တစ်ကြိမ်',
        ]);

        VisaType::create([
            'VisaTypeName' => 'Multiple',
            'VisaTypeNameMM' => 'အကြိမ်ကြိမ်',
        ]);
    }
}
