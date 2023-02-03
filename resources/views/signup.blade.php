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

@if (Auth::user()->Status == 0)
	<hr style="opacity: 0.4">

		<h5 style="color: green;" class="text-center"></h5>

		<div class="container mb-5" style="">
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Please Fill the Profile to Complete the Registration!</strong> 
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
@if (Auth::user()->RejectComment)
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>
					{{Auth::user()->RejectComment}}
				</strong> 
			</div>
@endif
			<h3 class="text-center mt-4"><span class="mm">
ကုမ္ပဏီအချက်အလက်</span><span class="eng">COMPANY PROFILE</span></h3>
			<br/>
			<form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
    				@csrf
				@if(session()->has('error'))
					<div class="alert alert-danger m-2">
						{{ session()->get('error') }}
					</div>
				@endif
    			<input type="hidden" value="{{Auth::user()->id}}" name="user_id">
				<div class="row">
					<div class="col-6">
						<fieldset class="form-group">
							<label ><span class="mm">ကုမ္ပဏီအမည်</span><span class="eng">Company Name</span></label>
							<input type="text" class="form-control" name="CompanyName" required>
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">ကုမ္ပဏီမှတ်ပုံတင်အမှတ်</span><span class="eng">Company Registeration No</span></label>
							<input type="text" class="form-control" name="CompanyRegistrationNo" required>
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label >Sector</label>
							<select class="form-control" name="sector_id" required>
								<option value="">Choose</option>
                                @foreach($sectors as $sec)
                                <option value="{{$sec->id}}">{{$sec->SectorName}}</option>
                                @endforeach
                            </select>
						</fieldset>
					</div>

					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">
ဒေသ</span><span class="eng">Region</span></label>
							<select class="form-control" name="region_id" required>
								<option value="">Choose</option>
                                @foreach($regions as $r)
                                <option value="{{$r->id}}">{{$r->RegionNameMM}}</option>
                                @endforeach
                            </select>
						</fieldset>
					</div>
				</div>
				
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">လုပ်ငန်းအမျိုးအစား</span><span class="eng">Business Type</span> <b class="text-danger">*</b></label>
							<br/>
							<textarea class="form-control" name="BusinessType" required></textarea>
							<small class="text-danger" style="font-weight: bold;">*&nbsp;(MIC Permit ပါအတိုင်း မြန်မာလိုဖြည့်ရန်)</small>
						</fieldset>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">
ခွင့်ပြုချက်/ထောက်ခံချက်အမျိုးအစား</span><span class="eng">Permit/Endorsement Type</span></label>
							<select class="form-control" name="permit_type_id" required>
								<option value="">Choose</option>
                                @foreach($permittypes as $pt)
                                <option value="{{$pt->id}}">{{$pt->PermitTypeNameMM}}</option>
                                @endforeach
                            </select>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">
ခွင့်ပြုချက်/ထောက်ခံချက်အမှတ်</span><span class="eng">Permit/Endorsement No</span></label> <b class="text-danger">*</b>
<br>
							<input type="text" class="form-control" name="PermitNo" required>
							<small class="text-danger" style="font-weight: bold;">*&nbsp;(MIC Permit ပါအတိုင်း မြန်မာလိုဖြည့်ရန်)</small>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ခွင့်ပြုရက်</span><span class="eng">Permitted Date</span></label>
							<input type="date" class="form-control" name="PermittedDate" required>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">စတင်သောနေ့</span><span class="eng">Commencement Date</span></label>
							<input type="date" class="form-control" name="CommercializationDate">
						</fieldset>
					</div>
				</div>

				{{-- <div class="row mt-3">
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">မြေကွက်အမှတ်</span><span class="eng">Plot No</span></label>
							<input type="text" class="form-control" name="LandNo" required>
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">Myay Taing Block No</span><span class="eng">Myay Taing Block No</span></label>
							<input type="text" class="form-control" name="LandSurveyDistrictNo" required>
						</fieldset>
					</div>
					
					<div class="col-6">
						<fieldset class="form-group">
							<label ><span class="mm">စက်မှုဇုန်</span><span class="eng">Industrial Zone</span></label>
							<input type="text" class="form-control" name="IndustrialZone" required>
						</fieldset>
					</div>
				</div> --}}

				
				<div class="row mt-3">
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">
ရင်းနှီးမြှုပ်နှံသည့်အရပ်ဒေသ</span><span class="eng">Place of Investment Project</span></label> <b class="text-danger">*</b>
							<textarea type="text" class="form-control" name="Township" required></textarea>
							<small class="text-danger" style="font-weight: bold;">*&nbsp;(MIC Permit ပါအတိုင်း မြန်မာလိုဖြည့်ရန်)</small>
						</fieldset>
					</div>
					
					{{-- <div class="col-md-4">
					    <fieldset class="form-group">
							<label ><span class="mm">
ဒေသ</span><span class="eng">Region</span></label>
							<select class="form-control" name="region_id" required>
								<option value="">Choose</option>
                                @foreach($regions as $r)
                                <option value="{{$r->id}}">{{$r->RegionNameMM}}</option>
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
							<label ><span class="mm">အဆိုပြု</span><span class="eng">In Proposal</span></label>
							<input type="number" class="form-control" name="StaffLocalProposal" required>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ထပ်တိုး</span><span class="eng">Increased</span></label>
							<input type="number" class="form-control" name="StaffLocalSurplus" required>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ခန့်အပ်ပြီး</span><span class="eng">Appointed</span></label>
							<input type="number" class="form-control" name="StaffLocalAppointed" required>
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
							
							<input type="number" class="form-control" name="StaffForeignProposal" required min="0">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							
							<input type="number" class="form-control" name="StaffForeignSurplus" required>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							
							<input type="number" class="form-control" name="StaffForeignAppointed" required>
						</fieldset>
					</div>
				</div>

                <br/>

                <div class="row mt-3">
                    <h3 class="text-center mt-3">ATTACHMENT</h3>
                </div>
                
				<div class="row mt-3">
				    <span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
                    <br><br>
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq11"><span class="mm">ခွင့်ပြုမိန့်</span><span class="eng">MIC Permit</span></label>
    					    <input type="file" class="form-control" name="AttachPermit" id="pxq11" onchange="validateFileSize(this);">
							@error('AttachPermit')
								<span class="text-danger"><small>* {{ $message }}</small></span>
							@enderror
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq12"><span class="mm">Proposal Employee List as per Proposal</span><span class="eng">Proposal Employee List as per Proposal</span></label>
    						<input type="file" class="form-control" name="AttachProposal" id="pxq12" onchange="validateFileSize(this);">
							@error('AttachProposal')
								<span class="text-danger"><small>* {{ $message }}</small></span>
							@enderror
						</fieldset>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq13"><span class="mm">Appointed Employee List (Local & Foreign)</span><span class="eng">Appointed Employee List (Local & Foreign)</span></label>
    						<input type="file" class="form-control" name="AttachAppointed" id="pxq13" onchange="validateFileSize(this);">
							@error('AttachAppointed')
								<span class="text-danger"><small>* {{ $message }}</small></span>
							@enderror
						</fieldset>
					</div>

					<div class="col">
						<fieldset class="form-group">
							<label for="pxq14"><span class="mm">Increased Employee List (If Any)</span><span class="eng">Increased Employee List (If Any)</span></label>
    						<input type="file" class="form-control" name="AttachIncreased" id="pxq14" accept=".pdf" onchange="validateFileSize(this);">
							@error('AttachIncreased')
								<span class="text-danger"><small>* {{ $message }}</small></span>
							@enderror
						</fieldset>
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary mt-4 mb-3">Submit</button>
			</form>
		</div>
@elseif(Auth::user()->Status == 1)
	<hr style="opacity: 0.4">

	<h5 style="color: green;" class="text-center"></h5>

	<div class="container mb-5" style="">
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <span><strong>You already submitted the form at {{date('j F Y, H:i:s', strtotime(Auth::user()->profile->created_at))}}.</strong></span>
		  <span><strong><span class="mm">ကျေးဇူးပြုပြီး Admin ရဲ့ခွင့်ပြုချက်ကိုစောင့်ပါ</span><span class="eng">Please Wait For Admin Approval!</span></strong></span>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	</div>
{{-- update 12/22/2021 --}}
@elseif (Auth::user()->Status == 3)
	<hr style="opacity: 0.4">

		<h5 style="color: green;" class="text-center"></h5>

		<div class="container mb-5" style="">
			<div class="alert alert-success alert-dismissible fade show" role="alert">
			  <strong>Please Fill the Profile to Complete the Registration!</strong> 
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			@if (Auth::user()->RejectComment)
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
			  <strong>
					{{Auth::user()->RejectComment}}
				</strong> 
			</div>
			@endif
		
			<h3 class="text-center mt-4"><span class="mm">
ကုမ္ပဏီအချက်အလက်</span><span class="eng">COMPANY PROFILE</span></h3>
			<br/>
			<form action="{{ route('profile.store') }}" method="post" enctype="multipart/form-data">
    				@csrf
				@if(session()->has('error'))
					<div class="alert alert-danger m-2">
						{{ session()->get('error') }}
					</div>
				@endif
    			<input type="hidden" value="{{Auth::user()->id}}" name="user_id">

    			
				<div class="row">
					<div class="col-6">
						<fieldset class="form-group">
							<label ><span class="mm">ကုမ္ပဏီအမည်</span><span class="eng">Company Name</span></label>
							<input type="text" class="form-control" name="CompanyName" value="{{Auth::user()->profile->CompanyName}}" required>
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">ကုမ္ပဏီမှတ်ပုံတင်အမှတ်</span><span class="eng">Company Registeration No</span></label>
							<input type="text" class="form-control" name="CompanyRegistrationNo" value="{{Auth::user()->profile->CompanyRegistrationNo}}" required>
						</fieldset>
					</div>
					
					<div class="col">
					    <fieldset class="form-group">
							<label >Sector</label>
							<select class="form-control" name="sector_id" required>
								<option value="">Choose</option>
                                @foreach($sectors as $sec)
                                	@if($sec->id == Auth::user()->profile->sector_id )
                                		<option value="{{$sec->id}}" selected> {{$sec->SectorName}}</option>
                                	@else
                                		 <option value="{{$sec->id}}">{{$sec->SectorName}}</option>
                                	@endif
                               
                                @endforeach
                            </select>
						</fieldset>
					</div>

					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">
ဒေသ</span><span class="eng">Region</span></label>
							<select class="form-control" name="region_id" required>
								<option value="">Choose</option>
                                @foreach($regions as $r)
                                	@if($r->id == Auth::user()->profile->region_id)
                                		<option value="{{$r->id}}" selected="">{{$r->RegionNameMM}}</option>
                                	@else
                                	   <option value="{{$r->id}}">{{$r->RegionNameMM}}</option>
                                	@endif
                              
                                @endforeach
                            </select>
						</fieldset>
					</div>
				</div>
				
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">လုပ်ငန်းအမျိုးအစား</span><span class="eng">Business Type</span> <b class="text-danger">*</b></label>
							<br/>
							<textarea class="form-control" name="BusinessType" required>{{Auth::user()->profile->BusinessType}}
							</textarea>
							<small class="text-danger" style="font-weight: bold;">*&nbsp;(MIC Permit ပါအတိုင်း မြန်မာလိုဖြည့်ရန်)</small>
						</fieldset>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">
ခွင့်ပြုချက်/ထောက်ခံချက်အမျိုးအစား</span><span class="eng">Permit/Endorsement Type</span></label>
							<select class="form-control" name="permit_type_id" required>
								<option value="">Choose</option>
                                @foreach($permittypes as $pt)
                                	@if($pt->id == Auth::user()->profile->permit_type_id)
                                		 <option value="{{$pt->id}}" selected="">{{$pt->PermitTypeNameMM}}</option>
                                	@else 
                                		 <option value="{{$pt->id}}">{{$pt->PermitTypeNameMM}}</option>
                                	@endif
                            
                                @endforeach
                            </select>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">
ခွင့်ပြုချက်/ထောက်ခံချက်အမှတ်</span><span class="eng">Permit/Endorsement No</span></label> <b class="text-danger">*</b>
								<br>
							<input type="text" class="form-control" name="PermitNo" value="{{Auth::user()->profile->PermitNo}}" required>
							<small class="text-danger" style="font-weight: bold;">*&nbsp;(MIC Permit ပါအတိုင်း မြန်မာလိုဖြည့်ရန်)</small>
						</fieldset>
					</div>
					
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ခွင့်ပြုရက်</span><span class="eng">Permitted Date</span></label>
							<input type="date" class="form-control" name="PermittedDate" 
							value="{{Auth::user()->profile->PermittedDate}}" required>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">စတင်သောနေ့</span><span class="eng">Commencement Date</span></label>
							<input type="date" class="form-control" name="CommercializationDate" 
							value="{{Auth::user()->profile->CommercializationDate}}">
						</fieldset>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col">
					    <fieldset class="form-group">
							<label ><span class="mm">
ရင်းနှီးမြှုပ်နှံသည့်အရပ်ဒေသ</span><span class="eng">Place of Investment Project</span></label> <b class="text-danger">*</b>
							<textarea type="text" class="form-control" name="Township" required>{{ Auth::user()->profile->Township}}</textarea>
							<small class="text-danger" style="font-weight: bold;">*&nbsp;(MIC Permit ပါအတိုင်း မြန်မာလိုဖြည့်ရန်)</small>
						</fieldset>
					</div>
					
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
							<label ><span class="mm">အဆိုပြု</span><span class="eng">In Proposal</span></label>
							<input type="number" class="form-control" name="StaffLocalProposal" 
							value="{{Auth::user()->profile->StaffLocalProposal}}" required>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ထပ်တိုး</span><span class="eng">Increased</span></label>
							<input type="number" class="form-control" name="StaffLocalSurplus" value="{{Auth::user()->profile->StaffLocalSurplus}}" required>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ခန့်အပ်ပြီး</span><span class="eng">Appointed</span></label>
							<input type="number" class="form-control" name="StaffLocalAppointed"  value="{{Auth::user()->profile->StaffLocalAppointed}}" required>
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
							
							<input type="number" class="form-control" name="StaffForeignProposal" value="{{Auth::user()->profile->StaffForeignProposal}}"  required min="0">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							
							<input type="number" class="form-control" name="StaffForeignSurplus" value="{{Auth::user()->profile->StaffForeignSurplus}}" required>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							
							<input type="number" class="form-control" name="StaffForeignAppointed"  value="{{Auth::user()->profile->StaffForeignAppointed}}" required>
						</fieldset>
					</div>
				</div>

                <br/>

                <div class="row mt-3">
                    <h3 class="text-center mt-3">ATTACHMENT</h3>
                </div>
                
				<div class="row mt-3">
				   <span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
                    <br><br>
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq11"><span class="mm">ခွင့်ပြုမိန့်</span><span class="eng">MIC Permit</span></label>
    					    <input type="file" class="form-control" name="AttachPermit" id="pxq11" onchange="validateFileSize(this);">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq12"><span class="mm">Proposal Employee List as per Proposal</span><span class="eng">Proposal Employee List as per Proposal</span></label>
    					<input type="file" class="form-control" name="AttachProposal" id="pxq12" onchange="validateFileSize(this);">
						</fieldset>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq13"><span class="mm">Appointed Employee List (Local & Foreign)</span><span class="eng">Appointed Employee List (Local & Foreign)</span></label>
    					<input type="file" class="form-control" name="AttachAppointed" id="pxq13" onchange="validateFileSize(this);">
						</fieldset>
					</div>

					<div class="col">
						<fieldset class="form-group">
							<label for="pxq14"><span class="mm">Increased Employee List (If Any)</span><span class="eng">Increased Employee List (If Any)</span></label>
    					<input type="file" class="form-control" name="AttachIncreased" id="pxq14" accept=".pdf" onchange="validateFileSize(this);">
						</fieldset>
					</div>
				</div>
				
				<button type="submit" class="btn btn-primary mt-4 mb-3">Submit</button>
			</form>
</div>

@else
	<hr style="opacity: 0.4">

	<h5 style="color: green;" class="text-center"></h5>

	<div class="container mb-5" style="">
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <span><strong><span class="mm">Formကိုအတည်ပြုပြီးပြီ။</span><span class="eng">Your form had been already approved.</span></strong></span>
		  <span><strong><span class="mm">Do something AMAZING!!</span><span class="eng">Do something AMAZING!!</span></strong></span>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	</div>
@endif
	

@endsection