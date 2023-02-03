@extends('admin.layout')
@section('content')

      <div class="d-xl-flex justify-content-between align-items-start" style="border-bottom: 1px solid lightblue;">
        <p class="text-dark mb-2"> Visa Application Pending List </p>
         
      </div>
      <div class="row mt-3">
          <div class="col-md-4 col-sm-6">
            <form class="navbar-form">
                    <div class="input-group no-border">
                      <input type="text" id="search" class="form-control" placeholder="Company Name" style="border-radius: 3px;" name="name">
                      
                      <button type="submit" style="margin-left: 10px;width: 40px;" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                        <!--<div class="ripple-container"></div>-->
                      </button>
                    </div>
                  </form>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-12">
            <table class="table table-hover table-bordered table-responsive">
              <thead>
                <tr style="background: #d7d8fd;color: black;">
                  <th>No</th>
                  <th>Company Name</th>
                  <th>Sector</th>
                  <th>First Apply Date</th>
                  <th>Final Apply Date</th>
                  <th class="text-center">Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @php
                  $i=1;
                  $isRecord = "0";
                @endphp
                @foreach ($visa_heads as $key => $value)
                @if (Auth::user()->rank->id == 1)
                  
                  @foreach($remarks as $remark)
                    @if($value->id == $remark->visa_application_head_id)
                      <?php $isRecord = 1; ?>
                    @endif
                  @endforeach

                  <tr >
                    <td>{{$visa_heads->firstItem() + $key}}</td>
                    <td class="text-wrap">{{$value->CompanyName}}</td>
                    <td>{{$value->SectorName}}</td>
                    {{-- <td>
                      {{$value->FirstApplyDate}}
                    </td> --}}
                    <td>{{ \Carbon\Carbon::parse($value->FirstApplyDate)->format('j F, Y') }}</td>
                    <td>
                      {{-- @php
                        echo date("d/m/Y");
                      @endphp --}}
                      @if ($value->FinalApplyDate)
                        {{ \Carbon\Carbon::parse($value->FinalApplyDate)->format('j F, Y') }}
                      @else
                        &nbsp;
                      @endif
                      
                    </td>
                    <td class="text-wrap" style="line-height: 24px;">
                      {{$value->CompanyName}}  မှ {{$value->Subject}}
                    </td>
                    <td>
                        <label class="badge badge-info">In-Process</label>
                    </td>
                    <td><a class="btn btn-sm rounded btn-primary button" href="{{ route('visa.show',$value->id) }}">Show</a></td>
                  </tr>

                @else
                <tr>
                    <td>{{$visa_heads->firstItem() + $key}}</td>
                    <td class="text-wrap">{{$value->CompanyName}}</td>
                    <td>{{$value->SectorName}}</td>
                    {{-- <td>
                      {{$value->FirstApplyDate}}
                    </td> --}}
                    <td>{{ \Carbon\Carbon::parse($value->FirstApplyDate)->format('j F, Y') }}</td>
                    <td>
                      {{-- @php
                        echo date("d/m/Y");
                      @endphp --}}
                      @if ($value->FinalApplyDate)
                        {{ \Carbon\Carbon::parse($value->FinalApplyDate)->format('j F, Y') }}
                      @else
                        &nbsp;
                      @endif
                      
                    </td>
                    <td class="text-wrap" style="line-height: 24px;">
                      {{$value->CompanyName}} မှ {{$value->Subject}}
                    </td>
                    <td>
                        <label class="badge badge-info">In-Process</label>
                    </td>
                    <td><a class="btn btn-sm rounded btn-primary button" href="{{ route('visa.show',$value->visa_head_id) }}">Show</a></td>
                  </tr>
                @endif
                  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <br>
        {{ $visa_heads->withQueryString()->links() }}
<br><br>
@endsection