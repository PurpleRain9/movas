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
            <form class="navbar-form" action="{{ route('user.email') }}" method="get">
                    <div class="input-group no-border">
                      <input type="text" id="search" class="form-control" placeholder="User name/Email..." style="border-radius: 3px; width: 0px;" name="search">
                      
                      <button type="submit" style="margin-left: 10px;width: 40px;" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                        <!--<div class="ripple-container"></div>-->
                      </button>
                    </div>
                  </form>
          </div>
        </div>

      		<table class="table table-sm table-bordered" id="size">
      			<thead>
      				<tr>
      					<th style="font-size:15px">No</th>
      					<th style="font-size:15px">User Name</th>
      					<th style="font-size:15px">Phone</th>
      					<th style="font-size:15px">Email</th>
      					<th width="30"></th>
      				</tr>
      			</thead>
      			<tbody>
      				 <?php $i = 1; ?>
      			@foreach($users as $user)
      		
      			
      				<tr>
      					<td style="font-size:15px">{{$i++}}</td>
      					<td style="font-size:15px">{{$user->name}}</td>
      					<td style="font-size:15px">{{$user->phone_no}}</td>
      					<td style="font-size:15px">{{$user->email}}</td>
      					 <td  style="font-size:15px"><a href="{{route('user.emailverify',$user->id)}}"  class="btn btn-primary" onclick="return confirm('Do you want to Verify?');">Verify</a></td>
      				</tr>
      			@endforeach
      			</tbody>
      		</table>
      </div>
<br><br><br>
      @endsection