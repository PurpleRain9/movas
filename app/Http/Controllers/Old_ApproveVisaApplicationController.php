<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rank;
use App\Models\VisaApplicationHead;
use App\Models\VisaApplicationHeadAttachment;
use App\Models\VisaApplicationDetail;
use App\Models\VisaApplicationDetailAttachment;
use App\Models\Admin;
use App\Models\Remark;
use App\Models\ForeignTechician;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;

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
        // dd($foreign_technicians);

    	$applicants = $data->visa_details;

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

    	$total_local = $data->StaffLocalProposal + $data->StaffLocalSurplus;
        $total_foreign = $data->StaffForeignProposal + $data->StaffForeignSurplus;

        $available_local = $total_local - $data->StaffLocalAppointed;
        $available_foreign = $total_foreign - $data->StaffForeignAppointed;

        $rr =Auth::user()->rank_id;
        // dd($rr);
        if ($rr == 1) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 1],
                        ])->get();
        }
        if ($rr == 2) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 2],
                        ])->get();
        }
        if ($rr == 3) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 3],
                        ])->get();
        }
        if ($rr == 4) {
            $admins = Admin::where([
                            ['id','!=',1],
                            ['rank_id', '<', 6],
                            ['rank_id', '>', 4],
                        ])->get();
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
    	
    	
    	// dd($data);
    	return view('admin.visadetail',compact('data','ranks','admins','total_local','total_foreign','available_local','available_foreign','remarks','foreign_technicians'));
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
        $detail_attachment_id=VisaApplicationDetailAttachment::where('visa_application_detail_id',$id)->first();

        if (!is_null($detail_attachment_id)) {
            $visa_detail = VisaApplicationDetail::find($detail_attachment_id->visa_application_detail_id);
        // dd($visa_detail);
            return view('admin.visa_detail_attachments',compact('visa_detail_attachments','visa_detail'));
        }else{
            return view('admin.visa_detail_attachments',compact('visa_detail_attachments'));
        }
    }

    public function foreignTech($id)
    {
        $profile = Profile::findOrFail($id);

        $foreign_technicians = ForeignTechician::where('profile_id',$id)->get();
        // dd($foreign_technicians);

        return view('admin.foreign_tech',compact('foreign_technicians','profile'));
    }

    public function send(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'Remark' => 'required',
        ]);

        $admin = Admin::find($request->ToAdminID);
        $ToRankID = $admin->rank->id;

        $visa_head= VisaApplicationHead::find($request->visa_application_head_id);
        // dd($visa_head);
        $visa_head->update(['ReviewerSubmitted'=>1]);
        $visa_head->update(['Status'=>0]);

        if (Auth::user()->rank_id == 1) {
            $visa_head->update(['reviewer_id'=>Auth::user()->id]);
        }
        // dd($ToRankID->rank->id);
        // dd($request->all());
        if (Auth::user()->rank_id != 1) {
            $remark = Remark::where('visa_application_head_id',$visa_head->id)->latest()->first();
            // dd($remark);
            $remark->update(['SubmittedStatus'=>1]);
        }

        
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

        
            

        Toastr::success('Successfully sent!');

        return redirect()->route('dashboard');
    }

    public function approve(Request $request)
    {
        $year= now()->year;
        // dd($year);
        // $ApproveLetterNo = DB::select('SELECT count(id)+1 as ApproveLetterNo FROM `visa_application_heads` WHERE year(ApproveDate) = '.$year.'');

        $ApproveLetterNo = DB::select('SELECT substring(count(id)+100001,2) as ApproveLetterNo FROM `visa_application_heads` WHERE Status=1 and year(ApproveDate) = '.$year.'');

        // dd($ApproveLetterNo);
        // dd($ApproveLetterNo[0]->ApproveLetterNo + 100000);

        $no = $ApproveLetterNo[0]->ApproveLetterNo;

         $app_letterno=$year."(".$no.")";
         // dd($app_letterno);

         $profile = DB::select('SELECT * FROM profiles WHERE id = 
         (SELECT profile_id FROM visa_application_heads WHERE id=' . $request->visa_application_head_id . ')');

            $visa_head= VisaApplicationHead::find($request->visa_application_head_id);

            $visa_head->update(['Status'=>1]);

            $visa_head->update(['CompanyName'=>$profile[0]->CompanyName]);
            $visa_head->update(['Township'=>$profile[0]->Township]);
            $visa_head->update(['PermitNo'=>$profile[0]->PermitNo]);
            $visa_head->update(['PermittedDate'=>$profile[0]->PermittedDate]);
            $visa_head->update(['BusinessType'=>$profile[0]->BusinessType]);
            $visa_head->update(['StaffLocalProposal'=>$profile[0]->StaffLocalProposal]);
            $visa_head->update(['StaffForeignProposal'=>$profile[0]->StaffForeignProposal]);
            $visa_head->update(['StaffLocalSurplus'=>$profile[0]->StaffLocalSurplus]);
            $visa_head->update(['StaffForeignSurplus'=>$profile[0]->StaffForeignSurplus]);
            $visa_head->update(['StaffLocalAppointed'=>$profile[0]->StaffLocalAppointed]);
            $visa_head->update(['StaffForeignAppointed'=>$profile[0]->StaffForeignAppointed]);

            $visa_head->update(['approve_admin_id'=>Auth::user()->id]);
            $visa_head->update(['approve_rank_id'=>Auth::user()->rank->id]);
            $visa_head->update(['ApproveDate'=>now()]);
            $visa_head->update(['ApproveLetterNo'=>$app_letterno]);

       
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
                    ->from('movas@unityitsolutionprovider.com', 'MOVAS')
                    ->to($data['email'])->subject('Your Visa Application had been approved.');
            }
        );

        Toastr::success('Successfully Approved!');

        return redirect()->route('dashboard');
    }

    public function reject(Request $request)
    {
        // dd($request->all());
        $visa_head= VisaApplicationHead::find($request->visa_application_head_id);
        $visa_head_attachments = VisaApplicationHeadAttachment::where('visa_application_head_id',$visa_head->id);

        // dd($visa_head->user->name);

        $myquery = DB::select('SELECT * FROM `visa_application_detail_attachments` WHERE `visa_application_detail_id` in 
        (
        SELECT `id` FROM `visa_application_details` WHERE `visa_application_head_id`='.$visa_head->id.'
        )');

                DB::delete('DELETE FROM `visa_application_detail_attachments` WHERE `visa_application_detail_id` in 
        (
        SELECT `id` FROM `visa_application_details` WHERE `visa_application_head_id`='.$visa_head->id.'
        )');

        $visa_detail = VisaApplicationDetail::where('visa_application_head_id',$request->visa_application_head_id)->first();

        if (!is_null($visa_detail)) {
            $visa_detail_attachments = VisaApplicationDetailAttachment::where('visa_application_detail_id',$visa_detail->id);

            $visa_detail_attachments->delete();
        }
        
        // dd($visa_detail_attachments);

        $visa_head_attachments->delete();
        

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
                    ->from('movas@unityitsolutionprovider.com', 'MOVAS')
                    ->to($data['email'])->subject('Your Visa Application had been rejected.');
            }
        );

        Toastr::success('Successfully Rejected!');

        return redirect()->route('dashboard');
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
}
