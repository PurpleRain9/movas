<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermitType;

class PermitTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermitType::create([
            'PermitTypeName' => 'Myanmar Investment Commission (MIC) Permit',
            'PermitTypeNameMM' => 'မြန်မာနိုင်ငံ ရင်းနှီးမြှုပ်နှံမှုကော်မရှင် ခွင့်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Myanmar Investment Commission (MIC) Endorsement',
            'PermitTypeNameMM' => 'မြန်မာနိုင်ငံ ရင်းနှီးမြှုပ်နှံမှုကော်မရှင် အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Kachin State Investment Committee (KCSIC) Endorsement',
            'PermitTypeNameMM' => 'ကချင်ပြည်နယ် ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Kayah State Investment Committee (KSIC) Endorsement',
            'PermitTypeNameMM' => 'ကယားပြည်နယ် ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Karen State Investment Committee (KYNIC) Endorsement',
            'PermitTypeNameMM' => 'ကရင်ပြည်နယ် ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Chin State Investment Committee (CSIC) Endorsement',
            'PermitTypeNameMM' => 'ချင်းပြည်နယ် ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Mon State Investment Committee (MSIC) Endorsement',
            'PermitTypeNameMM' => 'မွန်ပြည်နယ် ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Rakhine State Investment Committee (RSIC) Endorsement',
            'PermitTypeNameMM' => 'ရခိုင်ပြည်နယ် ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Shan State Investment Committee (SSIC) Endorsement',
            'PermitTypeNameMM' => 'ရှမ်းပြည်နယ် ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Naypyitaw Council Investment Committee (NCIC) Endorsement',
            'PermitTypeNameMM' => 'နေပြည်တော်ကောင်စီရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Sagaing Region Investment Committee (SRIC) Endorsement',
            'PermitTypeNameMM' => 'စစ်ကိုင်းတိုင်းဒေသကြီး ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Tanintharyi Region Investment Committee (TRIC) Endorsement',
            'PermitTypeNameMM' => 'တနင်္သာရီတိုင်းဒေသကြီး ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Bago Region Investment Committee (BRIC) Endorsement',
            'PermitTypeNameMM' => 'ပဲခူးတိုင်းဒေသကြီး ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Magway Region Investment Committee (MRIC) Endorsement',
            'PermitTypeNameMM' => 'မကွေးတိုင်းဒေသကြီး ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Mandalay Region Investment Committee (MRIC) Endorsement',
            'PermitTypeNameMM' => 'မန္တလေးတိုင်းဒေသကြီး ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Yangon Region Investment Committee (YRIC) Endorsement',
            'PermitTypeNameMM' => 'ရန်ကုန်တိုင်းဒေသကြီး ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);

        PermitType::create([
            'PermitTypeName' => 'Irrawaddy Region Investment Committee (ARIC) Endorsement',
            'PermitTypeNameMM' => 'ဧရာဝတီတိုင်းဒေသကြီး ရင်းနှီးမြှုပ်နှံမှုကော်မတီ အတည်ပြုမိန့်',
        ]);
    }
}
