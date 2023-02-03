<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\VisaType;
use App\Models\PersonType;
use App\Models\Nationality;
use App\Models\LabourCardType;
use App\Models\StayType;
use App\Models\RelationShip;
use App\Models\VisaApplicationHead;
use App\Models\VisaApplicationHeadAttachment;
use App\Models\VisaApplicationDetail;
use App\Models\VisaApplicationDetailAttachment;
use Auth;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class VisaApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    public function index()
    {
    	$user_id = Auth::user()->id;
        $visa_types = VisaType::all();
        $person_types = PersonType::all();
        $nationalities = Nationality::orderBy('NationalityName')->get();
        $labour_card_types = LabourCardType::all();
        $stay_types = StayType::all();
        $stay_types = StayType::all();
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

    	return view('applicationform',compact('profile','visa_types','person_types','nationalities','labour_card_types','stay_types','relation_ships','total_local','total_foreign','available_local','available_foreign'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'FilePath' => 'max:3000',
        ]);

        $ApplicantNumbers = 0;
        $VisaApply = false;
        $StayApply = false;
        $LabourCardApply = false;
        $Subject = "";

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
                'relation_ship_id' => $request->relation_ship_id1,
                'Remark' => $request->Remark1,
            ]);

            if (!is_null($request->visa_type_id1)) {
                $VisaApply = true;
            }
            if (!is_null($request->stay_type_id1)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id1)) {
                $LabourCardApply = true;
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

            
        if (!is_null($request->nationality_id2) && !is_null($request->PersonName2) && !is_null($request->PassportNo2)) {
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
                'relation_ship_id' => $request->relation_ship_id2,
                'Remark' => $request->Remark2,
            ]);


            if (!is_null($request->visa_type_id2)) {
                $VisaApply = true;
            }
            if (!is_null($request->stay_type_id2)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id2)) {
                $LabourCardApply = true;
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
                'relation_ship_id' => $request->relation_ship_id3,
                'Remark' => $request->Remark3,
            ]);


            if (!is_null($request->visa_type_id3)) {
                $VisaApply = true;
            }
            if (!is_null($request->stay_type_id3)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id3)) {
                $LabourCardApply = true;
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
                'relation_ship_id' => $request->relation_ship_id4,
                'Remark' => $request->Remark4,
            ]);


            if (!is_null($request->visa_type_id4)) {
                $VisaApply = true;
            }
            if (!is_null($request->stay_type_id4)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id4)) {
                $LabourCardApply = true;
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
                'relation_ship_id' => $request->relation_ship_id5,
                'Remark' => $request->Remark5,
            ]);


            if (!is_null($request->visa_type_id5)) {
                $VisaApply = true;
            }
            if (!is_null($request->stay_type_id5)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id5)) {
                $LabourCardApply = true;
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
                'relation_ship_id' => $request->relation_ship_id6,
                'Remark' => $request->Remark6,
            ]);


            if (!is_null($request->visa_type_id6)) {
                $VisaApply = true;
            }
            if (!is_null($request->stay_type_id6)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id6)) {
                $LabourCardApply = true;
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
                'relation_ship_id' => $request->relation_ship_id7,
                'Remark' => $request->Remark7,
            ]);


            if (!is_null($request->visa_type_id7)) {
                $VisaApply = true;
            }
            if (!is_null($request->stay_type_id7)) {
                $StayApply = true;
            }
            if (!is_null($request->labour_card_type_id7)) {
                $LabourCardApply = true;
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
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့်၊ တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ နှင့် အလုပ်သမားကတ် အသစ်/သက်တမ်းတိုး";
            $oss_status = 3;
        }
        elseif ($StayApply == True && $VisaApply == True && $LabourCardApply == False) {
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            $oss_status = 1;
        }
        elseif ($StayApply == True && $VisaApply == False && $LabourCardApply == True) {
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခွင့် နှင့် အလုပ်သမားကတ် အသစ်/သက်တမ်းတိုး";
            $oss_status = 3;
        }
        elseif ($StayApply == False && $VisaApply == True && $LabourCardApply == True) {
            $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ နှင့် အလုပ်သမားကတ် အသစ်/သက်တမ်းတိုး";
            $oss_status = 3;
        }
        elseif ($StayApply == True && $VisaApply == False && $LabourCardApply == False) {
            $Subject = "နေထိုင်ခွင့်သက်တမ်းတိုးခြင်း";
            $oss_status = 1;
        }
        elseif ($StayApply == False && $VisaApply == True && $LabourCardApply == False) {
            $Subject = "တစ်ကြိမ်/အကြိမ်ကြိမ် ပြည်ဝင်ခွင့်ဗီဇာ";
            $oss_status = 1;
        }
        elseif ($StayApply == False && $VisaApply == False && $LabourCardApply == True) {
            $Subject = "အလုပ်သမားကတ် အသစ်/သက်တမ်းတိုး";
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

        // dd($app_numbers);

        $des = "နိုင်ငံခြားသား ( ".$app_numbers." )ဦး အား ".$Subject." ပြုလုပ်ခွင့်ပေးပါရန် တင်ပြလာခြင်း";

        $visa_head->update(['Subject'=>$des]);
        $visa_head->update(['OssStatus'=>$oss_status]);


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

        return view('reject_applicationform',compact('profile','visa_types','person_types','nationalities','labour_card_types','stay_types','relation_ships','total_local','total_foreign','available_local','available_foreign','count','visa_details','visa_head'));
    }

    public function getData($data, $key)
    {
        return isset($data[key]) ? $data[key] : null;
    }

    public function update($id,Request $request)
    {
        $visa_head = VisaApplicationHead::findOrFail($id);
        //CompanyUpdate
        $visa_head->update(['Status'=>0]);
        $visa_head->update(['ReviewerSubmitted'=>Null]);

        

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
            $visa_detail1->update(['relation_ship_id'=>request('relation_ship_id1')]);
            $visa_detail1->update(['Remark'=>request('Remark1')]);

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
            $visa_detail2->update(['relation_ship_id'=>request('relation_ship_id2')]);
            $visa_detail2->update(['Remark'=>request('Remark2')]);

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
            $visa_detail3->update(['relation_ship_id'=>request('relation_ship_id3')]);
            $visa_detail3->update(['Remark'=>request('Remark3')]);

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
            $visa_detail4->update(['relation_ship_id'=>request('relation_ship_id4')]);
            $visa_detail4->update(['Remark'=>request('Remark4')]);

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
            $visa_detail5->update(['relation_ship_id'=>request('relation_ship_id5')]);
            $visa_detail5->update(['Remark'=>request('Remark5')]);

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
            $visa_detail6->update(['relation_ship_id'=>request('relation_ship_id6')]);
            $visa_detail6->update(['Remark'=>request('Remark6')]);

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
            $visa_detail7->update(['relation_ship_id'=>request('relation_ship_id7')]);
            $visa_detail7->update(['Remark'=>request('Remark7')]);

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
        
        Toastr::success('Form Sent!');

        return redirect()->route('home');
    }
}
