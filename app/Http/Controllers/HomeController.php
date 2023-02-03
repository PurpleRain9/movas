<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VisaApplicationHead;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\VisaApplicationDetail;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified','userstatus']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $u_id = Auth::user()->id;
        // dd($user_id);

        $validation = Validator::make($request->all(), [
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after:from_date',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        if (is_null($request->status) && is_null($request->from_date) && is_null($request->to_date)) {
             $visa_heads= VisaApplicationHead::where('user_id',$u_id)->orderBy('created_at', 'desc')->paginate(20);

            return view('home',compact('visa_heads'));
        }
        if (!is_null($request->status) && !is_null($request->from_date) && !is_null($request->to_date)) {
            // dd('here 1');
            $status = $request->status;
       $from_date = $request->from_date;
       $to_date = $request->to_date;
           $visa_heads = VisaApplicationHead::where(function ($query) use ($u_id,$status) {
                $query->where([
                            ['user_id',$u_id],
                            ['Status', $status],
                        ]);
            })->where(function($query) use ($from_date,$to_date) {
                $query->whereBetween('FirstApplyDate', [$from_date, $to_date]);

            })->orderBy('created_at', 'desc')->paginate(20);
           

            return view('home',compact('visa_heads'));
        }
       if (!is_null($request->from_date) || !is_null($request->to_date)) {
        // dd('here 2');
             $visa_heads= VisaApplicationHead::where([
                            ['user_id',$u_id],
                        ])->whereBetween('FirstApplyDate', [$request->from_date, $request->to_date])->orderBy('created_at', 'desc')->paginate(20);

            return view('home',compact('visa_heads'));
       }
       if (!is_null($request->status)) {
        // dd('here 3');
         $visa_heads= VisaApplicationHead::where([
                            ['user_id',$u_id],
                            ['Status', $request->status],
                        ])->orderBy('created_at', 'desc')->paginate(20);
         
            return view('home',compact('visa_heads'));
       }
    }


    public function show($id)
    {
        $data = VisaApplicationHead::findOrFail($id);
        
        // dd($data);
        return view('inprocessDetail',compact('data'));
    }

    public function delete($id)
    {
        
        try{
         $visa = VisaApplicationHead::findOrFail($id);
         VisaApplicationDetail::where('visa_application_head_id',$id)->delete();

         $visa->delete();
        Toastr::error('Successfully deleted visa .');

        return \Redirect::route('home');
       }catch(Exception $e)
       {
        return \Redirect::route('home');
       }
    }

    public function changePassword(){
        
        return view('change_password');
    }
    public function changePasswordStore(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
            // 'email_addr' => ['required'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);
        Auth::logout();
        Session::flush();
        return redirect()->route('home');
    }

    public function approvedVisa(Request $request)
    {
        $visa = VisaApplicationHead::findOrFail($request->id);
        $visa_details = $visa->visa_details;
        // $visa_details = VisaApplicationDetail::where('visa_application_head_id', $request->id)->get();
        return response()->json(["visa_head" => $visa, "visa_details" => $visa_details]);
    }


    public function changeEmail(){
        $useremail = Auth()->user()->email;
        return view('change_email' ,compact('useremail'));
    }

    public function changeEmailStore(Request $request , User $user){
        $request->validate([
            'newEmail' => 'required|unique:users,email,'.$user->id,
        ]);

        User::find(auth()->user()->id)->update([
            'email' =>$request->newEmail
        ]);

        Auth::logout();
        Session::flush();
        return redirect()->route('home');
    }
}
