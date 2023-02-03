@extends('admin.layout')
@section('content')

            <div class="d-xl-flex justify-content-between align-items-start" style="border-bottom: 1px solid lightblue;">
              <p class="text-dark mb-2"> Visa Application Rejected List </p>

            </div>

  @php
    $r_from_date = request()->from_date === null ? '' : request()->from_date;
    $r_to_date = request()->to_date === null ? '' : request()->to_date;
    
   
    if (old()) {
        $r_from_date = old('from_date');
        $r_to_date = old('to_date');
        
    }
  @endphp
      <div class="row mt-3">
          <div class="col-md-4 col-sm-6">
            <form class="navbar-form">
                    <div class="input-group no-border" style="width: 1000px;">
                      <input type="text" id="search" class="form-control" placeholder="Company Name" style="border-radius: 3px;" name="name">

                      <label style="font-size:14px; margin: 15px 15px 0px 15px;">Apply Date</label>
                

                      <input type="date" name="from_date" class="form-control" autocomplete="off"
                            value="{{ $r_from_date }}">

                      <label style="font-size:14px; margin: 15px 15px 0px 15px;">To</label>
                     

                      <input type="date" name="to_date" class="form-control" autocomplete="off"
                            value="{{ $r_to_date }}">
                      
                      
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
                  <!-- <th>Rejected Date</th> -->
                  <th class="text-center">Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($visa as $key => $value)
                  <tr>
                    <td>{{$visa->firstItem() + $key}}</td>
                    <td class="text-wrap" style="line-height: 24px;">{{$value->CompanyName}}</td>
                    <td>{{$value->SectorName}}</td>
                    <td>{{ \Carbon\Carbon::parse($value->FirstApplyDate)->format('j F, Y') }}</td>
                    <!-- <td>
                        {{ \Carbon\Carbon::parse($value->updated_at)->format('j F, Y') }}
                      
                    </td> -->
                    <td class="text-wrap" style="line-height: 24px;">
                      {{$value->CompanyName}}  မှ {{$value->Subject}}<br>@if ($value->Status == 2)
                  <span class="text-danger">{{$value->RejectComment}}</span>
                @endif
                    </td>
                    <td>
                        @if($value->Status == 1)
                        <label class="badge badge-success">Approved</label>
                        @elseif($value->Status == 2)
                        <label class="badge badge-danger">Rejected</label>
                        @elseif($value->Status == 3)
                        <label class="badge badge-warning">Turn Down</label>
                        @elseif($value->Status == 0)
                        <label class="badge badge-info">Apply</label>
                        @endif
                    </td>
                    <td><a class="btn btn-sm rounded btn-primary button" href="{{ route('showRejForm',$value->id) }}">Show</a></td>
                  </tr>
                  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <br>
        {{ $visa->withQueryString()->links() }}
<br><br>
@endsection