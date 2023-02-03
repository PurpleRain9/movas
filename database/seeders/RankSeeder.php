<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rank;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rank::create([
            'RankName' => 'Reviewer',
            'RankNameMM' => 'တာဝန်ခံ',
            'SortOrder' => '1',
        ]);

        Rank::create([
            'RankName' => 'AD',
            'RankNameMM' => 'လက်ထောက်ညွှန်ကြားရေးမှူး',
            'SortOrder' => '2',
        ]);

        Rank::create([
            'RankName' => 'DD',
            'RankNameMM' => 'ဒုတိယညွှန်ကြားရေးမှူး',
            'SortOrder' => '3',
        ]);

        Rank::create([
            'RankName' => 'Director',
            'RankNameMM' => 'ညွှန်ကြားရေးမှူး',
            'SortOrder' => '4',
        ]);

        Rank::create([
            'RankName' => 'DDG',
            'RankNameMM' => 'ဒု-ညွှန်ချုပ်',
            'SortOrder' => '5',
        ]);

        Rank::create([
            'RankName' => 'OSSL',
            'RankNameMM' => 'အလုပ်သမား',
            'SortOrder' => '6',
        ]);

        Rank::create([
            'RankName' => 'OSSI',
            'RankNameMM' => 'လဝက',
            'SortOrder' => '7',
        ]);
    }
}
