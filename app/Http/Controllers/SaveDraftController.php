<?php

namespace App\Http\Controllers;

use App\Models\LabourCardDuration;
use App\Models\LabourCardType;
use App\Models\Nationality;
use App\Models\PersonType;
use App\Models\Profile;
use App\Models\RelationShip;
use App\Models\StayType;
use App\Models\VisaApplicationDetail;
use App\Models\VisaApplicationHead;
use App\Models\VisaType;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class SaveDraftController extends Controller
{

    public function index(){
        $applicants=VisaApplicationDetail::where('profile_id',Auth::user()->profile->id)
                                        ->whereNull('visa_application_head_id')->get();


        return view("applicationformOpen",compact('applicants'));
    }

    public function newindexopen()
    {
        $user_id = Auth::user()->id;
        $visa_types = VisaType::all();
        $person_types = PersonType::all();
        $nationalities = Nationality::all();
        $labour_card_types = LabourCardType::all();
        $stay_types = StayType::all();
        $labour_card_duration = LabourCardDuration::all();
        $relation_ships = RelationShip::all();
        $id=0;
        // dd($total_local);

        //dd($status);

        // $user_info = DB::SELECT(
        //     'SELECT p.CompanyName,vd.PersonName,vd.PassportNo,vd.StayExpireDate,vd.visa_type_id, vd.stay_type_id, vd.labour_card_type_id FROM visa_application_heads as vh JOIN visa_application_details as vd ON vh.id=vd.visa_application_head_id JOIN profiles as p ON vh.profile_id=p.id WHERE vh.user_id='.$user_id.''
        // );
        //dd($user_info);

        return view('newapplicationform',compact('visa_types','person_types','nationalities','labour_card_types','stay_types','labour_card_duration','relation_ships','id'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function editApplicant($id,$editId){
        $applicant=VisaApplicationDetail::find($id);
        $visahead = VisaApplicationHead::find($applicant->visa_application_head_id);
        // dd($visahead);
        $user_id = Auth::user()->id;
        $visa_types = VisaType::all();
        $person_types = PersonType::all();
        $nationalities = Nationality::all();
        $labour_card_types = LabourCardType::all();
        $stay_types = StayType::all();
        $labour_card_duration = LabourCardDuration::all();
        $relation_ships = RelationShip::all();

        $id=$editId;
        return view('newapplicationform',compact('visa_types','person_types','nationalities','labour_card_types','stay_types','labour_card_duration','relation_ships','id','applicant','editId' , 'visahead'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function deleteAplicant($id, $deleteId){
        $applicant = VisaApplicationDetail::find($id);
        $id = $deleteId;
        $applicant->delete();
        return redirect()->back();
        
    }

    public function store(Request $request)
    {
        // Check two months ahead     
        $twoMonths = Carbon::now()->addMonths(2);
        if(!is_null($request->stay_type_id)){            
            $stayExpiredate = $request->StayExpireDate;
            if($stayExpiredate > $twoMonths){
                return redirect('newapplyform')->with('error', 'နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်');
            }
        }
        // check labour card type with controller (double check)
        if($request->labour_card_type_id == 1){
            
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName)
                    ->where('ad.PassportNo', $request->PassportNo)
                    ->where('ad.labour_card_type_id', '!=', NULL)
                    ->get();
            
            //အ မှန် က  ($check->count() != 0);
            if($check->count() != 0){
                // return redirect('applyformNew')->with('error',$request->PersonName. ' သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။');
                return redirect('newapplyform')->with('error', $request->PersonName. 'သည် အလုပ်သမားကဒ်လျှောက်ထားပြီး ဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ထားခွင့်ရှိပါမည်။');
            }
        }
    
        // check stay 2 month after approve with controller (double check)
        $twoMonthSub = Carbon::now()->subMonths(2);        
        if(!is_null($request->stay_type_id)){  
            $check = DB::table('visa_application_details as ad')
                    ->join('visa_application_heads as ah', 'ah.id', 'ad.visa_application_head_id')
                    ->where('ah.Status', 1)
                    ->where('ad.PersonName', $request->PersonName)
                    ->where('ad.PassportNo', $request->PassportNo)
                    ->where('ah.ApproveDate', '>', $twoMonthSub)
                    ->where('ad.stay_type_id', '!=', NULL)
                    ->get();
                    // dd('check stay 2 month');
            if($check->count() != 0){
                // dd('something');
                return redirect('newapplyform')->with('error',$request->PersonName. '  သည် နေထိုင်ခွင့်သက်တမ်းတိုးလျှောက်ထားခြင်းအား ခွင့်ပြုပြီး ၂ လ ပြည့်မှသာ ပြန်လည်လျှောက်ထားခွင့် ရနိုင်ပါမည်။'); 
            }
        }
        
        // check inprocess state
        // dd('checking inprocess');
        // (! ကို ဖြုတ်ထား သည်  အမှန် က (! is_null(request->PersonName)))
        if (!is_null($request->PersonName) && !is_null($request->PassportNo)) {
            // dd(auth()->user()->id);
            $visa = VisaApplicationHead::join('visa_application_details', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
                    ->where('visa_application_heads.user_id',auth()->user()->id) // solved duplicate error
                    ->where('visa_application_details.PersonName',$request->PersonName)
                    ->where('visa_application_details.PassportNo',$request->PassportNo)
                    ->where('visa_application_heads.status', '!=', 1)
                    ->where('visa_application_heads.status', '!=', 2)
                    ->count();
            // dd($visa->get());
            if($visa == 1){
                // dd('error in check inprocess state');
                return redirect()->route('newapplyform')->with('error',$request->PersonName.'သည်လျှောက်ထားဆဲဖြစ်နေသဖြင့်ထက်မံလျှောက်ထား၍မရပါ။');
            }
        }
       if( $request->submitButton == 0)
        {
            if (!is_null($request->nationality_id) && !is_null($request->PersonName) && !is_null($request->PassportNo)) {

                if (is_null($request->labour_card_type_id)) {
                    $labour_duration_id = NULL;
                }
                else{
                    $labour_duration_id = $request->labour_card_duration;
                }   
                $applicants=VisaApplicationDetail::where('profile_id',Auth::user()->profile->id)
                            ->whereNull('visa_application_head_id')->count();
                if($applicants == 7){
                    return redirect('applyform')->with('error','၇ ဉီးထက် ပို၍လျှောက်ထား၍မရပါ။');
                }
                $passport = NULL;
                $micLetter= NULL;
                $extract= NULL;
                $labourCard=NULL;
                $techpassport=NULL;
                $evidence=NULL;
                $underTaking=NULL;
                $formcfile = NULL;

                if($request->file('passport')){
                   $passport=$request->file('passport');
                   $passport= $this->storeAttachments($passport);
                }
                if($request->file('micLetter')){
                    $micLetter=$request->file('micLetter');
                    $micLetter= $this->storeAttachments($micLetter);
                 }
                 if($request->file('extract')){
                    $extract=$request->file('extract');
                    $extract= $this->storeAttachments($extract);
                 }
                 if($request->file('labourCard')){
                    $labourCard=$request->file('labourCard');
                    $labourCard= $this->storeAttachments($labourCard);
                 }
                 if($request->file('techPassport')){
                    $techpassport=$request->file('techPassport');
                    $techpassport= $this->storeAttachments($techpassport);
                 }
                 if($request->file('evidence')){
                    $evidence=$request->file('evidence');
                    $evidence= $this->storeAttachments($evidence);
                 }
                 if($request->file('underTaking')){
                    $underTaking=$request->file('underTaking');
                    $underTaking= $this->storeAttachments($underTaking);
                 }
                 if ($request->file('formcfile')) {
                    $formcfile = $request->file('formcfile');
                    $formcfile = $this->storeAttachments($formcfile);
                 }

                //  dd($request->file('formcfile'));
                 
                $visa_detail = VisaApplicationDetail::Create([

                    'profile_id' => Auth::user()->profile->id,  
                    'nationality_id' => $request->nationality_id,
                    'PersonName' => $request->PersonName,
                    'PassportNo' => $request->PassportNo,
                    'StayAllowDate' => $request->StayAllowDate,
                    'StayExpireDate' => $request->StayExpireDate,
                    'person_type_id' => $request->person_type_id,
                    'DateOfBirth' => $request->DateOfBirth,
                    'Gender' => $request->Gender,
                    'FormC' => $request->FormC,
                    'visa_type_id' => $request->visa_type_id,
                    'stay_type_id' => $request->stay_type_id,
                    'labour_card_type_id' => $request->labour_card_type_id,
                    'labour_card_duration_id' => $labour_duration_id,
                    'relation_ship_id' => $request->relation_ship_id,
                    'Remark' => $request->Remark,
                    'passport_attach'=> $passport,
                    'mic_approved_letter_attach'=> $micLetter,
                    'labour_card_attach'=> $labourCard,
                    'extract_form_attach'=> $extract,
                    'applicant_form_attach'=>$underTaking,
                    'technician_passport_attach'=> $techpassport,
                    'evidence_attach'=> $evidence,
                    'formcfile_attch'=> $formcfile
                ]);     
            }

            // return redirect()->route('applyforunderTakingmNew');
            return redirect('newapplyform');

        }else{
       
            $visa_detail = VisaApplicationDetail::find($request->detailId);
            
                $passport = NULL;
                $micLetter= NULL;
                $extract= NULL;
                $labourCard=NULL;
                $techpassport=NULL;
                $evidence=NULL;
                $underTaking=NULL;
                $formcfile = NULL;

            if($request->hasfile('passport')){
              if(!is_null($visa_detail->passport_attach)){
                $filePath1 = public_path() . $visa_detail->passport_attach;
                if(File::exists($filePath1))
                    File::delete($filePath1);
                }
                $passport=$request->file('passport');
                $passport= $this->storeAttachments($passport);
            }else{
                $passport=$visa_detail->passport_attach;
            }

            

            if($request->hasfile('underTaking')){
                if(!is_null($visa_detail->applicant_form_attach)){
                $filePath7 = public_path() . $visa_detail->applicant_form_attach;
                // dd($filePath7);
                if(File::exists($filePath7))
                    File::delete($filePath7);
                }
                $underTaking=$request->file('underTaking');
                $underTaking= $this->storeAttachments($underTaking);
            }else{
            
                $underTaking=$visa_detail->applicant_form_attach;
                // dd($underTaking);
            }

            if($request->hasfile('formcfile')){
                if($visa_detail->formcfile_attch){
                    $filePath9 = public_path().$visa_detail->formcfile_attch;
                    // dd('notnull');
                    if(File::exists($filePath9)){
                        File::delete($filePath9);
                    }
                }
                $formcfile = $request->file('formcfile');
                $formcfile = $this->storeAttachments($formcfile);
            }else {
                $formcfile = $visa_detail->formcfile_attch;
            } 
            
            // if ($request->hasfile('formcfile')) {
            //     if(!is_null($visa_detail->formcfile_attch)){
            //         $filePath9 = public_path() . $visa_detail->formcfile_attch;
            //         dd($filePath9);
            //         if (File::exists($filePath9)) {
            //             File::delete($filePath9);
            //         }
                    
            //         $formcfile = $request->file('formcfile');
            //         $formcfile = $this->storeAttachments($formcfile);
            //     }
            // }else{
            //     $formcfile = $visa_detail->formcfile_attch;
            // }
            // dd($request->formcfile);
            if($request->person_type_id == 1 || $request->person_type_id == 3){

                if($request->hasfile('labourCard')){
                    if(!is_null($visa_detail->labour_card_attach)){
                        $filePath3 = public_path() . $visa_detail->labour_card_attach;
                        if(File::exists($filePath3))
                            File::delete($filePath3);
                    }
                    $labourCard=$request->file('labourCard');
                    $labourCard= $this->storeAttachments($labourCard);
                }else{
                    $labourCard=$visa_detail->labour_card_attach;
                }
            }

            if($request->person_type_id == 3 || $request->person_type_id == 4){
                if($request->hasfile('micLetter')){
                    if(!is_null($visa_detail->mic_approved_letter_attach)){
                        $filePath2 = public_path() . $visa_detail->mic_approved_letter_attach;
                        if(File::exists($filePath2))
                            File::delete($filePath2);
                    }
                    $micLetter=$request->file('micLetter');
                    $micLetter= $this->storeAttachments($micLetter);
                }else{
                    $micLetter=  $visa_detail->mic_approved_letter_attach;
                }
            }
            
            if($request->person_type_id == 1){
                if($request->hasfile('extract')){
                    if(!is_null($visa_detail->extract_form_attach)){
                        $filePath4 = public_path() . $visa_detail->extract_form_attach;
                        if(File::exists($filePath4))
                            File::delete($filePath4);
                    }
                    $extract=$request->file('extract');
                    $extract= $this->storeAttachments($extract);
                }else{
                    $extract=$visa_detail->extract_form_attach;
                }
            }

            if($request->person_type_id == 4){
                if($request->hasfile('techPassport')){
                    if(!is_null($visa_detail->technician_passport_attach)){
                        $filePath5 = public_path() . $visa_detail->technician_passport_attach;
                        if(File::exists($filePath5))
                            File::delete($filePath5);
                    }
                    $techpassport=$request->file('techPassport');
                    $techpassport= $this->storeAttachments($techpassport);
                }else{
                    $techpassport=$visa_detail->technician_passport_attach;
                }

                if($request->hasfile('evidence')){
                    if(!is_null($visa_detail->evidence_attach)){
                    $filePath6 = public_path() . $visa_detail->evidence_attach;
                    if(File::exists($filePath6))
                        File::delete($filePath6);
                    }
                        $evidence=$request->file('evidence');
                        $evidence= $this->storeAttachments($evidence);
                }else{
                    $evidence=$visa_detail->evidence_attach;
                }
                
            }

            // dd($request->formcfile);

            $labour_card_type=null;
            $labour_duration=null;
            $relation_ship=null;
            $remark=null;
            if($request->person_type_id == 4){
                $relation_ship=$request->relation_ship_id;
                $remark= $request->Remark;
            }else{
                $labour_card_type =$request->labour_card_type_id;
                if (!is_null($request->labour_card_type_id)) {
                    $labour_duration = $request->labour_card_duration;
                }    
            }

            

            $visa_detail->update([
                
                'nationality_id' => $request->nationality_id,
                'PersonName' => $request->PersonName,
                'PassportNo' => $request->PassportNo,
                'StayAllowDate' => $request->StayAllowDate,
                'StayExpireDate' => $request->StayExpireDate,
                'person_type_id' => $request->person_type_id,
                'DateOfBirth' => $request->DateOfBirth,
                'Gender' => $request->Gender,
                'FormC' => $request->FormC,
                'visa_type_id' => $request->visa_type_id,
                'stay_type_id' => $request->stay_type_id,
                'labour_card_type_id' => $labour_card_type,
                'labour_card_duration_id' => $labour_duration,
                'relation_ship_id' => $relation_ship,
                'Remark' => $remark,
                'passport_attach'=> $passport,
                'mic_approved_letter_attach'=> $micLetter,
                'labour_card_attach'=> $labourCard,
                'extract_form_attach'=> $extract,
                'applicant_form_attach' => $underTaking,
                'technician_passport_attach'=> $techpassport,
                'evidence_attach'=> $evidence,
                'formcfile_attch'=> $formcfile
            ]); 
        }    
  
        // dd($Subject);
        Toastr::success('Success!');

        if($request->submitButton == '1' ){
            return redirect()->route('applyformNew');
        }else if($request->submitButton == '2'){
            return redirect()->route('applyFormReject',['id'=> $visa_detail->visa_application_head_id]); 
        }
     
       
    }

    // Delete start
    public function delete($id){
        $applicant=VisaApplicationDetail::find($id);
        $file3=public_path().$applicant->passport_attach;
        $file4=public_path().$applicant->mic_approved_letter_attach;
        $file5=public_path().$applicant->labour_card_attach;
        $file6=public_path().$applicant->extract_form_attach;
        $file7=public_path().$applicant->technician_passport_attach;
        $file8=public_path().$applicant->evidence_attach;
        $file9=public_path().$applicant->formcfile_attch;
        File::delete($file3,$file4,$file5,$file6,$file7,$file8,$file9);
        $applicant->delete();
        return redirect()->route('applyformNew');
    }
    //Delete End


    // APplicants Form store Start
    public function applicationFormStore(Request $request){
        $applicants=VisaApplicationDetail::where('profile_id',Auth::user()->profile->id)
                    ->whereNull('visa_application_head_id')->get();
        $VisaApply = false;
        $StayApply = false;
        $LabourCardApply = false;
        $Subject = "";
        $des = '';
        $VisaApplySingle = false;
        $VisaApplyMultiple = false;
        $LabourCardApplyNew = false;
        $LabourCardApplyRenew = false;
        $oss_status = '';
        foreach($applicants as $applicant){
            if ($applicant->visa_type_id != null) {
                $VisaApply = true;
    
                if ($applicant->visa_type_id == 1){
                    $VisaApplySingle = true;
                } else if ($applicant->visa_type_id == 2){
                    $VisaApplyMultiple = true;
                }
            }
            if ($applicant->stay_type_id != null) {
                $StayApply = true;
            }
            if ($applicant->labour_card_type_id != null) {
                $LabourCardApply = true;
    
                if ($applicant->labour_card_type_id == 1){
                    $LabourCardApplyNew = true;
                } else if ($applicant->labour_card_type_id == 2){
                    $LabourCardApplyRenew = true;
                }
            }
        }

        if ($StayApply == true && $VisaApply == true && $LabourCardApply == true) {
            if ($VisaApplySingle == true && $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == true && $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == false && $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
    
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့်၊ " . $Subject . " နှင့် ";
    
            if ($LabourCardApplyNew == true && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } else if ($LabourCardApplyNew == true && $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } else if ($LabourCardApplyNew == false && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }
    
            $oss_status = 3;
        }
        else if ($StayApply == true && $VisaApply == true && $LabourCardApply == false) {
            if ($VisaApplySingle == true && $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == true && $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == false && $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " . $Subject;
    
            $oss_status = 1;
        }
        else if ($StayApply == true && $VisaApply == false && $LabourCardApply == true) {
            if ($LabourCardApplyNew == true && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } else if ($LabourCardApplyNew == true && $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } else if ($LabourCardApplyNew == false && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " . $Subject;
    
            $oss_status = 3;
        }
        else if ($StayApply == false && $VisaApply == true && $LabourCardApply == true) {
            if ($VisaApplySingle == true && $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == true && $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == false && $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
            $Subject = $Subject . " နှင့် ";
            if ($LabourCardApplyNew == true && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } else if ($LabourCardApplyNew == true && $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } else if ($LabourCardApplyNew == false && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }
    
            $oss_status = 3;
        }
        else if ($StayApply == true && $VisaApply == false && $LabourCardApply == false) {
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခြင်း";
            $oss_status = 1;
        }
        else if ($StayApply == false && $VisaApply == true && $LabourCardApply == false) {
            if ($VisaApplySingle == true && $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == true && $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == false && $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
    
            $oss_status = 1;
        }
        else if ($StayApply == false && $VisaApply == false && $LabourCardApply == true) {
            if ($LabourCardApplyNew == true && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } else if ($LabourCardApplyNew == true && $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } else if ($LabourCardApplyNew == false && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }
    
            $oss_status = 2;
        }

        $des = "နိုင်ငံခြားသား ( ".$this->en2mmNumber($applicants->count())." ) ဦး အား ".$Subject." ပြုလုပ်ခွင့်ပေးပါရန် တင်ပြလာခြင်း";
        $profile=Profile::where('user_id',Auth::user()->id)->first();

        $visa_head = VisaApplicationHead::create([
            "user_id"=>Auth::user()->id,
            "profile_id"=>$profile->id,
            "StaffLocalProposal"=>$profile->StaffLocalProposal,
            "StaffForeignProposal"=>$profile->StaffForeignProposal,
            "StaffLocalSurplus"=>$profile->StaffLocalSurplus,
            "StaffForeignSurplus"=>$profile->StaffForeignSurplus,
            "StaffLocalAppointed"=>$profile->StaffLocalAppointed,
            "StaffForeignAppointed"=>$profile->StaffForeignAppointed,
            "FirstApplyDate"=>now(),
            "FinalApplyDate"=>now(),
            "Status"=>0,
            'Subject'=>$des,
            'OssStatus'=>$oss_status
        ]);

        foreach($applicants as $applicant){
            $applicant->update(['visa_application_head_id'=>$visa_head->id]);
        }
        Toastr::success('Your applicationform has been sent!');
        return redirect()->route('home');
    }
    //Applicants Form store End

    //Applicnts Form reject Start
    public function applyFormReject($id){
       
        $visa_details=VisaApplicationDetail::where('visa_application_head_id',$id)
        ->where('reject_status',0)
        ->get();
        $visa_head=VisaApplicationHead::find($id);
        $applicants=VisaApplicationDetail::where('visa_application_head_id',$id)->get();
        return view('newRejectApplicationList',compact('visa_details','visa_head','applicants'));
    }
    //Applicants Form reject End


    //Reject ApplicantUpdate Start
    public function rejectApplicantUpdate(Request $request){
        $visa_details=VisaApplicationDetail::where('visa_application_head_id',$request->headId)->where('reject_status',0)->get();

        foreach($visa_details as $visa_detail){
            $visa_detail->update([
                'reject_status'=>1
            ]);
        }
        $applicants=VisaApplicationDetail::where('visa_application_head_id',$request->headId)->get();
        $VisaApply = false;
        $StayApply = false;
        $LabourCardApply = false;
        $Subject = "";
        $des = '';
        $VisaApplySingle = false;
        $VisaApplyMultiple = false;
        $LabourCardApplyNew = false;
        $LabourCardApplyRenew = false;
        $oss_status = '';
        foreach($applicants as $applicant){
            if ($applicant->visa_type_id != null) {
                $VisaApply = true;
    
                if ($applicant->visa_type_id == 1){
                    $VisaApplySingle = true;
                } else if ($applicant->visa_type_id == 2){
                    $VisaApplyMultiple = true;
                }
            }
            if ($applicant->stay_type_id != null) {
                $StayApply = true;
            }
            if ($applicant->labour_card_type_id != null) {
                $LabourCardApply = true;
    
                if ($applicant->labour_card_type_id == 1){
                    $LabourCardApplyNew = true;
                } else if ($applicant->labour_card_type_id == 2){
                    $LabourCardApplyRenew = true;
                }
            }      
        }

        if ($StayApply == true && $VisaApply == true && $LabourCardApply == true) {
            if ($VisaApplySingle == true && $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == true && $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == false && $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
    
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့်၊ " . $Subject . " နှင့် ";
    
            if ($LabourCardApplyNew == true && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } else if ($LabourCardApplyNew == true && $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } else if ($LabourCardApplyNew == false && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }
    
            $oss_status = 3;
        }
        else if ($StayApply == true && $VisaApply == true && $LabourCardApply == false) {
            if ($VisaApplySingle == true && $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == true && $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == false && $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " . $Subject;
    
            $oss_status = 1;
        }
        else if ($StayApply == true && $VisaApply == false && $LabourCardApply == true) {
            if ($LabourCardApplyNew == true && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } else if ($LabourCardApplyNew == true && $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } else if ($LabourCardApplyNew == false && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် " . $Subject;
    
            $oss_status = 3;
        }
        else if ($StayApply == false && $VisaApply == true && $LabourCardApply == true) {
            if ($VisaApplySingle == true && $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == true && $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == false && $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
            $Subject = $Subject . " နှင့် ";
            if ($LabourCardApplyNew == true && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } else if ($LabourCardApplyNew == true && $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } else if ($LabourCardApplyNew == false && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }
    
            $oss_status = 3;
        }
        else if ($StayApply == true && $VisaApply == false && $LabourCardApply == false) {
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခြင်း";
            $oss_status = 1;
        }
        else if ($StayApply == false && $VisaApply == true && $LabourCardApply == false) {
            if ($VisaApplySingle == true && $VisaApplyMultiple == true) {
                $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == true && $VisaApplyMultiple == false) {
                $Subject = "တစ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            } else if ($VisaApplySingle == false && $VisaApplyMultiple == true) {
                $Subject = "အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            }
    
            $oss_status = 1;
        }
        else if ($StayApply == false && $VisaApply == false && $LabourCardApply == true) {
            if ($LabourCardApplyNew == true && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်/သက်တမ်းတိုး";
            } else if ($LabourCardApplyNew == true && $LabourCardApplyRenew == false) {
                $Subject .= "အလုပ်သမားကဒ် အသစ်";
            } else if ($LabourCardApplyNew == false && $LabourCardApplyRenew == true) {
                $Subject .= "အလုပ်သမားကဒ် သက်တမ်းတိုး";
            }
    
            $oss_status = 2;
        }

        $des = "နိုင်ငံခြားသား ( ".$this->en2mmNumber($applicants->count())." ) ဦး အား ".$Subject." ပြုလုပ်ခွင့်ပေးပါရန် တင်ပြလာခြင်း";

        $visa_head=VisaApplicationHead::find($request->headId);
        $profile=Profile::where('id',$visa_head->profile_id)->first();
        $visa_head->update([
            "StaffLocalProposal"=>$profile->StaffLocalProposal,
            "StaffForeignProposal"=>$profile->StaffForeignProposal,
            "StaffLocalSurplus"=>$profile->StaffLocalSurplus,
            "StaffForeignSurplus"=>$profile->StaffForeignSurplus,
            "StaffLocalAppointed"=>$profile->StaffLocalAppointed,
            "StaffForeignAppointed"=>$profile->StaffForeignAppointed,
            "Status"=>0,
            "ReviewerSubmitted"=>null,
            "FinalApplyDate"=>now(),
            'Subject'=>$des,
            'OssStatus'=>$oss_status
        ]);
        Toastr::success('Your applicationform has been sent!');
        return redirect()->route('home');
    }
    //Reject ApplicantUpade End


    //Store Attachments Start
    private function storeAttachments($attach)
    {
        $path = public_path().'/visadetail_attach/';
        // dd($path);
            $name =  Str::random(40).'.'.$attach->getClientOriginalExtension();
            $attach->move($path, $name);
            $attachPath ='/visadetail_attach/' . $name;
            return $attachPath;
    }
    // Store Attachments End

    public function en2mmNumber($content)
    {
        $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $my = ['၀','၁', '၂', '၃', '၄', '၅', '၆', '၇', '၈', '၉'];
  
        return str_replace($en, $my, (string) $content);
    }

}
