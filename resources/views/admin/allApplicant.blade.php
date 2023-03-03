@extends('admin.layout')
@section('content')

    @php
    $r_from_date = request()->from_date === null ? '' : request()->from_date;
    $r_to_date = request()->to_date === null ? '' : request()->to_date;
    $r_PersonNameSearch = request()->PersonNameSearch === null ? '' : request()->PersonNameSearch;
    $r_NationalitySearch = request()->NationalitySearch === null ? '' : request()->NationalitySearch;
    $r_GenderSearch = request()->GenderSearch === null ? '' : request()->GenderSearch;
    $r_SectorSearch = request()->SectorSearch === null ? '' : request()->SectorSearch;
    $r_PersonTypeSearch = request()->PersonTypeSearch === null ? '' : request()->PersonTypeSearch;
    $r_CompanyNameSearch = request()->CompanyNameSearch === null ? '' : request()->CompanyNameSearch;
    $r_PermitNoSearch = request()->PermitNoSearch === null ? '' : request()->PermitNoSearch;
    $r_AddressSearch = request()->AddressSearch === null ? '' : request()->AddressSearch;
    if (old()) {
        $r_from_date = old('from_date');
        $r_to_date = old('to_date');
        $r_PersonNameSearch = old('PersonNameSearch');
        $r_NationalitySearch = old('NationalitySearch');
        $r_GenderSearch = old('GenderSearch');  
        $r_SectorSearch = old('SectorSearch');
        $r_PersonTypeSearch = old('PersonTypeSearch');
        $r_type = old('Type');
    }
    @endphp

    <style>
        /*body {font-family: Pyidaungsu;}*/

        input {
            width: 150px !important;
        }

        table thead tr th {
            text-align: center;
            vertical-align: middle;

        }

        

    </style>


    <div class="d-xl-flex justify-content-between align-items-start" style="border-bottom: 1px solid lightblue;">
        <!-- <p class="text-dark mb-2"> ?????????????????????????? ????????????????????????????????????? </p> -->
        <p class="text-dark mb-2">Approved Foreign Technician/Skilled Labour All List</p>
    </div>


    <div class="row mt-3">
        <form action="#" method="Get" class="col-md-11">
            <div class="row"> 
                <div class="col-md-8 col-sm-12">
                    <label class="mt-2 mx-1" style="font-size: 14px;">Date</label>
                    <div class="input-group input-daterange">
                        {{-- <label class="mt-2 mx-1" style="font-size: 14px;">From</label> --}}
                        <input type="date" name="from_date" class="form-control" autocomplete="off"
                            value="{{ $r_from_date }}">

                        <div class="input-group-addon mx-1 mt-2 ml-3" style="font-size: 14px;">To</div>
                        <input type="date" name="to_date" class="form-control" autocomplete="off"
                            value="{{ $r_to_date }}">
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">

                    <button class="btn btn-primary" style="height: 46px; margin-top:35px;">
                        <i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
        <div class="col-md-1 col-sm-12">
            <form action="{{ route('report.allapplicant') }}" method="get">
                <input type="hidden" name="PersonNameSearch" value="{{ $r_PersonNameSearch }}">
                <input type="hidden" name="NationalitySearch" value="{{ $r_NationalitySearch }}">
                <input type="hidden" name="from_date" value="{{ $r_from_date }}">
                <input type="hidden" name="to_date" value="{{ $r_to_date }}">
                <input type="hidden" name="GenderSearch" value="{{ $r_GenderSearch }}">
                <input type="hidden" name="SectorSearch" value="{{ $r_SectorSearch }}">
                <input type="hidden" name="PersonTypeSearch" value="{{ $r_PersonTypeSearch }}">
                <input type="hidden" name="CompanyNameSearch" value="{{ $r_CompanyNameSearch }}">
                <input type="hidden" name="PermitNoSearch" value="{{ $r_PermitNoSearch }}">
                <input type="hidden" name="AddressSearch" value="{{ $r_AddressSearch }}">

                <button type="submit" class="btn btn-success" style="height: 46px;  margin-top:35px; font-size:12px;">
                    Print
                </button>
            </form>
        </div>

       
    </div>




    <div class="row">


    </div>

    <br>
    <style>
        .table-responsive {
            -sm|-md|-lg|-xl
        }

    </style>

    <div class="row">
        <div class="col-md-12 col-sm-4">
            <table class="table table-striped table-bordered table-responsive" style="border: 1px solid lightblue;">
                <thead>
                    <tr>
                        <th rowspan="2" align="center" style="line-height: 4;">No.</th>
                        <th rowspan="2" style="line-height: 4;">Name</th>
                        <th rowspan="2" style="line-height: 4;">Nationality</th>
                        <th rowspan="2" style="line-height: 4;">Gender</th>
                        <th rowspan="2" style="line-height: 4;">Passport No</th>
			            <th rowspan="2" style="line-height:4;">Stay Expire Date</th>
                        <th rowspan="2" style="line-height: 4;">MIC Approved Date</th>
                        <th rowspan="2" style="line-height: 4;">Visa Type</th>
                        <th rowspan="2" style="line-height: 4;">Stay (Duration)</th>
                        <th rowspan="2" style="line-height: 4;">Stay (From)</th>
                        <th rowspan="2" style="line-height: 4;">Stay (To)</th>
                        <th rowspan="2" style="line-height: 2;">Applicant <br> Type</th>
                        <th rowspan="2" style="line-height: 2;">Applicant <br> Rank</th>
                        <th rowspan="2" style="line-height: 4;">Relationship</th>
                        <th rowspan="2" style="line-height: 4;">Sector</th>
                        <th rowspan="2" style="line-height: 4;">Business Type</th>
                        <th rowspan="2" style="line-height: 4;">Company Name</th>
                        <th rowspan="2" style="line-height: 4;">Address</th>
                        <th rowspan="2" style="line-height: 4;">Form C Address</th>
                        <th rowspan="2" style="line-height: 2;">Permit No. (or) <br> Endorsement No.</th>
                        <th colspan="3">Approved Date</th>
                    </tr>
                    <tr>
                        <th>D</td>
                        <th>M</td>
                        <th>Y</td>
                    </tr>
                </thead>
                <tbody>
                    {{-- {{ dd($reports) }} --}}
                    @if (isset($aps))
                        @foreach ($aps as $key => $ap)
                            <tr>
                                <td style="text-align: center;">{{ ++$key }}</td>
                                <td>{{ $ap->PersonName }}</td>
                                <td style="text-align: center;">{{ $ap->NationalityName }}</td>
                                <td style="text-align: center;">{{ $ap->Gender }}</td>
                                <td style="text-align: center;">{{ $ap->PassportNo }}</td>
                                <td style="text-align: center;">{{ $ap->StayExpireDate }}</td>
				                <td style="text-align: center;">{{ $ap->StayAllowDate }}</td>
                                <td style="text-align: center;">{{ $ap->VisaTypeNameMM }}</td>
                                <td style="text-align: center;">{{ $ap->StayTypeNameMM }}</td>
                              
                                @if( $ap->StayTypeNameMM )
                                <td style="text-align: center;">{{ $ap->StayExpireDate }}</td>
                                @if($ap->StayId== 1)
                                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($ap->StayExpireDate)->addMonths(3)->subDays(1)->format('Y-m-d') }}</td>
                                @elseif($ap->StayId == 2)
                                  <td style="text-align: center;">{{ \Carbon\Carbon::parse($ap->StayExpireDate)->addMonths(6)->subDays(1)->format('Y-m-d')}}</td>
                                @else
                                  <td style="text-align: center;">{{ \Carbon\Carbon::parse($ap->StayExpireDate)->addMonths(12)->subDays(1)->format('Y-m-d') }}</td>
                                @endif
                                @else
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                @endif
                               

                                <td style="text-align: center;">{{ $ap->PersonTypeNameMM }}</td>
                                <td style="text-align:center;">
                                    @if ($ap->PersonTypeNameMM == 'ကျွမ်းကျင်လုပ်သား')
                                        @if ($ap->Rank)
                                            {{ $ap->Rank }}
                                        @else
                                            <p>Rank not filled</p>
                                        @endif
                                    @else
                                        {{ $ap->PersonTypeNameMM }}
                                    @endif
                                </td>
                                @if($ap->Remark == null)
                                <td style="text-align: center;"> {{ $ap->RelationShipNameMM }}</td>
                                @else
                                <td style="text-align: center;">{{ $ap->Remark }} ၏ {{ $ap->RelationShipNameMM }}</td>
                                @endif
                                <td style="text-align: center;">{{ $ap->SectorNameMM }}</td>
                                <td style="white-space: normal;line-height: 1.6;">{{ $ap->BusinessType }}</td>
                                <td style="white-space: normal;line-height: 1.6;">{{ $ap->CompanyName }}</td>
                                <td style="white-space: normal;line-height: 1.6;">{{ $ap->Township }}</td>
                                <td style="white-space: normal;line-height: 1.6;">{{ $ap->FormC }}</td>
                                <td style="text-align: center;">{{ $ap->PermitNo }}</td>
                                <td>{{ \Carbon\Carbon::parse($ap->ApproveDate)->format('d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($ap->ApproveDate)->format('m') }}</td>
                                <td>{{ \Carbon\Carbon::parse($ap->ApproveDate)->format('Y') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
        <div class="Container mt-2">
            <div class="" style="margin-left: 500px;">
                {{-- @if (isset($aps))
                    {{ $aps->links('vendor.pagination.custom') }}
                @endif --}}
            </div>
        </div>

    </div>



@endsection

