@extends('admin.layout')
@section('content')
<form class="form-inline">
	<div class="container mt-3 mb-4">
		<p class="text-center"><b>{{$profile->CompanyName}}</b>'s Foreign Technicians</p>
			<div class="row mt-4">
				<table class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th width="30">No</th>
							<th>Photo</th>
							<th>Name</th>
							<th>Rank</th>
							<!-- <th class="col-md-2">Status</th> -->
							<th>Passport No</th>
							<th width="40">status</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						$i=1;
						?>
						@foreach($foreign_technicians as $ft)
						
						<tr>
							<td>{{$i++}}</td>
							
							<td> <a href="/public{{$ft->Image}} " height="150px" width="150px">
								<img src="/public{{$ft->Image}}" ></a>
							</td>

							<td>{{ $ft->Name}}</td>
							<td>{{ $ft->Rank}}</td>
							<td>{{ $ft->PassportNo}}</td>
							<td><label class="badge badge-success">Active</label></td>
						</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
		</div>
</form>


@endsection	