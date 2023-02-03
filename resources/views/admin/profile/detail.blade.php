@extends('admin.layout')
@section('content')
		<h5 style="color: green;" class="text-center"></h5>

		<div class="container mb-5" style="">
			<h3 class="text-center mt-4">COMPANY PROFILE</h3>
			<br/>
    			<input type="hidden" value="{{Auth::user()->id}}" name="user_id">
				<div class="row">
					<div class="col-6">
						<fieldset class="form-group">
							<label >Company Name</label>
							<input type="text" readonly value="{{$profile->CompanyName}}" class="form-control" name="CompanyName">
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label >Company Registeration No</label>
							<input type="text" readonly value="{{$profile->CompanyRegistrationNo}}" class="form-control" name="CompanyRegistrationNo">
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label >Sector</label>
							<input type="text" readonly value="{{$profile->sector->SectorName}}" class="form-control" name="CompanyRegistrationNo">
							{{-- <select class="form-control" name="sector_id" required>
								<option value="">Choose</option>
                                @foreach($sectors as $sec)
                                <option value="{{$sec->id}}">{{$sec->SectorName}}</option>
                                @endforeach
                            </select> --}}
						</fieldset>
					</div>
				</div>
				
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label >Business Type</label>
							<br/>
							<textarea class="form-control" name="BusinessType" readonly>{{$profile->BusinessType}}</textarea>
						</fieldset>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col-md-5">
						<fieldset class="form-group">
							<label >Permit Type</label>
							<input type="text" readonly value="{{$profile->permit_type->PermitTypeNameMM}}" class="form-control" name="PermitNo">
							{{-- <select class="form-control" name="permit_type_id" required>
								<option value="">Choose</option>
                                @foreach($permittypes as $pt)
                                <option value="{{$pt->id}}">{{$pt->PermitTypeName}}</option>
                                @endforeach
                            </select> --}}
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label >Permit No</label>
							<input type="text" readonly value="{{$profile->PermitNo}}" class="form-control" name="PermitNo">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label >Permitted Date</label>
							<input type="date" class="form-control" name="PermittedDate" value="{{$profile->PermittedDate}}" readonly>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label >Commercialization Date</label>
							<input type="date" class="form-control" name="CommercializationDate" value="{{$profile->CommercializationDate}}" readonly>
						</fieldset>
					</div>
				</div>

				{{-- <div class="row mt-3">
					<div class="col">
					    <fieldset class="form-group">
							<label >Land No</label>
							<input type="text" readonly value="{{$profile->LandNo}}" class="form-control" name="LandNo">
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label >Land Survey District No</label>
							<input type="text" readonly value="{{$profile->LandSurveyDistrictNo}}" class="form-control" name="LandSurveyDistrictNo">
						</fieldset>
					</div>
					
					<div class="col-6">
						<fieldset class="form-group">
							<label >Industrial Zone</label>
							<input type="text" readonly value="{{$profile->IndustrialZone}}" class="form-control" name="IndustrialZone">
						</fieldset>
					</div>
				</div> --}}
				
				<div class="row mt-3">
					<div class="col">
					    <fieldset class="form-group">
							<label >Place of Investment Project</label>
							<input type="text" readonly value="{{$profile->Township}}" class="form-control" name="Township">
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label >Region</label>
							<input type="text" readonly value="{{$profile->region->RegionNameMM}}" class="form-control" name="PermitNo">
							{{-- <select class="form-control" name="region_id" required>
								<option value="">Choose</option>
                                @foreach($regions as $r)
                                <option value="{{$r->id}}">{{$r->RegionName}}</option>
                                @endforeach
                            </select> --}}
						</fieldset>
					</div>
				</div>
				
				<br/>
				
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label ></label>
							<input readonly type="text" readonly class="form-control" style="border: 0;" value="Numbers of Local Staff">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label >In Proposal</label>
							<input type="text" readonly value="{{$profile->StaffLocalProposal}}" class="form-control" name="StaffLocalProposal">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label >Increased</label>
							<input type="text" readonly value="{{$profile->StaffLocalSurplus}}" class="form-control" name="StaffLocalSurplus">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label >Appointed</label>
							<input type="text" readonly value="{{$profile->StaffLocalAppointed}}" class="form-control" name="StaffLocalAppointed">
						</fieldset>
					</div>
				</div>
				
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							
							<input readonly type="text" readonly class="form-control" style="border: 0;" value="Numbers of Foreign Staff">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							
							<input type="text" readonly value="{{$profile->StaffForeignProposal}}" class="form-control" name="StaffForeignProposal">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							
							<input type="text" readonly value="{{$profile->StaffForeignSurplus}}" class="form-control" name="StaffForeignSurplus">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							
							<input type="text" readonly value="{{$profile->StaffForeignAppointed}}" class="form-control" name="StaffForeignAppointed">
						</fieldset>
					</div>
				</div>

                <br/>

                <div class="row mt-3">
                    <h3 class="text-center mt-3">ATTACHMENT</h3>
                </div>
                
				<div class="row mt-3">
					@if ($profile->AttachPermit != '')
						<div class="col-md-6">
							<fieldset class="form-group">
								<label for="pxq11"><span class="mm">(၁) ခွင့်ပြုမိန့်</span><span class="eng">(1) MIC Permit</span></label>
	    					    <a href="/public{{$profile->AttachPermit}}" class="btn btn-secondary btn-sm ml-3">Open File</a>
							</fieldset>
						</div>
					@endif

					@if ($profile->AttachProposal != '')
						<div class="col-md-6">
							<fieldset class="form-group">
								<label for="pxq12"><span class="mm">(2) Proposal Employee List as per Proposal</span><span class="eng">(2)Proposal Employee List as per Proposal</span></label>
	    					<a href="/public{{$profile->AttachProposal}}" class="btn btn-secondary btn-sm ml-3">Open File</a>
							</fieldset>
						</div>
					@endif
				</div>

				<div class="row mt-3">
					@if ($profile->AttachAppointed != '')
						<div class="col-md-6">
							<fieldset class="form-group">
								<label for="pxq13"><span class="mm">(3) Appointed Employee List (Local & Foreign)</span><span class="eng">(3)Appointed Employee List (Local & Foreign)</span></label>
	    					    <a href="/public{{$profile->AttachAppointed}}" class="btn btn-secondary btn-sm ml-3">Open File</a>
							</fieldset>
						</div>
					@endif
					

					@if ($profile->AttachIncreased != '')
						<div class="col-md-6">
						<fieldset class="form-group">
							<label for="pxq14"><span class="mm">(4) Increased Employee List (If Any)</span><span class="eng">(4)Increased Employee List (If Any)</span></label>
    					<a href="/public/{{$profile->AttachIncreased}}" class="btn btn-secondary btn-sm ml-3">Open File</a>
						</fieldset>
					</div>
					@endif
					
				</div>

			
				<div style="display:flex;justify-content:end;">
					@if ($admin->Status == 1)
						<a href="{{ route('approveprofile.accept',$profile->id) }}" style="width:100px;" class="btn btn-success mt-4 mb-3"  onclick="confirm('Are you sure you want to approve ?')">Accept</a>
					@else
						<button type="button" data-toggle="modal" data-target="#exampleModal1" style="width:100px;" class="btn btn-success mt-4 mb-3 ml-3" disabled>Accept</button>
					@endif

					<button type="button" data-toggle="modal" data-target="#exampleModal1" style="width:100px;" class="btn btn-danger mt-4 mb-3 ml-3" @if ($admin->Status == 0) disabled @endif>Resubmit</button>

						<!-- Modal -->
					<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">မှတ်ချက်ထည့်သွင်းရန်</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      	<form action="{{ route('profile.deny',$profile->id) }}" method="POST" >
								@csrf
						        <div class="form-group">
						            <textarea class="form-control" name="cmt" style="height: 300px;" placeholder="Reject Reasons go here...." required></textarea>
						          </div>
						     
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<input type="Submit" class="btn btn-primary" />
									</div>
					      	</form>					    
						</div>
					  </div>
					</div>
				</div>
					
				</div>
		</div>
@endsection