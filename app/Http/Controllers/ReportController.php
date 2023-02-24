<?php

namespace App\Http\Controllers;

use App\Exports\AllapplicantExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Exports\ExcelExport;


class ReportController extends Controller
{
    //
    public function reportExport(Request $request)
    {
        $reportlist = DB::table('visa_application_details')
            ->join('visa_application_heads', 'visa_application_details.visa_application_head_id', '=', 'visa_application_heads.id')
            ->join('nationalities', 'visa_application_details.nationality_id', '=', 'nationalities.id')
            ->leftjoin('visa_types', 'visa_application_details.visa_type_id', '=', 'visa_types.id')
            ->leftjoin('stay_types', 'visa_application_details.stay_type_id', '=', 'stay_types.id')
            ->join('person_types', 'visa_application_details.person_type_id', '=', 'person_types.id')
            ->leftjoin('relation_ships', 'visa_application_details.relation_ship_id', '=', 'relation_ships.id')
            ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
            ->join('sectors', 'profiles.sector_id', '=', 'sectors.id')
            ->select('visa_application_details.*', 'nationalities.NationalityName', 'visa_types.VisaTypeNameMM', 'stay_types.StayTypeNameMM', 'person_types.PersonTypeNameMM', 'relation_ships.RelationShipNameMM', 'profiles.CompanyName', 'profiles.PermitNo', 'visa_application_heads.ApproveDate', 'sectors.SectorNameMM', 'profiles.Township', 'stay_types.id as StayId', 'profiles.BusinessType');

        if (!is_null($request->PersonNameSearch)) {
            $reportlist->where('visa_application_details.PersonName', 'like', '%' . $request->PersonNameSearch . '%');
        }
        if (!is_null($request->from_date) || !is_null($request->to_date)) {
            $reportlist->whereBetween('visa_application_heads.ApproveDate', [$request->from_date, $request->to_date]);
        }
        if (!is_null($request->NationalitySearch)) {
            $reportlist->where('visa_application_details.nationality_id', '=', $request->NationalitySearch);
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

        if (!is_null($request->CompanyNameSearch)) {
            $reportlist->where('profiles.CompanyName', 'like', '%' . $request->CompanyNameSearch . '%');
        }

        if (!is_null($request->PermitNoSearch)) {
            $reportlist->where('profiles.PermitNo', 'like', '%' . $request->PermitNoSearch . '%');
        }

        if (!is_null($request->AddressSearch)) {
            $reportlist->where('profiles.Township', 'like', '%' . $request->AddressSearch . '%');
        }



        $reportlist->where('visa_application_heads.Status', '=', 1);
        $reportlist->orderBy('PersonName', 'asc');
        $reportlist->get();

        $reports = $reportlist->get();

        // $reports = $query->orderBy('visa_application_details.id', 'desc')->get();

        $array = [];
        foreach ($reports as $key => $list) {
            if ($list->StayId == '1') {
                $toDate = Carbon::parse($list->StayExpireDate)->addMonth(3)->subDay(1)->format('Y-m-d');
            } else if ($list->StayId == '2') {
                $toDate = Carbon::parse($list->StayExpireDate)->addMonth(6)->subDay(1)->format('Y-m-d');
            } else if ($list->StayId == '3') {
                $toDate = Carbon::parse($list->StayExpireDate)->addMonth(12)->subDay(1)->format('Y-m-d');
            } else {
                $toDate = '';
            }

            $array[] = [
                'No' => $key + 1,
                'PersonName' => $list->PersonName,
                'Nationalities' => $list->NationalityName,
                'Gender' => $list->Gender,
                'PassportNo' => $list->PassportNo,
                'StayAllowDate' => $list->StayAllowDate,
                'StayExpireDate' => $list->StayExpireDate,
                'visa_types' => $list->VisaTypeNameMM,
                'stay_types' => $list->StayTypeNameMM,
                'StayAllowDateFrom' => $list->StayExpireDate,
                'StayAllowDateTo' => $toDate,
                'person_types' => $list->PersonTypeNameMM,
                'Rank' => $list->PersonTypeNameMM == 'ကျွမ်းကျင်လုပ်သား' ? $list->Rank : $list->PersonTypeNameMM,
                'relation_ships' => $list->RelationShipNameMM,
                'Sectore' => $list->SectorNameMM,
                'BusinessType' => $list->BusinessType,
                'CompanyName' => $list->CompanyName,
                // 'FormC' => $list->FormC,
                'Township' => $list->Township,
                'PermitNo' => $list->PermitNo,
                'ApproveDate' => Carbon::parse($list->ApproveDate)->format('d'),
                'ApproveDate1' => Carbon::parse($list->ApproveDate)->format('m'),
                'ApproveDate2' => Carbon::parse($list->ApproveDate)->format('Y'),
            ];
        }

        // dd($array);

        $rows = count($array);
        $export = new ExcelExport($array, $rows);
        $name = 'report.xlsx';

        return Excel::download($export, $name);
    }


    public function allapplicantExport(Request $request){
            $allapplicants = DB::table('visa_application_details as d')
            ->join('visa_application_heads', 'd.visa_application_head_id', '=', 'visa_application_heads.id')
            ->join('nationalities', 'd.nationality_id', '=', 'nationalities.id')
            ->join('profiles', 'visa_application_heads.profile_id', '=', 'profiles.id')
            ->join('person_types', 'd.person_type_id', '=', 'person_types.id')
            ->join('sectors','profiles.sector_id','=','sectors.id')
            ->leftjoin('relation_ships', 'd.relation_ship_id', '=', 'relation_ships.id')
            ->leftjoin('visa_types', 'd.visa_type_id', '=', 'visa_types.id')
            ->leftjoin('stay_types', 'd.stay_type_id', '=', 'stay_types.id')
            ->select('d.*','nationalities.NationalityName','visa_types.VisaTypeNameMM','stay_types.StayTypeNameMM','person_types.PersonTypeNameMM','relation_ships.RelationShipNameMM','profiles.CompanyName','profiles.PermitNo','visa_application_heads.ApproveDate','sectors.SectorNameMM','profiles.Township','stay_types.id as StayId','profiles.BusinessType')
            ->whereRaw(DB::raw('d.id in (SELECT max(d.id)
            from visa_application_details d left join visa_application_heads h on d.visa_application_head_id = h.id
            where h.Status = 1
            group by d.PersonName, d.PassportNo)'));

            if (!is_null($request->from_date) || !is_null($request->to_date)) {
                $allapplicants->whereBetween('visa_application_heads.ApproveDate', [$request->from_date, $request->to_date]);
            }

            $allapplicants->orderBy('PersonName', 'asc');
            $allapplicants->get();

            $aps = $allapplicants->get();

            $array = [];
            foreach ($aps as $key => $list) {
                if ($list->StayId == '1') {
                    $toDate = Carbon::parse($list->StayExpireDate)->addMonth(3)->subDay(1)->format('Y-m-d');
                } else if ($list->StayId == '2') {
                    $toDate = Carbon::parse($list->StayExpireDate)->addMonth(6)->subDay(1)->format('Y-m-d');
                } else if ($list->StayId == '3') {
                    $toDate = Carbon::parse($list->StayExpireDate)->addMonth(12)->subDay(1)->format('Y-m-d');
                } else {
                    $toDate = '';
                }
    
                $array[] = [
                    'No' => $key + 1,
                    'PersonName' => $list->PersonName,
                    'Nationalities' => $list->NationalityName,
                    'Gender' => $list->Gender,
                    'PassportNo' => $list->PassportNo,
                    'StayAllowDate' => $list->StayAllowDate,
                    'StayExpireDate' => $list->StayExpireDate,
                    'visa_types' => $list->VisaTypeNameMM,
                    'stay_types' => $list->StayTypeNameMM,
                    'StayAllowDateFrom' => $list->StayExpireDate,
                    'StayAllowDateTo' => $toDate,
                    'person_types' => $list->PersonTypeNameMM,
                    'Rank' => $list->PersonTypeNameMM == 'ကျွမ်းကျင်လုပ်သား' ? $list->Rank : $list->PersonTypeNameMM,
                    'relation_ships' => $list->RelationShipNameMM,
                    'Sectore' => $list->SectorNameMM,
                    'BusinessType' => $list->BusinessType,
                    'CompanyName' => $list->CompanyName,
                    // 'FormC' => $list->FormC,
                    'Township' => $list->Township,
                    'PermitNo' => $list->PermitNo,
                    'ApproveDate' => Carbon::parse($list->ApproveDate)->format('d'),
                    'ApproveDate1' => Carbon::parse($list->ApproveDate)->format('m'),
                    'ApproveDate2' => Carbon::parse($list->ApproveDate)->format('Y'),
                ];
            }

            $rws = count($array);
            $export_allaps = new AllapplicantExport($array, $rws);

            $name = 'all_applicants.xlsx';
            return Excel::download($export_allaps, $name);
        
    }
}


