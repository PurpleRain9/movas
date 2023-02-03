<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\VisaType;
use App\Models\PersonType;
use App\Models\Nationality;
use App\Models\LabourCardType;
use App\Models\StayType;
use App\Models\LabourCardDuration;
use App\Models\RelationShip;
use App\Models\VisaApplicationHead;
use App\Models\VisaApplicationHeadAttachment;
use App\Models\VisaApplicationDetail;
use App\Models\VisaApplicationDetailAttachment;
use Auth;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use DB;

class VisaApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function indexopen()
    {
        $user_id = Auth::user()->id;
        $visa_types = VisaType::all();
        $person_types = PersonType::all();
        $nationalities = Nationality::all();
        $labour_card_types = LabourCardType::all();
        $stay_types = StayType::all();
        $stay_types = StayType::all();
        $labour_card_duration = LabourCardDuration::all();
        $relation_ships = RelationShip::all();


        $profile = Profile::where([
                    ['Status', '=', '1'],
                    ['user_id', '=', $user_id],
                ])->first();

        $total_local = $profile->StaffLocalProposal + $profile->StaffLocalSurplus;
        $total_foreign = $profile->StaffForeignProposal + $profile->StaffForeignSurplus;

        $available_local = $total_local - $profile->StaffLocalAppointed;
        $available_foreign = $total_foreign - $profile->StaffForeignAppointed;
        // dd($total_local);

        $status = DB::Table('visa_application_heads')->select('Status')->where('user_id',$user_id)->get();
        //dd($status);
       

        // $user_info = DB::SELECT(
        //     'SELECT p.CompanyName,vd.PersonName,vd.PassportNo,vd.StayExpireDate,vd.visa_type_id, vd.stay_type_id, vd.labour_card_type_id FROM visa_application_heads as vh JOIN visa_application_details as vd ON vh.id=vd.visa_application_head_id JOIN profiles as p ON vh.profile_id=p.id WHERE vh.user_id='.$user_id.''
        // );
        //dd($user_info);

        return view('applicationform',compact('profile','visa_types','person_types','nationalities','labour_card_types','stay_types','labour_card_duration','relation_ships','total_local','total_foreign','available_local','available_foreign','status'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function checkTwoMonths(Request $request)
    {
        $i = 1;
        $res = 1;
        $name = '';
        $twoMonthSub = Carbon::now()->subMonths(2);

        for ($i=1; $i<=7 ; $i++) { 
            if($request->stay[$i] != ''){
                $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->name[$i])
                    ->where('ad.PassportNo', $request->passport[$i])
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

                if($check->count() != 0){
                    $res = 0;
                    $name .= $request->name[$i].', ';
                }
            }   
        }
        if($res == 1){
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Success'
                ]
            );
        }else{
            return response()->json(
                [
                    'success' => false,
                    'message' => $name
                ]
            );
        }
        
    }

    public function checkLabourType(Request $request)
    {
        $i = 1;
        $res = 1;
        $name = '';
        for ($i=1; $i<=7 ; $i++) { 
            if($request->labour[$i] == 1){
                $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->name[$i])
                    ->where('ad.PassportNo', $request->passport[$i])
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

                if($check->count() != 0){
                    $res = 0;
                    $name .= $request->name[$i].', ';
                    
                }
            }   
        }
        if($res == 1){
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Success'
                ]
            );
        }else{
            return response()->json(
                [
                    'success' => false,
                    'message' => $name
                ]
            );
        }
        
    }

    public function store(Request $request)
    {
        // Check two months ahead     
        // dd($request);
        $twoMonths = Carbon::now()->addMonths(2);
        if(!is_null($request->stay_type_id1)){            
            $stayExpiredate = $request->StayExpireDate1;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id2)){            
            $stayExpiredate = $request->StayExpireDate2;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id3)){            
            $stayExpiredate = $request->StayExpireDate3;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id4)){            
            $stayExpiredate = $request->StayExpireDate4;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id5)){            
            $stayExpiredate = $request->StayExpireDate5;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id6)){            
            $stayExpiredate = $request->StayExpireDate6;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id7)){            
            $stayExpiredate = $request->StayExpireDate7;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }

        // check labour card type with controller (double check)
        if($request->labour_card_type_id1 == 1){         
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName1)
                    ->where('ad.PassportNo', $request->PassportNo1)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();
            
            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName1. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id2 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName2)
                    ->where('ad.PassportNo', $request->PassportNo2)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName2. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id3 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName3)
                    ->where('ad.PassportNo', $request->PassportNo3)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName3. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id4 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName4)
                    ->where('ad.PassportNo', $request->PassportNo4)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName4. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id5 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName5)
                    ->where('ad.PassportNo', $request->PassportNo5)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName5. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id6 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName6)
                    ->where('ad.PassportNo', $request->PassportNo6)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName6. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id7 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName7)
                    ->where('ad.PassportNo', $request->PassportNo7)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName7. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }

        // check stay 2 month after approve with controller (double check)
        $twoMonthSub = Carbon::now()->subMonths(2);        
        if(!is_null($request->stay_type_id1)){  
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName1)
                    ->where('ad.PassportNo', $request->PassportNo1)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName1. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id2)){
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName2)
                    ->where('ad.PassportNo', $request->PassportNo2)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName2. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id3)){  
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName3)
                    ->where('ad.PassportNo', $request->PassportNo3)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName3. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id4)){
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName4)
                    ->where('ad.PassportNo', $request->PassportNo4)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName4. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id5)){  
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName5)
                    ->where('ad.PassportNo', $request->PassportNo5)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName5. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id6)){  
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName6)
                    ->where('ad.PassportNo', $request->PassportNo6)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName6. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id7)){
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName7)
                    ->where('ad.PassportNo', $request->PassportNo7)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform')->with('error',$request->PersonName7. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }

        // check inprocess state
        if (!is_null($request->PersonName1) && !is_null($request->PassportNo1)) {
      
            $visa = VisaApplicationHead::join('visa_application_details', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
                    ->where('visa_application_heads.user_id',$request->user_id)
                    ->where('visa_application_details.PersonName',$request->PersonName1)
                    ->where('visa_application_details.PassportNo',$request->PassportNo1)
                    ->where('visa_application_heads.status', '!=', 1)
                    ->count();
            if($visa == 1){
                return redirect('applyform')->with('error',$request->PersonName1.'သည်လျှောက်ထားဆဲဖြစ်နေသဖြင့်ထက်မံလျှောက်ထား၍မရပါ။');
            }
        }
        if (!is_null($request->PersonName2) && !is_null($request->PassportNo2)) {
            $visa = VisaApplicationHead::join('visa_application_details', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
                    ->where('visa_application_heads.user_id',$request->user_id)
                    ->where('visa_application_details.PersonName',$request->PersonName2)
                    ->where('visa_application_details.PassportNo',$request->PassportNo2)
                    ->where('visa_application_heads.status', '!=', 1)
                    ->count();
            if($visa == 1){
                return redirect('applyform')->with('error',$request->PersonName2.'သည်လျှောက်ထားဆဲဖြစ်နေသဖြင့်ထက်မံလျှောက်ထား၍မရပါ။');
            }
        }
        if (!is_null($request->PersonName3) && !is_null($request->PassportNo3)) {
            $visa = VisaApplicationHead::join('visa_application_details', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
                    ->where('visa_application_heads.user_id',$request->user_id)
                    ->where('visa_application_details.PersonName',$request->PersonName3)
                    ->where('visa_application_details.PassportNo',$request->PassportNo3)
                    ->where('visa_application_heads.status', '!=', 1)
                    ->count();
            if($visa == 1){
                return redirect('applyform')->with('error',$request->PersonName3.'သည်လျှောက်ထားဆဲဖြစ်နေသဖြင့်ထက်မံလျှောက်ထား၍မရပါ။');
            }
        }
        if (!is_null($request->PersonName4) && !is_null($request->PassportNo4)) {
            $visa = VisaApplicationHead::join('visa_application_details', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
                    ->where('visa_application_heads.user_id',$request->user_id)
                    ->where('visa_application_details.PersonName',$request->PersonName4)
                    ->where('visa_application_details.PassportNo',$request->PassportNo4)
                    ->where('visa_application_heads.status', '!=', 1)
                    ->count();
            if($visa == 1){
                return redirect('applyform')->with('error',$request->PersonName4.'သည်လျှောက်ထားဆဲဖြစ်နေသဖြင့်ထက်မံလျှောက်ထား၍မရပါ။');
            }
        }
        if (!is_null($request->PersonName5) && !is_null($request->PassportNo5)) {
            $visa = VisaApplicationHead::join('visa_application_details', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
                    ->where('visa_application_heads.user_id',$request->user_id)
                    ->where('visa_application_details.PersonName',$request->PersonName5)
                    ->where('visa_application_details.PassportNo',$request->PassportNo5)
                    ->where('visa_application_heads.status', '!=', 1)
                    ->count();
            if($visa == 1){
                return redirect('applyform')->with('error',$request->PersonName5.'သည်လျှောက်ထားဆဲဖြစ်နေသဖြင့်ထက်မံလျှောက်ထား၍မရပါ။');
            }
        }
        if (!is_null($request->PersonName6) && !is_null($request->PassportNo6)) {
            $visa = VisaApplicationHead::join('visa_application_details', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
                    ->where('visa_application_heads.user_id',$request->user_id)
                    ->where('visa_application_details.PersonName',$request->PersonName6)
                    ->where('visa_application_details.PassportNo',$request->PassportNo6)
                    ->where('visa_application_heads.status', '!=', 1)
                    ->count();
            if($visa == 1){
                return redirect('applyform')->with('error',$request->PersonName6.'သည်လျှောက်ထားဆဲဖြစ်နေသဖြင့်ထက်မံလျှောက်ထား၍မရပါ။');
            }
        }
        if (!is_null($request->PersonName7) && !is_null($request->PassportNo7)) {
            $visa = VisaApplicationHead::join('visa_application_details', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
                    ->where('visa_application_heads.user_id',$request->user_id)
                    ->where('visa_application_details.PersonName',$request->PersonName7)
                    ->where('visa_application_details.PassportNo',$request->PassportNo7)
                    ->where('visa_application_heads.status', '!=', 1)
                    ->count();
            if($visa == 1){
                return redirect('applyform')->with('error',$request->PersonName7.'သည်လျှောက်ထားဆဲဖြစ်နေသဖြင့်ထက်မံလျှောက်ထား၍မရပါ။');
            }
        }
        

        $ApplicantNumbers = 0;
        $VisaApply = false;
        $StayApply = false;
        $LabourCardApply = false;
        $Subject = "";

        $VisaApplySingle = false;
        $VisaApplyMultiple = false;
        $LabourCardApplyNew = false;
        $LabourCardApplyRenew = false;

        $visa_head = VisaApplicationHead::create([
            "user_id"=>$request['user_id'],
            "profile_id"=>$request['profile_id'],
            "StaffLocalProposal"=>$request['StaffLocalProposal'],
            "StaffForeignProposal"=>$request['StaffForeignProposal'],
            "StaffLocalSurplus"=>$request['StaffLocalSurplus'],
            "StaffForeignSurplus"=>$request['StaffForeignSurplus'],
            "StaffLocalAppointed"=>$request['StaffLocalAppointed'],
            "StaffForeignAppointed"=>$request['StaffForeignAppointed'],
            "FirstApplyDate"=>now(),
            "FinalApplyDate"=>now(),
            "Status"=>0,
        ]);

             $j = 0;
        $Description=$request->Description;
        $FilePath=$request->file('FilePath');
        if ($FilePath) {
            foreach ($FilePath as $file) {
                if ($file) {
                    $upload_path =public_path().'/visahead_attach/';
                    $filename = Str::random(40).'.'.$file->getClientOriginalExtension();
                    $name = '/visahead_attach/'.$filename;

                    $attach_id=VisaApplicationHeadAttachment::insertGetId([
                        'visa_application_head_id' => $visa_head->id,
                        'FilePath' => $name,
                        'Description' => $Description[$j],
                        'created_at' => now(),
                            'updated_at' => now(),
                    ]);

                    $file->move($upload_path, $filename);

                    $j++;
                }
            }
        }
        
        if (!is_null($request->nationality_id1) && !is_null($request->PersonName1) && !is_null($request->PassportNo1)) {

            if (is_null($request->labour_card_type_id1)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration1;
            }   
            $passport1 = NULL;
            $micLetter1= NULL;
            $extract1= NULL;
            $labourCard1=NULL;
            $techPassport1=NULL;
            $evidence1=NULL;
            if($request->file('passport1')){
               $passport1=$request->file('passport1');
               $passport1= $this->storeAttachments($passport1);
            }
            if($request->file('micLetter1')){
                $micLetter1=$request->file('micLetter1');
                $micLetter1= $this->storeAttachments($micLetter1);
             }
             if($request->file('extract1')){
                $extract1=$request->file('extract1');
                $extract1= $this->storeAttachments($extract1);
             }
             if($request->file('labourCard1')){
                $labourCard1=$request->file('labourCard1');
                $labourCard1= $this->storeAttachments($labourCard1);
             }
             if($request->file('techPassport1')){
                $techPassport1=$request->file('techPassport1');
                $techPassport1= $this->storeAttachments($techPassport1);
             }
             if($request->file('evidence1')){
                $evidence1=$request->file('evidence1');
                $evidence1= $this->storeAttachments($evidence1);
             }
             
            // dd($passport);
            $visa_detail1 = VisaApplicationDetail::create([
                'visa_application_head_id' => $visa_head->id,
                'nationality_id' => $request->nationality_id1,
                'PersonName' => $request->PersonName1,
                'PassportNo' => $request->PassportNo1,
                'StayAllowDate' => $request->StayAllowDate1,
                'StayExpireDate' => $request->StayExpireDate1,
                'person_type_id' => $request->person_type_id1,
                'DateOfBirth' => $request->DateOfBirth1,
                'Gender' => $request->Gender1,
                'visa_type_id' => $request->visa_type_id1,
                'stay_type_id' => $request->stay_type_id1,
                'labour_card_type_id' => $request->labour_card_type_id1,
                'labour_card_duration_id' => $labour_duration_id,
                'relation_ship_id' => $request->relation_ship_id1,
                'Remark' => $request->Remark1,
                'passport_attach'=> $passport1,
                'mic_approved_letter_attach'=> $micLetter1,
                'labour_card_attach'=> $labourCard1,
                'extract_form_attach'=> $extract1,
                'technician_passport_attach'=> $techPassport1,
                'evidence_attach'=> $evidence1,
            ]);

            if (!is_null($request->visa_type_id1)) {
                $VisaApply = true;

                if ($request->visa_type_id1==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id1==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id1)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id1)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id1==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id1==2){
                    $LabourCardApplyRenew = true;
                }
            }
            $ApplicantNumbers += 1;

            // dd($VisaApplyMultiple);

            $i = 0;
            $Description1=$request->Description1;
            $FilePath1=$request->file('FilePath1');
            if ($FilePath1) {
                foreach ($FilePath1 as $file1) {
                    if ($file1) {
                        $upload_path1 =public_path().'/visadetail_attach/';
                        $filename1 = $visa_detail1->id.'_'.Str::random(40).'.'.$file1->getClientOriginalExtension();
                        $name1 = '/visadetail_attach/'.$filename1;

                        $attach_id1=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail1->id,
                            'FilePath' => $name1,
                            'Description' => $Description1[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                            
                        ]);

                        $file1->move($upload_path1, $filename1);

                        $i++;
                    }
                }
            }
        }
            
            if (!is_null($request->nationality_id2) && !is_null($request->PersonName2) && !is_null($request->PassportNo2)) {

            if (is_null($request->labour_card_type_id2)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration2;
            }
            $passport2 = NULL;
            $micLetter2= NULL;
            $extract2= NULL;
            $labourCard2=NULL;
            $techPassport2=NULL;
            $evidence2=NULL;
            if($request->file('passport2')){
                $passport2=$request->file('passport2');
                $passport2= $this->storeAttachments($passport2);
             }
             if($request->file('micLetter2')){
                 $micLetter2=$request->file('micLetter2');
                 $micLetter2= $this->storeAttachments($micLetter2);
              }
              if($request->file('extract2')){
                 $extract2=$request->file('extract2');
                 $extract2= $this->storeAttachments($extract2);
              }
              if($request->file('labourCard2')){
                 $labourCard2=$request->file('labourCard2');
                 $labourCard2= $this->storeAttachments($labourCard2);
              }
              if($request->file('techPassport2')){
                 $techPassport2=$request->file('techPassport2');
                 $techPassport2= $this->storeAttachments($techPassport2);
              }
              if($request->file('evidence2')){
                 $evidence2=$request->file('evidence2');
                 $evidence2= $this->storeAttachments($evidence2);
              }

            $visa_detail2 = VisaApplicationDetail::create([
                'visa_application_head_id' => $visa_head->id,
                'nationality_id' => $request->nationality_id2,
                'PersonName' => $request->PersonName2,
                'PassportNo' => $request->PassportNo2,
                'StayAllowDate' => $request->StayAllowDate2,
                'StayExpireDate' => $request->StayExpireDate2,
                'person_type_id' => $request->person_type_id2,
                'DateOfBirth' => $request->DateOfBirth2,
                'Gender' => $request->Gender2,
                'visa_type_id' => $request->visa_type_id2,
                'stay_type_id' => $request->stay_type_id2,
                'labour_card_type_id' => $request->labour_card_type_id2,
                'labour_card_duration_id' => $labour_duration_id,
                'relation_ship_id' => $request->relation_ship_id2,
                'Remark' => $request->Remark2,
                'passport_attach'=> $passport2,
                'mic_approved_letter_attach'=> $micLetter2,
                'labour_card_attach'=> $labourCard2,
                'extract_form_attach'=> $extract2,
                'technician_passport_attach'=> $techPassport2,
                'evidence_attach'=> $evidence2,
            ]);


            if (!is_null($request->visa_type_id2)) {
                $VisaApply = true;

                if ($request->visa_type_id2==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id2==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id2)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id2)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id2==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id2==2){
                    $LabourCardApplyRenew = true;
                }

            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description2=$request->Description2;
            $FilePath2=$request->file('FilePath2');
            if ($FilePath2) {
                foreach ($FilePath2 as $file2) {
                    if ($file2) {
                        $upload_path2 =public_path().'/visadetail_attach/';
                        $filename2 = $visa_detail2->id.'_'.Str::random(40).'.'.$file2->getClientOriginalExtension();
                        $name2 = '/visadetail_attach/'.$filename2;

                        $attach_id2=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail2->id,
                            'FilePath' => $name2,
                            'Description' => $Description2[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                            
                        ]);

                        $file2->move($upload_path2, $filename2);

                        $i++;
                    }
                }
            }
        }
            
        
            if (!is_null($request->nationality_id3) && !is_null($request->PersonName3) && !is_null($request->PassportNo3)) {

            if (is_null($request->labour_card_type_id3)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration3;
            }
            $passport3 = NULL;
            $micLetter3= NULL;
            $extract3= NULL;
            $labourCard3=NULL;
            $techPassport3=NULL;
            $evidence3=NULL;
            if($request->file('passport3')){
                $passport3=$request->file('passport3');
                $passport3= $this->storeAttachments($passport3);
             }
             if($request->file('micLetter3')){
                 $micLetter3=$request->file('micLetter3');
                 $micLetter3= $this->storeAttachments($micLetter3);
              }
              if($request->file('extract3')){
                 $extract3=$request->file('extract3');
                 $extract3= $this->storeAttachments($extract3);
              }
              if($request->file('labourCard3')){
                 $labourCard3=$request->file('labourCard3');
                 $labourCard3= $this->storeAttachments($labourCard3);
              }
              if($request->file('techPassport3')){
                 $techPassport3=$request->file('techPassport3');
                 $techPassport3= $this->storeAttachments($techPassport3);
              }
              if($request->file('evidence3')){
                 $evidence3=$request->file('evidence3');
                 $evidence3= $this->storeAttachments($evidence3);
              }

            $visa_detail3 = VisaApplicationDetail::create([
                'visa_application_head_id' => $visa_head->id,
                'nationality_id' => $request->nationality_id3,
                'PersonName' => $request->PersonName3,
                'PassportNo' => $request->PassportNo3,
                'StayAllowDate' => $request->StayAllowDate3,
                'StayExpireDate' => $request->StayExpireDate3,
                'person_type_id' => $request->person_type_id3,
                'DateOfBirth' => $request->DateOfBirth3,
                'Gender' => $request->Gender3,
                'visa_type_id' => $request->visa_type_id3,
                'stay_type_id' => $request->stay_type_id3,
                'labour_card_type_id' => $request->labour_card_type_id3,
                'labour_card_duration_id' => $labour_duration_id,
                'relation_ship_id' => $request->relation_ship_id3,
                'Remark' => $request->Remark3,
                'passport_attach'=> $passport3,
                'mic_approved_letter_attach'=> $micLetter3,
                'labour_card_attach'=> $labourCard3,
                'extract_form_attach'=> $extract3,
                'technician_passport_attach'=> $techPassport3,
                'evidence_attach'=> $evidence3,
            ]);


            if (!is_null($request->visa_type_id3)) {
                $VisaApply = true;

                if ($request->visa_type_id3==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id3==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id3)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id3)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id3==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id3==2){
                    $LabourCardApplyRenew = true;
                }
            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description3=$request->Description3;
            $FilePath3=$request->file('FilePath3');
            if ($FilePath3) {
                foreach ($FilePath3 as $file3) {
                    if ($file3) {
                        $upload_path3 =public_path().'/visadetail_attach/';
                        $filename3 = $visa_detail3->id.'_'.Str::random(40).'.'.$file3->getClientOriginalExtension();
                        $name3 = '/visadetail_attach/'.$filename3;

                        $attach_id3=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail3->id,
                            'FilePath' => $name3,
                            'Description' => $Description3[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                            
                        ]);

                        $file3->move($upload_path3, $filename3);

                        $i++;
                    }
                }
            }
        }
            
             if (!is_null($request->nationality_id4) && !is_null($request->PersonName4) && !is_null($request->PassportNo4)) {

            if (is_null($request->labour_card_type_id4)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration4;
            }

            $passport4 = NULL;
            $micLetter4= NULL;
            $extract4= NULL;
            $labourCard4=NULL;
            $techPassport4=NULL;
            $evidence4=NULL;
            if($request->file('passport4')){
                $passport4=$request->file('passport4');
                $passport4= $this->storeAttachments($passport4);
             }
             if($request->file('micLetter4')){
                 $micLetter4=$request->file('micLetter4');
                 $micLetter4= $this->storeAttachments($micLetter4);
              }
              if($request->file('extract4')){
                 $extract4=$request->file('extract4');
                 $extract4= $this->storeAttachments($extract4);
              }
              if($request->file('labourCard4')){
                 $labourCard4=$request->file('labourCard4');
                 $labourCard4= $this->storeAttachments($labourCard4);
              }
              if($request->file('techPassport4')){
                 $techPassport4=$request->file('techPassport4');
                 $techPassport4= $this->storeAttachments($techPassport4);
              }
              if($request->file('evidence4')){
                 $evidence4=$request->file('evidence4');
                 $evidence4= $this->storeAttachments($evidence4);
              }

            $visa_detail4 = VisaApplicationDetail::create([
                'visa_application_head_id' => $visa_head->id,
                'nationality_id' => $request->nationality_id4,
                'PersonName' => $request->PersonName4,
                'PassportNo' => $request->PassportNo4,
                'StayAllowDate' => $request->StayAllowDate4,
                'StayExpireDate' => $request->StayExpireDate4,
                'person_type_id' => $request->person_type_id4,
                'DateOfBirth' => $request->DateOfBirth4,
                'Gender' => $request->Gender4,
                'visa_type_id' => $request->visa_type_id4,
                'stay_type_id' => $request->stay_type_id4,
                'labour_card_type_id' => $request->labour_card_type_id4,
                'labour_card_duration_id' => $labour_duration_id,
                'relation_ship_id' => $request->relation_ship_id4,
                'Remark' => $request->Remark4,
                'passport_attach'=> $passport4,
                'mic_approved_letter_attach'=> $micLetter4,
                'labour_card_attach'=> $labourCard4,
                'extract_form_attach'=> $extract4,
                'technician_passport_attach'=> $techPassport4,
                'evidence_attach'=> $evidence4,
            ]);


            if (!is_null($request->visa_type_id4)) {
                $VisaApply = true;

                if ($request->visa_type_id4==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id4==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id4)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id4)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id4==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id4==2){
                    $LabourCardApplyRenew = true;
                }
            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description4=$request->Description4;
            $FilePath4=$request->file('FilePath4');
            if ($FilePath4) {
                foreach ($FilePath4 as $file4) {
                    if ($file4) {
                        $upload_path4 =public_path().'/visadetail_attach/';
                        $filename4 = $visa_detail4->id.'_'.Str::random(40).'.'.$file4->getClientOriginalExtension();
                        $name4 = '/visadetail_attach/'.$filename4;

                        $attach_id4=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail4->id,
                            'FilePath' => $name4,
                            'Description' => $Description4[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $file4->move($upload_path4, $filename4);

                        $i++;
                    }
                }
            }
        }
       

       
            if (!is_null($request->nationality_id5) && !is_null($request->PersonName5) && !is_null($request->PassportNo5)) {

            if (is_null($request->labour_card_type_id5)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration5;
            }

            $passport5 = NULL;
            $micLetter5= NULL;
            $extract5= NULL;
            $labourCard5=NULL;
            $techPassport5=NULL;
            $evidence5=NULL;
            if($request->file('passport5')){
                $passport5=$request->file('passport5');
                $passport5= $this->storeAttachments($passport5);
             }
             if($request->file('micLetter5')){
                 $micLetter5=$request->file('micLetter5');
                 $micLetter5= $this->storeAttachments($micLetter5);
              }
              if($request->file('extract5')){
                 $extract5=$request->file('extract5');
                 $extract5= $this->storeAttachments($extract5);
              }
              if($request->file('labourCard5')){
                 $labourCard5=$request->file('labourCard5');
                 $labourCard5= $this->storeAttachments($labourCard5);
              }
              if($request->file('techPassport5')){
                 $techPassport5=$request->file('techPassport5');
                 $techPassport5= $this->storeAttachments($techPassport5);
              }
              if($request->file('evidence5')){
                 $evidence5=$request->file('evidence5');
                 $evidence5= $this->storeAttachments($evidence5);
              }

            $visa_detail5 = VisaApplicationDetail::create([
                'visa_application_head_id' => $visa_head->id,
                'nationality_id' => $request->nationality_id5,
                'PersonName' => $request->PersonName5,
                'PassportNo' => $request->PassportNo5,
                'StayAllowDate' => $request->StayAllowDate5,
                'StayExpireDate' => $request->StayExpireDate5,
                'person_type_id' => $request->person_type_id5,
                'DateOfBirth' => $request->DateOfBirth5,
                'Gender' => $request->Gender5,
                'visa_type_id' => $request->visa_type_id5,
                'stay_type_id' => $request->stay_type_id5,
                'labour_card_type_id' => $request->labour_card_type_id5,
                'labour_card_duration_id' => $labour_duration_id,
                'relation_ship_id' => $request->relation_ship_id5,
                'Remark' => $request->Remark5,
                'passport_attach'=> $passport5,
                'mic_approved_letter_attach'=> $micLetter5,
                'labour_card_attach'=> $labourCard5,
                'extract_form_attach'=> $extract5,
                'technician_passport_attach'=> $techPassport5,
                'evidence_attach'=> $evidence5,
            ]);


            if (!is_null($request->visa_type_id5)) {
                $VisaApply = true;

                if ($request->visa_type_id5==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id5==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id5)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id5)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id5==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id5==2){
                    $LabourCardApplyRenew = true;
                }
            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description5=$request->Description5;
            $FilePath5=$request->file('FilePath5');
            if ($FilePath5) {
                foreach ($FilePath5 as $file5) {
                    if ($file5) {
                        $upload_path5 =public_path().'/visadetail_attach/';
                        $filename5 = $visa_detail5->id.'_'.Str::random(40).'.'.$file5->getClientOriginalExtension();
                        $name5 = '/visadetail_attach/'.$filename5;

                        $attach_id5=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail5->id,
                            'FilePath' => $name5,
                            'Description' => $Description5[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $file5->move($upload_path5, $filename5);

                        $i++;
                    }
                }
            }
        }
            
        

       
            if (!is_null($request->nationality_id6) && !is_null($request->PersonName6) && !is_null($request->PassportNo6)) {

            if (is_null($request->labour_card_type_id6)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration6;
            }
            $passport6 = NULL;
            $micLetter6= NULL;
            $extract6= NULL;
            $labourCard6=NULL;
            $techPassport6=NULL;
            $evidence6=NULL;
            if($request->file('passport6')){
                $passport6=$request->file('passport6');
                $passport6= $this->storeAttachments($passport6);
             }
             if($request->file('micLetter6')){
                 $micLetter6=$request->file('micLetter6');
                 $micLetter6= $this->storeAttachments($micLetter6);
              }
              if($request->file('extract6')){
                 $extract6=$request->file('extract6');
                 $extract6= $this->storeAttachments($extract6);
              }
              if($request->file('labourCard6')){
                 $labourCard6=$request->file('labourCard6');
                 $labourCard6= $this->storeAttachments($labourCard6);
              }
              if($request->file('techPassport6')){
                 $techPassport6=$request->file('techPassport6');
                 $techPassport6= $this->storeAttachments($techPassport6);
              }
              if($request->file('evidence6')){
                 $evidence6=$request->file('evidence6');
                 $evidence6= $this->storeAttachments($evidence6);
              }

            $visa_detail6 = VisaApplicationDetail::create([
                'visa_application_head_id' => $visa_head->id,
                'nationality_id' => $request->nationality_id6,
                'PersonName' => $request->PersonName6,
                'PassportNo' => $request->PassportNo6,
                'StayAllowDate' => $request->StayAllowDate6,
                'StayExpireDate' => $request->StayExpireDate6,
                'person_type_id' => $request->person_type_id6,
                'DateOfBirth' => $request->DateOfBirth6,
                'Gender' => $request->Gender6,
                'visa_type_id' => $request->visa_type_id6,
                'stay_type_id' => $request->stay_type_id6,
                'labour_card_type_id' => $request->labour_card_type_id6,
                'labour_card_duration_id' => $labour_duration_id,
                'relation_ship_id' => $request->relation_ship_id6,
                'Remark' => $request->Remark6,
                'passport_attach'=> $passport6,
                'mic_approved_letter_attach'=> $micLetter6,
                'labour_card_attach'=> $labourCard6,
                'extract_form_attach'=> $extract6,
                'technician_passport_attach'=> $techPassport6,
                'evidence_attach'=> $evidence6,
            ]);


            if (!is_null($request->visa_type_id6)) {
                $VisaApply = true;

                if ($request->visa_type_id6==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id6==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id6)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id6)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id6==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id6==2){
                    $LabourCardApplyRenew = true;
                }
            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description6=$request->Description6;
            $FilePath6=$request->file('FilePath6');
            if ($FilePath6) {
                foreach ($FilePath6 as $file6) {
                    if ($file6) {
                        $upload_path6 =public_path().'/visadetail_attach/';
                        $filename6 = $visa_detail6->id.'_'.Str::random(40).'.'.$file6->getClientOriginalExtension();
                        $name6 = '/visadetail_attach/'.$filename6;

                        $attach_id6=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail6->id,
                            'FilePath' => $name6,
                            'Description' => $Description6[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $file6->move($upload_path6, $filename6);

                        $i++;
                    }
                }
            }
        }

        
             if (!is_null($request->nationality_id7) && !is_null($request->PersonName7) && !is_null($request->PassportNo7)) {

            if (is_null($request->labour_card_type_id7)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration7;
            }

            $passport7= NULL;
            $micLetter7= NULL;
            $extract7= NULL;
            $labourCard7=NULL;
            $techPassport7=NULL;
            $evidence7=NULL;
            if($request->file('passport7')){
                $passport7=$request->file('passport7');
                $passport7= $this->storeAttachments($passport7);
             }
             if($request->file('micLetter7')){
                 $micLetter7=$request->file('micLetter7');
                 $micLetter7= $this->storeAttachments($micLetter7);
              }
              if($request->file('extract7')){
                 $extract7=$request->file('extract7');
                 $extract7= $this->storeAttachments($extract7);
              }
              if($request->file('labourCard7')){
                 $labourCard7=$request->file('labourCard7');
                 $labourCard7= $this->storeAttachments($labourCard7);
              }
              if($request->file('techPassport7')){
                 $techPassport7=$request->file('techPassport7');
                 $techPassport7= $this->storeAttachments($techPassport7);
              }
              if($request->file('evidence7')){
                 $evidence7=$request->file('evidence7');
                 $evidence7= $this->storeAttachments($evidence7);
              }

            $visa_detail7 = VisaApplicationDetail::create([
                'visa_application_head_id' => $visa_head->id,
                'nationality_id' => $request->nationality_id7,
                'PersonName' => $request->PersonName7,
                'PassportNo' => $request->PassportNo7,
                'StayAllowDate' => $request->StayAllowDate7,
                'StayExpireDate' => $request->StayExpireDate7,
                'person_type_id' => $request->person_type_id7,
                'DateOfBirth' => $request->DateOfBirth7,
                'Gender' => $request->Gender7,
                'visa_type_id' => $request->visa_type_id7,
                'stay_type_id' => $request->stay_type_id7,
                'labour_card_type_id' => $request->labour_card_type_id7,
                'labour_card_duration_id' => $labour_duration_id,
                'relation_ship_id' => $request->relation_ship_id7,
                'Remark' => $request->Remark7,
                'passport_attach'=> $passport7,
                'mic_approved_letter_attach'=> $micLetter7,
                'labour_card_attach'=> $labourCard7,
                'extract_form_attach'=> $extract7,
                'technician_passport_attach'=> $techPassport7,
                'evidence_attach'=> $evidence7
            ]);


            if (!is_null($request->visa_type_id7)) {
                $VisaApply = true;

                if ($request->visa_type_id7==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id7==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id7)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id7)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id7==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id7==2){
                    $LabourCardApplyRenew = true;
                }
            }

            $ApplicantNumbers += 1;

            $i = 0;
            $Description7=$request->Description7;
            $FilePath7=$request->file('FilePath7');
            if ($FilePath7) {
                foreach ($FilePath7 as $file7) {
                    if ($file7) {
                        $upload_path7 =public_path().'/visadetail_attach/';
                        $filename7 = $visa_detail7->id.'_'.Str::random(40).'.'.$file7->getClientOriginalExtension();
                        $name7 = '/visadetail_attach/'.$filename7;

                        $attach_id7=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail7->id,
                            'FilePath' => $name7,
                            'Description' => $Description7[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $file7->move($upload_path7, $filename7);

                        $i++;
                    }
                }
            }
        }
       
        //1-immigration, 2-labour, 3-both
        if ($StayApply == True && $VisaApply == True && $LabourCardApply == True) {
            if ($VisaApplySingle == true and $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == true and $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == false and $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့်၊ " . $Subject . " နှင့် ";
            if ($LabourCardApplyNew == true and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } elseif ($LabourCardApplyNew == true and $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } elseif ($LabourCardApplyNew == false and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }

            $oss_status = 3;
        }
        elseif ($StayApply == True && $VisaApply == True && $LabourCardApply == False) {
            if ($VisaApplySingle == true and $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == true and $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == false and $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " . $Subject;

            $oss_status = 1;
        }
        elseif ($StayApply == True && $VisaApply == False && $LabourCardApply == True) {
            if ($LabourCardApplyNew == true and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } elseif ($LabourCardApplyNew == true and $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } elseif ($LabourCardApplyNew == false and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " . $Subject;

            $oss_status = 3;
        }
        elseif ($StayApply == False && $VisaApply == True && $LabourCardApply == True) {
            if ($VisaApplySingle == true and $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == true and $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == false and $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
            $Subject = $Subject . " နှင့် ";
            if ($LabourCardApplyNew == true and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } elseif ($LabourCardApplyNew == true and $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } elseif ($LabourCardApplyNew == false and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }

            $oss_status = 3;
        }
        elseif ($StayApply == True && $VisaApply == False && $LabourCardApply == False) {
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခြင်း";
            $oss_status = 1;
        }
        elseif ($StayApply == False && $VisaApply == True && $LabourCardApply == False) {
            if ($VisaApplySingle == true and $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == true and $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == false and $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }

            $oss_status = 1;
        }
        elseif ($StayApply == False && $VisaApply == False && $LabourCardApply == True) {
            if ($LabourCardApplyNew == true and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } elseif ($LabourCardApplyNew == true and $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } elseif ($LabourCardApplyNew == false and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }

            $oss_status = 2;
        }

        if ($ApplicantNumbers == 1) {
            $app_numbers = '၁';
        }elseif ($ApplicantNumbers == 2) {
            $app_numbers = '၂';
        }
        elseif ($ApplicantNumbers == 3) {
            $app_numbers = '၃';
        }
        elseif ($ApplicantNumbers == 4) {
            $app_numbers = '၄';
        }
        elseif ($ApplicantNumbers == 5) {
            $app_numbers = '၅';
        }
        elseif ($ApplicantNumbers == 6) {
            $app_numbers = '၆';
        }
        elseif ($ApplicantNumbers == 7) {
            $app_numbers = '၇';
        }

        

        $des = "နိုင်ငံခြားသား ( ".$app_numbers." ) ဦး အား ".$Subject." ပြုလုပ်ခွင့်ပေးပါရန် တင်ပြလာခြင်း";

        $visa_head->update(['Subject'=>$des]);
        $visa_head->update(['OssStatus'=>$oss_status]);

        // dd($Subject);
        Toastr::success('Your applicationform has been sent!');

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $visa_head = VisaApplicationHead::findOrFail($id);
        // dd($visa_head);
        $visa_details = VisaApplicationDetail::where('visa_application_head_id',$visa_head->id)->get();
        // $count =5;
        $count =count($visa_details);
        // dd($visa_details);

        $user_id = Auth::user()->id;
        $visa_types = VisaType::all();
        $person_types = PersonType::all();
        $nationalities = Nationality::all();
        $labour_card_types = LabourCardType::all();
        $stay_types = StayType::all();
        $stay_types = StayType::all();
        $labour_card_duration = LabourCardDuration::all();
        $relation_ships = RelationShip::all();


        $profile = Profile::where([
                    ['Status', '=', '1'],
                    ['user_id', '=', $user_id],
                ])->first();

        $total_local = $visa_head->StaffLocalProposal + $visa_head->StaffLocalSurplus;
        $total_foreign = $visa_head->StaffForeignProposal + $visa_head->StaffForeignSurplus;

        $available_local = $total_local - $visa_head->StaffLocalAppointed;
        $available_foreign = $total_foreign - $visa_head->StaffForeignAppointed;
        // dd($total_local);

        return view('reject_applicationform',compact('profile','visa_types','person_types','nationalities','labour_card_types','stay_types','labour_card_duration','relation_ships','total_local','total_foreign','available_local','available_foreign','count','visa_details','visa_head'));
    }

    public function getData($data, $key)
    {
        return isset($data[key]) ? $data[key] : null;
    }

    public function update($id,Request $request)
    {
        // Check two months ahead     
        // dd($request);
        $twoMonths = Carbon::now()->addMonths(2);
        if(!is_null($request->stay_type_id1)){            
            $stayExpiredate = $request->StayExpireDate1;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform/'.$id.'')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id2)){            
            $stayExpiredate = $request->StayExpireDate2;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform/'.$id.'')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }

        if(!is_null($request->stay_type_id3)){            
            $stayExpiredate = $request->StayExpireDate3;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform/'.$id.'')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id4)){            
            $stayExpiredate = $request->StayExpireDate4;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform/'.$id.'')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id5)){            
            $stayExpiredate = $request->StayExpireDate5;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform/'.$id.'')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id6)){            
            $stayExpiredate = $request->StayExpireDate6;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform/'.$id.'')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        if(!is_null($request->stay_type_id7)){            
            $stayExpiredate = $request->StayExpireDate7;
            if($stayExpiredate > $twoMonths){
                return redirect('applyform/'.$id.'')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }

        // check labour card type with controller (double check)
        if($request->labour_card_type_id1 == 1){         
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName1)
                    ->where('ad.PassportNo', $request->PassportNo1)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();
            
            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName1. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id2 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName2)
                    ->where('ad.PassportNo', $request->PassportNo2)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName2. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id3 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName3)
                    ->where('ad.PassportNo', $request->PassportNo3)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName3. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id4 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName4)
                    ->where('ad.PassportNo', $request->PassportNo4)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName4. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id5 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName5)
                    ->where('ad.PassportNo', $request->PassportNo5)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName5. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id6 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName6)
                    ->where('ad.PassportNo', $request->PassportNo6)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName6. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }
        if($request->labour_card_type_id7 == 1){            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName7)
                    ->where('ad.PassportNo', $request->PassportNo7)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName7. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။'); 
            }
        }

        // check stay 2 month after approve with controller (double check)
        $twoMonthSub = Carbon::now()->subMonths(2);        
        if(!is_null($request->stay_type_id1)){  
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName1)
                    ->where('ad.PassportNo', $request->PassportNo1)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName1. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id2)){
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName2)
                    ->where('ad.PassportNo', $request->PassportNo2)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName2. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id3)){  
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName3)
                    ->where('ad.PassportNo', $request->PassportNo3)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName3. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id4)){
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName4)
                    ->where('ad.PassportNo', $request->PassportNo4)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName4. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id5)){  
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName5)
                    ->where('ad.PassportNo', $request->PassportNo5)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName5. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id6)){  
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName6)
                    ->where('ad.PassportNo', $request->PassportNo6)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName6. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        if(!is_null($request->stay_type_id7)){
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName7)
                    ->where('ad.PassportNo', $request->PassportNo7)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();

            if($check->count() != 0){
                return redirect('applyform/'.$id.'')->with('error',$request->PersonName7. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }

        // dd($request);
        $visa_head = VisaApplicationHead::findOrFail($id);
        //CompanyUpdate
         $visa_head->update(['StaffLocalProposal'=>request('StaffLocalProposal')]);
         $visa_head->update(['StaffForeignProposal'=>request('StaffForeignProposal')]);
         $visa_head->update(['StaffLocalSurplus'=>request('StaffLocalSurplus')]);
         $visa_head->update(['StaffForeignSurplus'=>request('StaffForeignSurplus')]);
         $visa_head->update(['StaffLocalAppointed'=>request('StaffLocalAppointed')]);
         $visa_head->update(['StaffForeignAppointed'=>request('StaffForeignAppointed')]);

        $visa_head->update(['Status'=>0]);
        $visa_head->update(['ReviewerSubmitted'=>Null]);
        $visa_head->update(['FinalApplyDate'=>now()]);

        $ApplicantNumbers = 0;
        $VisaApply = false;
        $StayApply = false;
        $LabourCardApply = false;
        $Subject = "";

        $VisaApplySingle = false;
        $VisaApplyMultiple = false;
        $LabourCardApplyNew = false;
        $LabourCardApplyRenew = false;

        $j = 0;
        $Description=$request->Description;
        $FilePath=$request->file('FilePath');
        if ($FilePath) {
            foreach ($FilePath as $file) {
                if ($file) {
                    $upload_path =public_path().'/visahead_attach/';
                    $filename = Str::random(40).'.'.$file->getClientOriginalExtension();
                    $name = '/visahead_attach/'.$filename;

                    $attach_id=VisaApplicationHeadAttachment::insertGetId([
                        'visa_application_head_id' => $visa_head->id,
                        'FilePath' => $name,
                        'Description' => $Description[$j],
                        'created_at' => now(),
                            'updated_at' => now(),
                    ]);

                    $file->move($upload_path, $filename);

                    $j++;
                }
            }
        }
                
        if (!is_null($request->detail_id1)) {

            if (is_null($request->labour_card_type_id1)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration1;
            }
            $passport1 = NULL;
            $micLetter1= NULL;
            $extract1= NULL;
            $labourCard1=NULL;
            $techPassport1=NULL;
            $evidence1=NULL;
            if($request->file('passport1')){
               $passport1=$request->file('passport1');
               $passport1= $this->storeAttachments($passport1);
            }
            if($request->file('micLetter1')){
                $micLetter1=$request->file('micLetter1');
                $micLetter1= $this->storeAttachments($micLetter1);
             }
             if($request->file('extract1')){
                $extract1=$request->file('extract1');
                $extract1= $this->storeAttachments($extract1);
             }
             if($request->file('labourCard1')){
                $labourCard1=$request->file('labourCard1');
                $labourCard1= $this->storeAttachments($labourCard1);
             }
             if($request->file('techPassport1')){
                $techPassport1=$request->file('techPassport1');
                $techPassport1= $this->storeAttachments($techPassport1);
             }
             if($request->file('evidence1')){
                $evidence1=$request->file('evidence1');
                $evidence1= $this->storeAttachments($evidence1);
             }
            $visa_detail1 = VisaApplicationDetail::findOrFail($request->detail_id1);
            //UpdateApplicant 1
            $visa_detail1->update(['nationality_id'=>request('nationality_id1')]);
            $visa_detail1->update(['PersonName'=>request('PersonName1')]);
            $visa_detail1->update(['PassportNo'=>request('PassportNo1')]);
            $visa_detail1->update(['StayAllowDate'=>request('StayAllowDate1')]);
            $visa_detail1->update(['StayExpireDate'=>request('StayExpireDate1')]);
            $visa_detail1->update(['person_type_id'=>request('person_type_id1')]);
            $visa_detail1->update(['DateOfBirth'=>request('DateOfBirth1')]);
            $visa_detail1->update(['Gender'=>request('Gender1')]);
            $visa_detail1->update(['visa_type_id'=>request('visa_type_id1')]);
            $visa_detail1->update(['stay_type_id'=>request('stay_type_id1')]);
            $visa_detail1->update(['labour_card_type_id'=>request('labour_card_type_id1')]);
            $visa_detail1->update(['labour_card_duration_id'=>$labour_duration_id]);
            $visa_detail1->update(['relation_ship_id'=>request('relation_ship_id1')]);
            $visa_detail1->update(['Remark'=>request('Remark1'),
                                    'passport_attach'=> $passport1,
                                     'mic_approved_letter_attach'=> $micLetter1,
                                    'labour_card_attach'=> $labourCard1,
                                    'extract_form_attach'=> $extract1,
                                    'technician_passport_attach'=> $techPassport1,
                                    'evidence_attach'=> $evidence1]);
           
            if (!is_null($request->visa_type_id1)) {
                $VisaApply = true;

                if ($request->visa_type_id1==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id1==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id1)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id1)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id1==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id1==2){
                    $LabourCardApplyRenew = true;
                }
            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description1=$request->Description1;
            $FilePath1=$request->file('FilePath1');
            if ($FilePath1) {
                foreach ($FilePath1 as $file1) {
                    if ($file1) {
                        $upload_path1 =public_path().'/visadetail_attach/';
                        $filename1 = $visa_detail1->id.'_'.Str::random(40).'.'.$file1->getClientOriginalExtension();
                        $name1 = '/visadetail_attach/'.$filename1;

                        $attach_id1=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail1->id,
                            'FilePath' => $name1,
                            'Description' => $Description1[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                            
                        ]);

                        $file1->move($upload_path1, $filename1);

                        $i++;
                    }
                }
            }
        }

        if (!is_null($request->detail_id2)) {

            if (is_null($request->labour_card_type_id2)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration2;
            }

            $passport2 = NULL;
            $micLetter2= NULL;
            $extract2= NULL;
            $labourCard2=NULL;
            $techPassport2=NULL;
            $evidence2=NULL;
            if($request->file('passport2')){
                $passport2=$request->file('passport2');
                $passport2= $this->storeAttachments($passport2);
             }
             if($request->file('micLetter2')){
                 $micLetter2=$request->file('micLetter2');
                 $micLetter2= $this->storeAttachments($micLetter2);
              }
              if($request->file('extract2')){
                 $extract2=$request->file('extract2');
                 $extract2= $this->storeAttachments($extract2);
              }
              if($request->file('labourCard2')){
                 $labourCard2=$request->file('labourCard2');
                 $labourCard2= $this->storeAttachments($labourCard2);
              }
              if($request->file('techPassport2')){
                 $techPassport2=$request->file('techPassport2');
                 $techPassport2= $this->storeAttachments($techPassport2);
              }
              if($request->file('evidence2')){
                 $evidence2=$request->file('evidence2');
                 $evidence2= $this->storeAttachments($evidence2);
              }


            $visa_detail2 = VisaApplicationDetail::findOrFail($request->detail_id2);
            //UpdateApplicant 2
            $visa_detail2->update(['nationality_id'=>request('nationality_id2')]);
            $visa_detail2->update(['PersonName'=>request('PersonName2')]);
            $visa_detail2->update(['PassportNo'=>request('PassportNo2')]);
            $visa_detail2->update(['StayAllowDate'=>request('StayAllowDate2')]);
            $visa_detail2->update(['StayExpireDate'=>request('StayExpireDate2')]);
            $visa_detail2->update(['person_type_id'=>request('person_type_id2')]);
            $visa_detail2->update(['DateOfBirth'=>request('DateOfBirth2')]);
            $visa_detail2->update(['Gender'=>request('Gender2')]);
            $visa_detail2->update(['visa_type_id'=>request('visa_type_id2')]);
            $visa_detail2->update(['stay_type_id'=>request('stay_type_id2')]);
            $visa_detail2->update(['labour_card_type_id'=>request('labour_card_type_id2')]);
            $visa_detail2->update(['labour_card_duration_id'=>$labour_duration_id]);
            $visa_detail2->update(['relation_ship_id'=>request('relation_ship_id2')]);
            $visa_detail2->update(['Remark'=>request('Remark2'),
                                    'passport_attach'=> $passport2,
                                    'mic_approved_letter_attach'=> $micLetter2,
                                    'labour_card_attach'=> $labourCard2,
                                    'extract_form_attach'=> $extract2,
                                    'technician_passport_attach'=> $techPassport2,
                                    'evidence_attach'=> $evidence2]);

            if (!is_null($request->visa_type_id2)) {
                $VisaApply = true;

                if ($request->visa_type_id2==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id2==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id2)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id2)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id2==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id2==2){
                    $LabourCardApplyRenew = true;
                }

            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description2=$request->Description2;
            $FilePath2=$request->file('FilePath2');
            if ($FilePath2) {
                foreach ($FilePath2 as $file2) {
                    if ($file2) {
                        $upload_path2 =public_path().'/visadetail_attach/';
                        $filename2 = $visa_detail2->id.'_'.Str::random(40).'.'.$file2->getClientOriginalExtension();
                        $name2 = '/visadetail_attach/'.$filename2;

                        $attach_id2=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail2->id,
                            'FilePath' => $name2,
                            'Description' => $Description2[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                            
                        ]);

                        $file2->move($upload_path2, $filename2);

                        $i++;
                    }
                }
            }
        }

        if (!is_null($request->detail_id3)) {

            if (is_null($request->labour_card_type_id3)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration3;
            }
            
            $passport3 = NULL;
            $micLetter3= NULL;
            $extract3= NULL;
            $labourCard3=NULL;
            $techPassport3=NULL;
            $evidence3=NULL;
            if($request->file('passport3')){
                $passport3=$request->file('passport3');
                $passport3= $this->storeAttachments($passport3);
             }
             if($request->file('micLetter3')){
                 $micLetter3=$request->file('micLetter3');
                 $micLetter3= $this->storeAttachments($micLetter3);
              }
              if($request->file('extract3')){
                 $extract3=$request->file('extract3');
                 $extract3= $this->storeAttachments($extract3);
              }
              if($request->file('labourCard3')){
                 $labourCard3=$request->file('labourCard3');
                 $labourCard3= $this->storeAttachments($labourCard3);
              }
              if($request->file('techPassport3')){
                 $techPassport3=$request->file('techPassport3');
                 $techPassport3= $this->storeAttachments($techPassport3);
              }
              if($request->file('evidence3')){
                 $evidence3=$request->file('evidence3');
                 $evidence3= $this->storeAttachments($evidence3);
              }

            $visa_detail3 = VisaApplicationDetail::findOrFail($request->detail_id3);
            //UpdateApplicant 3
            $visa_detail3->update(['nationality_id'=>request('nationality_id3')]);
            $visa_detail3->update(['PersonName'=>request('PersonName3')]);
            $visa_detail3->update(['PassportNo'=>request('PassportNo3')]);
            $visa_detail3->update(['StayAllowDate'=>request('StayAllowDate3')]);
            $visa_detail3->update(['StayExpireDate'=>request('StayExpireDate3')]);
            $visa_detail3->update(['person_type_id'=>request('person_type_id3')]);
            $visa_detail3->update(['DateOfBirth'=>request('DateOfBirth3')]);
            $visa_detail3->update(['Gender'=>request('Gender3')]);
            $visa_detail3->update(['visa_type_id'=>request('visa_type_id3')]);
            $visa_detail3->update(['stay_type_id'=>request('stay_type_id3')]);
            $visa_detail3->update(['labour_card_type_id'=>request('labour_card_type_id3')]);
            $visa_detail3->update(['labour_card_duration_id'=>$labour_duration_id]);
            $visa_detail3->update(['relation_ship_id'=>request('relation_ship_id3')]);
            $visa_detail3->update(['Remark'=>request('Remark3'),
                                    'passport_attach'=> $passport3,
                                    'mic_approved_letter_attach'=> $micLetter3,
                                    'labour_card_attach'=> $labourCard3,
                                    'extract_form_attach'=> $extract3,
                                    'technician_passport_attach'=> $techPassport3,
                                    'evidence_attach'=> $evidence3]);

            if (!is_null($request->visa_type_id3)) {
                $VisaApply = true;

                if ($request->visa_type_id3==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id3==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id3)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id3)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id3==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id3==2){
                    $LabourCardApplyRenew = true;
                }
            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description3=$request->Description3;
            $FilePath3=$request->file('FilePath3');
            if ($FilePath3) {
                foreach ($FilePath3 as $file3) {
                    if ($file3) {
                        $upload_path3 =public_path().'/visadetail_attach/';
                        $filename3 = $visa_detail3->id.'_'.Str::random(40).'.'.$file3->getClientOriginalExtension();
                        $name3 = '/visadetail_attach/'.$filename3;

                        $attach_id3=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail3->id,
                            'FilePath' => $name3,
                            'Description' => $Description3[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                            
                        ]);

                        $file3->move($upload_path3, $filename3);

                        $i++;
                    }
                }
            }
        }

        if (!is_null($request->detail_id4)) {

            if (is_null($request->labour_card_type_id4)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration4;
            }
            $passport4 = NULL;
            $micLetter4= NULL;
            $extract4= NULL;
            $labourCard4=NULL;
            $techPassport4=NULL;
            $evidence4=NULL;
            if($request->file('passport4')){
                $passport4=$request->file('passport4');
                $passport4= $this->storeAttachments($passport4);
             }
             if($request->file('micLetter4')){
                 $micLetter4=$request->file('micLetter4');
                 $micLetter4= $this->storeAttachments($micLetter4);
              }
              if($request->file('extract4')){
                 $extract4=$request->file('extract4');
                 $extract4= $this->storeAttachments($extract4);
              }
              if($request->file('labourCard4')){
                 $labourCard4=$request->file('labourCard4');
                 $labourCard4= $this->storeAttachments($labourCard4);
              }
              if($request->file('techPassport4')){
                 $techPassport4=$request->file('techPassport4');
                 $techPassport4= $this->storeAttachments($techPassport4);
              }
              if($request->file('evidence4')){
                 $evidence4=$request->file('evidence4');
                 $evidence4= $this->storeAttachments($evidence4);
              }

            $visa_detail4 = VisaApplicationDetail::findOrFail($request->detail_id4);
            //UpdateApplicant 4
            $visa_detail4->update(['nationality_id'=>request('nationality_id4')]);
            $visa_detail4->update(['PersonName'=>request('PersonName4')]);
            $visa_detail4->update(['PassportNo'=>request('PassportNo4')]);
            $visa_detail4->update(['StayAllowDate'=>request('StayAllowDate4')]);
            $visa_detail4->update(['StayExpireDate'=>request('StayExpireDate4')]);
            $visa_detail4->update(['person_type_id'=>request('person_type_id4')]);
            $visa_detail4->update(['DateOfBirth'=>request('DateOfBirth4')]);
            $visa_detail4->update(['Gender'=>request('Gender4')]);
            $visa_detail4->update(['visa_type_id'=>request('visa_type_id4')]);
            $visa_detail4->update(['stay_type_id'=>request('stay_type_id4')]);
            $visa_detail4->update(['labour_card_type_id'=>request('labour_card_type_id4')]);
            $visa_detail4->update(['labour_card_duration_id'=>$labour_duration_id]);
            $visa_detail4->update(['relation_ship_id'=>request('relation_ship_id4')]);
            $visa_detail4->update(['Remark'=>request('Remark4'),
                                    'passport_attach'=> $passport4,
                                    'mic_approved_letter_attach'=> $micLetter4,
                                    'labour_card_attach'=> $labourCard4,
                                    'extract_form_attach'=> $extract4,
                                    'technician_passport_attach'=> $techPassport4,
                                    'evidence_attach'=> $evidence4]);

            if (!is_null($request->visa_type_id4)) {
                $VisaApply = true;

                if ($request->visa_type_id4==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id4==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id4)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id4)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id4==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id4==2){
                    $LabourCardApplyRenew = true;
                }
            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description4=$request->Description4;
            $FilePath4=$request->file('FilePath4');
            if ($FilePath4) {
                foreach ($FilePath4 as $file4) {
                    if ($file4) {
                        $upload_path4 =public_path().'/visadetail_attach/';
                        $filename4 = $visa_detail4->id.'_'.Str::random(40).'.'.$file4->getClientOriginalExtension();
                        $name4 = '/visadetail_attach/'.$filename4;

                        $attach_id4=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail4->id,
                            'FilePath' => $name4,
                            'Description' => $Description4[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $file4->move($upload_path4, $filename4);

                        $i++;
                    }
                }
            }
        }

        if (!is_null($request->detail_id5)) {

            if (is_null($request->labour_card_type_id5)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration5;
            }
            $passport5 = NULL;
            $micLetter5= NULL;
            $extract5= NULL;
            $labourCard5=NULL;
            $techPassport5=NULL;
            $evidence5=NULL;
            if($request->file('passport5')){
                $passport5=$request->file('passport5');
                $passport5= $this->storeAttachments($passport5);
             }
             if($request->file('micLetter5')){
                 $micLetter5=$request->file('micLetter5');
                 $micLetter5= $this->storeAttachments($micLetter5);
              }
              if($request->file('extract5')){
                 $extract5=$request->file('extract5');
                 $extract5= $this->storeAttachments($extract5);
              }
              if($request->file('labourCard5')){
                 $labourCard5=$request->file('labourCard5');
                 $labourCard5= $this->storeAttachments($labourCard5);
              }
              if($request->file('techPassport5')){
                 $techPassport5=$request->file('techPassport5');
                 $techPassport5= $this->storeAttachments($techPassport5);
              }
              if($request->file('evidence5')){
                 $evidence5=$request->file('evidence5');
                 $evidence5= $this->storeAttachments($evidence5);
              }

            $visa_detail5 = VisaApplicationDetail::findOrFail($request->detail_id5);
            //UpdateApplicant 5
            $visa_detail5->update(['nationality_id'=>request('nationality_id5')]);
            $visa_detail5->update(['PersonName'=>request('PersonName5')]);
            $visa_detail5->update(['PassportNo'=>request('PassportNo5')]);
            $visa_detail5->update(['StayAllowDate'=>request('StayAllowDate5')]);
            $visa_detail5->update(['StayExpireDate'=>request('StayExpireDate5')]);
            $visa_detail5->update(['person_type_id'=>request('person_type_id5')]);
            $visa_detail5->update(['DateOfBirth'=>request('DateOfBirth5')]);
            $visa_detail5->update(['Gender'=>request('Gender5')]);
            $visa_detail5->update(['visa_type_id'=>request('visa_type_id5')]);
            $visa_detail5->update(['stay_type_id'=>request('stay_type_id5')]);
            $visa_detail5->update(['labour_card_type_id'=>request('labour_card_type_id5')]);
            $visa_detail5->update(['labour_card_duration_id'=>$labour_duration_id]);
            $visa_detail5->update(['relation_ship_id'=>request('relation_ship_id5')]);
            $visa_detail5->update(['Remark'=>request('Remark5'),
                                    'passport_attach'=> $passport5,
                                    'mic_approved_letter_attach'=> $micLetter5,
                                    'labour_card_attach'=> $labourCard5,
                                    'extract_form_attach'=> $extract5,
                                    'technician_passport_attach'=> $techPassport5,
                                    'evidence_attach'=> $evidence5]);

            if (!is_null($request->visa_type_id5)) {
                $VisaApply = true;

                if ($request->visa_type_id5==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id5==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id5)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id5)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id5==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id5==2){
                    $LabourCardApplyRenew = true;
                }
            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description5=$request->Description5;
            $FilePath5=$request->file('FilePath5');
            if ($FilePath5) {
                foreach ($FilePath5 as $file5) {
                    if ($file5) {
                        $upload_path5 =public_path().'/visadetail_attach/';
                        $filename5 = $visa_detail5->id.'_'.Str::random(40).'.'.$file5->getClientOriginalExtension();
                        $name5 = '/visadetail_attach/'.$filename5;

                        $attach_id5=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail5->id,
                            'FilePath' => $name5,
                            'Description' => $Description5[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $file5->move($upload_path5, $filename5);

                        $i++;
                    }
                }
            }
        }

        if (!is_null($request->detail_id6)) {

            if (is_null($request->labour_card_type_id6)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration6;
            }
            $passport6 = NULL;
            $micLetter6= NULL;
            $extract6= NULL;
            $labourCard6=NULL;
            $techPassport6=NULL;
            $evidence6=NULL;
            if($request->file('passport6')){
                $passport6=$request->file('passport6');
                $passport6= $this->storeAttachments($passport6);
             }
             if($request->file('micLetter6')){
                 $micLetter6=$request->file('micLetter6');
                 $micLetter6= $this->storeAttachments($micLetter6);
              }
              if($request->file('extract6')){
                 $extract6=$request->file('extract6');
                 $extract6= $this->storeAttachments($extract6);
              }
              if($request->file('labourCard6')){
                 $labourCard6=$request->file('labourCard6');
                 $labourCard6= $this->storeAttachments($labourCard6);
              }
              if($request->file('techPassport6')){
                 $techPassport6=$request->file('techPassport6');
                 $techPassport6= $this->storeAttachments($techPassport6);
              }
              if($request->file('evidence6')){
                 $evidence6=$request->file('evidence6');
                 $evidence6= $this->storeAttachments($evidence6);
              }

            $visa_detail6 = VisaApplicationDetail::findOrFail($request->detail_id6);
            //UpdateApplicant 6
            $visa_detail6->update(['nationality_id'=>request('nationality_id6')]);
            $visa_detail6->update(['PersonName'=>request('PersonName6')]);
            $visa_detail6->update(['PassportNo'=>request('PassportNo6')]);
            $visa_detail6->update(['StayAllowDate'=>request('StayAllowDate6')]);
            $visa_detail6->update(['StayExpireDate'=>request('StayExpireDate6')]);
            $visa_detail6->update(['person_type_id'=>request('person_type_id6')]);
            $visa_detail6->update(['DateOfBirth'=>request('DateOfBirth6')]);
            $visa_detail6->update(['Gender'=>request('Gender6')]);
            $visa_detail6->update(['visa_type_id'=>request('visa_type_id6')]);
            $visa_detail6->update(['stay_type_id'=>request('stay_type_id6')]);
            $visa_detail6->update(['labour_card_type_id'=>request('labour_card_type_id6')]);
            $visa_detail6->update(['labour_card_duration_id'=>$labour_duration_id]);
            $visa_detail6->update(['relation_ship_id'=>request('relation_ship_id6')]);
            $visa_detail6->update(['Remark'=>request('Remark6'),
                                    'passport_attach'=> $passport6,
                                    'mic_approved_letter_attach'=> $micLetter6,
                                    'labour_card_attach'=> $labourCard6,
                                    'extract_form_attach'=> $extract6,
                                    'technician_passport_attach'=> $techPassport6,
                                    'evidence_attach'=> $evidence6,]);

            if (!is_null($request->visa_type_id6)) {
                $VisaApply = true;

                if ($request->visa_type_id6==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id6==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id6)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id6)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id6==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id6==2){
                    $LabourCardApplyRenew = true;
                }
            }
            $ApplicantNumbers += 1;

            $i = 0;
            $Description6=$request->Description6;
            $FilePath6=$request->file('FilePath6');
            if ($FilePath6) {
                foreach ($FilePath6 as $file6) {
                    if ($file6) {
                        $upload_path6 =public_path().'/visadetail_attach/';
                        $filename6 = $visa_detail6->id.'_'.Str::random(40).'.'.$file6->getClientOriginalExtension();
                        $name6 = '/visadetail_attach/'.$filename6;

                        $attach_id6=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail6->id,
                            'FilePath' => $name6,
                            'Description' => $Description6[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $file6->move($upload_path6, $filename6);

                        $i++;
                    }
                }
            }
        }

        if (!is_null($request->detail_id7)) {

            if (is_null($request->labour_card_type_id7)) {
                $labour_duration_id = NULL;
            }
            else{
                $labour_duration_id = $request->labour_card_duration7;
            }
            $passport7= NULL;
            $micLetter7= NULL;
            $extract7= NULL;
            $labourCard7=NULL;
            $techPassport7=NULL;
            $evidence7=NULL;
            if($request->file('passport7')){
                $passport7=$request->file('passport7');
                $passport7= $this->storeAttachments($passport7);
             }
             if($request->file('micLetter7')){
                 $micLetter7=$request->file('micLetter7');
                 $micLetter7= $this->storeAttachments($micLetter7);
              }
              if($request->file('extract7')){
                 $extract7=$request->file('extract7');
                 $extract7= $this->storeAttachments($extract7);
              }
              if($request->file('labourCard7')){
                 $labourCard7=$request->file('labourCard7');
                 $labourCard7= $this->storeAttachments($labourCard7);
              }
              if($request->file('techPassport7')){
                 $techPassport7=$request->file('techPassport7');
                 $techPassport7= $this->storeAttachments($techPassport7);
              }
              if($request->file('evidence7')){
                 $evidence7=$request->file('evidence7');
                 $evidence7= $this->storeAttachments($evidence7);
              }

            $visa_detail7 = VisaApplicationDetail::findOrFail($request->detail_id7);
            //UpdateApplicant 7
            $visa_detail7->update(['nationality_id'=>request('nationality_id7')]);
            $visa_detail7->update(['PersonName'=>request('PersonName7')]);
            $visa_detail7->update(['PassportNo'=>request('PassportNo7')]);
            $visa_detail7->update(['StayAllowDate'=>request('StayAllowDate7')]);
            $visa_detail7->update(['StayExpireDate'=>request('StayExpireDate7')]);
            $visa_detail7->update(['person_type_id'=>request('person_type_id7')]);
            $visa_detail7->update(['DateOfBirth'=>request('DateOfBirth7')]);
            $visa_detail7->update(['Gender'=>request('Gender7')]);
            $visa_detail7->update(['visa_type_id'=>request('visa_type_id7')]);
            $visa_detail7->update(['stay_type_id'=>request('stay_type_id7')]);
            $visa_detail7->update(['labour_card_type_id'=>request('labour_card_type_id7')]);
            $visa_detail7->update(['labour_card_duration_id'=>$labour_duration_id]);
            $visa_detail7->update(['relation_ship_id'=>request('relation_ship_id7')]);
            $visa_detail7->update(['Remark'=>request('Remark7'),
                                    'passport_attach'=> $passport7,
                                    'mic_approved_letter_attach'=> $micLetter7,
                                    'labour_card_attach'=> $labourCard7,
                                    'extract_form_attach'=> $extract7,
                                    'technician_passport_attach'=> $techPassport7,
                                    'evidence_attach'=> $evidence7]);

            if (!is_null($request->visa_type_id7)) {
                $VisaApply = true;

                if ($request->visa_type_id7==1){
                    $VisaApplySingle = true;
                } elseif ($request->visa_type_id7==2){
                    $VisaApplyMultiple = true;
                }
            }
            if (!is_null($request->stay_type_id7)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id7)) {
                $LabourCardApply = true;

                if ($request->labour_card_type_id7==1){
                    $LabourCardApplyNew = true;
                } elseif ($request->labour_card_type_id7==2){
                    $LabourCardApplyRenew = true;
                }
            }

            $ApplicantNumbers += 1;

            $i = 0;
            $Description7=$request->Description7;
            $FilePath7=$request->file('FilePath7');
            if ($FilePath7) {
                foreach ($FilePath7 as $file7) {
                    if ($file7) {
                        $upload_path7 =public_path().'/visadetail_attach/';
                        $filename7 = $visa_detail7->id.'_'.Str::random(40).'.'.$file7->getClientOriginalExtension();
                        $name7 = '/visadetail_attach/'.$filename7;

                        $attach_id7=VisaApplicationDetailAttachment::insertGetId([
                            'visa_application_detail_id' => $visa_detail7->id,
                            'FilePath' => $name7,
                            'Description' => $Description7[$i],
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $file7->move($upload_path7, $filename7);

                        $i++;
                    }
                }
            }
        }

        //1-immigration, 2-labour, 3-both
        if ($StayApply == True && $VisaApply == True && $LabourCardApply == True) {
            if ($VisaApplySingle == true and $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == true and $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == false and $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့်၊ " . $Subject . " နှင့် ";
            if ($LabourCardApplyNew == true and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } elseif ($LabourCardApplyNew == true and $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } elseif ($LabourCardApplyNew == false and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }

            $oss_status = 3;
        }
        elseif ($StayApply == True && $VisaApply == True && $LabourCardApply == False) {
            if ($VisaApplySingle == true and $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == true and $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == false and $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " . $Subject;

            $oss_status = 1;
        }
        elseif ($StayApply == True && $VisaApply == False && $LabourCardApply == True) {
            if ($LabourCardApplyNew == true and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } elseif ($LabourCardApplyNew == true and $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } elseif ($LabourCardApplyNew == false and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " . $Subject;

            $oss_status = 3;
        }
        elseif ($StayApply == False && $VisaApply == True && $LabourCardApply == True) {
            if ($VisaApplySingle == true and $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == true and $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == false and $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
            $Subject = $Subject . " နှင့် ";
            if ($LabourCardApplyNew == true and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } elseif ($LabourCardApplyNew == true and $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } elseif ($LabourCardApplyNew == false and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }

            $oss_status = 3;
        }
        elseif ($StayApply == True && $VisaApply == False && $LabourCardApply == False) {
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခြင်း";
            $oss_status = 1;
        }
        elseif ($StayApply == False && $VisaApply == True && $LabourCardApply == False) {
            if ($VisaApplySingle == true and $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == true and $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } elseif ($VisaApplySingle == false and $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }

            $oss_status = 1;
        }
        elseif ($StayApply == False && $VisaApply == False && $LabourCardApply == True) {
            if ($LabourCardApplyNew == true and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } elseif ($LabourCardApplyNew == true and $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } elseif ($LabourCardApplyNew == false and $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }

            $oss_status = 2;
        }

        if ($ApplicantNumbers == 1) {
            $app_numbers = '၁';
        }elseif ($ApplicantNumbers == 2) {
            $app_numbers = '၂';
        }
        elseif ($ApplicantNumbers == 3) {
            $app_numbers = '၃';
        }
        elseif ($ApplicantNumbers == 4) {
            $app_numbers = '၄';
        }
        elseif ($ApplicantNumbers == 5) {
            $app_numbers = '၅';
        }
        elseif ($ApplicantNumbers == 6) {
            $app_numbers = '၆';
        }
        elseif ($ApplicantNumbers == 7) {
            $app_numbers = '၇';
        }

        

        $des = "နိုင်ငံခြားသား ( ".$app_numbers." ) ဦး အား ".$Subject." ပြုလုပ်ခွင့်ပေးပါရန် တင်ပြလာခြင်း";

        $visa_head->update(['Subject'=>$des]);
        $visa_head->update(['OssStatus'=>$oss_status]);
        
        Toastr::success('Form Sent!');

        return redirect()->route('home');
    }
 public function delete($id)
    {
        
        try{
        $application = VisaApplicationDetail::findOrFail($id);
        $visaId=$application->visa_application_head_id;

        $application->delete();
        Toastr::error('Successfully deleted applicant .');

        return \Redirect::route('applyform.id', $visaId);
       }catch(Exception $e)
       {
        return \Redirect::route('applyform.id', $visaId);
       }
    }
    private function storeAttachments($attach)
    {
            $path = public_path().'/visadetail_attach/';
            $name =  Str::random(40).'.'.$attach->getClientOriginalExtension();
            $attach->move($path, $name);
            $attachPath ='/visadetail_attach/' . $name;
            return $attachPath;
    }
}
