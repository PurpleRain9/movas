<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RelationShip;

class RelationShipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RelationShip::create([
            'RelationShipName' => 'Father',
            'RelationShipNameMM' => 'အဖေ',
        ]);

        RelationShip::create([
            'RelationShipName' => 'Mother',
            'RelationShipNameMM' => 'အမေ',
        ]);
        RelationShip::create([
            'RelationShipName' => 'Husband',
            'RelationShipNameMM' => 'ခင်ပွန်း',
        ]);

        RelationShip::create([
            'RelationShipName' => 'Wife',
            'RelationShipNameMM' => 'ဇနီး',
        ]);

        RelationShip::create([
            'RelationShipName' => 'Son',
            'RelationShipNameMM' => 'သား',
        ]);

        RelationShip::create([
            'RelationShipName' => 'Daughter',
            'RelationShipNameMM' => 'သမီး',
        ]);

        RelationShip::create([
            'RelationShipName' => 'Father-in-law',
            'RelationShipNameMM' => 'ယောက္ခထီး',
        ]);

        RelationShip::create([
            'RelationShipName' => 'Mother-in-law',
            'RelationShipNameMM' => 'ယောက္ခမ',
        ]);
    }
}
