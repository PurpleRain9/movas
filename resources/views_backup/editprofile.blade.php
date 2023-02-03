@extends('layout')
@section('content')
<script>
	function validateFileSize(input) {
		const fileSize = input.files[0].size 
		if (fileSize > 3145728) {
		alert('Attach File Size Must Be Lower Than 3 MB');
		input.value='';
		}
	}
</script>
		<h5 style="color: green;" class="text-center"></h5>

		<div class="container mb-5" style="">
			<h3 class="text-center mt-4"><span class="mm">ကုမ္ပဏီအချက်အလက်</span><span class="eng">COMPANY PROFILE</span></h3>
			<br/>
			<form action="{{ route('profile.update',Auth::user()->profile->id) }}" method="post" enctype="multipart/form-data">
    				@csrf

    			<input type="hidden" value="{{Auth::user()->id}}" name="user_id">
				<div class="row">
					<div class="col-6">
						<fieldset class="form-group">
							<label ><span class="mm">ကုမ္ပဏီအမည်</span><span class="eng">Company Name</span></label>
							<input type="text" class="form-control" name="CompanyName" required value="{{Auth::user()->profile->CompanyName}}">
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">ကုမ္ပဏီမှတ်ပုံတင်အမှတ်</span><span class="eng">Company Registeration No</span></label>
							<input type="text" class="form-control" name="CompanyRegistrationNo" required value="{{Auth::user()->profile->CompanyRegistrationNo}}">
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label >Sector</label>
							<select class="form-control" name="sector_id" required>
								<option value="">Choose</option>
                                @foreach($sectors as $sec)
                                <option value="{{$sec->id}}" {{$sec->id == Auth::user()->profile->sector_id  ? 'selected' : ''}}>{{$sec->SectorName}}</option>
                                @endforeach
                            </select>
						</fieldset>
					</div>
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">ဒေသ</span><span class="eng">Region</span></label>
							<select class="form-control" name="region_id" required>
								<option value="">Choose</option>
                                @foreach($regions as $r)
                                <option value="{{$r->id}}" {{$r->id == Auth::user()->profile->region_id  ? 'selected' : ''}}>{{$r->RegionNameMM}}</option>
                                @endforeach
                            </select>
						</fieldset>
					</div>
				</div>
				
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">စီးပွားရေးအမျိုးအစား</span><span class="eng">Business Type</span></label> <b class="text-danger">*</b>
							<br/>
							<textarea class="form-control" name="BusinessType" required>{{Auth::user()->profile->BusinessType}}</textarea>
							<small class="text-danger" style="font-weight: bold;">*&nbsp;(MIC Permit ပါအတိုင်း မြန်မာလိုဖြည့်ရန်)</small>
						</fieldset>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ခွင့်ပြုချက်/ထောက်ခံချက်အမျိုးအစား</span><span class="eng">Permit/Endorsement Type</span></label>
							<select class="form-control" name="permit_type_id" required>
								<option value="">Choose</option>
                                @foreach($permittypes as $pt)
                                <option value="{{$pt->id}}" {{$pt->id == Auth::user()->profile->permit_type_id  ? 'selected' : ''}}>{{$pt->PermitTypeNameMM}}</option>
                                @endforeach
                            </select>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ခွင့်ပြုချက်/ထောက်ခံချက်အမှတ်</span><span class="eng">Permit/Endorsement No</span></label> <b class="text-danger">*</b>
							<input type="text" class="form-control" name="PermitNo" required value="{{Auth::user()->profile->PermitNo}}">
							<small class="text-danger" style="font-weight: bold;">*&nbsp;(MIC Permit ပါအတိုင်း မြန်မာလိုဖြည့်ရန်)</small>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ခွင့်ပြုရက်</span><span class="eng">Permitted Date</span></label>
							<input type="date" class="form-control" name="PermittedDate" required value="{{Auth::user()->profile->PermittedDate}}">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">စတင်သောနေ့</span><span class="eng">Commencement Date</span></label>
							<input type="date" class="form-control" name="CommercializationDate" value="{{Auth::user()->profile->CommercializationDate}}">
						</fieldset>
					</div>
				</div>

				{{-- <div class="row mt-3">
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">မြေကွက်အမှတ်</span><span class="eng">Plot No</span></label>
							<input type="text" class="form-control" name="LandNo" required value="{{Auth::user()->profile->LandNo}}">
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">Myay Taing Block No</span><span class="eng">Myay Taing Block No</span></label>
							<input type="text" class="form-control" name="LandSurveyDistrictNo" required value="{{Auth::user()->profile->LandSurveyDistrictNo}}">
						</fieldset>
					</div>
					
					<div class="col-6">
						<fieldset class="form-group">
							<label ><span class="mm">စက်မှုဇုန်</span><span class="eng">Industrial Zone</span></label>
							<input type="text" class="form-control" name="IndustrialZone" required value="{{Auth::user()->profile->IndustrialZone}}">
						</fieldset>
					</div>
				</div> --}}
				
				<div class="row mt-3">
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">ရင်းနှီးမြှုပ်နှံသည့်အရပ်ဒေသ</span><span class="eng">Place of Investment Project</span></label> <b class="text-danger">*</b>
							<textarea type="text" class="form-control" name="Township" required>{{Auth::user()->profile->Township}}</textarea>
							<small class="text-danger" style="font-weight: bold;">*&nbsp;(MIC Permit ပါအတိုင်း မြန်မာလိုဖြည့်ရန်)</small>
						</fieldset>
					</div>
					
					{{-- <div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">ဒေသ</span><span class="eng">Region</span></label>
							<select class="form-control" name="region_id" required>
								<option value="">Choose</option>
                                @foreach($regions as $r)
                                <option value="{{$r->id}}" {{$r->id == Auth::user()->profile->region_id  ? 'selected' : ''}}>{{$r->RegionNameMM}}</option>
                                @endforeach
                            </select>
						</fieldset>
					</div> --}}
				</div>
				
				<br/>
				
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label ></label>
							<input readonly type="text" class="form-control" style="border: 0;" value="Numbers of Local Staff">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">အဆိုပြု </span><span class="eng">In Proposal</span></label>
							<input type="number" class="form-control" name="StaffLocalProposal" required value="{{Auth::user()->profile->StaffLocalProposal}}">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ထပ်တိုး</span><span class="eng">Increased</span></label>
							<input type="number" class="form-control" name="StaffLocalSurplus" required value="{{Auth::user()->profile->StaffLocalSurplus}}">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ခန့်အပ်ပြီး</span><span class="eng">Appointed</span></label>
							<input type="number" class="form-control" name="StaffLocalAppointed" required value="{{Auth::user()->profile->StaffLocalAppointed}}">
						</fieldset>
					</div>
				</div>
				
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							
							<input readonly type="text" class="form-control" style="border: 0;" value="Numbers of Foreign Staff">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							
							<input type="number" class="form-control" name="StaffForeignProposal" required value="{{Auth::user()->profile->StaffForeignProposal}}">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							
							<input type="number" class="form-control" name="StaffForeignSurplus" required value="{{Auth::user()->profile->StaffForeignSurplus}}">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							
							<input type="number" class="form-control" name="StaffForeignAppointed" required value="{{Auth::user()->profile->StaffForeignAppointed}}">
						</fieldset>
					</div>
				</div>

                <br/>

                <div class="row mt-3">
                    <h3 class="text-center mt-3"><span class="mm">ပူးတွဲအချက်အလက်</span><span class="eng">ATTACHMENT</span></h3>
                </div>
                
                 <div class="row mt-3">
                 	<p>Current ATTACHMENT</p>
                   <div class="col">
                   	<div class="form-group">
                   		<label for="pxq11"><span class="mm">ခွင့်ပြုမိန့်</span><span class="eng">MIC Permit</span></label>
                   		<a href="/public{{Auth::user()->profile->AttachPermit}}" class="btn btn-info">View</a>
                   	</div>
                   </div>

                   <div class="col">
                   	<div class="form-group">
                   		<label for="pxq12"><span class="mm">Proposal Employee List as per Proposal</span><span class="eng">Proposal Employee List as per Proposal</span></label>
                   		<a href="/public{{Auth::user()->profile->AttachProposal}}" class="btn btn-info">View</a>
                   	</div>
                   </div>
                </div>

                <div class="row mt-3">
                   <div class="col">
                   	<div class="form-group">
                   		<label for="pxq13"><span class="mm">Appointed Employee List (Local & Foreign)</span><span class="eng">Appointed Employee List (Local & Foreign)</span></label>
                   		<a href="/public{{Auth::user()->profile->AttachAppointed}}" class="btn btn-info">View</a>
                   	</div>
                   </div>

                   @if (Auth::user()->profile->AttachIncreased != '')
                   		<div class="col">
	                   	<div class="form-group">
	                   		<label for="pxq14"><span class="mm">Increased Employee List (If Any)</span><span class="eng">Increased Employee List (If Any)</span></label>
	                   		<a href="/public{{Auth::user()->profile->AttachIncreased}}" class="btn btn-info">View</a>
	                   		<a href="{{ route('profile.deleteincrease',Auth::user()->profile->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete?');">Delete</a>
	                   	</div>
	                   </div>
                   @endif
                   
                </div>
                
                <hr>

				<div class="row mt-3">
				    <span style="color:red;"><b>***</b>If you want to update your current files, Please Upload.</span>
				     <span style="color:red;"><b>Note</b>: The following documents are optional. </span>
                    <br><br>
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq11"><span class="mm">ခွင့်ပြုမိန့်</span><span class="eng">MIC Permit</span> (Optional)</label>
    					    <input type="file" onchange="validateFileSize(this);" class="form-control" name="AttachPermit" id="pxq11" accept=".pdf" value="/public/{{Auth::user()->profile->AttachPermit}}">
    					    <input type="hidden" name="att_old1" value="{{Auth::user()->profile->AttachPermit}}">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq12"><span class="mm">Proposal Employee List as per Proposal</span><span class="eng">Proposal Employee List as per Proposal</span> (Optional)</label>
    					<input type="file" onchange="validateFileSize(this);" class="form-control" name="AttachProposal" id="pxq12" accept=".pdf" value="/public/{{Auth::user()->profile->AttachProposal}}">
						</fieldset>
						<input type="hidden" name="att_old2" value="{{Auth::user()->profile->AttachProposal}}">
					</div>
				</div>
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq13"><span class="mm">Appointed Employee List (Local & Foreign)</span><span class="eng">Appointed Employee List (Local & Foreign)</span> (Optional)</label>
    					<input type="file" onchange="validateFileSize(this);" class="form-control" name="AttachAppointed" id="pxq13" accept=".pdf" value="/public/{{Auth::user()->profile->AttachAppointed}}">
    					<input type="hidden" name="att_old3" value="{{Auth::user()->profile->AttachAppointed}}">
						</fieldset>
					</div>

					<div class="col">
						<fieldset class="form-group">
							<label for="pxq14"><span class="mm">Increased Employee List (If Any)</span><span class="eng">Increased Employee List (If Any)</span> (Optional)</label>
    					<input type="file" onchange="validateFileSize(this);" class="form-control" name="AttachIncreased" id="pxq14" accept=".pdf" value="/public/{{Auth::user()->profile->AttachIncreased}}">
    					<input type="hidden" name="att_old4" value="{{Auth::user()->profile->AttachIncreased}}">
						</fieldset>
					</div>
				</div>
				<button type="submit" class="btn btn-primary mt-4 mb-3">Save</button>
			</form>
		</div>
	

@endsection