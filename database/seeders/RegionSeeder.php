<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create([
            'RegionName' => 'Kachin State',
            'RegionNameMM' => 'ကချင်ပြည်နယ်',
        ]);

        Region::create([
            'RegionName' => 'Kayah State',
            'RegionNameMM' => 'ကယားပြည်နယ်',
        ]);

        Region::create([
            'RegionName' => 'Karen State',
            'RegionNameMM' => 'ကရင်ပြည်နယ်',
        ]);

        Region::create([
            'RegionName' => 'Chin State',
            'RegionNameMM' => 'ချင်းပြည်နယ်',
        ]);

        Region::create([
            'RegionName' => 'Mon State',
            'RegionNameMM' => 'မွန်ပြည်နယ်',
        ]);

        Region::create([
            'RegionName' => 'Rakhine State',
            'RegionNameMM' => 'ရခိုင်ပြည်နယ်',
        ]);

        Region::create([
            'RegionName' => 'Shan State',
            'RegionNameMM' => 'ရှမ်းပြည်နယ်',
        ]);

        Region::create([
            'RegionName' => 'Naypyitaw Region',
            'RegionNameMM' => 'နေပြည်တော်တိုင်းဒေသကြီး',
        ]);

        Region::create([
            'RegionName' => 'Sagaing Region',
            'RegionNameMM' => 'စစ်ကိုင်းတိုင်းဒေသကြီး',
        ]);

        Region::create([
            'RegionName' => 'Tanintharyi Region',
            'RegionNameMM' => 'တနင်္သာရီတိုင်းဒေသကြီး',
        ]);

        Region::create([
            'RegionName' => 'Bago Region',
            'RegionNameMM' => 'ပဲခူးတိုင်းဒေသကြီး',
        ]);

        Region::create([
            'RegionName' => 'Magway Region',
            'RegionNameMM' => 'မကွေးတိုင်းဒေသကြီး',
        ]);

        Region::create([
            'RegionName' => 'Mandalay Region',
            'RegionNameMM' => 'မန္တလေးတိုင်းဒေသကြီး',
        ]);

        Region::create([
            'RegionName' => 'Yangon Region',
            'RegionNameMM' => 'ရန်ကုန်တိုင်းဒေသကြီး',
        ]);

        Region::create([
            'RegionName' => 'Ayeyarwady Region',
            'RegionNameMM' => 'ဧရာဝတီတိုင်းဒေသကြီး',
        ]);
    }
}
