@extends('admin.layout')
@section('content')

		{{-- @foreach ($profiles as $pf)
		<li>{{$pf->sector->SectorName}}</li>
		<li>{{$pf->region->RegionName}}</li>
		<li>{{$pf->permit_type->PermitTypeName}}</li>
		@endforeach --}}


				<div class="row">
					<div class="col-md-4 col-sm-6">
						<form class="navbar-form">
			              <div class="input-group no-border">
			                <input type="text" id="search" class="form-control" placeholder="Company Name..." name="name">
			                <button type="submit" class="btn btn-outline-secondary btn-round btn-just-icon">
			                  Search
			                  <div class="ripple-container"></div>
			                </button>
			              </div>
			            </form>
					</div>
				</div>
				
			  <div class="table-responsive mt-2">
			    <table class="table">
			      <thead class="bg-info text-white">
			        <th>
			          No
			        </th>
			        <th>
			          Company Name
			        </th>
			        <th>
			          CompanyRegistrationNo
			        </th>
			        <th>
			          User Name
			        </th>
			        <th>
			        	Actions
			        </th>
			      </thead>
			      <tbody>
			      	@foreach ($profiles as $key => $value)
			        <tr>
			          <td class="align-text-top">{{++$i}}</td>
					  @if($value->profile_reject->count() == 0)
			          <td class="align-text-top">{{$value->CompanyName}}</td>
						@else
							<td class="align-text-top">
								 <a href="" data-toggle="modal" class="openRejectTable" data-target="#rejectInfo" data-reject="{{$value->profile_reject->count()}}" >{{$value->CompanyName}}</a>
							</td>
						@endif
			          <td style="white-space: pre-line">{{$value->CompanyRegistrationNo}}</td>
			          <td class="align-text-top">{{$value->user->name}}</td>
			          	<td class="align-text-top">
			                    <a class="btn btn-sm btn-round btn-info" href="{{ route('approveprofile.detail',$value->id) }}">View</a>    
			            </td>
			        </tr>
			        @endforeach
			      </tbody>
			    </table>
			    
			  </div>

			  <div class="modal fade" id="rejectInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"><span class="mm"> </span><span class="eng"> Reject Information</span></h5>
					<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body  ">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>Reject Times</td>
									<td id="rejectTimes"></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
				</div>
			  </div>

		<script>
			$(document).on("click", ".openRejectTable", function () {
			var reject = $(this).data('reject');
			$("#rejectTimes").html(reject);
		});
		</script>

@endsection