@extends('admin.layout')
@section('content')

  <h1>Edit Nationality</h1>

  <form action="{{route('nationality.update',$nation->id)}}" method="get">
			@csrf
			<div class="form-group">
				<label >Nationality Name</label>
				<input type="text" class="form-control" name="NationalityName" value="{{$nation->NationalityName}}">
			</div>

			
			
			<button type="submit" class="btn btn-primary">Update</button>
			<a href="{{route('nationalityform')}}" class="btn btn-info">Back</a>
		</form>	
	@endsection