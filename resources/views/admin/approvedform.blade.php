@extends('admin.layout')
@section('content')
<script type="text/javascript" src="{{ asset('wintouni/tlsDebug.js') }}"></script>
<script type="text/javascript" src="{{ asset('wintouni/tlsMyanmarConverter.js') }}"></script>
<script type="text/javascript" src="{{ asset('wintouni/tlsMyanmarConverterData.js') }}"></script>


            <div class="d-xl-flex justify-content-between align-items-start" style="border-bottom: 1px solid lightblue;">
              <p class="text-dark mb-2"> Visa Application Approved List </p>

            </div>

@php
 $r_from_date = request()->from_date === null ? '' : request()->from_date;
    $r_to_date = request()->to_date === null ? '' : request()->to_date;
    $r_section = request()->section === null ? '' : request()->section;
  
    if (old()) {
        $r_from_date = old('from_date');
        $r_to_date = old('to_date');
        $r_section = old('section');
    }
@endphp

      
        
            <form class="navbar-form">
        <div class="d-flex mt-5 justify-content-center">

                
                    <label class="mt-2 mx-2 ml-1" style="font-size: 14px;">CompanyName</label>
                      <input type="text" id="search" class="form-control" placeholder="Company Name" style="border-radius: 3px;width: 150px;" name="name" value="">
                

                 
                        <label class=" input-group-addon mt-2  ml-3" style="font-size: 14px;width:200px;">Approved Date</label>
                        <input type="date" name="from_date" class="form-control mr-1" autocomplete="off"
                            value="{{ $r_from_date }}" style="width: 200px;">

                        <label class="input-group-addon mx-2 mt-3" style="font-size: 14px;">To</label>
                        <input type="date" name="to_date" class="form-control" autocomplete="off"
                            value="{{ $r_to_date }}" style="width: 200px;">
                  
                        <label class="input-group-addon mx-1 mt-3 form-select-sm ml-4 " style="font-size: 14px;">Section</label>
                        <select class="form-select" name="section" aria-label="Default select example" style="border-radius: 3px;width: 150px;border-color: darkgrey">
                          <option value="0">All</option>
                          <option value="1" {{ 1 == $r_section ? 'selected' : '' }}>OSSI</option>
                          <option value="2" {{ 2 == $r_section ? 'selected' : '' }}>OSSL</option>
                        </select>


                    <button type="submit" style="margin-left: 10px;width: 40px;" class="row btn btn-primary">
                        <i class="fa fa-search"></i>
                        <!--<div class="ripple-container"></div>-->
                     </button>
        </div>
            </form>
          
       

        <div class="row mt-3">
          <div class="col-md-12">
            <table class="table table-hover table-bordered table-responsive">
              <thead>
                <tr style="background: #d7d8fd;color: black;">
                  <th>No</th>
                  <th>Company Name</th>
                  {{-- <th>Sector</th> --}}
                  <th>Approved Date & Approve Letter No</th>
                  {{-- <th>Approve Letter No</th> --}}
                  <th class="text-center">Description</th>
                  <th>Status</th>
                  <th>Action</th>
                  @if (Auth::user()->rank_id <= 5)
                    <th>OSSI</th>
                    <th>OSSL</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @php
                  $i=1;
                  $ia=1;
                  $ib=1;
                  $ic=1;
                  $id=1;
                  $ie=1;
                  $if=1;
                  $aa=1;
                  $ab=1;  
                  $ac=1;
                  $ad=1;
                  $ae=1;
                  $af=1;
                @endphp
                @foreach ($visa_heads as $key => $value)
                <input type="text" hidden id="approveLetterNo_sourceID{{$ia++}}" value="{{$value->ApproveLetterNo}}" /> 
                <input type="text" hidden id="approveDate_sourceID{{$ib++}}" value="{{ \Carbon\Carbon::parse($value->ApproveDate)->format('d-m-Y') }}" />

<script>
  $(document).ready(function() {
      var al{{$aa++}} = document.getElementById("approveLetterNo_sourceID{{$ic++}}").value;
      var ad{{$ab++}} = document.getElementById("approveDate_sourceID{{$id++}}").value;  

      document.getElementById("ApproveLetterNo{{$ie++}}").innerHTML = "မရက-၉/OSS/န-ဗီဇာ/" + uniConvert(al{{$ac++}});      
      document.getElementById("ApproveDate{{$if++}}").innerHTML = uniConvert(ad{{$ad++}});
  });
</script>
                  <tr>

                    {{-- {{ dd($value) }} --}}
                    <td>{{$visa_heads->firstItem() + $key}}</td>
                    <td class="text-wrap" style="line-height: 24px;">{{$value->CompanyName}}</td>
                    {{-- <td>{{$value->SectorName}}</td> --}}
                    {{-- <td>
                      {{$value->FirstApplyDate}}
                    </td> --}}
                    <td style="line-height: 24px;"><span  id="ApproveDate{{$ae++}}">{{ \Carbon\Carbon::parse($value->ApproveDate)->format('d-m-Y') }}</span><br><span id="ApproveLetterNo{{$af++}}">စာအမှတ်၊ မရက-၉/oss/န-ဗီဇာ/{{$value->ApproveLetterNo}}</span></td>
                    <td class="text-wrap" style="line-height: 24px;">
                      {{$value->CompanyName}}  မှ {{$value->Subject}}
                      @if (Auth::user()->rank_id == 7 && $value->IntegrationActionStatus == 2)
                        <br><span class="text-danger">{{$value->IntegrationActionRemark}}</span>
                      @endif
                    </td>
                    <td>
                      @if (Auth::user()->rank_id <= 5)
                        <label class="badge badge-success">Approved</label>
                      @endif
                      @if (Auth::user()->rank_id == 6 && $value->LabourActionStatus == 1)
                          <label class="badge badge-success">Approved</label>
                      @endif
                      @if (Auth::user()->rank_id == 7 && $value->IntegrationActionStatus == 1)
                        <label class="badge badge-success">Approved</label>
                      @endif
                      @if (Auth::user()->rank_id == 7)
                          {{-- {{ dd($value) }} --}}
                      @endif
                      @if (Auth::user()->rank_id == 7 && $value->IntegrationActionStatus == 2)
                        <label class="badge badge-danger">Rejected</label>
                      @endif
                    </td>
                    <td>
                      <a class="btn btn-sm rounded btn-primary button" href="{{ route('showAppForm',$value->id) }}">Show</a>
                    </td>
                    @if (Auth::user()->rank_id <= 5)
                      <td>
                        @if ($value->IntegrationActionStatus == 1)
                          <label class="badge badge-success">Approved</label><br><br>{{ \Carbon\Carbon::parse($value->IntegrationActionDate)->format('d-m-Y') }}
                        @endif
                        @if ($value->IntegrationActionStatus == 2)
                          <label class="badge badge-danger">Rejected</label><br><br>{{ \Carbon\Carbon::parse($value->IntegrationActionDate)->format('d-m-Y') }}<br><br><span class="text-danger">{{$value->IntegrationActionRemark}}</span>
                        @endif
                      </td>
                      <td>
                        @if ($value->LabourActionStatus == 1)
                          <label class="badge badge-success">Approved</label><br><br>{{ \Carbon\Carbon::parse($value->LabourActionDate)->format('d-m-Y') }}
                        @endif
                      </td>
                    @endif
                    
                  </tr>
                  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <br>
        {{ $visa_heads->withQueryString()->links() }}

<br><br>
@endsection