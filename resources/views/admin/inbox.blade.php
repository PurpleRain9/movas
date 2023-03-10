@extends('admin.layout')
@section('content')

<style>
  .modal-dialog{
    max-width: 70%;
  }
  .modal-dialog td{
    white-space: normal;
  }
</style>

            <div class="d-xl-flex justify-content-between align-items-start" style="border-bottom: 1px solid lightblue;">
              <p class="text-dark mb-2"> Visa Application Pending List </p>
                
            </div>

            

      {{-- <div class="row mt-3">
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
        </div> --}}

        <div class="row mt-3">
          <div class="col-md-12">
            <table class="table table-hover table-bordered table-responsive " id="inbox">
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
                @endphp
                @foreach ($visa_heads as $key => $value)
                @if (Auth::user()->rank->id == 1)
                  
                  

                  <tr>
                    <td>{{$i++}}</td>
                    @php
                      $rejectHistory=DB::table('reject_histories')
                                    ->join('admins','admins.id','=','reject_histories.reviewer_id')
                                    ->where('reject_histories.visa_application_head_id',$value->id)->count();
                  //  dd($rejectHistory->count());
                    @endphp
                    @if($rejectHistory !=0)
                      <td class="text-wrap"><a href="" data-toggle="modal" data-target="#rejectHistory" data-id="{{$value->id}}" class="reject">{{$value->CompanyName}}
                      </a></td>
                    @else
                      <td class="text-wrap">{{$value->CompanyName}}</td>
                    @endif
                   
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
                      {{$value->CompanyName}}  ?????? {{$value->Subject}}
                    </td>
                    <td>
                        <label class="badge badge-info">In-Process</label>
                    </td>
                    <td><a class="btn btn-sm rounded btn-primary button" href="{{ route('visa.show',$value->id) }}">Show</a></td>
                  </tr>

                @else
                <tr>
                    <td>{{$i++}}</td>
                      @php
                        $rejectHistory=DB::table('reject_histories')
                                      ->join('admins','admins.id','=','reject_histories.reviewer_id')
                                      ->where('reject_histories.visa_application_head_id',$value->id)->count();
                      //  dd($rejectHistory);
                      @endphp
                      @if($rejectHistory !=0)
                        <td class="text-wrap"><a href="" data-toggle="modal" data-target="#rejectHistory" data-id="{{$value->id}}" class="reject">{{$value->CompanyName}}
                        </a></td>
                      @else
                        <td class="text-wrap">{{$value->CompanyName}}</td>
                      @endif
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
                      {{$value->CompanyName}} ?????? {{$value->Subject}}
                    </td>
                    <td>
                        <label class="badge badge-info">In-Process</label>
                    </td>
                    <td><a class="btn btn-sm rounded btn-primary button" href="{{ route('visa.show',$value->id) }}">Show</a></td>
                  </tr>
                @endif
                  
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
        <br>
        {{-- {{ $visa_heads->withQueryString()->links() }} --}}
<br><br>

<script>

  $(document).ready(function() {
     $('#inbox').DataTable({
     });
  });
 </script>

<script>
  $(document).ready(function () {
    var getReject = "{{route('rejectHistory')}}";
   
    $(document).on("click",".reject",function(e) {
    e.preventDefault();
   var id= $(this).data('id');
   console.log(id);
   $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              $.ajax({
                    type: "GET",
                    url: getReject,
                    data: {id :id },
                    dataType: "json",
                    success: function (response) {
                        let rejectTable="";
                        
                        if(response.status == 404){
                            $('#success_message').html("");
                            $('#success_message').addClass( 'alert alert-danger');
                            $('#success_message').text(response.message);
                        }else{
                          var i=1;
                          console.log(response.reject);
                          $.each(response.reject, function (key, item) { 
                            rejectTable+=`<tr>
                                          <td>${i++}</td>
                                          <td>${item.RejectComment}</td>
                                          <td>${item.RejectDate}</td>
                                          <td>${item.username}</td>
                                           </tr>`;
                          })
                          console.log(rejectTable);
                          $('#rejectTable').html(rejectTable);
                        }
                    }
                });
  });
  });
 
</script>
<x-reject-history-modal />
@endsection