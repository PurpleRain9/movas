<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sector;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sector::create([
            'SectorName' => 'Agriculture',
            'SectorNameMM' => 'စိုက်ပျိုးရေး',
        ]);

        Sector::create([
            'SectorName' => 'Livestock & Fisheries',
            'SectorNameMM' => 'မွေးမြူရေးနှင့်ရေလုပ်ငန်း',
        ]);

        Sector::create([
            'SectorName' => 'Mining',
            'SectorNameMM' => 'သတ္တုတွင်း',
        ]);

        Sector::create([
            'SectorName' => 'Manufacturing',
            'SectorNameMM' => 'ကုန်ထုတ်လုပ်မှု',
        ]);

        Sector::create([
            'SectorName' => 'Power',
            'SectorNameMM' => 'စွမ်းအား',
        ]);

        Sector::create([
            'SectorName' => 'Oil and Gas',
            'SectorNameMM' => 'ရေနံနှင့်သဘာဝဓာတ်ငွေ့',
        ]);

        Sector::create([
            'SectorName' => 'Construction',
            'SectorNameMM' => 'ဆောက်လုပ်ရေး',
        ]);

        Sector::create([
            'SectorName' => 'Transport & Communication',
            'SectorNameMM' => 'ပို့ဆောင်ရေးနှင့်ဆက်သွယ်ရေး',
        ]);

        Sector::create([
            'SectorName' => 'Hotel & Tourism',
            'SectorNameMM' => 'ဟိုတယ်နှင့်ခရီးသွားလုပ်ငန်း',
        ]);

        Sector::create([
            'SectorName' => 'Real Estate',
            'SectorNameMM' => 'အိမ်ခြံမြေအကျိုးဆောင်',
        ]);

        Sector::create([
            'SectorName' => 'Industrial Estate',
            'SectorNameMM' => 'စက်မှုဇုန်',
        ]);

        Sector::create([
            'SectorName' => 'Other Services',
            'SectorNameMM' => 'အခြားဝန်ဆောင်မှုများ',
        ]);
    }
}
