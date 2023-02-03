@extends('layout')
@section('content')
<style>

	.badge{display:inline-block;padding:.25em .4em;font-size:75%;font-weight:700;line-height:1;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25rem}.badge:empty{display:none}.btn .badge{position:relative;top:-1px}.badge-pill{padding-right:.6em;padding-left:.6em;border-radius:10rem}.badge-primary{color:#fff;background-color:#007bff}.badge-primary[href]:focus,.badge-primary[href]:hover{color:#fff;text-decoration:none;background-color:#0062cc}.badge-secondary{color:#fff;background-color:#6c757d}.badge-secondary[href]:focus,.badge-secondary[href]:hover{color:#fff;text-decoration:none;background-color:#545b62}.badge-success{color:#fff;background-color:#28a745}.badge-success[href]:focus,.badge-success[href]:hover{color:#fff;text-decoration:none;background-color:#1e7e34}.badge-info{color:#fff;background-color:#17a2b8}.badge-info[href]:focus,.badge-info[href]:hover{color:#fff;text-decoration:none;background-color:#117a8b}.badge-warning{color:#212529;background-color:#ffc107}.badge-warning[href]:focus,.badge-warning[href]:hover{color:#212529;text-decoration:none;background-color:#d39e00}.badge-danger{color:#fff;background-color:#dc3545}.badge-danger[href]:focus,.badge-danger[href]:hover{color:#fff;text-decoration:none;background-color:#bd2130}.badge-light{color:#212529;background-color:#f8f9fa}.badge-light[href]:focus,.badge-light[href]:hover{color:#212529;text-decoration:none;background-color:#dae0e5}.badge-dark{color:#fff;background-color:#343a40}.badge-dark[href]:focus,.badge-dark[href]:hover{color:#fff;text-decoration:none;background-color:#1d2124}
</style>
<form class="form-inline">
	<div class="container mt-3 mb-4">
		<h3 class="text-center"><span class="mm">နိုင်ငံခြားသားနည်းပညာရှင်/ကျွမ်းကျင်လုပ်သား</span><span class="eng">Foreign Technician/Skilled Labour</span></h3>
		<div class="row mb-3">
			<div class="col-md-9">

			</div>
			<div class="col-md-3">
				<a href="{{route('FT.create')}}" class="btn btn-success " style="margin-left:190px;">Add New</a>
			</div>
			<div class="row mt-4">
				<table class="table table-hover table-responsive">
					<thead>
						<tr>
							<th class="col-md-1"><span class="mm">နံပါတ်</span><span class="eng">No</span></th>
							<th class="col-md-2"><span class="mm">ဓာတ်ပုံ</span><span class="eng">Photo</span></th>
							<th class="col-md-2"><span class="mm">အမည်</span><span class="eng">Name</span></th>
							<th class="col-md-2"><span class="mm">ရာထူး</span><span class="eng">Rank</span></th>
							<!-- <th class="col-md-2">Status</th> -->
							<th class="col-md-2"><span class="mm">ပက်စ်ပို့ နံပါတ်</span><span class="eng">Passport No</span></th>
							<th class="col-md-2"><span class="mm">အခြေအနေ</span><span class="eng">status</span></th>
							<th></th>
							<th></th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						$i=1;
						?>
						@foreach($playlists as $playlist)
						
						<tr style="vertical-align: middle;">
							<td>{{$i++}}</td>
							
							<td><a href="{{$playlist->Image}}"><img src="{{$playlist->Image}}" width="150px" height="150px"></a> </td>

							<td>{{ $playlist->Name}}</td>
							<td>{{ $playlist->Rank}}</td>
							<td>{{ $playlist->PassportNo}}</td>
							
							<td><label class="badge badge-success">Active</label></td>
							
							<td><a href="{{route('FT.edit',$playlist->id)}}" class="btn btn-primary">Edit</a></td>
							<td>
								<form action="{{route('FT.delete',$playlist->id)}}" method="post">
									@csrf 
									{{-- <button type="submit" class="btn btn-danger">Delete</button> --}}
								</form>
								<form action="{{route('FT.delete',$playlist->id)}}" method="post">
									@csrf 
									<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
								</form>
								
							</td>
						</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>


@endsection	
