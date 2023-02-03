<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\Console\Input\Input;

class GoogleChartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function googleChart(Request $request)
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

        // $AppliedPersonByApplicantType = DB::select("SELECT date(FinalApplyDate) as D,
        //                                 sum(case when person_type_id = 1 then 1 else 0 end) as 'Director', 
        //                                 sum(case when person_type_id = 2 then 1 else 0 end) as 'Secretary', 
        //                                 sum(case when person_type_id = 3 then 1 else 0 end) as 'Technician',
        //                                 sum(case when person_type_id = 4 then 1 else 0 end) as 'Dependant'
        //                                 FROM visa_application_details as d, visa_application_heads as h
        //                                 WHERE d.visa_application_head_id=h.id 
        //                                 AND date(FinalApplyDate) >= '$request->from_date' AND date(FinalApplyDate) <= '$request->to_date'
        //                                 GROUP BY date(FinalApplyDate)");

        // $ApprovedPersonByApplicantType = DB::select("SELECT date(ApproveDate) as D,
        //                                 sum(case when person_type_id = 1 then 1 else 0 end) as 'Director', 
        //                                 sum(case when person_type_id = 2 then 1 else 0 end) as 'Secretary', 
        //                                 sum(case when person_type_id = 3 then 1 else 0 end) as 'Technician',
        //                                 sum(case when person_type_id = 4 then 1 else 0 end) as 'Dependant'
        //                                 FROM visa_application_details as d, visa_application_heads as h
        //                                 WHERE d.visa_application_head_id=h.id 
        //                                 AND date(ApproveDate) >= '$request->from_date' AND date(ApproveDate) <= '$request->to_date'
        //                                 GROUP BY date(ApproveDate)");

        $AppliedPersonByApplicantType = DB::select("SELECT DATE_FORMAT(date(FinalApplyDate),'$format') as D,
                                        sum(case when person_type_id = 1 then 1 else 0 end) as 'Director', 
                                        sum(case when person_type_id = 2 then 1 else 0 end) as 'Secretary', 
                                        sum(case when person_type_id = 3 then 1 else 0 end) as 'Technician',
                                        sum(case when person_type_id = 4 then 1 else 0 end) as 'Dependant'
                                        FROM visa_application_details as d, visa_application_heads as h
                                        WHERE d.visa_application_head_id=h.id 
                                        AND date(FinalApplyDate) >= '$request->from_date' AND date(FinalApplyDate) <= '$request->to_date'
                                        GROUP BY DATE_FORMAT(date(FinalApplyDate),'$format')");
                                        
        $ApprovedPersonByApplicantType = DB::select("SELECT DATE_FORMAT(date(ApproveDate),'$format')  as D,
                                        sum(case when person_type_id = 1 then 1 else 0 end) as 'Director', 
                                        sum(case when person_type_id = 2 then 1 else 0 end) as 'Secretary', 
                                        sum(case when person_type_id = 3 then 1 else 0 end) as 'Technician',
                                        sum(case when person_type_id = 4 then 1 else 0 end) as 'Dependant'
                                        FROM visa_application_details as d, visa_application_heads as h
                                        WHERE d.visa_application_head_id=h.id 
                                        AND date(ApproveDate) >= '$request->from_date' AND date(ApproveDate) <= '$request->to_date'
                                        GROUP BY DATE_FORMAT(date(ApproveDate),'$format')");
        // dd($AppliedPersonByApplicantType, $ApprovedPersonByApplicantType);


        $Approved = DB::select("SELECT x.ApproveDate as Dt, sum(D) as DICA, sum(I) as Immigration, sum(L) as Labour
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

              


  
        $ApprovedProfiles[] = ['Date', 'User'];
        foreach ($ApprovedProfile as $key => $val) {
            $ApprovedProfiles[++$key] = [$val->D, (int)$val->C];
        }

        $AppliedCases[] = ['Date', 'Case'];
        foreach ($AppliedCase as $key => $val) {
            $AppliedCases[++$key] = [$val->D, (int)$val->C];
        }

        $ApprovedCases[] = ['Date', 'Case'];
        foreach ($ApprovedCase as $key => $val) {
            $ApprovedCases[++$key] = [$val->D, (int)$val->C];
        }

        $RejectedCases[] = ['Date', 'Case'];
        foreach ($RejectedCase as $key => $val) {
            $RejectedCases[++$key] = [$val->D, (int)$val->C];
        }

        $AppliedPersons[] = ['Date', 'Person'];
        foreach ($AppliedPerson as $key => $val) {
            $AppliedPersons[++$key] = [$val->D, (int)$val->C];
        }

        $ApprovedPersons[] = ['Date', 'Person'];
        foreach ($ApprovedPerson as $key => $val) {
            $ApprovedPersons[++$key] = [$val->D, (int)$val->C];
        }



        $AppliedPersonByTypes[] = ['Date', 'Visa', 'Stay', 'LabourCard'];
        foreach ($AppliedPersonByType as $key => $val) {
            $AppliedPersonByTypes[++$key] = [$val->D, (int)$val->Visa, (int)$val->Stay, (int)$val->LabourCard];
        }

        $ApprovedPersonByTypes[] = ['Date', 'Visa', 'Stay', 'LabourCard'];
        foreach ($ApprovedPersonByType as $key => $val) {
            $ApprovedPersonByTypes[++$key] = [$val->D, (int)$val->Visa, (int)$val->Stay, (int)$val->LabourCard];
        }

        $AppliedGenders[] = ['Date', 'Male', 'Female'];
        foreach ($AppliedGender as $key => $val) {
            $AppliedGenders[++$key] = [$val->D, (int)$val->Male, (int)$val->Female];
        }

        $ApprovedGenders[] = ['Date', 'Male', 'Female'];
        foreach ($ApprovedGender as $key => $val) {
            $ApprovedGenders[++$key] = [$val->D, (int)$val->Male, (int)$val->Female];
        }



        $AppliedCaseByCountries[] = ['Name', 'Case'];
        foreach ($AppliedCaseByCountry as $key => $val) {
            $AppliedCaseByCountries[++$key] = [$val->N, (int)$val->C];
        }
        $ApprovedCaseByCountries[] = ['Name', 'Case'];
        foreach ($ApprovedCaseByCountry as $key => $val) {
            $ApprovedCaseByCountries[++$key] = [$val->N, (int)$val->C];
        }
        $AppliedPersonByCountries[] = ['Name', 'Person'];
        foreach ($AppliedPersonByCountry as $key => $val) {
            $AppliedPersonByCountries[++$key] = [$val->N, (int)$val->C];
        }
        $ApprovedPersonByCountries[] = ['Name', 'Person'];
        foreach ($ApprovedPersonByCountry as $key => $val) {
            $ApprovedPersonByCountries[++$key] = [$val->N, (int)$val->C];
        }
        $AppliedCaseBySectors[] = ['Name', 'Case'];
        foreach ($AppliedCaseBySector as $key => $val) {
            $AppliedCaseBySectors[++$key] = [$val->N, (int)$val->C];
        }
        $ApprovedCaseBySectors[] = ['Name', 'Case'];
        foreach ($ApprovedCaseBySector as $key => $val) {
            $ApprovedCaseBySectors[++$key] = [$val->N, (int)$val->C];
        }
        $AppliedPersonBySectors[] = ['Name', 'Person'];
        foreach ($AppliedPersonBySector as $key => $val) {
            $AppliedPersonBySectors[++$key] = [$val->N, (int)$val->C];
        }
        $ApprovedPersonBySectors[] = ['Name', 'Person'];
        foreach ($ApprovedPersonBySector as $key => $val) {
            $ApprovedPersonBySectors[++$key] = [$val->N, (int)$val->C];
        }

        $AppliedPersonByApplicantTypes[] = ['Date', 'Director', 'Secretary', 'Technician', 'Dependant'];
        foreach ($AppliedPersonByApplicantType as $key => $val) {
            $AppliedPersonByApplicantTypes[++$key] = [$val->D, (int)$val->Director, (int)$val->Secretary, (int)$val->Technician, (int)$val->Dependant];
        }
        $ApprovedPersonByApplicantTypes[] = ['Date', 'Director', 'Secretary', 'Technician', 'Dependant'];
        foreach ($ApprovedPersonByApplicantType as $key => $val) {
            $ApprovedPersonByApplicantTypes[++$key] = [$val->D, (int)$val->Director, (int)$val->Secretary, (int)$val->Technician, (int)$val->Dependant];
        }

        $Approveds[] = ['Date', 'DICA', 'Immigration', 'Labour'];
        foreach ($Approved as $key => $val) {
            $Approveds[++$key] = [$val->Dt, (int)$val->DICA, (int)$val->Immigration, (int)$val->Labour];
        }

        

       

        return view('admin.graphForm')
                ->with('approvedProfile',json_encode($ApprovedProfiles))
                ->with('appliedCase',json_encode($AppliedCases))
                ->with('approvedCase',json_encode($ApprovedCases))
                ->with('rejectedCase',json_encode($RejectedCases))
                ->with('appliedPerson',json_encode($AppliedPersons))
                ->with('approvedPerson',json_encode($ApprovedPersons))

                ->with('appliedPersonByType',json_encode($AppliedPersonByTypes))
                ->with('approvedPersonByType',json_encode($ApprovedPersonByTypes))
                ->with('appliedGender',json_encode($AppliedGenders))
                ->with('approvedGender',json_encode($ApprovedGenders))

                ->with('appliedCaseByCountry',json_encode($AppliedCaseByCountries))
                ->with('approvedCaseByCountry',json_encode($ApprovedCaseByCountries))
                ->with('appliedPersonByCountry',json_encode($AppliedPersonByCountries))
                ->with('approvedPersonByCountry',json_encode($ApprovedPersonByCountries))
                ->with('appliedCaseBySector',json_encode($AppliedCaseBySectors))
                ->with('approvedCaseBySector',json_encode($ApprovedCaseBySectors))
                ->with('appliedPersonBySector',json_encode($AppliedPersonBySectors))
                ->with('approvedPersonBySector',json_encode($ApprovedPersonBySectors))
                ->with('appliedPersonByApplicantType',json_encode($AppliedPersonByApplicantTypes)) 
                ->with('approvedPersonByApplicantType',json_encode($ApprovedPersonByApplicantTypes))
                ->with('approved',json_encode($Approveds));
               
    }
}


