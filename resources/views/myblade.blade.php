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

      	<div class="row">
      		<table class="table table-sm table-responsive" id="size">
      			<thead>
      				<tr>
      					<th style="font-size:15px"class="col-md-1">No</th>
      					<th style="font-size:15px"class="col-md-2">User Name</th>
      					<th style="font-size:15px"class="col-md-2">Phone</th>
      					<th style="font-size:15px"class="col-md-1">Email</th>
      					<th style="font-size:15px"class="col-md-1">Company Name</th>
      				</tr>
      			</thead>
      			<tbody>
      			@foreach($users as $user)
      				<tr>
      					<td style="font-size:14px">1</td>
      					<td style="font-size:14px">{{$user->name}}</td>
      					<td style="font-size:14px">{{$user->phone_no}}</td>
      					<td style="font-size:14px">{{$user->email}}</td>
      					<td style="font-size:14px">{{$user->CompanyName}}</td>
      					
      				</tr>
      			@endforeach
      			</tbody>
      		</table>
      	</div>
      </div>

      @endsection