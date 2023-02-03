<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class GraphTableController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth:admin');
        // $this->middleware(['auth:admin','superadmin']);
    }


   public function index()
   {
       return view('admin.graphtable');
   }


   public function graphtable(Request $request)
   {

    if($request){
        if($request->DMY=='Y'){
            $format='%Y'; // Yearly
        } else if($request->DMY=='M'){
            $format='%m-%Y'; // Monthly
        } else {
            $format='%d-%m-%Y'; // Daily
        }
    } else {
        $format='%d-%m-%Y'; // Daily
    }

    // dd($request->DMY);

    $ApprovedProfile =  DB::select("SELECT DATE_FORMAT(date(created_at),'$format') as D, count(id) as C 
    FROM profiles WHERE Status=1 
    AND date(created_at) >= '$request->from_date' and date(created_at) <= '$request->to_date'
    GROUP BY DATE_FORMAT(date(created_at),'$format')");


    $AppliedCase =  DB::select("SELECT DATE_FORMAT(date(FinalApplyDate),'$format') as D, count(id) as C
    FROM `visa_application_heads` 
    WHERE date(FinalApplyDate) >= '$request->from_date' and date(FinalApplyDate) <= '$request->to_date'
    GROUP BY DATE_FORMAT(date(FinalApplyDate),'$format')");

    $ApprovedCase = DB::select("SELECT DATE_FORMAT(date(ApproveDate),'$format') as D, count(id) as C
    FROM `visa_application_heads` 
    WHERE date(ApproveDate) >= '$request->from_date' and date(ApproveDate) <= '$request->to_date'
    and Status=1
    GROUP BY DATE_FORMAT(date(ApproveDate),'$format')");

    $RejectedCase = DB::select("SELECT DATE_FORMAT(date(RejectedDate),'$format') as D, count(id) as C
    FROM `visa_application_heads` 
    WHERE date(RejectedDate) >= '$request->from_date' and date(RejectedDate) <= '$request->to_date'
    and Status=2
    GROUP BY DATE_FORMAT(date(RejectedDate),'$format')");

    $AppliedPerson = DB::select("SELECT DATE_FORMAT(date(FinalApplyDate),'$format') as D, count(d.id) as C
    FROM visa_application_details as d, visa_application_heads as h
    WHERE d.visa_application_head_id=h.id and d.visa_application_head_id in 
    (
    SELECT id
    FROM visa_application_heads
    WHERE date(FinalApplyDate) >= '$request->from_date' and date(FinalApplyDate) <= '$request->to_date'
    )
    GROUP BY DATE_FORMAT(date(FinalApplyDate),'$format')");

    $ApprovedPerson =   DB::select("SELECT DATE_FORMAT(date(ApproveDate),'$format') as D, count(d.id) as C
    FROM visa_application_details as d, visa_application_heads as h
    WHERE d.visa_application_head_id=h.id and d.visa_application_head_id in 
    (
    SELECT id
    FROM visa_application_heads
    WHERE date(ApproveDate) >= '$request->from_date' and date(ApproveDate) <= '$request->to_date'
    )
    GROUP BY DATE_FORMAT(date(ApproveDate),'$format')");

    
    $AppliedPersonByType =  DB::select("SELECT DATE_FORMAT(date(FinalApplyDate),'$format') as D,
    sum(case when visa_type_id is null then 0 else 1 end) as Visa, 
    sum(case when stay_type_id is null then 0 else 1 end) as Stay, 
    sum(case when labour_card_type_id is null then 0 else 1 end) as LabourCard 
    FROM visa_application_details as d, visa_application_heads as h, nationalities as n 
    WHERE d.visa_application_head_id=h.id AND d.nationality_id=n.id 
    AND date(FinalApplyDate) >= '$request->from_date' AND date(FinalApplyDate) <= '$request->to_date'
    GROUP BY DATE_FORMAT(date(FinalApplyDate),'$format')");

    $ApprovedPersonByType = DB::select("SELECT DATE_FORMAT(date(ApproveDate),'$format') as D,
    sum(case when visa_type_id is null then 0 else 1 end) as Visa, 
    sum(case when stay_type_id is null then 0 else 1 end) as Stay, 
    sum(case when labour_card_type_id is null then 0 else 1 end) as LabourCard 
    FROM visa_application_details as d, visa_application_heads as h, nationalities as n 
    WHERE d.visa_application_head_id=h.id AND d.nationality_id=n.id 
    AND date(ApproveDate) >= '$request->from_date' AND date(ApproveDate) <= '$request->to_date'
    GROUP BY DATE_FORMAT(date(ApproveDate),'$format')");

    $AppliedCaseByCountry = DB::select("SELECT n.NationalityName as N, count(h.id) as C
    FROM visa_application_details as d, visa_application_heads as h, nationalities as n 
    WHERE d.visa_application_head_id=h.id AND d.nationality_id=n.id 
    AND date(FinalApplyDate) >= '$request->from_date' AND date(FinalApplyDate) <= '$request->to_date'
    GROUP BY n.NationalityName");

    $ApprovedCaseByCountry =    DB::select("SELECT n.NationalityName as N, count(h.id) as C
    FROM visa_application_details as d, visa_application_heads as h, nationalities as n 
    WHERE d.visa_application_head_id=h.id AND d.nationality_id=n.id 
    AND date(ApproveDate) >= '$request->from_date' AND date(ApproveDate) <= '$request->to_date'
    GROUP BY n.NationalityName");


    $AppliedPersonByCountry =   DB::select("SELECT n.NationalityName as N, count(d.id) as C
    FROM visa_application_details as d, visa_application_heads as h, nationalities as n 
    WHERE d.visa_application_head_id=h.id AND d.nationality_id=n.id 
    AND date(FinalApplyDate) >= '$request->from_date' AND date(FinalApplyDate) <= '$request->to_date'
    GROUP BY n.NationalityName");

    $ApprovedPersonByCountry =  DB::select("SELECT n.NationalityName as N, count(d.id) as C
    FROM visa_application_details as d, visa_application_heads as h, nationalities as n 
    WHERE d.visa_application_head_id=h.id AND d.nationality_id=n.id 
    AND date(ApproveDate) >= '$request->from_date' AND date(ApproveDate) <= '$request->to_date'
    GROUP BY n.NationalityName");

    $AppliedGender =    DB::select("SELECT DATE_FORMAT(date(FinalApplyDate),'$format') as D,
    sum(case when Gender = 'Male' then 1 else 0 end) as Male, 
    sum(case when Gender = 'Female' then 1 else 0 end) as Female 
    FROM visa_application_details as d, visa_application_heads as h
    WHERE d.visa_application_head_id=h.id 
    AND date(FinalApplyDate) >= '$request->from_date' AND date(FinalApplyDate) <= '$request->to_date'
    GROUP BY DATE_FORMAT(date(FinalApplyDate),'$format')");

    $ApprovedGender =   DB::select("SELECT DATE_FORMAT(date(ApproveDate),'$format') as D,
    sum(case when Gender = 'Male' then 1 else 0 end) as Male, 
    sum(case when Gender = 'Female' then 1 else 0 end) as Female 
    FROM visa_application_details as d, visa_application_heads as h
    WHERE d.visa_application_head_id=h.id 
    AND date(ApproveDate) >= '$request->from_date' AND date(ApproveDate) <= '$request->to_date'
    GROUP BY DATE_FORMAT(date(ApproveDate),'$format')");

    $AppliedCaseBySector =  DB::select("SELECT s.SectorName as N, count(h.id) as C
    FROM visa_application_heads as h, profiles as p, sectors as s 
    WHERE h.profile_id=p.id and p.sector_id=s.id
    AND date(FinalApplyDate) >= '$request->from_date' AND date(FinalApplyDate) <= '$request->to_date'
    GROUP BY s.SectorName");

    $ApprovedCaseBySector = DB::select("SELECT s.SectorName as N, count(h.id) as C
    FROM visa_application_heads as h, profiles as p, sectors as s 
    WHERE h.profile_id=p.id and p.sector_id=s.id
    AND date(h.ApproveDate) >= '$request->from_date' AND date(h.ApproveDate) <= '$request->to_date'
    GROUP BY s.SectorName");

    $AppliedPersonBySector = DB::select("SELECT s.SectorName as N, count(d.id) as C
    FROM visa_application_details as d, visa_application_heads as h, profiles as p, sectors as s 
    WHERE h.profile_id=p.id and p.sector_id=s.id and d.visa_application_head_id=h.id 
    AND date(FinalApplyDate) >= '$request->from_date' AND date(FinalApplyDate) <= '$request->to_date'
    GROUP BY s.SectorName");

    $ApprovedPersonBySector = DB::select("SELECT s.SectorName as N, count(d.id) as C
    FROM visa_application_details as d, visa_application_heads as h, profiles as p, sectors as s 
    WHERE h.profile_id=p.id and p.sector_id=s.id and d.visa_application_head_id=h.id 
    AND date(h.ApproveDate) >= '$request->from_date' AND date(h.ApproveDate) <= '$request->to_date'
    GROUP BY s.SectorName");

    $AppliedPersonByApplicantType = DB::select("SELECT DATE_FORMAT(date(FinalApplyDate),'$format') as D,
    sum(case when person_type_id = 1 then 1 else 0 end) as 'Director', 
    sum(case when person_type_id = 2 then 1 else 0 end) as 'Secretary', 
    sum(case when person_type_id = 3 then 1 else 0 end) as 'TechnicianSkilledLabour',
    sum(case when person_type_id = 4 then 1 else 0 end) as 'Dependant'
    FROM visa_application_details as d, visa_application_heads as h
    WHERE d.visa_application_head_id=h.id 
    AND date(FinalApplyDate) >= '$request->from_date' AND date(FinalApplyDate) <= '$request->to_date'
    GROUP BY DATE_FORMAT(date(FinalApplyDate),'$format')");

    $ApprovedPersonByApplicantType = DB::select("SELECT DATE_FORMAT(date(ApproveDate),'$format') as D,
    sum(case when person_type_id = 1 then 1 else 0 end) as 'Director', 
    sum(case when person_type_id = 2 then 1 else 0 end) as 'Secretary', 
    sum(case when person_type_id = 3 then 1 else 0 end) as 'TechnicianSkilledLabour',
    sum(case when person_type_id = 4 then 1 else 0 end) as 'Dependant'
    FROM visa_application_details as d, visa_application_heads as h
    WHERE d.visa_application_head_id=h.id 
    AND date(ApproveDate) >= '$request->from_date' AND date(ApproveDate) <= '$request->to_date'
    GROUP BY DATE_FORMAT(date(ApproveDate),'$format')");

        // ----------------------------------------------------------------------
    
    $Approved = DB::select("SELECT x.ApproveDate as d, sum(D) as DICA, sum(I) as Immigration, sum(L) as Labour
                    from (
                    SELECT DATE_FORMAT(date(ApproveDate),'$format') as ApproveDate, count(ApproveDate) as D, 0 as I, 0 as L
                    FROM visa_application_heads as d
                    WHERE Status=1
                    AND date(ApproveDate) >= '$request->from_date' AND date(ApproveDate) <= '$request->to_date'
                    GROUP BY DATE_FORMAT(date(ApproveDate),'$format')

                    UNION

                    SELECT DATE_FORMAT(date(IntegrationActionDate),'$format') as ApproveDate, 0 as D, count(IntegrationActionDate) as I, 0 as L
                    FROM visa_application_heads as d
                    WHERE IntegrationActionStatus=1
                    AND date(IntegrationActionDate) >= '$request->from_date' AND date(IntegrationActionDate) <= '$request->to_date'
                    GROUP BY DATE_FORMAT(date(IntegrationActionDate),'$format')


                    UNION

                    SELECT DATE_FORMAT(date(LabourActionDate),'$format') as ApproveDate, 0 as D, 0 as I, count(LabourActionDate) as L
                    FROM visa_application_heads as d
                    WHERE LabourActionStatus=1
                    AND date(LabourActionDate) >= '$request->from_date' AND date(LabourActionDate) <= '$request->to_date'
                    GROUP BY DATE_FORMAT(date(LabourActionDate),'$format')
                    ) as x
                    GROUP BY x.ApproveDate");

    // ---------------------------------------------------------------------

    return view('admin.graphtable', compact('ApprovedProfile','AppliedCase','ApprovedCase','RejectedCase','AppliedPerson','ApprovedPerson','AppliedPersonByType','ApprovedPersonByType','AppliedCaseByCountry','ApprovedCaseByCountry','AppliedPersonByCountry','ApprovedPersonByCountry','AppliedGender','ApprovedGender','AppliedCaseBySector','ApprovedCaseBySector','AppliedPersonBySector','ApprovedPersonBySector','AppliedPersonByApplicantType','ApprovedPersonByApplicantType','Approved'));
    }
}
