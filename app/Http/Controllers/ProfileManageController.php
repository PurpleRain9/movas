<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\ProfileDelete;
use App\Models\VisaApplicationHead;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class ProfileManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request){

        $search = $request->search;
        $admin = auth()->user();
        if (!is_null($search)) {
            $profiles = Profile::where('CompanyName', 'like', '%'.$search.'%')
            ->paginate(20);
            // dd($profiles);
        }else{
            $profiles = Profile::latest()
            ->paginate(20);
        }
        // dd($profiles);
        return view('admin.profile_management.profiletable', compact('profiles','admin'));
    }

    public function deleteProfile($id){

        $profile = Profile::findOrFail($id);
        // dd($profile);
        $admin = auth()->user();
        // dd($admin->username);
        $admin_id = $admin->id;
        $visaHead = VisaApplicationHead::where('profile_id','=', $profile->id)->limit(1)->get();
        // dd($visaHead->count());
        if ($visaHead->count()) {
            return redirect('/profiletable')->with('error', 'လက်ရှိ ကုမ္ပဏီသည် ၀န်ထမ်းများခန့်ထားပါဖြင့် Profile အားဖျတ်၍ မရပါ။');
            dd('Visadetailhead in profile seen');
            
        }else{
            ProfileDelete::create([
                'id' => $profile['id'],
                'user_id' => $profile['user_id'],
                // 'rejectTimes' => $profile['rejectTimes'],
                'CompanyName' => $profile['CompanyName'],
                'CompanyRegistrationNo' => $profile['CompanyRegistrationNo'],
                'sector_id' => $profile['sector_id'],
                'BusinessType' => $profile['BusinessType'],
                'permit_type_id' => $profile['permit_type_id'],
                'PermitNo' => $profile['PermitNo'],
                'PermittedDate' => $profile['PermittedDate'],
                'CommercializationDate'=> $profile['CommercializationDate'],
                'LandNo' => $profile['LandNo'],
                'LandSurveyDistrictNo' => $profile['LandSurveyDistrictNo'],
                'IndustrialZone' => $profile['IndustrialZone'],
                'Township' => $profile['Township'],
                'region_id' => $profile['region_id'],
                'StaffLocalProposal' => $profile['StaffLocalProposal'],
                'StaffForeignProposal' => $profile['StaffForeignProposal'],
                'StaffLocalSurplus' => $profile['StaffLocalSurplus'],
                'StaffForeignSurplus' => $profile['StaffForeignSurplus'],
                'StaffLocalAppointed' => $profile['StaffLocalAppointed'],
                'StaffForeignAppointed' => $profile['StaffForeignAppointed'],
                'AttachPermit' => $profile['AttachPermit'],
                'AttachProposal' => $profile['AttachProposal'],
                'AttachAppointed' => $profile['AttachAppointed'],
                'AttachIncreased' => $profile['AttachIncreased'],
                'Status' => $profile['Status'],
                'ApproveDate' => $profile['ApproveDate'],
                'admin_id' => $admin_id
            ]);
            $profile->delete();
            Toastr::success('User deleted!');
            return redirect('/profiletable');
        }
        
    }

    // Profile Deleted Show

    public function showdeleted(Request $request){
        $search = $request->search;
        
        if (!is_null($search)) {
            $deleteProfiles = ProfileDelete::where('CompanyName', 'like', '%'.$search.'%')
            ->paginate(20); 
            // dd($profiles);
        }else{
            $deleteProfiles = ProfileDelete::latest()
            ->paginate(20);
        }
        return view('admin.profile_management.profiledeletedshow', compact('deleteProfiles'));
    }

}
