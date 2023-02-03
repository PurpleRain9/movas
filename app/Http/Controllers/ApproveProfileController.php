<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfileRejectHistory;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use DB;
use Session;
use Auth;
use Illuminate\Support\Facades\File;

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
        $admin = auth()->user();
        // dd($profile);
        return view('admin.profile.detail',compact('profile', 'admin'));
    }

    public function acceptProfile($id,request $request)
    {
       try{
        $profile = Profile::findOrFail($id);

        $profile->user->update(['Status'=>2]);
        $profile->update(['Status'=>1]);
        $profile->update(['ApproveDate'=>now()]);
        // $data = array(
        //             'username' => $profile->user->name,
        //             // 'cmt' => $request->cmt,
        //             'email' => $profile->user->email,
        //         );

        // \Mail::send(
        //     'admin.profile.approvemail',
        //     ['data' => $data],
        //     function ($message) use ($data) {
        //         $message
        //             ->from('movasygn@dica.gov.mm', 'MOVAS')
        //             ->to($data['email'])->subject('Your signup form had been approved.');
        //     }
        // );
        Toastr::success('Successfully approved company registration!');
        return redirect()->route('approveprofile');
       }catch(Exception $e)
       {
        print($e);
        // return("OK");
       }
    }

    public function destroy($id,request $request)
    {
       try{
        $profile = Profile::findOrFail($id);
        
        $file1 = public_path() . $profile->AttachPermit;
        $file2 = public_path() . $profile->AttachProposal;
        $file3 = public_path() . $profile->AttachAppointed;
        $file4 = public_path() . $profile->AttachIncreased;

        if(!is_null($profile->AttachPermit)){
            if (File::exists($file1)){
                File::delete($file1);
            }
        }   
        if(!is_null($profile->AttachProposal)){
            if (File::exists($file2)){
                File::delete($file2);
            }
        }
        if(!is_null($profile->AttachAppointed)){
            if (File::exists($file3)){
                File::delete($file3);
            }
        }

        if(!is_null($profile->AttachIncreased)){
            if (File::exists($file4)){
                File::delete($file4);
            }    
        }
       
        ProfileRejectHistory::create([
            'profile_id'=>$profile->id,
            'description'=>$request->cmt,
            'reviewer_id'=>Auth::user()->id,
            'reviewer_rank_id'=>Auth::user()->rank_id
        ]);
        //update 12/22/2021
        $profile->user->update(['Status'=>3]);
        $profile->user->update(['RejectComment'=>$request->cmt]);

        $profile->update(['AttachPermit'=>null]);
        $profile->update(['AttachProposal'=>null]);
        $profile->update(['AttachIncreased'=>null]);
        $profile->update(['AttachAppointed'=>null]);
        $profile->update(['Status'=>'2']);

        // $data = array(
        //             'username' => $profile->user->name,
        //             'cmt' => $request->cmt,
        //             'email' => $profile->user->email,
        //         );

        // \Mail::send(
        //     'admin.profile.denymail',
        //     ['data' => $data],
        //     function ($message) use ($data) {
        //         $message
        //             ->from('movasygn@dica.gov.mm','MOVAS')
        //             ->to($data['email'])->subject('Your signup form had been denied.');
        //     }
        // );
            return redirect()->route('approveprofile');
       }catch(Exception $e)
       {
          print($e);
       }
    }
}
