@extends('admin.layout')
@section('content')


<style type="text/css">
	#border1
    {
        width: 50%;   
        margin: 8px 0;  
        padding: 12px 20px;   
        border-radius: 5px;
        height: 50%;
        border: 1px solid green;   
        box-sizing: border-box; 
        
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
<h1 class="mb-4">Nationality </h1>

<div class="container">
	<div class="row">

		<div class="col-md-5">

			 <div class="row my-3">
          <div class="col-md-7 ">
            <form class="navbar-form" action="{{ route('nationalityform') }}" method="get">
                    <div class="input-group no-border">
                      <input type="text" id="search" class="form-control" placeholder="Nationality Name" style="border-radius: 3px; width: 0px;" name="search">
                      
                      <button type="submit" style="margin-left: 10px;width: 40px;" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                        <!--<div class="ripple-container"></div>-->
                      </button>
                    </div>
                  </form>
          </div>
        </div>
			<table class="table table-sm table-responsive " style="text-align:center;" >
				<thead>
					<tr>
						<th style="font-size:16px"class="col-md-1">No</th>
						<th style="font-size:16px"class="col-md-1">Nationality Name</th>
						<th colspan="2" style="font-size:16px"class="col-md-1">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					?>
					@foreach($nations as $na)
					<tr>
						<td style="font-size:15px">{{ $i++ }}</td>
						<td style="font-size:15px">{{$na->NationalityName}}</td>
						<td  style="font-size:15px"><a href="{{route('nationality.edit',$na->id)}}"  class="btn btn-primary">Edit</a></td>

					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
		<div class="col-md-2">

		</div>
		<div class="col-md-5" id="border1">
			
			<h3 >Add New Nationality</h3>
			<form action="{{route('nationality.store')}}" method="post">
			@csrf
				
				<div class="form-group">
					<input type="text" class="form-control @error('nation') is-invalid @enderror" name="NationalityName" placeholder="New Nationality" required>
					  
				</div>


				
				<button type="submit" class="btn btn-primary">Add New </button>
				
			</form>
		</div>
	</div>
</div>

	@endsection