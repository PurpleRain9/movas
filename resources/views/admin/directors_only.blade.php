@extends('admin.layout')
@section('content')
<form class="form-inline">
	<div class="container-fluid mt-3 mb-4 px-0">
		<p class="text-center"><b>{{$profile->CompanyName}}</b>'s Directors</p>
			<div class="mt-4" style="display:flex;justify-content:end;">
				<a href="{{ route('DT.export', $profile->id) }}" style="width:200px;" class="btn btn-primary btn-sm my-3">
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
                            <th>Extract Form</th>
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
						@foreach($directors as $dt)
						
						<tr>
							<td>{{$i++}}</td>
							
							<td>
								<a href="{{asset('public'.$dt->image)}}" height="150px" width="150px">
									<img src="{{asset('public'.$dt->image)}}" style="object-fit: contain;">
								</a>
							</td>

							<td>{{ $dt->name}}</td>
							<td>{{ $dt->rank}}</td>
							<td>{{ $dt->qualification}}</td>
							@php
								$file = '/public';
								if($dt->formc_file_name){
									$file = '/public'.$dt->formc_file_name;
								}else{
									$file = '';
								}
							@endphp
							
							<td><a href="{{ $file }}"><div style="width:250px;white-space: normal;">{{ $dt->formc_address }}</div></a></td>
							
                            @php
                                $et = '/public';
                                if ($dt->extract_filename) {
                                   $et = '/public'.$dt->extract_filename;
                                }else {
                                    $et = '';
                                }
                            @endphp

                            <td><a href="{{ $et }}"><div style="white-space: normal;">yes</div></a></td>

							<td><div style="white-space: normal;">{{ $dt->permanent_address }}</div></td>
							<td>{{ $dt->phone_no}}</td>
							<td>{{ $dt->passport_no}}</td>
							<td>
								@if ($dt->status == 1)
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