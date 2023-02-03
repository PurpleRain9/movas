@extends('admin.layout')
@section('content')
<div class="container" style="border-radius: 10px; border: 2px solid green; padding: 15px 15px;">
	<h4 class="mb-3">Admin Sector</h4>
	<form method="POST" action="{{ route('adminsector.store',$admin->id) }}">
		@csrf
		<label><b>Name</b></label>
		<p>{{$admin->username}}</p>
		<input type="hidden" value="{{$admin->id}}" name="admin_id">

		<label class="mt-3"><b>Sectors</b></label><br>
		@foreach ($sectors as $s)
		<label class="checkbox-inline mt-3">
            <input type="checkbox" id="sector_id" name="sector_id[]" value="{{$s->id}}" {{ $admin->sectors->contains($s->id) ? 'checked' : '' }}> 
            
            <span class="mr-4">{{$s->SectorNameMM}}</span>
        </label>
        @endforeach
        <br>
        <button class="btn btn-success btn-lg mt-3">Save</button>
        <a href="{{ URL::previous() }}" class="btn btn-danger btn-lg mt-3">Back</a>
	</form>
</div>
@endsection