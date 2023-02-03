@extends('layout')
@section('content')

<style type="text/css">
#btt
{
	margin-left: 83%;
}

.form-group
{
	margin-top: 5px;
}
#mt
{
	margin-top: 4px;
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
				<div class="header my-2" style="text-align: center;">
					<h1><span class="eng" id="eng">Update Technician Information</span><span class="mm" id="mm">Update Technician Information</span></h1>
				</div>
				<br>
				<font face="verdana" color="red" size="1" style="display:none"><b>Message Show</b></font>

				<div class="content">
					<form  action="{{route('FT.update',$playlist->id)}}" method="get" enctype="multipart/form-data">
						<!-- update -->
						@csrf
						
						{{-- <div class="row control" id="mt">
							<div class="col-md-2 lable">
							<strong><span class="mm">ဓာတ်ပုံ</span><span class="eng">Image:</span></strong>
						</div>

							<div class="col-md-10">

							<input type="file" name="Image" class="form-control">
							<img src="{{ $playlist->Image }}" id="previewing" alt="profile img" style="max-width: 100px; margin-top: 20px;">
							<input type="hidden" value="{{$playlist->Image}}" name="old_att">
						</div>


						</div> --}}


						<div class="row control" id="mt">
							<div class="col-md-2 lable">
							<label ><span class="mm">အမည်</span><span class="eng">Name</span></label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="Name" value="{{$playlist->Name}}">
							</div>
						</div>


						<div class="row control" id="mt">
							<div class="col-md-2 lable">
							<label ><span class="mm">ရာထူး</span><span class="eng">Rank</span></label>
							</div>
							<div class="col-md-10">
							<input type="text" class="form-control" name="Rank" value="{{$playlist->Rank}}">
							</div>
						</div>

						<div class="form-group mt-3 control text-center">
							<label ><span class="mm">ကျား၊မ</span><span class="eng">Gender:</span> </label>
							<input type="radio"  id="male" name="Gender" value="male" {{$playlist->Gender == 'male'  ? 'checked' : ''}}>
							<label for="male">Male</label>
							<input type="radio"  id="female" name="Gender" value="female" {{$playlist->Gender == 'female'  ? 'checked' : ''}}>
							<label for="female">Female</label>

						</div>


						<div class="row control" id="mt">
							<div class="col-md-2 lable">
							<label ><span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span></label>
						</div>
						<div class="col-md-10">
							<input type="date" value="{{$playlist->DateOfBirth}}" class="form-control"  name="DateOfBirth">
						</div>
						</div>

						<div class="row control" id="mt">
							<div class="col-md-2 lable">
							<label ><span class="mm">ပက်စ်ပိုံနံပါတ်</span><span class="eng">Passport No</span></label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="PassportNo" value="{{$playlist->PassportNo}}">
						</div>
						</div>


						<div id="btt">
							<button type="submit" class="btn btn-primary my-3">Update</button>
							<a href="{{route('FT.show')}}" class="btn btn-info my-3">Back</a>
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
</script>
@endsection	