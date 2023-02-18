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
        <p class="text-dark mb-2">Approved Foreign Technician/Skilled Labour List</p>
    </div>


    <div class="row mt-3">
        <form action="#" method="Get">
            <div class="row"> 
                <div class="col-md-2 col-sm-12">
                    <label class="mt-2 mr-1" style="font-size: 14px;">Applicant</b></label>
                    <input type="text" id="search" class="form-control" placeholder="Applicant Name"
                        name="PersonNameSearch" value={{ $r_PersonNameSearch }}>
                </div>


                <div class="col-md-2 col-sm-12">
                    <label class="mt-2 mx-1" style="font-size: 14px;">Nationality</label>
                    <select id="search" name="NationalitySearch" class="form-control">
                        <option value="">Choose</option>
                        @foreach ($nationality as $na)
                            <!-- <option value="{{ $na->id }}">{{ $na->NationalityName }}</option> -->
                            <option value="{{ $na->id }}" {{ $na->id == $r_NationalitySearch ? 'selected' : '' }}>
                                {{ $na->NationalityName }}</option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-5 col-sm-12">
                    <label class="mt-2 mx-1" style="font-size: 14px;">Date</label>
                    <div class="input-group input-daterange">
                        {{-- <label class="mt-2 mx-1" style="font-size: 14px;">From</label> --}}
                        <input type="date" name="from_date" class="form-control" autocomplete="off"
                            value="{{ $r_from_date }}">

                        <div class="input-group-addon mx-1 mt-2" style="font-size: 14px;">To</div>
                        <input type="date" name="to_date" class="form-control" autocomplete="off"
                            value="{{ $r_to_date }}">
                    </div>
                </div>
                {{-- ----------------------------------------------------------------------- --}}
                <div class="col-md-2 col-sm-12">
                    <label class="mt-2 mx-1 ml-1" style="font-size: 14px;">Gender</label>
                    <select id="search" name="GenderSearch" class="form-control">
                        <option value="">Choose</option>
                        <option value="Male" {{ $r_GenderSearch == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $r_GenderSearch == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                {{-- ------------------------------------------------------------------------------------- --}}
                {{-- --------------------------------- Applicant Type Search ----------------------------- --}}
                {{-- ------------------------------------------------------------------------------------- --}}
                <div class="col-md-2 col-sm-12">
                    <label class="mt-2 mx-1 ml-1" style="font-size: 14px;">Applicant Type</label>
                    <select id="search" name="PersonTypeSearch" class="form-control">
                        <option value="">Choose</option>
                        @foreach ($persontype as $pe)
                            <option value="{{ $pe->id }}" {{ $pe->id == $r_PersonTypeSearch ? 'selected' : '' }}>
                                {{ $pe->PersonTypeNameMM }}</option>
                        @endforeach

                    </select>
                </div>
                {{-- ------------------------------------------------------------------------------------- --}}
                {{-- --------------------------------- Sector Search -------------------------------- --}}
                {{-- ----------------------------------------------------------------------------------- --}}
                <div class="col-md-2 col-sm-12">
                    <label class="mt-2 mx-1 ml-1" style="font-size: 14px;">Sector</label>
                    <select id="search" name="SectorSearch" class="form-control">
                        <option value="">Choose</option>
                        @foreach ($sector as $se)
                            <option value="{{ $se->id }}" {{ $se->id == $r_SectorSearch ? 'selected' : '' }}>
                                {{ $se->SectorNameMM }}</option>
                        @endforeach

                    </select>
                </div>


                {{-- ------------------------------------------- --}}

                <div class="col-md-2 col-sm-12">
                    <label class="mt-2 mr-1" style="font-size: 14px;">Company Name</label>
                    <input type="text" id="search" class="form-control" placeholder="Company Name"
                        name="CompanyNameSearch" value={{ $r_CompanyNameSearch }}>
                </div>
                {{-- ------------------------------------------------------------------------ --}}
                <div class="col-md-2 col-sm-12">
                    <label class="mt-2 mr-1" style="font-size: 14px;">Permit No</label>
                    <input type="text" id="search" class="form-control" placeholder="Permit No"
                        name="PermitNoSearch" value={{ $r_PermitNoSearch }}>
                </div>
                {{-- ------------------------------------------------------------------------ --}}
                <div class="col-md-2 col-sm-12">
                    <label class="mt-2 mr-1" style="font-size: 14px;">Address</label>
                    <input type="text" id="search" class="form-control" placeholder="Address"
                        name="AddressSearch" value={{ $r_AddressSearch }}>
                </div>
                {{-- ------------------------------------------------------------------------ --}}



                <div class="col-md-1 col-sm-12">

                    <button class="btn btn-primary" style="height: 46px; margin-top:35px;">
                        <i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>

        <div class="col-md-1 col-sm-12">
            <form action="{{ route('report.export') }}" method="get">
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
                        <!-- <th rowspan="2" align="center" style="line-height: 4;">???</th>
                                        <th rowspan="2" style="line-height: 4;">????</th>
                                        <th rowspan="2" style="line-height: 4;">??????????</th>
                                        <th rowspan="2" style="line-height: 4;">????</th>
                                        <th rowspan="2" style="line-height: 4;">??????????????????????</th>

                                        <th rowspan="2" style="line-height: 4;">??????????????????????</th>
                                        <th rowspan="2" style="line-height: 4;">??????????????</th>
                                        <th rowspan="2" style="line-height: 4;">????????????(???)</th>
                                        <th rowspan="2" style="line-height: 4;">????????????(??)</th>
                                        <th rowspan="2" style="line-height: 4;">????????????(????)</th>
                                        <th rowspan="2" style="line-height: 2;">????????????????? <br> /?????</th>
                                        <th rowspan="2" style="line-height: 4;">??????????</th>
                                        <th rowspan="2" style="line-height: 4;">???????????</th>
                                        <th rowspan="2" style="line-height: 2;">?????????????(????) <br> ?????????????????</th>
                                        <th colspan="3">??????????????</th> -->

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
                        <!-- <th>???</td>
                                        <th>?</td>
                                        <th>????</td> -->

                        <th>D</td>
                        <th>M</td>
                        <th>Y</td>
                    </tr>
                </thead>
                <tbody>
                    {{-- {{ dd($reports) }} --}}
                    @if (isset($reports))
                        @foreach ($reports as $r)
                            <tr>
                                <td style="text-align: center;">{{ ++$i }}</td>
                                <td>{{ $r->PersonName }}</td>
                                <td style="text-align: center;">{{ $r->NationalityName }}</td>
                                <td style="text-align: center;">{{ $r->Gender }}</td>
                                <td style="text-align: center;">{{ $r->PassportNo }}</td>
                                <td style="text-align: center;">{{ $r->StayExpireDate }}</td>
				                <td style="text-align: center;">{{ $r->StayAllowDate }}</td>
                                <td style="text-align: center;">{{ $r->VisaTypeNameMM }}</td>
                                <td style="text-align: center;">{{ $r->StayTypeNameMM }}</td>
                              
                                @if( $r->StayTypeNameMM )
                                <td style="text-align: center;">{{ $r->StayExpireDate }}</td>
                                @if($r->StayId== 1)
                                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($r->StayExpireDate)->addMonths(3)->subDays(1)->format('Y-m-d') }}</td>
                                @elseif($r->StayId == 2)
                                  <td style="text-align: center;">{{ \Carbon\Carbon::parse($r->StayExpireDate)->addMonths(6)->subDays(1)->format('Y-m-d')}}</td>
                                @else
                                  <td style="text-align: center;">{{ \Carbon\Carbon::parse($r->StayExpireDate)->addMonths(12)->subDays(1)->format('Y-m-d') }}</td>
                                @endif
                                @else
                                <td style="text-align: center;"></td>
                                <td style="text-align: center;"></td>
                                @endif
                               

                                <td style="text-align: center;">{{ $r->PersonTypeNameMM }}</td>
                                <td style="text-align:center;">
                                    @if ($r->PersonTypeNameMM == 'ကျွမ်းကျင်လုပ်သား')
                                        @if ($r->Rank)
                                            {{ $r->Rank }}
                                        @else
                                            <p>Rank not filled</p>
                                        @endif
                                    @else
                                        {{ $r->PersonTypeNameMM }}
                                    @endif
                                </td>
                                @if($r->Remark == null)
                                <td style="text-align: center;"> {{ $r->RelationShipNameMM }}</td>
                                @else
                                <td style="text-align: center;">{{ $r->Remark }} ၏ {{ $r->RelationShipNameMM }}</td>
                                @endif
                                <td style="text-align: center;">{{ $r->SectorNameMM }}</td>
                                <td style="white-space: normal;line-height: 1.6;">{{ $r->BusinessType }}</td>
                                <td style="white-space: normal;line-height: 1.6;">{{ $r->CompanyName }}</td>
                                <td style="white-space: normal;line-height: 1.6;">{{ $r->Township }}</td>
                                <td style="white-space: normal;line-height: 1.6;">{{ $r->FormC }}</td>
                                <td style="text-align: center;">{{ $r->PermitNo }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->ApproveDate)->format('d') }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->ApproveDate)->format('m') }}</td>
                                <td>{{ \Carbon\Carbon::parse($r->ApproveDate)->format('Y') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
        <div class="Container mt-2">
            <div class="" style="margin-left: 500px;">
                @if (isset($reports))
                    {{ $reports->links('vendor.pagination.custom') }}
                @endif
            </div>
        </div>

    </div>



@endsection
