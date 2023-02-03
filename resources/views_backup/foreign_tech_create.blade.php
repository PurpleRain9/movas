@extends('layout')
@section('content')
<style type="text/css">
	#btt
	{
		margin-left: 37%;
	}
</style>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			@if(Session::has('alert'))

			<div class="alert alert-success form-group">

				{{ Session::get('alert') }}

				@php

				Session::forget('alert');

				@endphp
			</div>

			@endif


			@foreach ($errors->all() as $error)
			<div class="alert alert-danger">{{ $error }}</div>
			@endforeach

			<div id="wrapper">
				<div class="header my-4" style="text-align: center;">
					<h1><span class="eng" id="eng">Add New Technician</span><span class="mm" id="mm">နည်းပညာရှင်အသစ်ထည့်ရန်</span></h1>
				</div>
				<br>
				<font face="verdana" color="red" size="1" style="display:none"><b>Message Show</b></font>

				<div class="content">
					<form action="{{route('FT.store')}}" method="post" enctype="multipart/form-data">
						
						@csrf

						<input type="hidden" value="{{Auth::user()->profile->id}}" name="profile_id">
						<div class="row control">
							<div class="col-md-2 lable">
								<span class="eng">Image</span><span class="mm">ဓာတ်ပုံ</span> :
							</div>
							<div class="col-md-10">
								 <!-- <input type="file" name="Image" class="form-control" placeholder="image"> -->
								 <input type="file" name="Image" class="form-control" placeholder="image" onchange="previewFile(this)" required accept=".jpg,.png">
								 <img id="previewing" alt="profile img" style="max-width: 100px; max-width: 100px; margin-top: 20px;">
							</div>
						</div>

						<div class="row mt-3 control">
							<div class="col-md-2 lable">
								<span class="eng">Name</span><span class="mm">အမည်</span> :
							</div>
							<div class="col-md-10">
								<input type="text" name="Name" class="form-control" placeholder="Name" required>
							</div>
						</div>

						<div class="row mt-3 control">
							<div class="col-md-2 lable">
								<span class="mm">ရာထူး</span><span class="eng">Rank</span> :
							</div>
							<div class="col-md-10">
								<input type="text" name="Rank" class="form-control" placeholder="Rank" required>
							</div>
						</div>

						<div class="mt-3 control text-center">
						 <input type="radio"  id="male" name="Gender" value="male" checked>
                                      <label for="male">Male</label>
                                      <input type="radio"  id="female" name="Gender" value="female">
                                      <label for="female">Female</label>

						</div>
					<!-- 	
						<div class="row mt-3 control">
							<div class="col-md-2 lable">
								<span>Gender</span> :
							</div>
							<div class="col-md-10">

								
								<div class="radio">
										<label>
											<input type="radio" name="" value="Male" checked>
											Male
										</label>
										<label>
											<input type="radio" name="" value="Female">
											Female
										</label>
									</div>
							</div>
						</div>
 -->

						

<!-- <select class="form-control" name="" required>
									<option value="">Choose</option>
									<option>Male</option>
									<option>Femal</option>
									
									
								</select> -->

						<div class="row mt-3 control">
							<div class="col-md-2 lable">
								<span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span> :
							</div>
							<div class="col-md-10">
								<input type="date" class="form-control" name="DateOfBirth" required>
							</div>
						</div>

						<div class="row mt-3 control">
							<div class="col-md-2 lable">
								<span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span> :
							</div>
							<div class="col-md-10">
								<input type="text" class="form-control" name="PassportNo" placeholder="Passport No" required>
							</div>
						</div>
						
								
						<div class="row mt-3">
							<div class="col-md-8" id="btt">
								<button type="submit" class="btn btn-primary btn my-2" style="margin-left: 70%;">
									<span class="eng">Save</span><span class="mm">Save</span>
								</button>
								<a href="{{route('FT.show')}}" class="btn btn-info my-3">Back</a>
							</div>
							
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function previewFile(input){
		var file=$("input[type=file").get(0).files[0];
		if(file)
		{
			var reader = new FileReader();
			reader.onload = function(){
				$('#previewing').attr("src",reader.result);
			}
			reader.readAsDataURL(file);
		}
	}
</script>
@endsection	