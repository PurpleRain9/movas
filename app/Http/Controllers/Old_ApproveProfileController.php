<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Session;
use Auth;

class ApproveProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        if (is_null($request->name)) {
            $profiles = Profile::where('Status',0)->get();
        }
    	else{
            $profiles = Profile::where([
                                            ['Status','=',0],
                                            ['CompanyName', 'like', '%'.$request->name.'%'],
                                        ])->get();
        }

        return view('admin.profile.index',compact('profiles'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function detail($id)
    {
        $profile = Profile::findOrFail($id);
        // dd($profile);
        return view('admin.profile.detail',compact('profile'));
    }

    public function acceptProfile($id,request $request)
    {
        $profile = Profile::findOrFail($id);

        $profile->user->update(['Status'=>2]);
        $profile->update(['Status'=>1]);

        $data = array(
                    'username' => $profile->user->name,
                    // 'cmt' => $request->cmt,
                    'email' => $profile->user->email,
                );

        \Mail::send(
            'admin.profile.approvemail',
            ['data' => $data],
            function ($message) use ($data) {
                $message
                    ->from('movas@unityitsolutionprovider.com', 'MOVAS')
                    ->to($data['email'])->subject('Your signup form had been approved.');
            }
        );

        Toastr::success('Successfully approved company registration!');

        return redirect()->route('approveprofile');
    }

    public function destroy($id,request $request)
    {
        $profile = Profile::findOrFail($id);
        
            $file1 = public_path() . $profile->AttachPermit;
            $file2 = public_path() . $profile->AttachProposal;
            $file3 = public_path() . $profile->AttachAppointed;
            $file4 = public_path() . $profile->AttachIncreased;

            if ($profile->AttachPermit != '') {
                unlink($file1);
            }
            if ($profile->AttachProposal != '') {
                unlink($file2);
            }
            if ($profile->AttachAppointed != '') {
                unlink($file3);
            }
            if ($profile->AttachIncreased != '') {
                unlink($file4);
            }
            
        $profile->user->update(['Status'=>0]);
        $profile->user->update(['RejectComment'=>$request->cmt]);

        $profile->delete();
        
        Toastr::error('Successfully denied company registration.');

        $data = array(
                    'username' => $profile->user->name,
                    'cmt' => $request->cmt,
                    'email' => $profile->user->email,
                );

        \Mail::send(
            'admin.profile.denymail',
            ['data' => $data],
            function ($message) use ($data) {
                $message
                    ->from('movas@unityitsolutionprovider.com', 'MOVAS')
                    ->to($data['email'])->subject('Your signup form had been denied.');
            }
        );

        return redirect()->route('approveprofile');
    }
}
