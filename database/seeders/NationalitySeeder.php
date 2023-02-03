<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nationality;

class NationalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Nationality::create([
            'NationalityName' => 'China',
            'NationalityNameMM' => 'China',
        ]);

        Nationality::create([
            'NationalityName' => 'Japan',
            'NationalityNameMM' => 'Japan',
        ]);

        Nationality::create([
            'NationalityName' => 'Korea',
            'NationalityNameMM' => 'Korea',
        ]);
    }
}
