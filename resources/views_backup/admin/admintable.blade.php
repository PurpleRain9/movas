@extends('admin.layout')
@section('content')

            <!-- <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2"> Admin List </h2>

            </div> -->
<style type="text/css">
  #mtop
  {
    margin-bottom: 150px;
  }

  #mm
{

  margin-left: 120px;
}



</style>
            
            <div class="container">  

              @if(Session::has('alert'))

              <div class="alert alert-success form-group">

                {{ Session::get('alert') }}

                @php

                Session::forget('alert');

                @endphp

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              @endif


              @foreach ($errors->all() as $error)
              <div class="alert alert-danger">{{ $error }}</div>
              @endforeach
              {{-- <div class="row mb-3">
                <div class="col-md-12 col-sm-6">
                  <form class="navbar-form">
                    <div class="input-group no-border">
                      <input type="text" id="search" class="form-control" placeholder="Company Name" name="query">
                      <label style="margin-left: 10px;">Sector</label>
                      <select class="form-control" name="sector_id" required>
                        <option value="">Choose</option>
                        @foreach ($sectors as $s)
                        <option value="{{$s->id}}">{{$s->SectorName}}</option>
                        @endforeach
                      </select>
                      <label style="margin-left: 10px;">From</label>
                      <input type="date" id="search" class="form-control"  name="query">
                      <label style="margin-left: 10px;">To</label>
                      <input type="date" id="search" class="form-control" name="query">
                      <button type="submit" style="margin-left: 10px;" class="btn btn-primary btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                      </button>
                    </div>
                  </form>
                </div>
              </div> --}}
              <div class="row mb-5" id="mtop">

                <div class="col-md-5">
                  <span class="text-dark font-weight-bold mb-2 text-center" style="font-size: 20px;"> Admin List </span>
                </div>
                <div class="col-md-6">
                  <a href="{{ route('adminmanagement') }}" class="btn btn-success" style="width:100px; float: right; font-size:15px;" id="mm"><b>Add New</b></a>
                </div>
              </div>

              <div class="row">
                <table class="table table-sm table-responsive" id="size">
                  <thead>
                    <tr>
                      <th style="font-size:15px"class="col-md-1">No</th>
                      <th style="font-size:15px"class="col-md-1">Admin ID</th>
                      <th style="font-size:15px"class="col-md-2">Admin Name</th>
                      <th style="font-size:15px"class="col-md-2">Rank</th>
                      <!-- <th style="font-size:15px"class="col-md-2">Status</th> -->
                      <th style="font-size:15px"class="col-md-1">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($admins as $key => $value)
                    <tr>
                      <td style="font-size:14px">{{$admins->firstItem() + $key}}</td>
                      <td style="font-size:14px">{{$value->UserID}}</td>
                      <td style="font-size:14px">{{$value->username}}</td>
                      <td style="font-size:14px">{{$value->RankName}} ({{$value->RankNameMM}})</td>
                      <!-- <td><label class="badge badge-success">Active</label></td> -->
                      <td  style="font-size:14px"><a href="{{ route('admin.edit',$value->id) }}"  class="btn btn-primary">Edit</a></td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
            </div>

            @endsection