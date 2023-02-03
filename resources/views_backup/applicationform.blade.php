@extends('layout')
@section('content')
<style>
/* Style the tab */
.tab {
	overflow: hidden;
	/*border: 1px solid #ccc;*/
	/*background-color: #f1f1f1;*/
}

/* Style the buttons inside the tab */
.tab button {
	background-color: #9894e5;
	color: white;
	float: left;
	border: none;
	outline: none;
	cursor: pointer;
	padding: 14px 16px;
	transition: 0.3s;
	font-size: 15px;
}

/* Change background color of buttons on hover */
.tab button:hover {
	background-color: #7a7acf;
}

/* Create an active/current tablink class */
.tab button.active {
	background-color: #524bef;
}

/* Style the tab content */
.tabcontent {
	display: none;
	padding: 6px 12px;
	border: 1px solid green;
	-webkit-animation: fadeEffect 1s;
	animation: fadeEffect 1s;
}

/* Fade in tabs */
@-webkit-keyframes fadeEffect {
	from {opacity: 0;}
	to {opacity: 1;}
}

@keyframes fadeEffect {
	from {opacity: 0;}
	to {opacity: 1;}
}

.mybutton {
	/* background-color: #4CAF50 !important; */
	background-color: #4CAF50; /* Green */
	border: none;
	color: white;
	
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 16px;
}

.modal-dialog {
          max-width: 1000px; /* New width for default modal */
     }
</style>
<script>
	function validateFileSize(input) {
		const fileSize = input.files[0].size 
		if (fileSize > 3145728) {
		alert('Attach File Size Must Be Lower Than 3 MB');
		input.value='';
		}
	}
</script>

<form class="form-inline" method="POST" action="{{ route('applyform.store') }}" enctype="multipart/form-data" id="myForm"  onsubmit="return true;">
	@csrf
	@foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
    @if (session('error'))
		<div class="alert alert-danger">{{ session('error') }}</div>
	@endif
	<div class="container mt-3 mb-4">
		{{-- <h3 class="text-center">Application Form</h3> --}}
		{{-- <p class="text-danger text-center d-none" id="disableMsg"> <strong>Please wait until your previous form approve!</strong></p> --}}

		<div class="tab row">
			<div class="col-md-10 col-sm-6">
				<button class="tablinks active company" type="button" id="Mytab0" onclick="openCity(event, 'Company')">Company</button>
				<button class="tablinks applicant1" type="button" id="Mytab1" onclick="openCity(event, 'Applicant1')">Applicant - 1</button>
				<button class="tablinks applicant2" type="button" id="Mytab2" onclick="openCity(event, 'Applicant2')" style="display: none;">Applicant - 2</button>
				<button class="tablinks applicant3" type="button" id="Mytab3" onclick="openCity(event, 'Applicant3')" style="display: none;">Applicant - 3</button>
				<button class="tablinks applicant4" type="button" id="Mytab4" onclick="openCity(event, 'Applicant4')" style="display: none;">Applicant - 4</button>
				<button class="tablinks applicant5" type="button" id="Mytab5" onclick="openCity(event, 'Applicant5')" style="display: none;">Applicant - 5</button>
				<button class="tablinks applicant6" type="button" id="Mytab6" onclick="openCity(event, 'Applicant6')" style="display: none;">Applicant - 6</button>
				<button class="tablinks applicant7" type="button" id="Mytab7" onclick="openCity(event, 'Applicant7')" style="display: none;">Applicant - 7</button>
			</div>

			<div class="col-md-2 col-sm-6">	
				<a class="btn mybutton" id="applySubmit" style="margin-right: 20px;background-color: #4CAF50;" data-toggle="modal" data-target="#applicationModal" >Submit</a>
				<a class="btn-outline-success btn btn-sm" id="add_tab" onclick="ShowTab()"><i class="fa fa-plus" aria-hidden="true"></i></a>
				<a class="btn-outline-danger btn btn-sm" id="remove_tab" onclick="HideTab()"><i class="fa fa-minus" aria-hidden="true"></i></a>
			</div>

		</div>
		
		
		<div id="Company" class="tabcontent" style="display: block;">

			<input type="hidden" value="{{Auth::user()->id}}" name="user_id">
			<input type="hidden" value="{{$profile->id}}" name="profile_id">
			<div class="container mb-5">
				<h3 class="text-center mt-4"><span class="mm">ကုမ္ပဏီအချက်အလက်</span><span class="eng">COMPANY PROFILE</span></h3>
				<br/>

				<div class="row">
					<div class="col-6">
						<fieldset class="form-group">
							<label ><span class="mm">ကုမ္ပဏီအမည်</span><span class="eng">Company Name</span></label>
							<input type="text" disabled value="{{$profile->CompanyName}}" class="form-control" name="CompanyName" id="comName">
						</fieldset>
					</div>

					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ကုမ္ပဏီလျှောက်လွှာအမှတ်</span><span class="eng">Company Registeration No</span></label>
							<input type="text" disabled value="{{$profile->CompanyRegistrationNo}}" class="form-control" name="CompanyRegistrationNo">
						</fieldset>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">လုပ်ငန်းအမျိုုးအစား</span><span class="eng">Business Type</span></label>
							<br/>
							<textarea class="form-control" name="BusinessType" disabled>{{$profile->BusinessType}}</textarea>
						</fieldset>
					</div>
				</div>

				<br/>

				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">
							<label ></label>
							<input disabled type="text" disabled class="form-control" style="border: 0;" value="Numbers of Local Staff">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">အဆိုပြု </span><span class="eng">In Proposal</span></label>
							<input type="text" value="{{$profile->StaffLocalProposal}}" class="form-control" name="StaffLocalProposal" readonly>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ထပ်တိုး</span><span class="eng">Increased</span></label>
							<input type="text" value="{{$profile->StaffLocalSurplus}}" class="form-control" name="StaffLocalSurplus" readonly>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">စုစုပေါင်း</span><span class="eng">Total</span></label>
							<input type="text" value="{{$total_local}}" class="form-control" readonly>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ခန့်အပ်ပြီး</span><span class="eng">Appointed</span></label>
							<input type="text" value="{{$profile->StaffLocalAppointed}}" class="form-control" name="StaffLocalAppointed" readonly>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label ><span class="mm">ခန့်ရန်ကျန်</span><span class="eng">Available</span></label>
							<input type="text" value="{{$available_local}}" class="form-control" readonly>
						</fieldset>
					</div>
				</div>

				<div class="row mt-3">
					<div class="col">
						<fieldset class="form-group">

							<input disabled type="text" disabled class="form-control" style="border: 0;" value="Numbers of Foreign Staff" readonly>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">

							<input type="text" value="{{$profile->StaffForeignProposal}}" class="form-control" name="StaffForeignProposal" readonly>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">

							<input type="text" value="{{$profile->StaffForeignSurplus}}" class="form-control" name="StaffForeignSurplus" readonly>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">

							<input type="text" value="{{$total_foreign}}" class="form-control" readonly>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">

							<input type="text" value="{{$profile->StaffForeignAppointed}}" class="form-control" name="StaffForeignAppointed" readonly>
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">

							<input type="text" value="{{$available_foreign}}" class="form-control" readonly>
						</fieldset>
					</div>
				</div>

				<br/>

				<div class="row mt-3 d-none">
					<h3 class="text-center mt-3">ATTACHMENT</h3>
				</div>

				<div class="row mt-3 d-none">
					<span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note:</b> The following documents need to be attached (PDF File Only) </span>
					<br>

					{{-- <div class="col">
						<fieldset class="form-group">
							<label for="pxq11"><span class="mm">E-Visaပါရှိသော် ပါတ်စ်ပို့၏ အရှေ့စာမျက်နာ . အနောက်စာမျက်နာ နှင့် ဗီဇာတံဆိပ်ခေါင်းစာမျက်နှာ မိတ္တူ </span><span class="eng">Copy of passport first page. Lastest page and visa stamp page with (E-Visa)</span></label>
							<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
							<small class="text-danger"><span class="mm">သင်ကညွှန်ကြားသူမဟုတ်၊ အစုရှယ်ယာရှင်မဟုတ်လျှင်သာထောက်ပံ့သည်။</span><span class="eng">Provied only if you are not adirector or shareholder.</span></small>
							<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
						</fieldset>
					</div> --}}
					<script>
						$(document).ready(function() {
							var i = 0;

							$("#add").click(function() {

								++i;

								$("#CompanyTable").append('<tr><td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
							});

							$(document).on('click', '.remove-tr', function() {
								$(this).parents('tr').remove();
							});

						});
					</script>

					<table class="table table-bordered" id="CompanyTable">
						<tr>
							<th>File</th>
							<th>Description</th>
							<th>Action</th>
						</tr>
						<tr>
							<td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath[]" placeholder="Enter your Name" class="form-control" /></td>
							<td><input type="text" name="Description[]" placeholder="Enter attachment description" class="form-control" /></td>
							<td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
						</tr>
					</table>
				</div>

			</div>
			{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
			{{-- <button type="button" class="btn btn-primary mb-3 mytab">Next</button> --}}
		</div>

		<div id="Applicant1" class="tabcontent">
			<h3 class="text-center mt-4" style="text-transform: uppercase;">APPLICANT-1 INFORMATION</h3>
			<br/>

			<div class="row">
				<div class="col-6">
					<fieldset class="form-group">	
						<label ><span class="mm">နာမည်</span><span class="eng">Name</span></label>
						<input type="text" class="form-control" name="PersonName1"  id="PersonName1" required>
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span></label>
						<select class="form-control" name="nationality_id1" required id="nationality_id1">
							<option value="">Choose</option>
							@foreach($nationalities as $n)
							<option value="{{$n->id}}" >{{$n->NationalityName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq13"><span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span></label>
						<input type="text" class="form-control PassportNo1" name="PassportNo1" id="pxq13" required>
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">MIC မှအတည်ပြုသည့်ရက်စွဲ</span><span class="eng">MIC Approve Date</span></label>
						<input type="date" class="form-control StayAllowDate1" name="StayAllowDate1" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span><span id="TwoMonthWarning1" style="color:red;visibility: hidden;"><small><span class="mm">နှစ်လမတိုင်ခင်ထက်မစောစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
						<input type="date" class="form-control StayExpireDate1" name="StayExpireDate1" id="StayExpireDate1" onchange="checkTwoMonth('StayExpireDate1','TwoMonthWarning1','stay_type_id1')">
						<!-- <input type="date" class="form-control" name="StayExpireDate1" id="pxq15" onchange="checkTwoMonth(this.value,'TwoMonthWarning1')"> -->
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">
						လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id1" id="applicantType1" onchange="checkApplicantType1(this.value);changeAttachmentLabel('applicantType1','attachmentLabel1')" required>
							<option value="">Choose</option>
							@foreach($person_types as $pt)
							<option value="{{$pt->id}}">{{$pt->PersonTypeName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="abc231"><span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span></label>
						<input type="date" class="form-control" name="DateOfBirth1" id="abc231" onchange="checkAge('relationship1','abc231','relation1')">
					</fieldset>
				</div>
				<div class="col col-md-3">
					<fieldset class="form-group">
						<label ><span class="mm">
						ကျား၊မ</span><span class="eng">Gender</span></label>
						<div class="radio">
							<label>
								<input type="radio" name="Gender1" value="Male" checked>
								Male
							</label>
							<label>
								<input type="radio" name="Gender1" value="Female">
								Female
							</label>
						</div>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<label ><span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id1" id="visa_type_id1">
						<option value="">Not Apply</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span><small id="alertmsg1" class="d-none text-danger"> * </small></label>
					<select class="form-control" name="stay_type_id1" id="stay_type_id1" onchange="checkTwoMonth('StayExpireDate1','TwoMonthWarning1','stay_type_id1')">
						<option value="">Not Apply</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type1">
					<label ><span class="mm">
					အလုပ်သမားကတ်အမျိုးအစား</span><span class="eng">Labour Card Type</span><small class="text-danger d-none" id="labouralert1"> * </small></label>
					<select class="form-control" name="labour_card_type_id1" id="labour_card_type_id1">
						<option value="">Not Apply</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
					
				</div>
				<div class="col" id="labourduration1" style="display: none;">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Labour Stay Duration </span></label>
					<select class="form-control" name="labour_card_duration1" id="labour_card_duration1">
						@foreach($labour_card_duration as $lcd)
						<option value="{{$lcd->id}}">{{$lcd->LabourCardDuration}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant1">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation1" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id1" id="relationship1" onchange="checkAge('relationship1','abc231','relation1')">
							<option value="">Choose</option>
							@foreach($relation_ships as $rs)
							<option value="{{$rs->id}}">{{$rs->RelationShipName}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="abc125">Relation with (eg. Mr. John Smith)</label>
							<textarea type="text" class="form-control" name="Remark1" id="abc125"></textarea>
						</fieldset>
					</div>
				</div>
			</div>


			<br/>

			<div class="row mt-5">
				<h3 class="text-center mt-3">APPLICANT-1 ATTACHMENT</h3>
			</div>

			<div class="row mt-3">
				<span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
				<br>
				<p id="attachmentLabel1">Necessary Documents of the Applicant</p>
				{{-- <div class="col">
					<fieldset class="form-group">
						<label for="pxq11"><span class="mm">နိုင်ငံကူးလက်မှတ်ပထမစာမျက်နှာ။ နောက်ဆုံးစာမျက်နှာနှင့်ဗီဇာတံဆိပ်ခေါင်းစာမျက်နှာ (E-Visa) မိင်္တတူ</span><span class="eng">Copy of passport first page. Lastest page and visa stamp page with (E-Visa)</span></label>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach1").click(function() {

							++i;

							$("#ApplicantTable1").append('<tr><td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath1[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description1[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach1">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach1', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable1">
					<tr>
						<th>File</th>
						<th>Description <span class="text-danger d-none" id="desmsg1"> * </span></th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath1[]" placeholder="Enter your Name" class="form-control" id="file1" /></td>
						<td>
							<input type="text" name="Description1[]" placeholder="Enter attachment description" class="form-control" id="des1" />
							
						</td>
						<td><button type="button" name="add_applicant_attach1" id="add_applicant_attach1" class="btn btn-success">Add More</button></td>
					</tr>
				</table>
			</div>
			{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
		</div>

		<div id="Applicant2" class="tabcontent">
			<h3 class="text-center mt-4" style="text-transform: uppercase;">APPLICANT-2 INFORMATION</h3>
			<br/>

			<div class="row">
				<div class="col-6">
					<fieldset class="form-group">
						<label ><span class="mm">နာမည်</span><span class="eng">Name</span></label>
						<input type="text" class="form-control" name="PersonName2" id="PersonName2">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id2" id="nationality_id2">
							<option value="">Choose</option>
							@foreach($nationalities as $n)
							<option value="{{$n->id}}">{{$n->NationalityName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq13"><span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span></label>
						<input type="text" class="form-control PassportNo2" name="PassportNo2" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">MIC မှအတည်ပြုသည့်ရက်စွဲ</span><span class="eng">MIC Approve Date</span></label>
						<input type="date" class="form-control StayAllowDate2" name="StayAllowDate2" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<!-- <label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate2" id="pxq15"> -->
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span><span id="TwoMonthWarning2" style="color:red;visibility: hidden;"><small><span class="mm">နှစ်လမတိုင်ခင်ထက်မစောစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
						<input type="date" class="form-control StayExpireDate2" name="StayExpireDate2" id="StayExpireDate2" onchange="checkTwoMonth('StayExpireDate2','TwoMonthWarning2','stay_type_id2')">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id2" id="applicantType2" onchange="checkApplicantType2(this.value);changeAttachmentLabel('applicantType2','attachmentLabel2')">
							<option value="">Choose</option>
							@foreach($person_types as $pt)
							<option value="{{$pt->id}}">{{$pt->PersonTypeName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="abc232"><span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span></label>
						<input type="date" class="form-control" name="DateOfBirth2" id="abc232" onchange="checkAge('relationship2','abc232','relation2')">
					</fieldset>
				</div>
				<div class="col col-md-3">
					<fieldset class="form-group">
						<label ><span class="mm">ကျား၊မ</span><span class="eng">Gender</span></label>
						<div class="radio">
							<label>
								<input type="radio" name="Gender2" value="Male" checked>
								Male
							</label>
							<label>
								<input type="radio" name="Gender2" value="Female">
								Female
							</label>
						</div>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<label ><span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id2" id="visa_type_id2">
						<option value="">Not Apply</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id2" id="stay_type_id2" onchange="checkTwoMonth('StayExpireDate2','TwoMonthWarning2','stay_type_id2')">
						<option value="">Not Apply</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type2">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id2" id="labour_card_type_id2">
						<option value="">Not Apply</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labourduration2" style="display: none;">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Labour Stay Duration</span></label>
					<select class="form-control" name="labour_card_duration2" id="labour_card_duration2">
						@foreach($labour_card_duration as $lcd)
						<option value="{{$lcd->id}}">{{$lcd->LabourCardDuration}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant2">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation2" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id2" id="relationship2" onchange="checkAge('relationship2','abc232','relation2')">
							<option value="">Choose</option>
							@foreach($relation_ships as $rs)
							<option value="{{$rs->id}}">{{$rs->RelationShipName}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="abc125">Relation with (eg. Mr. John Smith)</label>
							<textarea type="text" class="form-control" name="Remark2" id="abc125"></textarea>
						</fieldset>
					</div>
				</div>
			</div>


			<br/>

			<div class="row mt-5">
				<h3 class="text-center mt-3">APPLICANT-2 ATTACHMENT</h3>
			</div>

			<div class="row mt-3">
				<span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
				<br>
				<p id="attachmentLabel2">Necessary Documents of the Applicant</p>
				{{-- <div class="col">
					<fieldset class="form-group">
						<label for="pxq11"><span class="mm">နိုင်ငံကူးလက်မှတ်ပထမစာမျက်နှာ။ နောက်ဆုံးစာမျက်နှာနှင့်ဗီဇာတံဆိပ်ခေါင်းစာမျက်နှာ (E-Visa)</span><span class="eng">Copy of passport first page. Lastest page and visa stamp page with (E-Visa)</span></label>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach2").click(function() {

							++i;

							$("#ApplicantTable2").append('<tr><td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath2[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description2[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach2">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach2', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable2">
					<tr>
						<th>File</th>
						<th>Description<span class="text-danger d-none" id="desmsg2"> * </span></th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath2[]" placeholder="Enter your Name" class="form-control" id="file2" /></td>
						<td><input type="text" name="Description2[]" placeholder="Enter attachment description" class="form-control"  id="des2"/></td>
						<td><button type="button" name="add_applicant_attach2" id="add_applicant_attach2" class="btn btn-success">Add More</button></td>
					</tr>
				</table>
			</div>
			{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
		</div>

		<div id="Applicant3" class="tabcontent">
			<h3 class="text-center mt-4" style="text-transform: uppercase;">APPLICANT-3 INFORMATION</h3>
			<br/>

			<div class="row">
				<div class="col-6">
					<fieldset class="form-group">
						<label ><span class="mm">နာမည်</span><span class="eng">Name</span></label>
						<input type="text" class="form-control" name="PersonName3" id="PersonName3">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id3" id="nationality_id3">
							<option value="">Choose</option>
							@foreach($nationalities as $n)
							<option value="{{$n->id}}">{{$n->NationalityName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq13"><span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span></label>
						<input type="text" class="form-control PassportNo3" name="PassportNo3" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">MIC မှအတည်ပြုသည့်ရက်စွဲ</span><span class="eng">MIC Approve Date</span></label>
						<input type="date" class="form-control StayAllowDate3" name="StayAllowDate3" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<!-- <label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate3" id="pxq15"> -->
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span><span id="TwoMonthWarning3" style="color:red;visibility: hidden;"><small><span class="mm">နှစ်လမတိုင်ခင်ထက်မစောစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
						<input type="date" class="form-control StayExpireDate3" name="StayExpireDate3" id="StayExpireDate3" onchange="checkTwoMonth('StayExpireDate3','TwoMonthWarning3','stay_type_id3')">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id3" id="applicantType3" onchange="checkApplicantType3(this.value);changeAttachmentLabel('applicantType3','attachmentLabel3')">
							<option value="">Choose</option>
							@foreach($person_types as $pt)
							<option value="{{$pt->id}}">{{$pt->PersonTypeName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="abc233"><span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span></label>
						<input type="date" class="form-control" name="DateOfBirth3" id="abc233" onchange="checkAge('relationship3','abc233','relation3')">
					</fieldset>
				</div>
				<div class="col col-md-3">
					<fieldset class="form-group">
						<label ><span class="mm">ကျား၊မ</span><span class="eng">Gender</span></label>
						<div class="radio">
							<label>
								<input type="radio" name="Gender3" value="Male" checked>
								Male
							</label>
							<label>
								<input type="radio" name="Gender3" value="Female">
								Female
							</label>
						</div>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<label ><span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id3" id="visa_type_id3">
						<option value="">Not Apply</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id3" id="stay_type_id3"  onchange="checkTwoMonth('StayExpireDate3','TwoMonthWarning3','stay_type_id3')">
						<option value="">Not Apply</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type3">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id3" id="labour_card_type_id3">
						<option value="">Not Apply</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labourduration3" style="display: none;">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Labour Stay Duration</span></label>
					<select class="form-control" name="labour_card_duration3" id="labour_card_duration3">
						@foreach($labour_card_duration as $lcd)
						<option value="{{$lcd->id}}">{{$lcd->LabourCardDuration}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant3">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation3" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id3" id="relationship3" onchange="checkAge('relationship3','abc233','relation3')">
							<option value="">Choose</option>
							@foreach($relation_ships as $rs)
							<option value="{{$rs->id}}">{{$rs->RelationShipName}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="abc125">Relation with (eg. Mr. John Smith)</label>
							<textarea type="text" class="form-control" name="Remark3" id="abc125"></textarea>
						</fieldset>
					</div>
				</div>
			</div>


			<br/>

			<div class="row mt-5">
				<h3 class="text-center mt-3">APPLICANT-3 ATTACHMENT</h3>
			</div>

			<div class="row mt-3">
				<span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
				<br>
				<p id="attachmentLabel3">Necessary Documents of the Applicant</p>
				{{-- <div class="col">
					<fieldset class="form-group">
						<label for="pxq11"><span class="mm">နိုင်ငံကူးလက်မှတ်ပထမစာမျက်နှာ။ နောက်ဆုံးစာမျက်နှာနှင့်ဗီဇာတံဆိပ်ခေါင်းစာမျက်နှာ (E-Visa)</span><span class="eng">Copy of passport first page. Lastest page and visa stamp page with (E-Visa)</span></label>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach3").click(function() {

							++i;

							$("#ApplicantTable3").append('<tr><td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath3[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description3[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach3">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach3', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable3">
					<tr>
						<th>File</th>
						<th>Description<span class="text-danger d-none" id="desmsg3"> * </span></th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath3[]" placeholder="Enter your Name" class="form-control" id="file3" /></td>
						<td><input type="text" name="Description3[]" placeholder="Enter attachment description" class="form-control" id="des3"/></td>
						<td><button type="button" name="add_applicant_attach3" id="add_applicant_attach3" class="btn btn-success">Add More</button></td>
					</tr>
				</table>
			</div>
			{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
		</div>

		<div id="Applicant4" class="tabcontent">
			<h3 class="text-center mt-4" style="text-transform: uppercase;">APPLICANT-4 INFORMATION</h3>
			<br/>

			<div class="row">
				<div class="col-6">
					<fieldset class="form-group">
						<label ><span class="mm">နာမည်</span><span class="eng">Name</span></label>
						<input type="text" class="form-control" name="PersonName4" id="PersonName4">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id4" id="nationality_id4">
							<option value="">Choose</option>
							@foreach($nationalities as $n)
							<option value="{{$n->id}}">{{$n->NationalityName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq13"><span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span></label>
						<input type="text" class="form-control PassportNo4" name="PassportNo4" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">MIC မှအတည်ပြုသည့်ရက်စွဲ</span><span class="eng">MIC Approve Date</span></label>
						<input type="date" class="form-control StayAllowDate4" name="StayAllowDate4" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<!-- <label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate4" id="pxq15"> -->
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span><span id="TwoMonthWarning4" style="color:red;visibility: hidden;"><small><span class="mm">နှစ်လမတိုင်ခင်ထက်မစောစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
						<input type="date" class="form-control StayExpireDate4" name="StayExpireDate4" id="StayExpireDate4" onchange="checkTwoMonth('StayExpireDate4','TwoMonthWarning4','stay_type_id4')">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id4" id="applicantType4" onchange="checkApplicantType4(this.value);changeAttachmentLabel('applicantType4','attachmentLabel4')">
							<option value="">Choose</option>
							@foreach($person_types as $pt)
							<option value="{{$pt->id}}">{{$pt->PersonTypeName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="abc234"><span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span></label>
						<input type="date" class="form-control" name="DateOfBirth4" id="abc234" onchange="checkAge('relationship4','abc234','relation4')">
					</fieldset>
				</div>
				<div class="col col-md-3">
					<fieldset class="form-group">
						<label ><span class="mm">ကျား၊မ</span><span class="eng">Gender</span></label>
						<div class="radio">
							<label>
								<input type="radio" name="Gender4" value="Male" checked>
								Male
							</label>
							<label>
								<input type="radio" name="Gender4" value="Female">
								Female
							</label>
						</div>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<label ><span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id4" id="visa_type_id4">
						<option value="">Not Apply</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id4" id="stay_type_id4"  onchange="checkTwoMonth('StayExpireDate4','TwoMonthWarning4','stay_type_id4')">
						<option value="">Not Apply</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type4">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id4" id="labour_card_type_id4">
						<option value="">Not Apply</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labourduration4" style="display: none;">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Labour Stay Duration</span></label>
					<select class="form-control" name="labour_card_duration4" id="labour_card_duration4">
						@foreach($labour_card_duration as $lcd)
						<option value="{{$lcd->id}}">{{$lcd->LabourCardDuration}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant4">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation4" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id4" id="relationship4" onchange="checkAge('relationship4','abc234','relation4')">
							<option value="">Choose</option>
							@foreach($relation_ships as $rs)
							<option value="{{$rs->id}}">{{$rs->RelationShipName}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="abc125">Relation with (eg. Mr. John Smith)</label>
							<textarea type="text" class="form-control" name="Remark4" id="abc125"></textarea>
						</fieldset>
					</div>
				</div>
			</div>


			<br/>

			<div class="row mt-5">
				<h3 class="text-center mt-3">APPLICANT-4 ATTACHMENT</h3>
			</div>

			<div class="row mt-3">
				<span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
				<br>
				<p id="attachmentLabel4">Necessary Documents of the Applicant</p>
				{{-- <div class="col">
					<fieldset class="form-group">
						<label for="pxq11"><span class="mm">နိုင်ငံကူးလက်မှတ်ပထမစာမျက်နှာ။ နောက်ဆုံးစာမျက်နှာနှင့်ဗီဇာတံဆိပ်ခေါင်းစာမျက်နှာ (E-Visa)</span><span class="eng">Copy of passport first page. Lastest page and visa stamp page with (E-Visa)</span></label>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach4").click(function() {

							++i;

							$("#ApplicantTable4").append('<tr><td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath4[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description4[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach4">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach4', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable4">
					<tr>
						<th>File</th>
						<th>Description<span class="text-danger d-none" id="desmsg4"> * </span></th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath4[]" placeholder="Enter your Name" class="form-control" id="file4" /></td>
						<td><input type="text" name="Description4[]" placeholder="Enter attachment description" class="form-control" id="des4" /></td>
						<td><button type="button" name="add_applicant_attach4" id="add_applicant_attach4" class="btn btn-success">Add More</button></td>
					</tr>
				</table>
			</div>
			{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
		</div>

		<div id="Applicant5" class="tabcontent">
			<h3 class="text-center mt-4" style="text-transform: uppercase;">APPLICANT-5 INFORMATION</h3>
			<br/>

			<div class="row">
				<div class="col-6">
					<fieldset class="form-group">
						<label ><span class="mm">နာမည်</span><span class="eng">Name</span></label>
						<input type="text" class="form-control" name="PersonName5" id="PersonName5">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id5" id="nationality_id5">
							<option value="">Choose</option>
							@foreach($nationalities as $n)
							<option value="{{$n->id}}">{{$n->NationalityName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq13"><span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span></label>
						<input type="text" class="form-control PassportNo5" name="PassportNo5" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">MIC မှအတည်ပြုသည့်ရက်စွဲ</span><span class="eng">MIC Approve Date</span></label>
						<input type="date" class="form-control StayAllowDate5" name="StayAllowDate5" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<!-- <label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate5" id="pxq15"> -->
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span><span id="TwoMonthWarning5" style="color:red;visibility: hidden;"><small><span class="mm">နှစ်လမတိုင်ခင်ထက်မစောစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
						<input type="date" class="form-control StayExpireDate5" name="StayExpireDate5" id="StayExpireDate5" onchange="checkTwoMonth('StayExpireDate5','TwoMonthWarning5','stay_type_id5')">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id5" id="applicantType5" onchange="checkApplicantType5(this.value);changeAttachmentLabel('applicantType5','attachmentLabel5')">
							<option value="">Choose</option>
							@foreach($person_types as $pt)
							<option value="{{$pt->id}}">{{$pt->PersonTypeName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="abc235"><span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span></label>
						<input type="date" class="form-control" name="DateOfBirth5" id="abc235" onchange="checkAge('relationship5','abc235','relation5')">
					</fieldset>
				</div>
				<div class="col col-md-3">
					<fieldset class="form-group">
						<label ></label>
						<div class="rGenderadio">
							<label>
								<input type="radio" name="Gender5" value="Male" checked>
								Male
							</label>
							<label>
								<input type="radio" name="Gender5" value="Female">
								Female
							</label>
						</div>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<label ><span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id5" id="visa_type_id5">
						<option value="">Not Apply</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id5" id="stay_type_id5"  onchange="checkTwoMonth('StayExpireDate5','TwoMonthWarning5','stay_type_id5')">
						<option value="">Not Apply</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type5">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id5" id="labour_card_type_id5">
						<option value="">Not Apply</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labourduration5" style="display: none;">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Labour Stay Duration</span></label>
					<select class="form-control" name="labour_card_duration5" id="labour_card_duration5">
						@foreach($labour_card_duration as $lcd)
						<option value="{{$lcd->id}}">{{$lcd->LabourCardDuration}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant5">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation5" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id5" id="relationship5" onchange="checkAge('relationship5','abc235','relation5')">
							<option value="">Choose</option>
							@foreach($relation_ships as $rs)
							<option value="{{$rs->id}}">{{$rs->RelationShipName}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="abc125">Relation with (eg. Mr. John Smith)</label>
							<textarea type="text" class="form-control" name="Remark5" id="abc125"></textarea>
						</fieldset>
					</div>
				</div>
			</div>


			<br/>

			<div class="row mt-5">
				<h3 class="text-center mt-3">APPLICANT-5 ATTACHMENT</h3>
			</div>

			<div class="row mt-3">
				<span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
				<br>
				<p id="attachmentLabel5">Necessary Documents of the Applicant</p>
				{{-- <div class="col">
					<fieldset class="form-group">
						<label for="pxq11"><span class="mm">နိုင်ငံကူးလက်မှတ်ပထမစာမျက်နှာ။ နောက်ဆုံးစာမျက်နှာနှင့်ဗီဇာတံဆိပ်ခေါင်းစာမျက်နှာ (E-Visa)</span><span class="eng">Copy of passport first page. Lastest page and visa stamp page with (E-Visa)</span></label>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach5").click(function() {

							++i;

							$("#ApplicantTable5").append('<tr><td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath5[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description5[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach5">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach5', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable5">
					<tr>
						<th>File</th>
						<th>Description<span class="text-danger d-none" id="desmsg5"> * </span></th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath5[]" placeholder="Enter your Name" class="form-control" id="file5" /></td>
						<td><input type="text" name="Description5[]" placeholder="Enter attachment description" class="form-control" id="des5" /></td>
						<td><button type="button" name="add_applicant_attach5" id="add_applicant_attach5" class="btn btn-success">Add More</button></td>
					</tr>
				</table>
			</div>
			{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
		</div>

		<div id="Applicant6" class="tabcontent">
			<h3 class="text-center mt-4" style="text-transform: uppercase;">APPLICANT-6 INFORMATION</h3>
			<br/>

			<div class="row">
				<div class="col-6">
					<fieldset class="form-group">
						<label ><span class="mm">နာမည်</span><span class="eng">Name</span></label>
						<input type="text" class="form-control" name="PersonName6" id="PersonName6">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id6" id="nationality_id6">
							<option value="">Choose</option>
							@foreach($nationalities as $n)
							<option value="{{$n->id}}">{{$n->NationalityName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq13"><span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span></label>
						<input type="text" class="form-control PassportNo6" name="PassportNo6" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">MIC မှအတည်ပြုသည့်ရက်စွဲ</span><span class="eng">MIC Approve Date</span></label>
						<input type="date" class="form-control StayAllowDate6" name="StayAllowDate6" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<!-- <label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate6" id="pxq15"> -->
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span><span id="TwoMonthWarning6" style="color:red;visibility: hidden;"><small><span class="mm">နှစ်လမတိုင်ခင်ထက်မစောစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
						<input type="date" class="form-control StayExpireDate6" name="StayExpireDate6" id="StayExpireDate6" onchange="checkTwoMonth('StayExpireDate6','TwoMonthWarning6','stay_type_id6')">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id6" id="applicantType6" onchange="checkApplicantType6(this.value);changeAttachmentLabel('applicantType6','attachmentLabel6')">
							<option value="">Choose</option>
							@foreach($person_types as $pt)
							<option value="{{$pt->id}}">{{$pt->PersonTypeName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="abc236"><span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span></label>
						<input type="date" class="form-control" name="DateOfBirth6" id="abc236" onchange="checkAge('relationship6','abc236','relation6')">
					</fieldset>
				</div>
				<div class="col col-md-3">
					<fieldset class="form-group">
						<label ><span class="mm">ကျား၊မ</span><span class="eng">Gender</span></label>
						<div class="radio">
							<label>
								<input type="radio" name="Gender6" value="Male" checked>
								Male
							</label>
							<label>
								<input type="radio" name="Gender6" value="Female">
								Female
							</label>
						</div>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<label ><span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id6" id="visa_type_id6">
						<option value="">Not Apply</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id6" id="stay_type_id6"  onchange="checkTwoMonth('StayExpireDate6','TwoMonthWarning6','stay_type_id6')">
						<option value="">Not Apply</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type6">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id6" id="labour_card_type_id6">
						<option value="">Not Apply</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labourduration6" style="display: none;">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Labour Stay Duration</span></label>
					<select class="form-control" name="labour_card_duration6" id="labour_card_duration6">
						@foreach($labour_card_duration as $lcd)
						<option value="{{$lcd->id}}">{{$lcd->LabourCardDuration}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant6">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation6" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id6" id="relationship6" onchange="checkAge('relationship6','abc236','relation6')">
							<option value="">Choose</option>
							@foreach($relation_ships as $rs)
							<option value="{{$rs->id}}">{{$rs->RelationShipName}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="abc125">Relation with (eg. Mr. John Smith)</label>
							<textarea type="text" class="form-control" name="Remark6" id="abc125"></textarea>
						</fieldset>
					</div>
				</div>
			</div>


			<br/>

			<div class="row mt-5">
				<h3 class="text-center mt-3">APPLICANT-6 ATTACHMENT</h3>
			</div>

			<div class="row mt-3">
				<span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
				<br>
				<p id="attachmentLabel6">Necessary Documents of the Applicant</p>
				{{-- <div class="col">
					<fieldset class="form-group">
						<label for="pxq11"><span class="mm">နိုင်ငံကူးလက်မှတ်ပထမစာမျက်နှာ။ နောက်ဆုံးစာမျက်နှာနှင့်ဗီဇာတံဆိပ်ခေါင်းစာမျက်နှာ (E-Visa)</span><span class="eng">Copy of passport first page. Lastest page and visa stamp page with (E-Visa)</span></label>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach6").click(function() {

							++i;

							$("#ApplicantTable6").append('<tr><td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath6[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description6[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach6">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach6', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable6">
					<tr>
						<th>File</th>
						<th>Description<span class="text-danger d-none" id="desmsg6"> * </span></th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath6[]" placeholder="Enter your Name" class="form-control" id="file6" /></td>
						<td><input type="text" name="Description6[]" placeholder="Enter attachment description" class="form-control" id="des6" /></td>
						<td><button type="button" name="add_applicant_attach6" id="add_applicant_attach6" class="btn btn-success">Add More</button></td>
					</tr>
				</table>
			</div>
			{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
		</div>

		<div id="Applicant7" class="tabcontent">
			<h3 class="text-center mt-4" style="text-transform: uppercase;">APPLICANT-7 INFORMATION</h3>
			<br/>

			<div class="row">
				<div class="col-6">
					<fieldset class="form-group">
						<label ><span class="mm">နာမည်</span><span class="eng">Name</span></label>
						<input type="text" class="form-control" name="PersonName7" id="PersonName7">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id7" id="nationality_id7">
							<option value="">Choose</option>
							@foreach($nationalities as $n)
							<option value="{{$n->id}}">{{$n->NationalityName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq13"><span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span></label>
						<input type="text" class="form-control PassportNo7" name="PassportNo7" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">MIC မှအတည်ပြုသည့်ရက်စွဲ</span><span class="eng">MIC Approve Date</span></label>
						<input type="date" class="form-control StayAllowDate7" name="StayAllowDate7" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<!-- <label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate7" id="pxq15"> -->
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span><span id="TwoMonthWarning7" style="color:red;visibility: hidden;"><small><span class="mm">နှစ်လမတိုင်ခင်ထက်မစောစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
						<input type="date" class="form-control StayExpireDate7" name="StayExpireDate7" id="StayExpireDate7" onchange="checkTwoMonth('StayExpireDate7','TwoMonthWarning7','stay_type_id7')">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id7" id="applicantType7" onchange="checkApplicantType7(this.value);changeAttachmentLabel('applicantType7','attachmentLabel7')">
							<option value="">Choose</option>
							@foreach($person_types as $pt)
							<option value="{{$pt->id}}">{{$pt->PersonTypeName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="abc237"><span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span></label>
						<input type="date" class="form-control" name="DateOfBirth7" id="abc237" onchange="checkAge('relationship7','abc237','relation7')">
					</fieldset>
				</div>
				<div class="col col-md-3">
					<fieldset class="form-group">
						<label ><span class="mm">ကျား၊မ</span><span class="eng">Gender</span></label>
						<div class="radio">
							<label>
								<input type="radio" name="Gender7" value="Male" checked>
								Male
							</label>
							<label>
								<input type="radio" name="Gender7" value="Female">
								Female
							</label>
						</div>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<label ><span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id7" id="visa_type_id7">
						<option value="">Not Apply</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id7" id="stay_type_id7">
						<option value="">Not Apply</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type7">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id7" id="labour_card_type_id7">
						<option value="">Not Apply</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labourduration7" style="display: none;">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Labour Stay Duration</span></label>
					<select class="form-control" name="labour_card_duration7" id="labour_card_duration7" onchange="checkTwoMonth('StayExpireDate7','TwoMonthWarning7','stay_type_id7')">
						@foreach($labour_card_duration as $lcd)
						<option value="{{$lcd->id}}">{{$lcd->LabourCardDuration}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant7">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation7" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id7" id="relationship7" onchange="checkAge('relationship7','abc237','relation7')">
							<option value="">Choose</option>
							@foreach($relation_ships as $rs)
							<option value="{{$rs->id}}">{{$rs->RelationShipName}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="abc125">Relation with (eg. Mr. John Smith)</label>
							<textarea type="text" class="form-control" name="Remark7" id="abc125"></textarea>
						</fieldset>
					</div>
				</div>
			</div>


			<br/>

			<div class="row mt-5">
				<h3 class="text-center mt-3">APPLICANT-7 ATTACHMENT</h3>
			</div>

			<div class="row mt-3">
				<span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
				<br>
				<p id="attachmentLabel7">Necessary Documents of the Applicant</p>
				{{-- <div class="col">
					<fieldset class="form-group">
						<label for="pxq11"><span class="mm">နိုင်ငံကူးလက်မှတ်ပထမစာမျက်နှာ။ နောက်ဆုံးစာမျက်နှာနှင့်ဗီဇာတံဆိပ်ခေါင်းစာမျက်နှာ (E-Visa)</span><span class="eng">Copy of passport first page. Lastest page and visa stamp page with (E-Visa)</span></label>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" onchange="validateFileSize(this);" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach7").click(function() {

							++i;

							$("#ApplicantTable7").append('<tr><td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath7[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description7[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach7">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach7', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable7">
					<tr>
						<th>File</th>
						<th>Description<span class="text-danger d-none" id="desmsg7"> * </span></th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" onchange="validateFileSize(this);" accept=".pdf" name="FilePath7[]" placeholder="Enter your Name" class="form-control" id="file7" /></td>
						<td><input type="text" name="Description7[]" placeholder="Enter attachment description" class="form-control" id="des7" /></td>
						<td><button type="button" name="add_applicant_attach7" id="add_applicant_attach7" class="btn btn-success">Add More</button></td>
					</tr>
				</table>
			</div>

		</div>

		<!-- Modal -->
		<div class="modal fade" id="applicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h7 class="modal-title" id="exampleModalLabel">ဖြည့်သွင်းထားသော အချက်အလက်များအား အောက်တွင် ဖော်ပြထားသော ဇယားနှင့် တိုက်ဆိုင်စစ်ဆေးပါရန်</h7>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      
		      <div class="modal-body">
		        <div class="row mt-3" id="checkTitle">
		        </div>
  
				<table class="table table-bordered table-responsive mt-2" id="TableHeader">
					<thead>
						<tr>
							<th>စဉ်</th>
							<th>အမည်/ရာထူး</th>
							<th>နိုင်ငံသား</th>
							<th>နိုင်ငံကူးလက်မှတ်</th>
							<th>စတင်ခန့်ထားသည့်ရက်စွဲ</th>
							<th>နေထိုင်ခွင့် ကုန်ဆုံးမည့်နေ</th>
							<th>ပြည်ဝင်ခွင့်</th>
							<th>နေထိုင်ခွင့်</th>
							<th>အလုပ်သမားကဒ်/သက်တမ်း</th>
						</tr>
					</thead>
					<tbody id="bodyhtml">
						
					</tbody>
				</table>
				
				<p id="msg1" class="text-danger d-none">ယခုလျှောက်ထားသော Applicant1 သည် လျှောက်ထားဆဲဖြစ်နေသဖြင့် ထပ်မံလျှောက်ထား၍ မရပါ။</p>
				<p id="msg2" class="text-danger d-none">ယခုလျှောက်ထားသော Applicant2 သည် လျှောက်ထားဆဲဖြစ်နေသဖြင့် ထပ်မံလျှောက်ထား၍ မရပါ။</p>
				<p id="msg3" class="text-danger d-none">ယခုလျှောက်ထားသော Applicant3 သည် လျှောက်ထားဆဲဖြစ်နေသဖြင့် ထပ်မံလျှောက်ထား၍ မရပါ။</p>
				<p id="msg4" class="text-danger d-none">ယခုလျှောက်ထားသော Applicant4 သည် လျှောက်ထားဆဲဖြစ်နေသဖြင့် ထပ်မံလျှောက်ထား၍ မရပါ။</p>
				<p id="msg5" class="text-danger d-none">ယခုလျှောက်ထားသော Applicant5 သည် လျှောက်ထားဆဲဖြစ်နေသဖြင့် ထပ်မံလျှောက်ထား၍ မရပါ။</p>
				<p id="msg6" class="text-danger d-none">ယခုလျှောက်ထားသော Applicant6 သည် လျှောက်ထားဆဲဖြစ်နေသဖြင့် ထပ်မံလျှောက်ထား၍ မရပါ။</p>
				<p id="msg7" class="text-danger d-none">ယခုလျှောက်ထားသော Applicant7 သည် လျှောက်ထားဆဲဖြစ်နေသဖြင့် ထပ်မံလျှောက်ထား၍ မရပါ။</p>


				<p class="text-danger d-none" id="labourMsg1">Applicant1 သည် အလုပ်သမားကဒ် လျှောက်ထားပြီးသားဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ခွင့်ရှိပါမည်။</p>
				<p class="text-danger d-none" id="labourMsg2">Applicant2 သည် အလုပ်သမားကဒ် လျှောက်ထားပြီးသားဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ခွင့်ရှိပါမည်။</p>
				<p class="text-danger d-none" id="labourMsg3">Applicant3 သည် အလုပ်သမားကဒ် လျှောက်ထားပြီးသားဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ခွင့်ရှိပါမည်။</p>
				<p class="text-danger d-none" id="labourMsg4">Applicant4 သည် အလုပ်သမားကဒ် လျှောက်ထားပြီးသားဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ခွင့်ရှိပါမည်။</p>
				<p class="text-danger d-none" id="labourMsg5">Applicant5 သည် အလုပ်သမားကဒ် လျှောက်ထားပြီးသားဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ခွင့်ရှိပါမည်။</p>
				<p class="text-danger d-none" id="labourMsg6">Applicant6 သည် အလုပ်သမားကဒ် လျှောက်ထားပြီးသားဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ခွင့်ရှိပါမည်။</p>
				<p class="text-danger d-none" id="labourMsg7">Applicant7 သည် အလုပ်သမားကဒ် လျှောက်ထားပြီးသားဖြစ်သောကြောင့် သက်တမ်းတိုးသာ လျှောက်ခွင့်ရှိပါမည်။</p>

				<p class="text-danger d-none" id="inputMsg">အချက်အလက်များ ပြည့်စုံစွာ ဖြည့်သွင်းပါ။</p>

				<p class="text-danger d-none" id="dateAlert">နေထိုင်ခွင့်လျှောက်ထားလိုပါက နေထိုင်ခွင့်ကုန်ဆုံးမည့်ရက် မတိုင်ခင် (၂)လ အတွင်းသာ လျှောက်ထားပါရန်</p>
				
		      </div>

		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button class="btn btn-primary" disabled style="display:none;" id="loadingGif">
		        	<i class="fas fa-1x fa-spinner fa-pulse"></i> Uploading...
		        </button>	
		        
		        {{-- <div id="loadingGif" style="display:none;"><img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif" style="opacity: 0.7px;"></div> --}}

		        <button type="submit" class="btn mybutton" id="btnsave" style="background-color: #4CAF50;" onclick="showDiv();">Confirm & Apply</button>
		      </div>
		    </div>
		  </div>
		</div>

	</form>
</div>
{{-- <?php
	$isDisable = "0";
?>
@foreach($status as $s)
	@if($s->Status != "1")
		<?php $isDisable = "1"; ?>		
	@endif
@endforeach --}}

@php
	$user_arr = json_decode(json_encode($user_info), true);
	
	//print_r($user_arr[0]['PassportNo']);
@endphp

<script src="{{ asset('js/applyform.js') }}"></script>
<script type="text/javascript">
	function showDiv() {
	  document.getElementById('btnsave').style.display = "none";
	  document.getElementById('loadingGif').style.display = "block";
	  setTimeout(function() {
	    document.getElementById('loadingGif').style.display = "none";
	    
	  },4000);
	  setTimeout(function() {
	    alert('Successfully uploaded!');
	    
	  },1000);
   		
}

	// var user_info = <?php echo json_encode($user_arr); ?>;
	// console.log(user_info);
	$('.mybutton').on('click',function(){
		var user_info = <?php echo json_encode($user_arr); ?>;

		var currentDate=new Date().getTime();
		//console.log(currentDate);

		var saveDisable = "0";
		var applicant = "0";
		//console.log(user_info);

		$.each(user_info, function(key, val) {
			var substractDate=new Date(user_info[key]['StayExpireDate']).getTime();

			const daydiff = currentDate-substractDate;	
			var numberOfDays = Math.trunc(daydiff / (1000 * 60 * 60 * 24)); 
			// console.log(numberOfDays);
			// console.log(user_info[key]['CompanyName']);
			// console.log(user_info[key]['PersonName']);
			// console.log(user_info[key]['PassportNo']);
			 if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName1').val() == user_info[key]['PersonName'] && $('.PassportNo1').val() == user_info[key]['PassportNo'] && numberOfDays <= 60){
			 	saveDisable = "1";
			 	applicant = "1";
			 	console.log('not apply');
			 }
			 if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName2').val() == user_info[key]['PersonName'] && $('.PassportNo2').val() == user_info[key]['PassportNo'] && numberOfDays <= 60){
			 	saveDisable = "1";
			 	applicant = "2";
			 }
			 if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName3').val() == user_info[key]['PersonName'] && $('.PassportNo3').val() == user_info[key]['PassportNo'] && numberOfDays <= 60){
			 	saveDisable = "1";
			 	applicant = "3";
			 }
			 if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName4').val() == user_info[key]['PersonName'] && $('.PassportNo4').val() == user_info[key]['PassportNo'] && numberOfDays <= 60){
			 	saveDisable = "1";
			 	applicant = "4";
			 }
			 if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName5').val() == user_info[key]['PersonName'] && $('.PassportNo5').val() == user_info[key]['PassportNo'] && numberOfDays <= 60){
			 	saveDisable = "1";
			 	applicant = "5";
			 }
			 if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName6').val() == user_info[key]['PersonName'] && $('.PassportNo6').val() == user_info[key]['PassportNo'] && numberOfDays <= 60){
			 	saveDisable = "1";
			 	applicant = "6";
			 }
			 if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName7').val() == user_info[key]['PersonName'] && $('.PassportNo7').val() == user_info[key]['PassportNo'] && numberOfDays <= 60){
			 	saveDisable = "1";
			 	applicant = "7";
			 }


			if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName1').val() == user_info[key]['PersonName'] && $('.PassportNo1').val() == user_info[key]['PassportNo'] && user_info[key]['labour_card_type_id'] == "1"){				 	
				 	if($('#labour_card_type_id1').val() == "1"){
				 		console.log('ok');
				 		saveDisable = "1";
				 		$('#labourMsg1').removeClass('d-none');
				 	}
				 	else{
				 		$('#labourMsg1').addClass('d-none');
				 	}
			}
			if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName2').val() == user_info[key]['PersonName'] && $('.PassportNo2').val() == user_info[key]['PassportNo'] && user_info[key]['labour_card_type_id'] == "1"){				 	
				 	if($('#labour_card_type_id2').val() == "1"){
				 		saveDisable = "1";
				 		$('#labourMsg2').removeClass('d-none');
				 	}
				 	else{
				 		$('#labourMsg2').addClass('d-none');
				 	}
			}
			if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName3').val() == user_info[key]['PersonName'] && $('.PassportNo3').val() == user_info[key]['PassportNo'] && user_info[key]['labour_card_type_id'] == "1"){				 	
				 	if($('#labour_card_type_id3').val() == "1"){
				 		saveDisable = "1";
				 		$('#labourMsg3').removeClass('d-none');
				 	}else{
				 		$('#labourMsg3').addClass('d-none');
				 	}
			}
			if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName4').val() == user_info[key]['PersonName'] && $('.PassportNo4').val() == user_info[key]['PassportNo'] && user_info[key]['labour_card_type_id'] == "1"){				 	
				 	if($('#labour_card_type_id4').val() == "1"){
				 		saveDisable = "1";
				 		$('#labourMsg4').removeClass('d-none');
				 	}else{
				 		$('#labourMsg4').addClass('d-none');
				 	}
			}
			if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName5').val() == user_info[key]['PersonName'] && $('.PassportNo5').val() == user_info[key]['PassportNo'] && user_info[key]['labour_card_type_id'] == "1"){				 	
				 	if($('#labour_card_type_id5').val() == "1"){
				 		saveDisable = "1";
				 		$('#labourMsg5').removeClass('d-none');
				 	}else{
				 		$('#labourMsg5').addClass('d-none');
				 	}
			}
			if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName6').val() == user_info[key]['PersonName'] && $('.PassportNo6').val() == user_info[key]['PassportNo'] && user_info[key]['labour_card_type_id'] == "1"){				 	
				 	if($('#labour_card_type_id6').val() == "1"){
				 		saveDisable = "1";
				 		$('#labourMsg6').removeClass('d-none');
				 	}else{
				 		$('#labourMsg6').addClass('d-none');
				 	}
			}
			if($('#comName').val() == user_info[key]['CompanyName'] && $('#PersonName7').val() == user_info[key]['PersonName'] && $('.PassportNo7').val() == user_info[key]['PassportNo'] && user_info[key]['labour_card_type_id'] == "1"){				 	
				 	if($('#labour_card_type_id7').val() == "1"){
				 		saveDisable = "1";
				 		$('#labourMsg7').removeClass('d-none');
				 	}else{
				 		$('#labourMsg7').addClass('d-none');
				 	}
			}
		});
		if(saveDisable == "1"){
			$('#btnsave').removeAttr('style');
	        $('#btnsave').addClass('btn-secondary');
	        $('#btnsave').addClass('disabled');
		}

		if(saveDisable == "1" && applicant == "1"){
			$('#btnsave').removeAttr('style');
        	$('#btnsave').addClass('btn-secondary');
        	$('#btnsave').addClass('disabled');
			$('#msg1').removeClass('d-none');
		}else{
			$('#msg1').addClass('d-none');
		}

		if(saveDisable == "1" && applicant == "2"){
			$('#btnsave').removeAttr('style');
        	$('#btnsave').addClass('btn-secondary');
        	$('#btnsave').addClass('disabled');
			$('#msg2').removeClass('d-none');
		}else{
			$('#msg2').addClass('d-none');
		}

		if(saveDisable == "1" && applicant == "3"){
			$('#btnsave').removeAttr('style');
        	$('#btnsave').addClass('btn-secondary');
        	$('#btnsave').addClass('disabled');
			$('#msg3').removeClass('d-none');
		}else{
			$('#msg3').addClass('d-none');
		}

		if(saveDisable == "1" && applicant == "4"){
			$('#btnsave').removeAttr('style');
        	$('#btnsave').addClass('btn-secondary');
        	$('#btnsave').addClass('disabled');
			$('#msg4').removeClass('d-none');
		}else{
			$('#msg4').addClass('d-none');
		}

		if(saveDisable == "1" && applicant == "5"){
			$('#btnsave').removeAttr('style');
        	$('#btnsave').addClass('btn-secondary');
        	$('#btnsave').addClass('disabled');
			$('#msg5').removeClass('d-none');
		}else{
			$('#msg5').addClass('d-none');
		}

		if(saveDisable == "1" && applicant == "6"){
			$('#btnsave').removeAttr('style');
        	$('#btnsave').addClass('btn-secondary');
        	$('#btnsave').addClass('disabled');
			$('#msg6').removeClass('d-none');
		}else{
			$('#msg6').addClass('d-none');
		}

		if(saveDisable == "1" && applicant == "7"){
			$('#btnsave').removeAttr('style');
        	$('#btnsave').addClass('btn-secondary');
        	$('#btnsave').addClass('disabled');
			$('#msg7').removeClass('d-none');
		}else{
			$('#msg7').addClass('d-none');
		}
	})

	
	
	// const numberOfDaysInCurrentMonthOnly = currentDate-substractDate;
	// console.log(numberOfDaysInCurrentMonthOnly);

	// 
	// console.log(btnDisable);
	// if(btnDisable == "1"){
	// 	$('#applySubmit').removeAttr('style');
 //        $('#applySubmit').addClass('btn-secondary');
 //        $('#applySubmit').addClass('disabled');
	// 	$('#disableMsg').removeClass('d-none');
	// }


	$('#labour_card_type_id1').change(function(){
		if($(this).val() != '' ){
			$('#labourduration1').show();
		}else{
			$('#labourduration1').hide();
		}
	})
	$('#labour_card_type_id2').change(function(){
		if($(this).val() != '' ){
			$('#labourduration2').show();
		}else{
			$('#labourduration2').hide();
		}
	})
	$('#labour_card_type_id3').change(function(){
		if($(this).val() != '' ){
			$('#labourduration3').show();
		}else{
			$('#labourduration3').hide();
		}
	})
	$('#labour_card_type_id4').change(function(){
		if($(this).val() != '' ){
			$('#labourduration4').show();
		}else{
			$('#labourduration4').hide();
		}
	})
	$('#labour_card_type_id5').change(function(){
		if($(this).val() != '' ){
			$('#labourduration5').show();
		}else{
			$('#labourduration5').hide();
		}
	})
	$('#labour_card_type_id6').change(function(){
		if($(this).val() != '' ){
			$('#labourduration6').show();
		}else{
			$('#labourduration6').hide();
		}
	})
	$('#labour_card_type_id7').change(function(){
		if($(this).val() != '' ){
			$('#labourduration7').show();
		}else{
			$('#labourduration7').hide();
		}
	})

	function checkTwoMonth(expireDateID,sourceID,stayDurationID){
    	var staySelected = document.getElementById(stayDurationID);
    	var expireDate = document.getElementById(expireDateID).value;
    	//alert(expireDate);

		const d = new Date();
		var newDate = new Date(d.setMonth(d.getMonth()+2)).toISOString().split('T')[0];
		var b = document.getElementById("applySubmit");
		
    	if (staySelected.value != '') {
    		if (newDate < expireDate) {
				b.disabled = true;
		    	b.style.background = "lightgrey"; //"#dc3545";
		    	document.getElementById("Mytab0").disabled = true;
		    	document.getElementById("Mytab1").disabled = true;
		    	document.getElementById("Mytab2").disabled = true;
		    	document.getElementById("Mytab3").disabled = true;
		    	document.getElementById("Mytab4").disabled = true;
		    	document.getElementById("Mytab5").disabled = true;
		    	document.getElementById("Mytab6").disabled = true;
		    	document.getElementById("Mytab7").disabled = true;
		    	document.getElementById("add_tab").disabled = true;
		    	document.getElementById("remove_tab").disabled = true;

		    	// document.getElementById("TwoMonthWarning1").style.visibility = "visible";
		    	document.getElementById(sourceID).style.visibility = "visible";
		    } else {
		    	b.disabled = false;
		    	b.style.background = "#4CAF50";
		    	document.getElementById("Mytab0").disabled = false;
		    	document.getElementById("Mytab1").disabled = false;
		    	document.getElementById("Mytab2").disabled = false;
		    	document.getElementById("Mytab3").disabled = false;
		    	document.getElementById("Mytab4").disabled = false;
		    	document.getElementById("Mytab5").disabled = false;
		    	document.getElementById("Mytab6").disabled = false;
		    	document.getElementById("Mytab7").disabled = false;
		    	document.getElementById("add_tab").disabled = false;
		    	document.getElementById("remove_tab").disabled = false;
		    	// document.getElementById("TwoMonthWarning1").style.visibility = "hidden";
		    	document.getElementById(sourceID).style.visibility = "hidden";
		    }
    	} else {
	    	b.disabled = false;
	    	b.style.background = "#4CAF50";
	    	document.getElementById("Mytab0").disabled = false;
	    	document.getElementById("Mytab1").disabled = false;
	    	document.getElementById("Mytab2").disabled = false;
	    	document.getElementById("Mytab3").disabled = false;
	    	document.getElementById("Mytab4").disabled = false;
	    	document.getElementById("Mytab5").disabled = false;
	    	document.getElementById("Mytab6").disabled = false;
	    	document.getElementById("Mytab7").disabled = false;
	    	document.getElementById("add_tab").disabled = false;
	    	document.getElementById("remove_tab").disabled = false;
	    	// document.getElementById("TwoMonthWarning1").style.visibility = "hidden";
	    	document.getElementById(sourceID).style.visibility = "hidden";
    	}
	}

	function checkAge(id1,id2,id3){
		var r = document.getElementById(id1).value;
		var dob = document.getElementById(id2).value;
		var x = document.getElementById(id3);

		// var years = new Date(new Date() - new Date(dob)).getFullYear() - 1970;		

		var b = document.getElementById("applySubmit");

		//1=Father, 2=Mother, 5=Son, 6=Daughter
		if (r==1 || r==2){
			const d = new Date();
			var newDate = new Date(d.setYear(d.getFullYear()-60)).toISOString().split('T')[0];
			// alert(newDate);
			if (newDate < dob) {
				x.innerHTML = "Invalid Under 60 Years";
				x.style.visibility = "visible";

				b.disabled = true;
				b.style.background = "lightgrey"; //"#dc3545";
				document.getElementById("Mytab0").disabled = true;
		    	document.getElementById("Mytab1").disabled = true;
		    	document.getElementById("Mytab2").disabled = true;
		    	document.getElementById("Mytab3").disabled = true;
		    	document.getElementById("Mytab4").disabled = true;
		    	document.getElementById("Mytab5").disabled = true;
		    	document.getElementById("Mytab6").disabled = true;
		    	document.getElementById("Mytab7").disabled = true;
		    	document.getElementById("add_tab").disabled = true;
	    	document.getElementById("remove_tab").disabled = true;
			} else {
				x.innerHTML = "";
				x.style.visibility = "hidden";

				b.disabled = false;
				b.style.background = "#4CAF50";
				document.getElementById("Mytab0").disabled = false;
		    	document.getElementById("Mytab1").disabled = false;
		    	document.getElementById("Mytab2").disabled = false;
		    	document.getElementById("Mytab3").disabled = false;
		    	document.getElementById("Mytab4").disabled = false;
		    	document.getElementById("Mytab5").disabled = false;
		    	document.getElementById("Mytab6").disabled = false;
		    	document.getElementById("Mytab7").disabled = false;
		    	document.getElementById("add_tab").disabled = false;
	    	document.getElementById("remove_tab").disabled = false;
			}
		} else if (r==5 || r==6){
			const d = new Date();
			var newDate = new Date(d.setYear(d.getFullYear()-18)).toISOString().split('T')[0];
			if (newDate > dob) {
				x.innerHTML = "Invalid Over 18 Years";
				x.style.visibility = "visible";

				b.disabled = true;
				b.style.background = "lightgrey"; //"#dc3545";
				document.getElementById("Mytab0").disabled = true;
		    	document.getElementById("Mytab1").disabled = true;
		    	document.getElementById("Mytab2").disabled = true;
		    	document.getElementById("Mytab3").disabled = true;
		    	document.getElementById("Mytab4").disabled = true;
		    	document.getElementById("Mytab5").disabled = true;
		    	document.getElementById("Mytab6").disabled = true;
		    	document.getElementById("Mytab7").disabled = true;
		    	document.getElementById("add_tab").disabled = true;
	    	document.getElementById("remove_tab").disabled = true;
			} else {
				x.innerHTML = "";
				x.style.visibility = "hidden";

				b.disabled = false;
				b.style.background = "#4CAF50";
				document.getElementById("Mytab0").disabled = false;
		    	document.getElementById("Mytab1").disabled = false;
		    	document.getElementById("Mytab2").disabled = false;
		    	document.getElementById("Mytab3").disabled = false;
		    	document.getElementById("Mytab4").disabled = false;
		    	document.getElementById("Mytab5").disabled = false;
		    	document.getElementById("Mytab6").disabled = false;
		    	document.getElementById("Mytab7").disabled = false;
		    	document.getElementById("add_tab").disabled = false;
	    	document.getElementById("remove_tab").disabled = false;
			}
		} else {
			x.innerHTML = "";
			x.style.visibility = "hidden";

			b.disabled = false;
			b.style.background = "#4CAF50";
			document.getElementById("Mytab0").disabled = false;
		    	document.getElementById("Mytab1").disabled = false;
		    	document.getElementById("Mytab2").disabled = false;
		    	document.getElementById("Mytab3").disabled = false;
		    	document.getElementById("Mytab4").disabled = false;
		    	document.getElementById("Mytab5").disabled = false;
		    	document.getElementById("Mytab6").disabled = false;
		    	document.getElementById("Mytab7").disabled = false;
		    	document.getElementById("add_tab").disabled = false;
	    	document.getElementById("remove_tab").disabled = false;
		}
	}

	function changeAttachmentLabel(id1,id2){
		// var t = document.getElementById("applicantType1").value;
		// var l = document.getElementById("attachmentLabel1");

		var t = document.getElementById(id1).value;
		var l = document.getElementById(id2);
		switch(t){
			case "1":
			l.innerHTML = "Passport, Company Registration Card, Extract Form";
			break;
			case "2":
			l.innerHTML = "Passport, Company Registration Card, Extract Form";
			break;
			case "3":
			l.innerHTML = "Passport, MIC Approved Letter, Labour Card (if any)";
			break;
			case "4":
			l.innerHTML = "Passport, Evidence (eg. Marriage Contract, Birth Certificate), MIC Approved Letter and Technician/Skill Labour's Passport (if Relation with Technician/Skill Labour)";
			break;
		}
	}

</script>
@endsection