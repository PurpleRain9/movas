@extends('admin.layout')
@section('content')
<form class="form-inline">
	<div class="container-fluid mt-3 mb-4 px-0">
		<p class="text-center"><b>{{$profile->CompanyName}}</b>'s Foreign Dependants</p>
			<div class="mt-4" style="display:flex;justify-content:end;">
				<a href="{{ route('DP.export', $profile->id) }}" style="width:200px;" class="btn btn-primary btn-sm my-3">
					Print Excel <i class="fa fa-download"></i>
				</a>
			</div>

				<table class="table table-hover table-striped table-bordered table-responsive">
					<thead>
						<tr>
							<th>No</th>
							<th>Photo</th>
							<th>Name</th>
							<th>Rank</th>
							<th>Qualification</th>
							<th>Form C Address</th>
							<th>Permanent Address in Home Country</th>
							<th>Phone No</th>
							<th>Passport No</th>
							<th>Status</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						$i=1;
						?>
						@foreach($dependants as $dp)
						
						<tr>
							<td>{{$i++}}</td>
							
							<td>
								<a href="{{asset('public'.$dp->image)}}" height="150px" width="150px">
									<img src="{{asset('public'.$dp->image)}}" style="object-fit: contain;">
								</a>
							</td>

							<td>{{ $dp->name}}</td>
							<td>{{ $dp->rank}}</td>
							<td>{{ $dp->qualification}}</td>
							@php
								$file = '/public';
								if($dp->formc_file_name){
									$file = '/public'.$dp->formc_file_name;
								}else{
									$file = '';
								}
							@endphp
							
							<td><a href="{{ $file }}"><div style="width:250px;white-space: normal;">{{ $dp->formc_address }}</div></a></td>
							
                            
							<td><div style="white-space: normal;">{{ $dp->permanent_address }}</div></td>
							<td>{{ $dp->phone_no}}</td>
							<td>{{ $dp->passport_no}}</td>
							<td>
								@if ($dp->status == 1)
                                    <label class="badge badge-success">Active</label>
                                @endif
							</td>
						</tr>
						@endforeach
						
					</tbody>
				</table>
			
		</div>
</form>


@endsection	