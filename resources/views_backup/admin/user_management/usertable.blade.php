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



      	




      	<div class="row mb-5" id="mtop">

      		<div class="col-md-5">
      			<span class="text-dark font-weight-bold mb-2 text-center" style="font-size: 20px;"> User List </span>
      		</div>
      		
      	</div>
      	<div class="row my-3">
          <div class="col-md-7 ">
            <form class="navbar-form" action="{{ route('user.index') }}" method="get">
                    <div class="input-group no-border">
                      <input type="text" id="search" class="form-control" placeholder="User name/Email/Company name..." style="border-radius: 3px; width: 0px;" name="search">
                      
                      <button type="submit" style="margin-left: 10px;width: 40px;" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                        <!--<div class="ripple-container"></div>-->
                      </button>
                    </div>
                  </form>
          </div>
        </div>
      	<div class="row">
      		<table class="table table-sm table-responsive table-bordered" id="size">
      			<thead>
      				<tr>
      					<th style="font-size:15px"class="col-md-1">No</th>
      					<th style="font-size:15px"class="col-md-2">User Name</th>
      					<th style="font-size:15px"class="col-md-1">Phone</th>
      					<th style="font-size:15px"class="col-md-1">Email</th>
      					<th style="font-size:15px">Company Name</th>
                <th style="font-size:15px">Reject Comment</th>
      					<th width="30"></th>
      				</tr>
      			</thead>
      			<tbody>
      			@foreach($users as $key => $user)
      		
      			
      				<tr>
      					<td style="font-size:15px">{{$users->firstItem() + $key}}</td>
      					<td style="font-size:15px">{{$user->name}}</td>
      					<td style="font-size:15px">{{$user->phone_no}}</td>
      					<td style="font-size:15px">{{$user->email}}</td>
      					<td style="font-size:15px" class="text-wrap">{{$user->CompanyName}}</td>
                <td style="font-size:15px"  class="text-wrap">@if ($user->Status == 0 && !is_null($user->RejectComment))
                                               <small class="text-danger font-weight-bold">Reject comment- {{$user->RejectComment}}</small>
                                            @endif
                                            @if ($user->Status == 1 && !is_null($user->RejectComment))
                                               <small class="text-danger font-weight-bold">Reject comment- {{$user->RejectComment}}</small>
                                            @endif
                                          </td>
      					 <td  style="font-size:15px"><a href="{{route('user.edit',$user->id)}}"  class="btn btn-primary">Edit</a></td>
                 <td  style="font-size:15px">
                  <form action="{{route('user.delete',$user->id)}}" method="POST">
                    @csrf
                    <button type="submit"  class="btn btn-danger" onclick="return confirm('You sure to delete user?');">Delete</button>
                  </form>
                  </td>
      				</tr>
      			@endforeach
      			</tbody>
      		</table>
      		</table>
      	</div>
      </div>
      <br>
      {{ $users->withQueryString()->links() }}
      @endsection