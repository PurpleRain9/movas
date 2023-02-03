<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\VisaApplicationHead;
use App\Models\VisaApplicationDetail;
use App\Models\Rank;
use App\Models\Admin;
use DB;
use Auth;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class ApproveOssController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function ossiApprove($id,Request $request)
    {
    	$visa_head = VisaApplicationHead::findOrFail($id);
        // dd($visa_head);
    	$visa_head->update(['IntegrationActionStatus'=>1]);
    	$visa_head->update(['IntegrationActionDate'=>now()]);

        $visa_details = VisaApplicationDetail::where('visa_application_head_id', $id)->get();
        foreach ($visa_details as $visa_detail) {
            $visa_detail->update([
                'immegration_approve'=>1
            ]);
        }
        // $visa_detail = VisaApplicationDetail::findOrFail($id);
        // $visa_detail->update(['immegration_approve'=>1]);


       

    	Toastr::success('Successfully Approved!');

    	return redirect()->route('approvedform');
    }

    public function osslApprove($id,Request $request)
    {
      
    	$visa_head = VisaApplicationHead::findOrFail($id);
    	$visa_head->update(['LabourActionStatus'=>1]);
    	$visa_head->update(['LabourActionDate'=>now()]);

        $visa_details = VisaApplicationDetail::where('visa_application_head_id', $id)->get();
        foreach ($visa_details as $visa_detail) {
            $visa_detail->update([
                'labour_approve'=>1
            ]);
        }

        // $visa_detail = VisaApplicationDetail::findOrFail($id);
        // $visa_detail->update(['labour_approve'=>1]);

        
      
    	Toastr::success('Successfully Approved!');

    	return redirect()->route('approvedform');
    }

    public function ossiReject($id,Request $request)
    {
        $visa_head = VisaApplicationHead::findOrFail($id);

        $visa_head->update(['IntegrationActionStatus'=>2]);
        $visa_head->update(['IntegrationActionDate'=>now()]);
        $visa_head->update(['IntegrationActionRemark'=>$request->cmt]);

        Toastr::success('Successfully Rejected!');

        return redirect()->route('approvedform');
    }

    public function ossiEachApprove($id,Request $request)
    {
        // dd($request->all());
        $visa_detail = VisaApplicationDetail::findOrFail($id);
        $visa_detail->update(['immegration_approve'=>1]);
        
        $head_id = $visa_detail->visa_application_head_id;
        $detail_count = VisaApplicationDetail::where('visa_application_head_id', $head_id)->count();
        $approve_count = VisaApplicationDetail::where('visa_application_head_id', $head_id)->where('immegration_approve', 1)->count();
        if($detail_count == $approve_count)
            VisaApplicationHead::find($head_id)->update(['IntegrationActionStatus' => 1, 'IntegrationActionDate'=>now()]);
        
        Toastr::success('Successfully Approved!');
    	return back();
    }

    public function osslEachApprove($id,Request $request)
    {
        // dd($request->all());
        $visa_detail = VisaApplicationDetail::findOrFail($id);
        $visa_detail->update(['labour_approve'=>1]);
        
        $head_id = $visa_detail->visa_application_head_id;
        $detail_count = VisaApplicationDetail::where('visa_application_head_id', $head_id)->count();
        $approve_count = VisaApplicationDetail::where('visa_application_head_id', $head_id)->where('labour_approve', 1)->count();
        if($detail_count == $approve_count)
            VisaApplicationHead::find($head_id)->update(['LabourActionStatus' => 1, 'LabourActionDate'=>now()]);

        Toastr::success('Successfully Approved!');
    	return back();
    }
}
