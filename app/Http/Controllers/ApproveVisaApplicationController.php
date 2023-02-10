<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rank;
use App\Models\VisaApplicationHead;
use App\Models\VisaApplicationHeadAttachment;
use App\Models\VisaApplicationDetail;
use App\Models\VisaApplicationDetailAttachment;
use App\Models\Admin;
use App\Models\ApproveLetter;
use App\Models\Dependant;
use App\Models\Director;
use App\Models\Remark;
use App\Models\ForeignTechician;
use App\Models\Profile;
use App\Models\RejectHistory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use PDO;

class ApproveVisaApplicationController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        $ranks = Rank::all();
        return view('admin.visadetail',compact('ranks'));
    }

    public function show($id)
    {
        $ranks = Rank::all();
        $data = VisaApplicationHead::findOrFail($id);

        $foreign_technicians = ForeignTechician::where('profile_id',$data->profile->id)->get();

        $applicants = $data->visa_details;
        $directors_total  = Director::where('profile_id', $data->profile->id)->count();
        $dependants_total = Dependant::where('profile_id', $data->profile->id)->count();
        // dd($directors);
        // $remarks = Remark::where('visa_application_head_id',$data->id)->get();
        $remarks = DB::table('remarks')
                        // ->join('visa_application_heads', 'remarks.visa_application_head_id', '=', 'visa_application_heads.id')
                        ->join('admins as a1', 'remarks.FromAdminID', '=', 'a1.id')
                        ->join('admins as a2', 'remarks.ToAdminID', '=', 'a2.id')
                        ->join('ranks as r1', 'remarks.FromRankID', '=', 'r1.id')
                        ->join('ranks as r2', 'remarks.ToRankID', '=', 'r2.id')
                        ->select('remarks.*', 'a1.username as a1_name','a2.username as a2_name','r1.RankNameMM as r1_name','r2.RankNameMM as r2_name')
                        ->where([
                            ['remarks.visa_application_head_id',$data->id],
                            // ['SubmittedStatus', '!=', 1],
                        ])
                        ->get();

    	// dd($remarks);
    	// foreach ($applicants as $value) {
    	// 	dd($value->stay_type);
    	// }

        $total_local = $data->profile->StaffLocalProposal + $data->profile->StaffLocalSurplus;
        $total_foreign = $data->profile->StaffForeignProposal + $data->profile->StaffForeignSurplus;

        $available_local = $total_local - $data->profile->StaffLocalAppointed;
        $available_foreign = $total_foreign - $data->profile->StaffForeignAppointed;

        $rr =Auth::user()->rank_id;
        // dd($rr);
        if ($rr == 1) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 1],
                        ])->orderBy('rank_id', 'asc')->get();
        }
        if ($rr == 2) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 2],
                        ])->orderBy('rank_id', 'asc')->get();
        }
        if ($rr == 3) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 3],
                        ])->orderBy('rank_id', 'asc')->get();
        }
        if ($rr == 4) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 4],
                        ])->orderBy('rank_id', 'asc')->get();
        }
        if ($rr == 5) {
            $admins = [];
        }
        if ($rr == 6) {
            $admins = [];
        }
        if ($rr == 7) {
            $admins = [];
        }
        
        $ad = auth()->user();
        
    	// dd($data);
        return view('admin.visadetail',compact('data','ranks','admins','total_local','total_foreign','available_local','available_foreign','remarks','foreign_technicians','directors_total','dependants_total', 'ad'));
    }

    // delete remark
    public function deleteRemark($id)
    {
        $remark=Remark::find($id);
        $remark->delete();
        return redirect()->back();
    }

    public function toName(Request $request)
    {
        $toname = DB::table('admins')
                ->join('ranks', 'admins.rank_id', '=', 'ranks.id')
                ->select('admins.*','ranks.RankName','ranks.RankNameMM')
                ->where('admins.id', $request->get('id'))->get();
        return response()->json($toname);
    }

    public function visa_detail_attach($id)
    {
        $visa_detail_attachments = VisaApplicationDetailAttachment::where('visa_application_detail_id',$id)->get();
        $visa_detail=VisaApplicationDetail::find($id);
        // dd($visa_detail);
        return view('admin.visa_detail_attachments',compact('visa_detail_attachments','visa_detail'));
        
    }

    public function foreignTech($id)
    {
        $profile = Profile::findOrFail($id);

        $foreign_technicians = ForeignTechician::where('profile_id', $id)
                                ->whereIn('Status', [1, 3])
                                ->orderBy('Status', 'asc')->get();
                                
        return view('admin.foreign_tech',compact('foreign_technicians','profile'));
    }


    // Directors 
    public function directors($id){
        $profile = Profile::findOrFail($id);
        $directors = Director::where('profile_id', $id)
                        ->where('status', 1)
                        ->orderBy('status', 'asc')->get();
        return view('admin.directors_only', compact('directors', 'profile'));
    }

    // Dependants
    public function dependants($id){
        $profile = Profile::findOrFail($id);
        $dependants = Dependant::where('profile_id', $id)
                        ->where('status', 1)
                        ->orderBy('status', 'asc')->get();
        return view('admin.dependants_only', compact('dependants', 'profile'));
    }

    

    public function send(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'Remark' => 'required',
        ]);

        $admin = Admin::find($request->ToAdminID);
        $ToRankID = $admin->rank->id;

        if($request->Remark == 'option1'){
            $remark =Remark::create([
                            "visa_application_head_id"=>$request['visa_application_head_id'],
                            "Remark"=>$request['Comment1'],
                            "ReviewDate"=>now(),
                            "FromAdminID"=>Auth::user()->id,
                            "FromRankID"=>Auth::user()->rank->id,
                            "ToAdminID"=>$request['ToAdminID'],
                            "ToRankID"=>$ToRankID,
                            "SubmittedStatus"=>0,
                        ]);
        }else{
            $remark =Remark::create([
                            "visa_application_head_id"=>$request['visa_application_head_id'],
                            "Remark"=>$request['Comment2'],
                            "ReviewDate"=>now(),
                            "FromAdminID"=>Auth::user()->id,
                            "FromRankID"=>Auth::user()->rank->id,
                            "ToAdminID"=>$request['ToAdminID'],
                            "ToRankID"=>$ToRankID,
                            "SubmittedStatus"=>0,
                        ]);
        }
        $visa_head= VisaApplicationHead::find($request->visa_application_head_id);
        //dd($visa_head);
        $visa_head->update(['ReviewerSubmitted'=>1]);

        //dd($visa_head);
        $visa_head->update(['Status'=>0]);


        if (Auth::user()->rank_id == 1) {
            $visa_head->update(['reviewer_id'=>Auth::user()->id]);
        }
        // dd($ToRankID->rank->id);
        // dd($request->all());
        if (Auth::user()->rank_id != 1) {
            $remark = Remark::where('visa_application_head_id',$visa_head->id);
            // dd($remark);
            $remark->update(['SubmittedStatus'=>1]);
        }
        Toastr::success('Successfully sent!');

        return redirect()->route('dashboard');
    }

    public function approve(Request $request)
    {
        try{
            $year= now()->year;
    
            $approveYear=ApproveLetter::whereYear('created_at',$year)->count();
            $no='';
            if($approveYear > 0){
                $letter=ApproveLetter::latest()->first();
                $letter=substr($letter->letterNo,5,-1);
                $no=substr($letter+100001,1);
            
            }else{
                $no='00001';
            }

            $app_letterno=$year."(".$no.")";
            
            $profile = DB::select('SELECT * FROM profiles WHERE id = 
            (SELECT profile_id FROM visa_application_heads WHERE id=' . $request->visa_application_head_id . ')');

            $visa_head= VisaApplicationHead::find($request->visa_application_head_id);

            $letterNo=ApproveLetter::create([
                'visa_application_head_id'=>$visa_head->id,
                'letterNo'=>$app_letterno
            ]);
            // dd($letterNo);
            
            $visa_head->update([
                        'Status'=>1,
                        'CompanyName'=>$profile[0]->CompanyName,
                        'Township'=>$profile[0]->Township,
                        'PermitNo'=>$profile[0]->PermitNo,
                        'PermittedDate'=>$profile[0]->PermittedDate,
                        'BusinessType'=>$profile[0]->BusinessType,
                        'StaffLocalProposal'=>$profile[0]->StaffLocalProposal,
                        'StaffForeignProposal'=>$profile[0]->StaffForeignProposal,
                        'StaffLocalSurplus'=>$profile[0]->StaffLocalSurplus,
                        'StaffForeignSurplus'=>$profile[0]->StaffForeignSurplus,
                        'StaffLocalAppointed'=>$profile[0]->StaffLocalAppointed,
                        'StaffForeignAppointed'=>$profile[0]->StaffForeignAppointed,
                        'approve_admin_id'=>Auth::user()->id,
                        'approve_rank_id'=>Auth::user()->rank->id,
                        'ApproveDate'=>now(),
                        'ApproveLetterNo'=>$letterNo->letterNo,
                ]);
                $data = array(
                            'username' => $visa_head->user->name,
                            // 'cmt' => $request->cmt,
                            'email' => $visa_head->user->email,
                        );

                \Mail::send(
                    'admin.visa.approvemail',
                    ['data' => $data],
                    function ($message) use ($data) {
                        $message
                            ->from('movasygn@dica.gov.mm', 'MOVAS')
                            ->to($data['email'])->subject('Your Visa Application had been approved.');
                    }
                );

        Toastr::success('Successfully Approved!');

        return redirect()->route('dashboard');
        }catch(Exception $e)
        {
            return redirect()->back()->with('errors', 'Try Submit Again!');
        }
    }

    public function reject(Request $request)
    {
        try{
            // dd($request->all());
            $visa_head= VisaApplicationHead::find($request->visa_application_head_id);
            // $visa_head_attachments = VisaApplicationHeadAttachment::where('visa_application_head_id',$visa_head->id)->get();
            // foreach ($visa_head_attachments as  $visa_head_attachment) {
            //     $filePath2 = public_path() . $visa_head_attachment->FilePath;
            //     File::delete($filePath2);
            // }
    
            RejectHistory::create([
                "visa_application_head_id"=>$request['visa_application_head_id'],
                "RejectComment"=>$request['Comment'],
                "RejectDate"=>now(),
                "reviewer_id"=>Auth::user()->id,
            ]);

            $visa_details = VisaApplicationDetail::where('visa_application_head_id',$request->visa_application_head_id)->get();
            
            foreach ($visa_details as $visa_detail) {
                
                // update status 0 in item_attaches
                if($request->has('detail'.$visa_detail->id)){
                    $file3=public_path().$visa_detail->passport_attach;
                    $file4=public_path().$visa_detail->mic_approved_letter_attach;
                    $file5=public_path().$visa_detail->labour_card_attach;
                    $file6=public_path().$visa_detail->extract_form_attach;
                    $file7=public_path().$visa_detail->technician_passport_attach;
                    $file8=public_path().$visa_detail->evidence_attach;
                    $file9=public_path().$visa_detail->applicant_form_attach;
                    $file10=public_path().$visa_detail->formcfile_attch;
                    File::delete($file3,$file4,$file5,$file6,$file7,$file8,$file9,$file10);
                    $visa_detail->update([
                        'reject_status' => 0,
                        'passport_attach' => null,
                        'mic_approved_letter_attach'=> null,
                        'labour_card_attach'=> null,
                        'extract_form_attach'=> null,
                        'technician_passport_attach'=> null,
                        'evidence_attach'=> null,
                        'applicant_form_attach' => null, 
                        'formcfile_attch' => null,
                    ]);
                    
                    
                }
            }
            $visa_head->update(['Status'=>2]);
            $visa_head->update(['RejectedDate'=>now()]);
            $visa_head->update(['RejectComment'=>$request->Comment]);
    
            $data = array(
                        'username' => $visa_head->user->name,
                        'cmt' => $request->Comment,
                        'email' => $visa_head->user->email,
                    );

            \Mail::send(
                'admin.visa.rejectmail',
                ['data' => $data],
                function ($message) use ($data) {
                    $message
                        ->from('movasygn@dica.gov.mm', 'MOVAS')
                        ->to($data['email'])->subject('Your Visa Application had been rejected.');
                }
            );

            Toastr::success('Successfully Rejected!');
            return redirect()->route('dashboard');
        }catch(Exception $e){
            print($e);
        }
    }

    public function turnDown(Request $request)
    {
        // dd($request->all());
        $visa_head= VisaApplicationHead::find($request->visa_application_head_id);

        $visa_head->update(['Status'=>3]);

        $admin = Admin::find($visa_head->reviewer_id);
        $torank_id = $admin->rank->id;
        // dd($admin->id);

        if (Auth::user()->rank_id != 1) {
            $remark = Remark::where('visa_application_head_id',$visa_head->id)->latest()->first();
            // dd($remark);
            $remark->update(['SubmittedStatus'=>1]);
        }
        $remark =Remark::create([
                        "visa_application_head_id"=>$request['visa_application_head_id'],
                        "Remark"=>$request->Comment,
                        "ReviewDate"=>now(),
                        "FromAdminID"=>Auth::user()->id,
                        "FromRankID"=>Auth::user()->rank->id,
                        "ToAdminID"=>$admin->id,
                        "ToRankID"=>$torank_id,
                        "SubmittedStatus"=>0,
                    ]);

        Toastr::success('Successfully turn down!');

        return redirect()->route('dashboard');
    }

    public function profile(){

        $profile=Profile::orderBy('created_at','desc')->get();
        return view('admin.profileList',compact('profile'));
    }

    public function profileShow($id){
        $profile = Profile::findOrFail($id);
        return view('admin.profileShow',compact('profile'));
    }

    public function getCompanyUserInfo(Request $request)
    {
        $user = User::find($request->id);
        return response()->json($user);
    }

}
