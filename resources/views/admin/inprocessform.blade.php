@extends('admin.layout')
@section('content')

<!-- <br><script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script> -->

            <div class="d-xl-flex justify-content-between align-items-start" style="border-bottom: 1px solid lightblue;">
              <p class="text-dark mb-2"> Visa Application In-Process List </p>

            </div>


      <div class="row mt-3">
        <div class="col-md-4 col-sm-6">
          <form class="navbar-form">
                  <div class="input-group no-border">
                    <input type="text" id="search" class="form-control" placeholder="Officer Name" style="border-radius: 3px;" name="name">
                    
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
            <table class="table table-hover table-bordered table-responsive" id="dataPage">
              <thead>
                <tr style="background: #d7d8fd;color: black;">
                  <th>No</th>
                  <th style="width: 100px!important;">Company Name</th>
                  <th>Officer</th>
                  <th>First Apply Date</th>
                  <th>Submitted Date</th>
                  <th class="text-center">Description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>  
                @php
                  $i=1;
                @endphp
  
                  @foreach ($visa_heads as $visa)
                    <tr>
                      <td class="text-wrap">{{$i++}}</td>
                      <td class="text-wrap">{{$visa->CompanyName}} </td>
                      <td class="text-wrap">{{$visa->RankName == null ? 'CO':$visa->RankName}}</td>
                      <td class="text-wrap">{{ \Carbon\Carbon::parse($visa->FirstApplyDate)->format('j F, Y')}}</td>
                      <td class="text-wrap">{{ \Carbon\Carbon::parse($visa->updated_at)->format('j F, Y')}}</td>
                      <td class="text-wrap" style="line-height: 24px;">
                        {{$visa->CompanyName}}  မှ {{$visa->Subject}}
                      </td>
                      <td class="text-wrap">
                          <label class="badge badge-info">In-Process</label>
                      </td>
                      <td class="text-wrap"><a class="btn btn-sm rounded btn-primary button" href="{{ route('showinProcessForm',$visa->id) }}">Show</a></td>
                    </tr>
                  </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <br>
<br><br>

<script>

  $(document).ready(function() {
     $('#dataPage').DataTable({
     });
  });
 </script>

@endsection