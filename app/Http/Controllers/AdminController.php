<?php

namespace App\Http\Controllers;

use App\Exports\ApplicantsExport;
use App\Exports\ExportDependant;
use App\Exports\ExportDirector;
use App\Exports\ForeignTechExport;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use App\Models\Sector;
use App\Models\Rank;
use App\Models\Remark;
use App\Models\Admin;
use App\Models\Dependant;
use App\Models\Director;
use App\Models\ForeignTechician;
use App\Models\User;
use App\Models\PersonType;
use App\Models\Nationality;
use App\Models\Profile;
use App\Models\ProfileRejectHistory;
use App\Models\RejectHistory;
use App\Models\VisaApplicationDetail;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\DB;
use App\Models\VisaApplicationHead;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Mail;
use Laravel\Ui\Presets\Vue;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware(['auth:admin','superadmin']);
    }

    public function dashboard(Request $request)
    {   
        $now='';
        $fromDate='';
        $toDate='';
        if(is_null($request->from_date) && is_null($request->to_date)){
            $toDate= Carbon::today()->toDateString();
            $now = Carbon::today()->addDays(1)->toDateString();
            $fromDate = Carbon::today()->startOfMonth()->toDateString();
        }else{
            $toDate= $request->to_date;
            $now = Carbon::parse($request->to_date)->addDays(1)->toDateString();
            $fromDate = $request->from_date;
        }
           // visa 
        $visa_heads=VisaApplicationHead::where('Status',1)
           ->select('ApproveDate')
           ->whereBetween('ApproveDate',[$fromDate,$now])->get();
        $reject_times=RejectHistory::whereBetween('created_at',[$fromDate,$now])
                    ->get();  
        $visa_inprocess=VisaApplicationHead::where('Status',0)
                                        ->whereNotNull('ReviewerSubmitted')
                                        ->whereBetween('updated_at',[$fromDate,$now])
                                        ->count();
        $visa_newcase=VisaApplicationHead::where('Status',0)
                                        ->whereNull('ReviewerSubmitted')
                                        ->whereBetween('FinalApplyDate',[$fromDate,$now])
                                        ->count();                                    
        //profile
        $profile_approved=Profile::whereNotNull('ApproveDate')->whereBetween('ApproveDate',[$fromDate,$now])->get();  
        $profile_reject=ProfileRejectHistory::whereBetween('created_at',[$fromDate,$now])->count();
        $profile_inprocess=Profile::whereBetween('created_at',[$fromDate,$now])
                        ->where('Status',0)->count();
        $visa_rejects=RejectHistory::whereBetween('created_at',[$fromDate,$now])->get();

        $reject_histories=RejectHistory::select('reviewer_id',DB::raw( 'count(visa_application_head_id) as count') )
                                ->whereBetween('created_at',[$fromDate,$now])
                                ->groupBy('reviewer_id')->get();
        $visa_submits=Remark::select('FromAdminID',DB::raw( 'count(id) as count') )
                                ->whereBetween('created_at',[$fromDate,$now])
                                ->whereIn('FromAdminID', [3, 4, 5,6])
                                ->groupBy('FromAdminID')
                                ->get();

        $visa_submit_count=Remark::whereBetween('created_at',[$fromDate,$now])
                                ->whereIn('FromAdminID', [3, 4, 5,6])
                                ->count();
        
        $visa_submit=
        $approveMon=0;
        $approveTue=0;
        $approveWed=0;
        $approveThur=0;
        $approveFri=0;
        $approveSat=0;
        $approveSun= 0;

        $rejectMon=0;
        $rejectTue=0;
        $rejectWed=0;
        $rejectThur=0;
        $rejectFri=0;
        $rejectSat=0;
        $rejectSun= 0;
        foreach ($visa_heads as $visa_head) {
            if(Carbon::parse($visa_head->ApproveDate)->isMonday()){
                $approveMon +=1;
            }else if(Carbon::parse($visa_head->ApproveDate)->isTuesday()){
                $approveTue +=1;
            }else if(Carbon::parse($visa_head->ApproveDate)->isWednesday()){
                $approveWed +=1;
            } else if(Carbon::parse($visa_head->ApproveDate)->isThursday()){
                $approveThur +=1;
            }else if(Carbon::parse($visa_head->ApproveDate)->isFriday()){
                $approveFri +=1;
            }else if(Carbon::parse($visa_head->ApproveDate)->isSaturday()){
                $approveSat +=1;
            }else if(Carbon::parse($visa_head->ApproveDate)->isSunday()){
                $approveSun +=1;
            }
        }
        foreach ($visa_rejects as $visa_reject) {
            if(Carbon::parse($visa_reject->created_at)->isMonday()){
                $rejectMon +=1;
            }else if(Carbon::parse($visa_reject->created_at)->isTuesday()){
                $rejectTue +=1;
            }else if(Carbon::parse($visa_reject->created_at)->isWednesday()){
                $rejectWed +=1;
            } else if(Carbon::parse($visa_reject->created_at)->isThursday()){
                $rejectThur +=1;
            }else if(Carbon::parse($visa_reject->created_at)->isFriday()){
                $rejectFri +=1;
            }else if(Carbon::parse($visa_reject->created_at)->isSaturday()){
                $rejectSat +=1;
            }else if(Carbon::parse($visa_reject->created_at)->isSunday()){
                $rejectSun +=1;
            }
        }
        return view('admin.dash', compact('approveMon', 'approveTue', 'approveWed','approveThur', 'approveFri', 'approveSat',  'approveSun','rejectMon','rejectTue','rejectWed',
        'rejectThur','rejectFri','rejectSat','rejectSun','toDate','fromDate','reject_histories','visa_rejects','visa_heads','reject_times','profile_approved','visa_inprocess',
        'visa_newcase','profile_reject','profile_inprocess','visa_submits','visa_submit_count'));
    }

    public function index(Request $request)
    {
        
    	$sectors = Sector::all();
        $remarks = Remark::all();
        $admin_id = Auth::user()->id;
        // dd($admin_id);
    if (Auth::user()->rank_id == 1) {
        $visa_heads = DB::SELECT(
            'SELECT h.*, x.RankName, p.CompanyName,s.SectorName
            FROM visa_application_heads AS h 
            LEFT JOIN
                (
                    select c.*, r.RankName 
                    from remarks as c, ranks as r
                    where c.ToRankID = r.id
                    and c.id in (
                        SELECT max(id)
                        FROM remarks
                        GROUP BY visa_application_head_id
                    )
                ) AS x
            ON h.id = x.visa_application_head_id
            LEFT JOIN profiles as p
            ON h.profile_id = p.id
            LEFT JOIN sectors as s
            ON p.sector_id=s.id
            WHERE h.Status =0 AND (x.RankName is null OR x.ToRankID =1) AND h.ReviewerSubmitted is null
            order by created_at DESC',
        );
    }else{
        $visa_heads = DB::SELECT(
            "SELECT h.*, x.RankName, p.CompanyName,s.SectorName
            FROM visa_application_heads AS h 
            LEFT JOIN
                (
                    select c.*, r.RankName 
                    from remarks as c, ranks as r
                    where c.ToRankID = r.id
                    and c.id in (
                        SELECT max(id)
                        FROM remarks
                        GROUP BY visa_application_head_id
                    )
                ) AS x
            ON h.id = x.visa_application_head_id
            LEFT JOIN profiles as p
            ON h.profile_id = p.id
            LEFT JOIN sectors as s
            ON p.sector_id=s.id
            WHERE h.Status =0 AND x.ToAdminID =:name order by created_at DESC", ['name' =>  Auth::user()->id ]
        );

    }
	return view('admin.inbox',compact('sectors','visa_heads','remarks'));
    }
    // -----------------------------------------------------------------------------------------------------------------------
    public function newCase(Request $request)
    {
    	$sectors = Sector::all();
        $remarks = Remark::all();
        $admin_id = Auth::user()->id;
        // dd($admin_id);
        if (Auth::user()->rank_id == 2) {

            if (is_null($request->name)) {

                $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                                                
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                        ->where('visa_application_heads.Status', 0 )
                                         ->whereNull('visa_application_heads.ReviewerSubmitted')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
                //dd($visa_heads);

            }else {
                $visa_heads=DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                                        ->where([
                                            ['visa_application_heads.Status','=',0],
                                            ['profiles.CompanyName', 'like', '%'.$request->name.'%'],
                                        ])
                                        ->whereNull('visa_application_heads.ReviewerSubmitted')
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(20);
            }
             

                                        // dd($visa_heads);
        }else{

            if (is_null($request->name)) {
                $visa_heads= DB::table('remarks')
                        ->join('visa_application_heads', 'remarks.visa_application_head_id', '=', 'visa_application_heads.id')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('remarks.*', 'profiles.CompanyName','visa_application_heads.FirstApplyDate','visa_application_heads.FinalApplyDate','visa_application_heads.Status','visa_application_heads.Subject','sectors.SectorName','visa_application_heads.id as visa_head_id')
                        ->where([
                            ['remarks.ToAdminID','=',$admin_id],
                            ['remarks.SubmittedStatus', '!=', 1],
                            ['visa_application_heads.Status', '=', 0],
                        ])
                        ->orderby('created_at','desc')
                        ->paginate(20);
            }else{
                 $visa_heads= DB::table('remarks')
                        ->join('visa_application_heads', 'remarks.visa_application_head_id', '=', 'visa_application_heads.id')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        ->select('remarks.*', 'profiles.CompanyName','visa_application_heads.FirstApplyDate','visa_application_heads.FinalApplyDate','visa_application_heads.Status','visa_application_heads.Subject','sectors.SectorName','visa_application_heads.id as visa_head_id')
                        ->where([
                            ['remarks.ToAdminID','=',$admin_id],
                            ['remarks.SubmittedStatus', '!=', 1],
                            ['visa_application_heads.Status', '=', 0],
                            ['profiles.CompanyName', 'like', '%'.$request->name.'%'],
                        ])
                       
                        ->orderby('created_at','desc')
                        ->paginate(20);
            }
            
        }
       
    	return view('admin.newCase',compact('sectors','visa_heads','remarks'));
    }


    // --------------------------------------------------------------------------------------------------------------------
    public function applyCase(Request $request)
    {
       
            $visa_heads= DB::table('visa_application_heads')
                        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
                        ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
                        // ->join('status', 'visa_application_heads.profile_id.status', '=', 'status.StatusNo')
                        ->select('visa_application_heads.*','profiles.CompanyName','sectors.SectorName')
                        ->whereIn('visa_application_heads.Status', [0,1,2,3])
                        ->where([
                                            // ['visa_application_heads.Status','=', 1],
                                            ['profiles.CompanyName', 'like', '%'.$request->name.'%'],
                        ]);
             if (!is_null($request->from_date) || !is_null($request->to_date)) {
                $visa_heads->whereBetween('visa_application_heads.FirstApplyDate', [$request->from_date, $request->to_date]);
            }
            
            $visa=$visa_heads->orderBy('created_at', 'desc')->paginate(20);
    	    $sectors = Sector::all();
    	return view('admin.applyCase',compact('sectors','visa'));
       
    }

    // --------------------------------------------------------------------------------------------------------------------

    public function noteSheet()
    {
        $ranks = Rank::all();
        return view('admin.notesheet',compact('ranks'));
    }

    public function adminTable()
    {
        // $admins = Admin::where('id','!=',1)->paginate(20);
        $admins = DB::table('admins')
            ->join('ranks', 'admins.rank_id', '=', 'ranks.id')
            ->select('admins.*', 'ranks.RankName','ranks.RankNameMM')
            ->where('admins.id','!=',1)
            ->orderby('created_at','desc')
            ->paginate(20);

        return view('admin.admintable',compact('admins'));
    }

    public function showCreateForm()
    {
        $ranks = Rank::all();
        return view('admin.create', compact('ranks'));
    }

    public function createAdmin(Request $request)
    {
        $request->validate([
            'UserID' => ['required','unique:admins'],
            'username' => ['required'],
            'password' => ['required'],
            'confirmpassword' => ['same:password'],
        ]);

        Admin::create([
            'UserID'  =>  $request['UserID'],
            'username'  =>  $request['username'],
            'password'  =>  Hash::make($request['password']),
            'rank_id' => $request['rank_id'],
            'Status' => $request['Status'],
        ]);

        Toastr::success('Adminstrator Created!');

        return redirect()->route('admintable');
    }

    public function showEditForm($id)
    {
        $admin = Admin::findOrFail($id);
        $ranks = Rank::all();
        return view('admin.edit', compact('admin','ranks'));
    }

    public function updateAdmin($id,Request $request)
    {
        $admin = Admin::findOrFail($id);

        /*$request->validate([
            'UserID' => ['required','unique:admins'],
            'username' => ['required'],
        ]);*/

        // $admin->update(['UserID'=>request('UserID')]);
        $admin->update(['username'=>request('username')]);
        $admin->update(['rank_id'=>request('rank_id')]);
        $admin->update(['Status' => request('Status')]);
        Toastr::success('Adminstrator Updated!');

        return redirect()->route('admintable');
    }

    public function changePasswordForm()
    {
        return view('admin.changePassword');
    }

    public function changepasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        Admin::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->back()->with('alert', 'Password Successfully Changed.');
    }
    public function reportForm(Request $request)
    {
        $sector = Sector::orderBy('SectorNameMM')->get();
        $nationality = Nationality::orderBy('NationalityName')->get();
        $persontype = PersonType::orderBy('PersonTypeNameMM')->get();
        $reportlist = DB::table('visa_application_details')
        ->join('visa_application_heads', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
        ->join('nationalities', 'visa_application_details.nationality_id', '=', 'nationalities.id')
        ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
        ->join('person_types', 'visa_application_details.person_type_id', '=', 'person_types.id')
        ->join('sectors','profiles.sector_id','=','sectors.id')
        ->leftjoin('relation_ships', 'visa_application_details.relation_ship_id', '=', 'relation_ships.id')
        ->leftjoin('visa_types', 'visa_application_details.visa_type_id', '=', 'visa_types.id')
        ->leftjoin('stay_types', 'visa_application_details.stay_type_id', '=', 'stay_types.id')
        ->select('visa_application_details.*','nationalities.NationalityName','visa_types.VisaTypeNameMM','stay_types.StayTypeNameMM','person_types.PersonTypeNameMM','relation_ships.RelationShipNameMM','profiles.CompanyName','profiles.PermitNo','visa_application_heads.ApproveDate','sectors.SectorNameMM','profiles.Township','stay_types.id as StayId','profiles.BusinessType');

	        if (!is_null($request->PersonNameSearch)) {
	            $reportlist->where('visa_application_details.PersonName', 'like', '%'.$request->PersonNameSearch.'%');
	        }
	        if (!is_null($request->from_date) || !is_null($request->to_date)) {
	            $reportlist->whereBetween('visa_application_heads.ApproveDate', [$request->from_date, $request->to_date]);
	        }

            if (!is_null($request->GenderSearch)) {
	            $reportlist->where('visa_application_details.Gender', '=', $request->GenderSearch);
	        }

            if (!is_null($request->SectorSearch)) {
	            $reportlist->where('profiles.sector_id', '=', $request->SectorSearch);
	        }

            if (!is_null($request->PersonTypeSearch)) {
	            $reportlist->where('visa_application_details.person_type_id', '=', $request->PersonTypeSearch);
	        }

	        if (!is_null($request->NationalitySearch)) {
	            $reportlist->where('visa_application_details.nationality_id', '=', $request->NationalitySearch);
	        }

            if (!is_null($request->CompanyNameSearch)) {
	            $reportlist->where('profiles.CompanyName', 'like', '%'.$request->CompanyNameSearch.'%');
	        }

            if (!is_null($request->PermitNoSearch)) {
	            $reportlist->where('profiles.PermitNo', 'like', '%'.$request->PermitNoSearch.'%');
	        }

            if (!is_null($request->AddressSearch)) {
	            $reportlist->where('profiles.Township', 'like', '%'.$request->AddressSearch.'%');
	        }

	        
            $reportlist->where('visa_application_heads.Status', '=', 1);
	        $reportlist->orderBy('PersonName','asc');
	        $total = $reportlist->get();
            $reports = $reportlist->paginate(1000);

        return view('admin.reportForm',compact('reports','nationality','persontype','sector'))->with('i', (request()->input('page', 1) - 1) * 1000);

    }
    public function rejectHistory(Request $request){
        $reject = RejectHistory::join('admins', 'admins.id', '=', 'reject_histories.reviewer_id')
                    ->where('visa_application_head_id',$request->id)
                    ->get();
        return response()->json([
            'reject' => $reject,
        ]);
    }


    public function resignList()
    {
        $technicians = ForeignTechician::where('Status', 2)
                        ->orWhere('Status', 3)
                        ->orWhere('Status', 0)->orderBy('updated_at', 'desc')->get();
        return view('admin.resignList', compact('technicians'));
    }

    public function resignShow($id)
    {
        $technician = ForeignTechician::find($id);
        $ad = auth()->user();
        return view('admin.resignShow', compact('technician','ad'));
    }

    public function approveForeignResign($id)
    {
        $foreign_technician = ForeignTechician::find($id);
        $foreign_technician->approved_date = Carbon::now()->toDateString();
        $foreign_technician->Status = 3;
        $foreign_technician->update();

        $data = array(
                    'username' => $foreign_technician->profile->user->name,
                    'email' => $foreign_technician->profile->user->email,
                );

        // dd($data);

        // \Mail::send(
        //     'admin.resigned.approvemail',
        //     ['data' => $data],
        //     function ($message) use ($data) {
        //         $message
        //             ->from('movasygn@dica.gov.mm', 'MOVAS')
        //             ->to($data['email'])->subject('Your resignation letter had been approved.');
        //             // ->to('davidzaw1111@gmail.com')->subject('Your resignation letter had been approved.');
        //     }
        // );

        Toastr::success('Successfully Approved!');

        return redirect()->route('resignList');
    }

    public function rejectForeignResign(Request $request, $id)
    {
        $foreign_technician = ForeignTechician::find($id);
        $foreign_technician->rejected_date = Carbon::now()->toDateString();
        $foreign_technician->Status = 0;
        $foreign_technician->reject_comment = $request->reject_comment;
        $foreign_technician->update();

        $data = array(
            'username' => $foreign_technician->profile->user->name,
            'email' => $foreign_technician->profile->user->email,
            'reject_comment' => $request->reject_comment
        );

        // \Mail::send(
        //     'admin.resigned.rejectmail',
        //     ['data' => $data],
        //     function ($message) use ($data) {
        //         $message
        //             ->from('movasygn@dica.gov.mm', 'MOVAS')
        //             ->to($data['email'])->subject('Your resignation letter had been rejected.');
        //             // ->to('davidzaw1111@gmail.com')->subject('Your resignation letter had been rejected.');
        //     }
        // );

        Toastr::success('Successfully Rejected!');

        return redirect()->route('resignList');
    }

    public function applicantList()
    {

        $applicants = DB::SELECT(
            'SELECT *
            FROM visa_application_details AS vd
            INNER JOIN visa_application_heads AS vh ON vh.id=vd.visa_application_head_id
            INNER JOIN nationalities AS n ON n.id=vd.nationality_id
            INNER JOIN person_types AS pt ON pt.id=vd.person_type_id
            LEFT JOIN relation_ships AS rs ON rs.id=vd.person_type_id AND vd.person_type_id=4
            LEFT JOIN visa_types AS vt ON vt.id=vd.visa_type_id AND vd.visa_type_id IS NOT NULL
            LEFT JOIN stay_types AS st ON st.id=vd.stay_type_id AND vd.stay_type_id IS NOT NULL
            LEFT JOIN labour_card_types AS lt ON lt.id=vd.labour_card_type_id AND vd.labour_card_type_id IS NOT NULL
            LEFT JOIN labour_card_durations AS ld ON ld.id=vd.labour_card_duration_id AND vd.labour_card_duration_id IS NOT NULL
            LEFT JOIN
                (
                    select c.*, r.RankName 
                    from remarks as c, ranks as r
                    where c.ToRankID = r.id
                    and c.id in (
                        SELECT max(id)
                        FROM remarks
                        GROUP BY visa_application_head_id
                    )
                ) AS x
            ON vh.id = x.visa_application_head_id
            LEFT JOIN profiles as p ON vh.profile_id = p.id
            WHERE vh.Status IN (0,3)
            ORDER BY ABS(DATEDIFF(StayExpireDate, NOW()))'
        );
        // dd($applicants);
        return view('admin.applicantList', compact('applicants'));
    }

    public function applicantsExport()
    {
        $applicants = DB::SELECT(
            'SELECT *
            FROM visa_application_details AS vd
            INNER JOIN visa_application_heads AS vh ON vh.id=vd.visa_application_head_id
            INNER JOIN nationalities AS n ON n.id=vd.nationality_id
            INNER JOIN person_types AS pt ON pt.id=vd.person_type_id
            LEFT JOIN relation_ships AS rs ON rs.id=vd.person_type_id AND vd.person_type_id=4
            LEFT JOIN visa_types AS vt ON vt.id=vd.visa_type_id AND vd.visa_type_id IS NOT NULL
            LEFT JOIN stay_types AS st ON st.id=vd.stay_type_id AND vd.stay_type_id IS NOT NULL
            LEFT JOIN labour_card_types AS lt ON lt.id=vd.labour_card_type_id AND vd.labour_card_type_id IS NOT NULL
            LEFT JOIN labour_card_durations AS ld ON ld.id=vd.labour_card_duration_id AND vd.labour_card_duration_id IS NOT NULL
            LEFT JOIN
                (
                    select c.*, r.RankName 
                    from remarks as c, ranks as r
                    where c.ToRankID = r.id
                    and c.id in (
                        SELECT max(id)
                        FROM remarks
                        GROUP BY visa_application_head_id
                    )
                ) AS x
            ON vh.id = x.visa_application_head_id
            LEFT JOIN profiles as p ON vh.profile_id = p.id
            WHERE vh.Status IN (0,3)
            ORDER BY ABS(DATEDIFF(StayExpireDate, NOW()))'
        );
        // $applicants = VisaApplicationHead::where('status', 0)->latest()->get();
        return Excel::download(new ApplicantsExport($applicants), 'applicants.xlsx');
    }

    public function foreignExport($id)
    {
        $foreign_technicians = ForeignTechician::where('profile_id', $id)
                                ->whereIn('Status', [1, 3])
                                ->orderBy('Status', 'asc')->get();
    
        return Excel::download(new ForeignTechExport($foreign_technicians), 'foreign_technicians.xlsx');
    }

    // Director Export
    public function directorsExport($id){
        $directors = Director::where('profile_id', $id)
                                    ->where('status', 1)
                                    ->orderBy('status', 'asc')->get();
        return Excel::download(new ExportDirector($directors), 'directors.xlsx');
    }

    public function dependantsExport($id){
        $dependants = Dependant::where('profile_id', $id)
                                    ->where('status', 1)
                                    ->orderBy('status', 'asc')->get();
        return Excel::download(new ExportDependant($dependants), 'dependants.xlsx');
    }


    public function emailSend(){
        $profiles = Profile::where('Status', [2])->orderBy('Status', 'asc')->paginate(150);
        return view('admin.email', compact('profiles'));
    }


    public function sendMail(Request $request){
            try {
            
            $mailData = [
                'email' => $request->email,
                'subject'=>$request->subject,
                'message' => $request->message,
                // 'file' => $request->file,
                
            ];
            // dd($mailData);
            $users = [];
            foreach($mailData['email'] as $key => $ut){
                $ua = [];
                $ua['email'] = $ut;
                $users[$key] = (object)$ua;
            }
            //dd($mailData);
            Mail::to($users)->send(new ContactUsMail($mailData));
            return redirect()->back()->with('success', 'Email sent successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',  $th);
        }     
     }
}
