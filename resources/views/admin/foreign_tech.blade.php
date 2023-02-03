@extends('admin.layout')
@section('content')
<form class="form-inline">
	<div class="container-fluid mt-3 mb-4 px-0">
		<p class="text-center"><b>{{$profile->CompanyName}}</b>'s Foreign Technicians</p>
			<div class="mt-4" style="display:flex;justify-content:end;">
				<a href="{{ route('FT.export', $profile->id) }}" style="width:200px;" class="btn btn-primary btn-sm my-3">
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
							<th>MIC Approved Letter</th>
							<th>Labour Card</th>
							<th>Permanent Address in Home Country</th>
							<th>Phone No</th>
							<th>Passport No</th>
							<th>Resigned Date</th>
							<th>Status</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						$i=1;
						?>
						@foreach($foreign_technicians as $ft)
						
						<tr>
							<td>{{$i++}}</td>
							
							<td>
								<a href="{{asset('public'.$ft->Image)}}" height="150px" width="150px">
									<img src="{{asset('public'.$ft->Image)}}" style="object-fit: contain;">
								</a>
							</td>

							<td>{{ $ft->Name}}</td>
							<td>{{ $ft->Rank}}</td>
							<td>{{ $ft->Qualification}}</td>
							@php
								$file = '/public';
								if($ft->form_c_filename){
									$file = '/public'.$ft->form_c_filename;
								}else{
									$file = '';
								}
							@endphp
							@php
								$mic = '/public';
								if($ft->mic_aprroved_letter){
									$mic = '/public'.$ft->mic_aprroved_letter;
								}else {
									$mic = '';
								}
							@endphp

							@php
								$labour = '/public';
								if($ft->labour_card) {
									$labour = '/public'.$ft->labour_card;
								}else{
									$labour = '';
								}
							@endphp
							<td><a href="{{ $file }}"><div style="width:250px;white-space: normal;">{{ $ft->address }}</div></a></td>
							@if ($mic)
								<td><a href="{{ $mic }}">yes</a></td>
							@else
								<td><span class="badge text-bg-danger">Not Have</span></td>
							@endif
							
							@if ($labour)
								<td><a href="{{ $labour }}">yes</a></td>
							@else
								<td><span class="badge text-bg-danger">Not Have</span></td>
							@endif
							

							<td><div style="white-space: normal;">{{ $ft->home_address }}</div></td>
							<td>{{ $ft->phone_no}}</td>
							<td>{{ $ft->PassportNo}}</td>
							<td>
								@if ($ft->approved_date)
									{{ date('d F, Y', strtotime($ft->approved_date)) }}
								@else
									<span class="text-center">-</span>
								@endif
							</td>
							<td>
								@if ($ft->Status == 1)
									<lable class="badge badge-success">Active</lable>
								@elseif ($ft->Status == 3)
									<lable class="badge badge-danger">Resigned</lable>
								@endif
							</td>
						</tr>
						@endforeach
						
					</tbody>
				</table>
			
		</div>
</form>


@endsection	