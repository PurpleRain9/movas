<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\Region;
use App\Models\PermitType;
use App\Models\Profile;
use Brian2694\Toastr\Facades\Toastr;
use Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function passwordReset()
    {
        return view('passwordResetSuccess');
    }

    public function index()
    {
        $sectors = Sector::all();
        $regions = Region::all();
        $permittypes = PermitType::all();

        return view('signup',compact('sectors','regions','permittypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'AttachPermit' => "required|mimes:pdf",
            'AttachProposal' => "required|mimes:pdf",
            'AttachAppointed' => "required|mimes:pdf",
            'AttachIncreased' => "mimes:pdf",
        ]);
        if (Auth::user()->Status == 0) {
            $permit=Profile::whereRaw("REPLACE(`PermitNo`, ' ', '') = ? ", str_replace(' ', '', $request->PermitNo))
                            ->where('permit_type_id',$request->permit_type_id)->count();

           if($permit != 0){
                return redirect()->back()->with('error', $request->PermitNo.'သည် System ထဲတွင်ရှိပြီးသားဖြစ်ပါသဖြင့်ဆက်လက်လျှောက်ထား၍မရပါ။');
           }else{
            $att1=null;
            $att2=null;
            $att3=null;
            $att4=null;
            if ($request->hasfile('AttachPermit')) {
                $profile1 = $request->file('AttachPermit');
                $upload_path1 =public_path().'/profile_attach/';
                $name1 = Str::random(40).'AttachPermit'.time().'.'.$profile1->getClientOriginalExtension();
                $profile1->move($upload_path1,$name1);
                $att1 = '/profile_attach/'.$name1;
            }

            if ($request->hasfile('AttachProposal')) {
                $profile2 = $request->file('AttachProposal');
                $upload_path2 =public_path().'/profile_attach/';
                $name2 = Str::random(40).'AttachProposal'.time().'.'.$profile2->getClientOriginalExtension();
                $profile2->move($upload_path2,$name2);
                $att2 = '/profile_attach/'.$name2;
            }

            if ($request->hasfile('AttachAppointed')) {
                $profile3 = $request->file('AttachAppointed');
                $upload_path3 =public_path().'/profile_attach/';
                $name3 = Str::random(40).'AttachAppointed'.time().'.'.$profile3->getClientOriginalExtension();
                $profile3->move($upload_path3,$name3);
                $att3 = '/profile_attach/'.$name3;
            }

            if ($request->hasfile('AttachIncreased')) {
                $profile4 = $request->file('AttachIncreased');
                $upload_path4 =public_path().'/profile_attach/';
                $name4 = Str::random(40).'AttachIncreased'.time().'.'.$profile4->getClientOriginalExtension();
                $profile4->move($upload_path4,$name4);
                $att4 = '/profile_attach/'.$name4;
            }

            // dd($att);

            // dd($request->all());
            $profile = Profile::create([
                "user_id"=>$request['user_id'],
                "CompanyName"=>$request['CompanyName'],
                "CompanyRegistrationNo"=>$request['CompanyRegistrationNo'],
                "sector_id"=>$request['sector_id'],
                "BusinessType"=>$request['BusinessType'],
                "permit_type_id"=>$request['permit_type_id'],
                "PermitNo"=> str_replace(' ', '',  $request['PermitNo']),
                "PermittedDate"=>$request['PermittedDate'],
                "CommercializationDate"=>$request['CommercializationDate'],
                "LandNo"=>$request['LandNo'],
                "LandSurveyDistrictNo"=>$request['LandSurveyDistrictNo'],
                "IndustrialZone"=>$request['IndustrialZone'],
                "Township"=>$request['Township'],
                "region_id"=>$request['region_id'],
                "StaffLocalProposal"=>$request['StaffLocalProposal'],
                "StaffForeignProposal"=>$request['StaffForeignProposal'],
                "StaffLocalSurplus"=>$request['StaffLocalSurplus'],
                "StaffForeignSurplus"=>$request['StaffForeignSurplus'],
                "StaffLocalAppointed"=>$request['StaffLocalAppointed'],
                "StaffForeignAppointed"=>$request['StaffForeignAppointed'],
                "AttachPermit"=>$att1,
                "AttachProposal"=>$att2,
                "AttachAppointed"=>$att3,
                "AttachIncreased"=>$att4,
                "Status"=>0,
            ]);

            Auth::user()->update(['Status'=>1]);

            Toastr::success('Profile submitted. Please wait for admin approval!');

            return redirect()->back();
         }
        }
        else if (Auth::user()->Status == 3) {
            
            $id=Auth::user()->profile->id;
                $att1=null;
                $att2=null;
                $att3=null;
                $att4=null;
            $permit=Profile::whereRaw("REPLACE(`PermitNo`, ' ', '') = ? ", str_replace(' ', '', $request->PermitNo))
                    ->where('permit_type_id',$request->permit_type_id)
                    ->where('id','!=',$id)->count();
                if($permit != 0){
                return redirect()->back()->with('error', $request->PermitNo.'သည် System ထဲတွင်ရှိပြီးသားဖြစ်ပါသဖြင့်ဆက်လက်လျှောက်ထား၍မရပါ။');
                }else{
                if ($request->hasfile('AttachPermit')) {
                    $profile1 = $request->file('AttachPermit');
                    $upload_path1 =public_path().'/profile_attach/';
                    $name1 = Str::random(40).'AttachPermit'.time().'.'.$profile1->getClientOriginalExtension();
                    $profile1->move($upload_path1,$name1);
                    $att1 = '/profile_attach/'.$name1;
                }

                if ($request->hasfile('AttachProposal')) {
                    $profile2 = $request->file('AttachProposal');
                    $upload_path2 =public_path().'/profile_attach/';
                    $name2 = Str::random(40).'AttachProposal'.time().'.'.$profile2->getClientOriginalExtension();
                    $profile2->move($upload_path2,$name2);
                    $att2 = '/profile_attach/'.$name2;
                }

                if ($request->hasfile('AttachAppointed')) {
                    $profile3 = $request->file('AttachAppointed');
                    $upload_path3 =public_path().'/profile_attach/';
                    $name3 = Str::random(40).'AttachAppointed'.time().'.'.$profile3->getClientOriginalExtension();
                    $profile3->move($upload_path3,$name3);
                    $att3 = '/profile_attach/'.$name3;
                }

                if ($request->hasfile('AttachIncreased')) {
                    $profile4 = $request->file('AttachIncreased');
                    $upload_path4 =public_path().'/profile_attach/';
                    $name4 = Str::random(40).'AttachIncreased'.time().'.'.$profile4->getClientOriginalExtension();
                    $profile4->move($upload_path4,$name4);
                    $att4 = '/profile_attach/'.$name4;
                }
            
            $profile =Profile::findOrFail($id);
            $profile->update(['user_id'=>request('user_id')]);
            $profile->update(['CompanyName'=>request('CompanyName')]);   
            $profile->update(['CompanyRegistrationNo'=>request('CompanyRegistrationNo')]);
            $profile->update(['sector_id'=>request('sector_id')]);
            $profile->update(['BusinessType'=>request('BusinessType')]);
            $profile->update(['permit_type_id'=>request('permit_type_id')]);
            $profile->update(['PermitNo'=>request('PermitNo')]);
            $profile->update(['PermittedDate'=>request('PermittedDate')]);
            $profile->update(['CommercializationDate'=>request('CommercializationDate')]);
            $profile->update(['LandNo'=>request('LandNo')]);
            $profile->update(['LandSurveyDistrictNo'=>request('LandSurveyDistrictNo')]);
            $profile->update(['IndustrialZone'=>request('IndustrialZone')]);
            $profile->update(['Township'=>request('Township')]);
            $profile->update(['region_id'=>request('region_id')]);
            $profile->update(['StaffLocalProposal'=>request('StaffLocalProposal')]);
            $profile->update(['StaffForeignProposal'=>request('StaffForeignProposal')]);
            $profile->update(['StaffLocalSurplus'=>request('StaffLocalSurplus')]);
            $profile->update(['StaffForeignSurplus'=>request('StaffForeignSurplus')]);
            $profile->update(['StaffLocalAppointed'=>request('StaffLocalAppointed')]);
            $profile->update(['StaffForeignAppointed'=>request('StaffForeignAppointed')]);
            $profile->update(['Status'=>0]);
            $profile->update(['AttachPermit'=>$att1]);
            $profile->update(['AttachProposal'=>$att2]);
            $profile->update(['AttachAppointed'=>$att3]);
            $profile->update(['AttachIncreased'=>$att4]);

            Auth::user()->update(['Status'=>1]);

                Toastr::success('Profile submitted. Please wait for admin approval!');

                return redirect()->back();
                }
            } 	
        else{
                Toastr::error('Profile already submitted. Please wait for admin approval!');

                return redirect()->back();
            }
        
    }

    public function edit()
    {
      $sectors = Sector::all();
        $regions = Region::all();
        $permittypes = PermitType::all();

        return view('editprofile',compact('sectors','regions','permittypes'));
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'AttachPermit' => "mimes:pdf",
            'AttachProposal' => "mimes:pdf",
            'AttachAppointed' => "mimes:pdf",
            'AttachIncreased' => "mimes:pdf",
        ]);
       $profile = Profile::findOrFail($id);
       $profile->update(['user_id'=>request('user_id')]);
       $profile->update(['CompanyName'=>request('CompanyName')]);   
       $profile->update(['CompanyRegistrationNo'=>request('CompanyRegistrationNo')]);
       $profile->update(['sector_id'=>request('sector_id')]);
       $profile->update(['BusinessType'=>request('BusinessType')]);
       $profile->update(['permit_type_id'=>request('permit_type_id')]);
       $profile->update(['PermitNo'=>request('PermitNo')]);
       $profile->update(['PermittedDate'=>request('PermittedDate')]);
       $profile->update(['CommercializationDate'=>request('CommercializationDate')]);
       $profile->update(['LandNo'=>request('LandNo')]);
       $profile->update(['LandSurveyDistrictNo'=>request('LandSurveyDistrictNo')]);
       $profile->update(['IndustrialZone'=>request('IndustrialZone')]);
       $profile->update(['Township'=>request('Township')]);
       $profile->update(['region_id'=>request('region_id')]);
       $profile->update(['StaffLocalProposal'=>request('StaffLocalProposal')]);
       $profile->update(['StaffForeignProposal'=>request('StaffForeignProposal')]);
       $profile->update(['StaffLocalSurplus'=>request('StaffLocalSurplus')]);
       $profile->update(['StaffForeignSurplus'=>request('StaffForeignSurplus')]);
       $profile->update(['StaffLocalAppointed'=>request('StaffLocalAppointed')]);
       $profile->update(['StaffForeignAppointed'=>request('StaffForeignAppointed')]);

        if ($request->hasfile('AttachPermit')) {
            if(!is_null($profile->AttachPermit)){
                $filePath1 = public_path() . $profile->AttachPermit;
                if(File::exists($filePath1))
                    File::delete($filePath1);
            }
            $profile1 = $request->file('AttachPermit');
            $upload_path1 =public_path().'/profile_attach/';
            $name1 = Str::random(40).'AttachPermit'.time().'.'.$profile1->getClientOriginalExtension();
            $profile1->move($upload_path1,$name1);
            $att1 = '/profile_attach/'.$name1;
        }else{
            $att1= $request->att_old1;
        }

        if ($request->hasfile('AttachProposal')) {
            if(!is_null($profile->AttachProposal)){
                $filePath2 = public_path() . $profile->AttachProposal;
                if(File::exists($filePath2))
                    File::delete($filePath2);
            }
            $profile2 = $request->file('AttachProposal');
            $upload_path2 =public_path().'/profile_attach/';
            $name2 = Str::random(40).'AttachProposal'.time().'.'.$profile2->getClientOriginalExtension();
            $profile2->move($upload_path2,$name2);
            $att2 = '/profile_attach/'.$name2;
        }else{
            $att2= $request->att_old2;
        }

        if ($request->hasfile('AttachAppointed')) {
            if(!is_null($profile->AttachAppointed)){
                $filePath3 = public_path() . $profile->AttachAppointed;
                if(File::exists($filePath3))
                    File::delete($filePath3);
            }
            $profile3 = $request->file('AttachAppointed');
            $upload_path3 =public_path().'/profile_attach/';
            $name3 = Str::random(40).'AttachAppointed'.time().'.'.$profile3->getClientOriginalExtension();
            $profile3->move($upload_path3,$name3);
            $att3 = '/profile_attach/'.$name3;
        }else{
           $att3= $request->att_old3;
        }

        if ($request->hasfile('AttachIncreased')) {
            if(!is_null($profile->AttachIncreased)){
                $filePath4 = public_path() . $profile->AttachIncreased;
                if(File::exists($filePath4))
                    File::delete($filePath4);
            }
            $profile4 = $request->file('AttachIncreased');
            $upload_path4 =public_path().'/profile_attach/';
            $name4 = Str::random(40).'AttachIncreased'.time().'.'.$profile4->getClientOriginalExtension();
            $profile4->move($upload_path4,$name4);
            $att4 = '/profile_attach/'.$name4;
        }else{
            $att4= $request->att_old4;
        }

            $profile->update(['AttachPermit'=>$att1]);
            $profile->update(['AttachProposal'=>$att2]);
            $profile->update(['AttachAppointed'=>$att3]);
             $profile->update(['AttachIncreased'=>$att4]);

       Toastr::success('Profile updated!');

       return redirect()->back();

   }

   public function deleteIncreased($id)
   {
        $profile = Profile::findOrFail($id);

        if ($profile->AttachIncreased != '') {
            $file = public_path() . $profile->AttachIncreased;

            unlink($file);
        }
       $profile->update(['AttachIncreased'=>'']);

       Toastr::success('Profile updated!');

       return redirect()->back();
   }
   public function undertaking(){
    return view('undertaking');
   }
}
