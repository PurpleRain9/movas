@extends('layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/preview_img.css') }}">
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
					<h1><span class="eng" id="eng">Add New Dependent</span><span class="mm" id="mm">မှီခိုအသစ် ထည့်ရန်</span></h1>
				</div>
				<br>
				<fornt face="verdana" color="red" size="1" style="display:none"><b>Message Show</b></fornt>

				<div class="content">
					<form action="{{route('DP.store')}}" method="post" enctype="multipart/form-data">
						
						@csrf

						<input type="hidden" value="{{Auth::user()->profile->id}}" name="profile_id">
						{{-- <div class="row control">
							<div class="col-md-2 lable">
								<span class="eng">Image</span><span class="mm">ဓာတ်ပုံ</span> :
							</div>
							<div class="col-md-10">
								<input type="file" name="Image" class="form-control" placeholder="image" onchange="previewFile(this)" required accept=".jpg,.png">
								<img id="previewing" alt="profile img" style="max-width: 100px; max-width: 100px; margin-top: 20px;">
							</div>
						</div> --}}

						<div class="row control">
							<div class="col-md-3 lable">
								<span class="eng">Image</span><span class="mm">ဓာတ်ပုံ</span> :
							</div>
							<div class="col-md-9">
								<input type="file" name="image" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files" />
								<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose Foreign Technician Image &hellip;</span></label>
								<div class="img-preview" id="imgPreview">
									<img src="" alt="Image Preview" class="img-preview__image" />
									<span class="img-preview__text">Image Preview</span>
								</div>
							</div>
						</div>

						<div class="row mt-3 control">
							<div class="col-md-3 lable">
								<span class="eng">Name</span><span class="mm">အမည်</span> :
							</div>
							<div class="col-md-9">
								<input type="text" name="name" class="form-control" required>
							</div>
						</div>
                        <div class="row mt-3 control">
							<div class="col-md-3 lable">
								<span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span> :
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" name="passport_no" required>
							</div>
						</div>
                        <div class="row mt-3 control">
							<div class="col-md-3 lable">
								<span class="mm">ဖုန်းနံပါတ်</span><span class="eng">Phone No</span> :
							</div>
							<div class="col-md-9">
								<input type="text" name="phone_no" class="form-control" required>
							</div>
						</div>
                        <div class="row mt-3 control">
							<div class="col-md-3 lable">
								<span class="mm">ရာထူး</span><span class="eng">Rank</span> :
							</div>
							<div class="col-md-9">
								<input type="text" name="rank" class="form-control" required>
							</div>
						</div>
						<div class="row mt-3 control">
							<div class="col-md-3 lable">
								<span class="mm">အရည်အချည်း</span><span class="eng">Qualification</span> :
							</div>
							<div class="col-md-9">
								<input type="text" name="qualification" class="form-control" required>
							</div>
						</div>
                        <div class="row mt-3 control">
							<div class="col-md-3 lable">
								<span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span> :
							</div>
							<div class="col-md-9">
								<input type="date" class="form-control" name="date_of_birth" required>
							</div>
						</div>
                        <div class="row mt-3 control">
							<div class="col-md-3 lable">
								<span class="mm">Relation</span><span class="eng">Relation</span> :
							</div>
							<div class="col-md-9">
                                <textarea name="relation" id="" class="form-control"  rows="5"></textarea>
							</div>
						</div>
						

						<div class="row mt-3 control">
							<div class="col-md-3 lable">
								<span class="mm">မိခင်နိုင်ငံရှိ အမြဲတမ်းလိပ်စာ</span><span class="eng">Permanent Address in Home Country</span>:
							</div>
							<div class="col-md-9">
								<textarea name="permanent_address" id="home_address" class="form-control" cols="10" rows="5" required></textarea>
							</div>
						</div>
                        <div class="row mt-3 control">
							<div class="col-md-3 lable">
								<span class="mm">Form C</span><span class="eng">Form C</span> :
							</div>
							<div class="col-md-9">
								<input type="file" name="formc_file_name" class="form-control" required>
							</div>
						</div>
						<div class="row mt-3 control">
							<div class="col-md-3 lable">
								<span class="mm">Form C တိုင်သည့်လိပ်စာ</span><span class="eng">Form C Address</span> :
							</div>
							<div class="col-md-9">
								<textarea name="formc_address" id="address" cols="30" rows="5" class="form-control" required ></textarea>
							</div>
						</div>

						
						<div class="mt-3 control row">
                            <div class="col-md-3">
                                <label for="">Gender :</label>
                            </div>
							<div class="col-md-9">
                                <input type="radio"  id="male" name="gender" value="male" checked>
                                <label for="male"><span class="eng">Male</span><span class="mm">ကျား</span></label>
                                <input type="radio" style="margin-left: 2rem;"  id="female" name="gender" value="female">
                                <label for="female"><span class="eng">Female</span><span class="mm">မ</span></label>
                            </div>
						</div>
						
						<div class="row mt-3">
							<div class="col-md-8" id="btt">
								<button type="submit" class="btn btn-primary btn my-2" style="margin-left: 70%;">
									<span class="eng">Save</span><span class="mm">Save</span>
								</button>
								<a href="{{route('FT.show')}}" class="btn btn-danger my-3">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/preview_img.js') }}"></script>
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
	$(document).ready(function () {
		let yes = $("#yes");
		let no = $("#no");
		no.prop("checked", true);
		$("#micApproved").hide();
		$(yes).click(function () { 
			$("#micApproved").show(500);
		});
		$(no).click(function () { 
			$("#micApproved").hide(500);
		});
	});
</script>
@endsection	