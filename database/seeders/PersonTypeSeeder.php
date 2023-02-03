<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonType;

class PersonTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonType::create([
            'PersonTypeName' => 'Director',
            'PersonTypeNameMM' => 'ဒါရိုက်တာ',
        ]);

        PersonType::create([
            'PersonTypeName' => 'Secretary',
            'PersonTypeNameMM' => 'အတွင်းရေးမှူး',
        ]);

        PersonType::create([
            'PersonTypeName' => 'Technician',
            'PersonTypeNameMM' => 'ပညာရှင်',
        ]);

        PersonType::create([
            'PersonTypeName' => 'Dependant',
            'PersonTypeNameMM' => 'မှီခို',
        ]);
    }
}
