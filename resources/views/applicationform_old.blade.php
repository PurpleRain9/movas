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
	padding: 15px 32px;
	text-align: center;
	text-decoration: none;
	display: inline-block;
	font-size: 16px;
}
</style>
<form class="form-inline" method="POST" action="{{ route('applyform.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="container mt-3 mb-4">
		{{-- <h3 class="text-center">Application Form</h3> --}}
		<div class="tab row">
			<div class="col-md-10 col-sm-6">
				<button class="tablinks active company" type="button" onclick="openCity(event, 'Company')">Company</button>
				<button class="tablinks applicant1" type="button" id="Mytab1" onclick="openCity(event, 'Applicant1')">Applicant - 1</button>
				<button class="tablinks applicant2" type="button" id="Mytab2" onclick="openCity(event, 'Applicant2')" style="display: none;">Applicant - 2</button>
				<button class="tablinks applicant3" type="button" id="Mytab3" onclick="openCity(event, 'Applicant3')" style="display: none;">Applicant - 3</button>
				<button class="tablinks applicant4" type="button" id="Mytab4" onclick="openCity(event, 'Applicant4')" style="display: none;">Applicant - 4</button>
				<button class="tablinks applicant5" type="button" id="Mytab5" onclick="openCity(event, 'Applicant5')" style="display: none;">Applicant - 5</button>
				<button class="tablinks applicant6" type="button" id="Mytab6" onclick="openCity(event, 'Applicant6')" style="display: none;">Applicant - 6</button>
				<button class="tablinks applicant7" type="button" id="Mytab7" onclick="openCity(event, 'Applicant7')" style="display: none;">Applicant - 7</button>
			</div>

			<div class="col-md-2 col-sm-6">
				<button type="submit" class="mybutton" id="applySubmit" style="margin-right: 20px;background-color: #4CAF50;" onclick="return confirm('Submit Now');" >Submit</button>
				<a class="btn-outline-success btn btn-sm" onclick="ShowTab()"><i class="fa fa-plus" aria-hidden="true"></i></a>
				<a class="btn-outline-danger btn btn-sm" id="remove_tab" onclick="HideTab()"><i class="fa fa-minus" aria-hidden="true"></i></a>
			</div>

		</div>

		<div id="Company" class="tabcontent" style="display: block;">

			<input type="hidden" value="{{Auth::user()->id}}" name="user_id">
			<input type="hidden" value="{{$profile->id}}" name="profile_id">
			<div class="container mb-5" style="">
				<h3 class="text-center mt-4"><span class="mm">ကုမ္ပဏီအချက်အလက်</span><span class="eng">COMPANY PROFILE</span></h3>
				<br/>

				<div class="row">
					<div class="col-6">
						<fieldset class="form-group">
							<label ><span class="mm">ကုမ္ပဏီအမည်</span><span class="eng">Company Name</span></label>
							<input type="text" disabled value="{{$profile->CompanyName}}" class="form-control" name="CompanyName">
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

				<div class="row mt-3">
					<h3 class="text-center mt-3">ATTACHMENT</h3>
				</div>

				<div class="row mt-3">
					<span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note:</b> The following documents need to be attached (PDF File Only) </span>
					<br>

					{{-- <div class="col">
						<fieldset class="form-group">
							<label for="pxq11"><span class="mm">E-Visaပါရှိသော် ပါတ်စ်ပို့၏ အရှေ့စာမျက်နာ . အနောက်စာမျက်နာ နှင့် ဗီဇာတံဆိပ်ခေါင်းစာမျက်နှာ မိတ္တူ </span><span class="eng">Copy of passport first page. Lastest page and visa stamp page with (E-Visa)</span></label>
							<input type="file" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
						</fieldset>
					</div>
					<div class="col">
						<fieldset class="form-group">
							<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
							<small class="text-danger"><span class="mm">သင်ကညွှန်ကြားသူမဟုတ်၊ အစုရှယ်ယာရှင်မဟုတ်လျှင်သာထောက်ပံ့သည်။</span><span class="eng">Provied only if you are not adirector or shareholder.</span></small>
							<input type="file" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
						</fieldset>
					</div> --}}
					<script>
						$(document).ready(function() {
							var i = 0;

							$("#add").click(function() {

								++i;

								$("#CompanyTable").append('<tr><td><input type="file" accept=".pdf" name="FilePath[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
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
							<td><input type="file" accept=".pdf" name="FilePath[]" placeholder="Enter your Name" class="form-control" /></td>
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
						<input type="text" class="form-control" name="PersonName1">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span></label>
						<select class="form-control" name="nationality_id1">
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
						<input type="text" class="form-control" name="PassportNo1" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">MIC မှအတည်ပြုသည့်ရက်စွဲ</span><span class="eng">MIC Approve Date</span></label>
						<input type="date" class="form-control" name="StayAllowDate1" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span> <span id="TwoMonthWarning" style="color:red;visibility: hidden;"><small><span class="mm">ရှေ့လနှစ်လထက်မပိုစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
						<input type="date" class="form-control" name="StayExpireDate1" id="pxq15" onchange="checkTwoMonth(this.value)">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">
						လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id1" id="applicantType1" onchange="checkApplicantType1(this.value);changeAttachmentLabel1()">
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
						<input type="date" class="form-control" name="DateOfBirth1" id="abc231" onchange="checkAge1()">
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
					<select class="form-control" name="visa_type_id1">
						<option value="">Choose</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id1">
						<option value="">Choose</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type1">
					<label ><span class="mm">
					အလုပ်သမားကတ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id1">
						<option value="">Choose</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant1">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation1" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id1" id="relationship1" onchange="checkAge1()">
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
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach1").click(function() {

							++i;

							$("#ApplicantTable1").append('<tr><td><input type="file" accept=".pdf" name="FilePath1[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description1[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach1">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach1', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable1">
					<tr>
						<th>File</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" accept=".pdf" name="FilePath1[]" placeholder="Enter your Name" class="form-control" /></td>
						<td><input type="text" name="Description1[]" placeholder="Enter attachment description" class="form-control" /></td>
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
						<input type="text" class="form-control" name="PersonName2">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id2">
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
						<input type="text" class="form-control" name="PassportNo2" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">နေထိုင်ခွင့်ရက်</span><span class="eng">Stay Allow Date</span></label>
						<input type="date" class="form-control" name="StayAllowDate2" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate2" id="pxq15">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id2" id="applicantType2" onchange="checkApplicantType2(this.value);changeAttachmentLabel2()">
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
						<input type="date" class="form-control" name="DateOfBirth2" id="abc232" onchange="checkAge2()">
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
					<label >Visa Type<span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id2">
						<option value="">Choose</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id2">
						<option value="">Choose</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type2">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id2">
						<option value="">Choose</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant2">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation2" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id2" id="relationship2" onchange="checkAge2()">
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
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach2").click(function() {

							++i;

							$("#ApplicantTable2").append('<tr><td><input type="file" accept=".pdf" name="FilePath2[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description2[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach2">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach2', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable2">
					<tr>
						<th>File</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" accept=".pdf" name="FilePath2[]" placeholder="Enter your Name" class="form-control" /></td>
						<td><input type="text" name="Description2[]" placeholder="Enter attachment description" class="form-control" /></td>
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
						<input type="text" class="form-control" name="PersonName3">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id3">
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
						<input type="text" class="form-control" name="PassportNo3" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">နေထိုင်ခွင့်ရက်</span><span class="eng">Stay Allow Date</span></label>
						<input type="date" class="form-control" name="StayAllowDate3" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate3" id="pxq15">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id3" id="applicantType3" onchange="checkApplicantType3(this.value);changeAttachmentLabel3()">
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
						<input type="date" class="form-control" name="DateOfBirth3" id="abc233" onchange="checkAge3()">
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
					<label >Visa Type<span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id3">
						<option value="">Choose</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id3">
						<option value="">Choose</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type3">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id3">
						<option value="">Choose</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant3">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation3" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id3" id="relationship3" onchange="checkAge3()">
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
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach3").click(function() {

							++i;

							$("#ApplicantTable3").append('<tr><td><input type="file" accept=".pdf" name="FilePath3[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description3[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach3">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach3', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable3">
					<tr>
						<th>File</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" accept=".pdf" name="FilePath3[]" placeholder="Enter your Name" class="form-control" /></td>
						<td><input type="text" name="Description3[]" placeholder="Enter attachment description" class="form-control" /></td>
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
						<input type="text" class="form-control" name="PersonName4">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id4">
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
						<input type="text" class="form-control" name="PassportNo4" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">နေထိုင်ခွင့်ရက်</span><span class="eng">Stay Allow Date</span></label>
						<input type="date" class="form-control" name="StayAllowDate4" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate4" id="pxq15">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id4" id="applicantType4" onchange="checkApplicantType4(this.value);changeAttachmentLabel4()">
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
						<input type="date" class="form-control" name="DateOfBirth4" id="abc234" onchange="checkAge4()">
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
					<label >Visa Type<span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id4">
						<option value="">Choose</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id4">
						<option value="">Choose</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type4">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id4">
						<option value="">Choose</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant4">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation4" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id4" id="relationship4" onchange="checkAge4()">
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
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach4").click(function() {

							++i;

							$("#ApplicantTable4").append('<tr><td><input type="file" accept=".pdf" name="FilePath4[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description4[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach4">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach4', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable4">
					<tr>
						<th>File</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" accept=".pdf" name="FilePath4[]" placeholder="Enter your Name" class="form-control" /></td>
						<td><input type="text" name="Description4[]" placeholder="Enter attachment description" class="form-control" /></td>
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
						<input type="text" class="form-control" name="PersonName5">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id5">
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
						<input type="text" class="form-control" name="PassportNo5" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">နေထိုင်ခွင့်ရက်</span><span class="eng">Stay Allow Date</span></label>
						<input type="date" class="form-control" name="StayAllowDate5" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate5" id="pxq15">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id5" id="applicantType5" onchange="checkApplicantType5(this.value);changeAttachmentLabel5()">
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
						<input type="date" class="form-control" name="DateOfBirth5" id="abc235" onchange="checkAge5()">
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
					<label >Visa Type<span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id5">
						<option value="">Choose</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id5">
						<option value="">Choose</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type5">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id5">
						<option value="">Choose</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant5">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation5" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id5" id="relationship5" onchange="checkAge5()">
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
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach5").click(function() {

							++i;

							$("#ApplicantTable5").append('<tr><td><input type="file" accept=".pdf" name="FilePath5[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description5[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach5">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach5', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable5">
					<tr>
						<th>File</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" accept=".pdf" name="FilePath5[]" placeholder="Enter your Name" class="form-control" /></td>
						<td><input type="text" name="Description5[]" placeholder="Enter attachment description" class="form-control" /></td>
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
						<input type="text" class="form-control" name="PersonName6">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id6">
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
						<input type="text" class="form-control" name="PassportNo6" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">နေထိုင်ခွင့်ရက်</span><span class="eng">Stay Allow Date</span></label>
						<input type="date" class="form-control" name="StayAllowDate6" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate6" id="pxq15">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id6" id="applicantType6" onchange="checkApplicantType6(this.value);changeAttachmentLabel6()">
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
						<input type="date" class="form-control" name="DateOfBirth6" id="abc236" onchange="checkAge6()">
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
					<label >Visa Type<span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id6">
						<option value="">Choose</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id6">
						<option value="">Choose</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type6">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id6">
						<option value="">Choose</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant6">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation6" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id6" id="relationship6" onchange="checkAge6()">
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
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach6").click(function() {

							++i;

							$("#ApplicantTable6").append('<tr><td><input type="file" accept=".pdf" name="FilePath6[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description6[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach6">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach6', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable6">
					<tr>
						<th>File</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" accept=".pdf" name="FilePath6[]" placeholder="Enter your Name" class="form-control" /></td>
						<td><input type="text" name="Description6[]" placeholder="Enter attachment description" class="form-control" /></td>
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
						<input type="text" class="form-control" name="PersonName7">
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span>
						<select class="form-control" name="nationality_id7">
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
						<input type="text" class="form-control" name="PassportNo7" id="pxq13">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">နေထိုင်ခွင့်ရက်</span><span class="eng">Stay Allow Date</span></label>
						<input type="date" class="form-control" name="StayAllowDate7" id="pxq14">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span></label>
						<input type="date" class="form-control" name="StayExpireDate7" id="pxq15">
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control" name="person_type_id7" id="applicantType7" onchange="checkApplicantType7(this.value);changeAttachmentLabel7()">
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
						<input type="date" class="form-control" name="DateOfBirth7" id="abc237" onchange="checkAge7()">
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
					<label >Visa Type<span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id7">
						<option value="">Choose</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}">{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span></label>
					<select class="form-control" name="stay_type_id7">
						<option value="">Choose</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}">{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type7">
					<label >  <span class="mm">အလုပ်သမားကဒ်အမျိုးအစား</span><span class="eng">Labour Card Type</span></label>
					<select class="form-control" name="labour_card_type_id7">
						<option value="">Choose</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}">{{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant7">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation7" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id7" id="relationship7" onchange="checkAge7()">
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
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1a" id="pxq11" accept=".pdf">
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="pxq12"><span class="mm">စာချုပ်/လက်မှတ်</span><span class="eng">Contract/Certificate</span></label>
						<small class="text-danger">Provie only if you are not adirector or shareholder.</small>
						<input type="file" accept=".pdf" class="form-control" name="applicant_att1b" id="pxq12" accept=".pdf">
					</fieldset>
				</div> --}}
				<script>
					$(document).ready(function() {
						var i = 0;

						$("#add_applicant_attach7").click(function() {

							++i;

							$("#ApplicantTable7").append('<tr><td><input type="file" accept=".pdf" name="FilePath7[]" placeholder="Enter your Name" class="form-control" /></td><td><input type="text" name="Description7[]" placeholder="Enter attachment description" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-applicant_attach7">Remove</button></td></tr>');
						});

						$(document).on('click', '.remove-applicant_attach7', function() {
							$(this).parents('tr').remove();
						});

					});
				</script>

				<table class="table table-bordered" id="ApplicantTable7">
					<tr>
						<th>File</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
					<tr>
						<td><input type="file" accept=".pdf" name="FilePath7[]" placeholder="Enter your Name" class="form-control" /></td>
						<td><input type="text" name="Description7[]" placeholder="Enter attachment description" class="form-control" /></td>
						<td><button type="button" name="add_applicant_attach7" id="add_applicant_attach7" class="btn btn-success">Add More</button></td>
					</tr>
				</table>
			</div>

		</div>
	</form>
</div>
<script src="{{ asset('js/applyform.js') }}"></script>
<script type="text/javascript">
	function checkTwoMonth(expireDate){
		const d = new Date();
		var newDate = new Date(d.setMonth(d.getMonth()+2)).toISOString().split('T')[0];

		var b = document.getElementById("applySubmit");
		if (newDate < expireDate) {
			b.disabled = true;
				    	b.style.background = "lightgrey"; //"#dc3545";

				    	document.getElementById("TwoMonthWarning").style.visibility = "visible";
				    } else {
				    	b.disabled = false;
				    	b.style.background = "#4CAF50";

				    	document.getElementById("TwoMonthWarning").style.visibility = "hidden";
				    }
				  }

				  function checkAge1(){
				  	var r = document.getElementById("relationship1").value;
				  	var dob = document.getElementById("abc231").value;
 					// var years = new Date(new Date() - new Date(dob)).getFullYear() - 1970;		

 					var x = document.getElementById("relation1");
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
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else if (r==5 || r==6){
				    	const d = new Date();
				    	var newDate = new Date(d.setYear(d.getFullYear()-18)).toISOString().split('T')[0];
				    	if (newDate > dob) {
				    		x.innerHTML = "Invalid Over 18 Years";
				    		x.style.visibility = "visible";

				    		b.disabled = true;
				    		b.style.background = "lightgrey"; //"#dc3545";
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else {
				    	x.innerHTML = "";
				    	x.style.visibility = "hidden";

				    	b.disabled = false;
				    	b.style.background = "#4CAF50";
				    }
				  }
				  function checkAge2(){
				  	var r = document.getElementById("relationship2").value;
				  	var dob = document.getElementById("abc232").value;

 					var x = document.getElementById("relation2");
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
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else if (r==5 || r==6){
				    	const d = new Date();
				    	var newDate = new Date(d.setYear(d.getFullYear()-18)).toISOString().split('T')[0];
				    	if (newDate > dob) {
				    		x.innerHTML = "Invalid Over 18 Years";
				    		x.style.visibility = "visible";

				    		b.disabled = true;
				    		b.style.background = "lightgrey"; //"#dc3545";
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else {
				    	x.innerHTML = "";
				    	x.style.visibility = "hidden";

				    	b.disabled = false;
				    	b.style.background = "#4CAF50";
				    }
				  }
				  function checkAge3(){
				  	var r = document.getElementById("relationship3").value;
				  	var dob = document.getElementById("abc233").value;

 					var x = document.getElementById("relation3");
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
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else if (r==5 || r==6){
				    	const d = new Date();
				    	var newDate = new Date(d.setYear(d.getFullYear()-18)).toISOString().split('T')[0];
				    	if (newDate > dob) {
				    		x.innerHTML = "Invalid Over 18 Years";
				    		x.style.visibility = "visible";

				    		b.disabled = true;
				    		b.style.background = "lightgrey"; //"#dc3545";
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else {
				    	x.innerHTML = "";
				    	x.style.visibility = "hidden";

				    	b.disabled = false;
				    	b.style.background = "#4CAF50";
				    }
				  }
				  function checkAge4(){
				  	var r = document.getElementById("relationship4").value;
				  	var dob = document.getElementById("abc234").value;

 					var x = document.getElementById("relation4");
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
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else if (r==5 || r==6){
				    	const d = new Date();
				    	var newDate = new Date(d.setYear(d.getFullYear()-18)).toISOString().split('T')[0];
				    	if (newDate > dob) {
				    		x.innerHTML = "Invalid Over 18 Years";
				    		x.style.visibility = "visible";

				    		b.disabled = true;
				    		b.style.background = "lightgrey"; //"#dc3545";
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else {
				    	x.innerHTML = "";
				    	x.style.visibility = "hidden";

				    	b.disabled = false;
				    	b.style.background = "#4CAF50";
				    }
				  }
				  function checkAge5(){
				  	var r = document.getElementById("relationship5").value;
				  	var dob = document.getElementById("abc235").value;

 					var x = document.getElementById("relation5");
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
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else if (r==5 || r==6){
				    	const d = new Date();
				    	var newDate = new Date(d.setYear(d.getFullYear()-18)).toISOString().split('T')[0];
				    	if (newDate > dob) {
				    		x.innerHTML = "Invalid Over 18 Years";
				    		x.style.visibility = "visible";

				    		b.disabled = true;
				    		b.style.background = "lightgrey"; //"#dc3545";
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else {
				    	x.innerHTML = "";
				    	x.style.visibility = "hidden";

				    	b.disabled = false;
				    	b.style.background = "#4CAF50";
				    }
				  }
				  function checkAge6(){
				  	var r = document.getElementById("relationship6").value;
				  	var dob = document.getElementById("abc236").value;

 					var x = document.getElementById("relation6");
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
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else if (r==5 || r==6){
				    	const d = new Date();
				    	var newDate = new Date(d.setYear(d.getFullYear()-18)).toISOString().split('T')[0];
				    	if (newDate > dob) {
				    		x.innerHTML = "Invalid Over 18 Years";
				    		x.style.visibility = "visible";

				    		b.disabled = true;
				    		b.style.background = "lightgrey"; //"#dc3545";
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else {
				    	x.innerHTML = "";
				    	x.style.visibility = "hidden";

				    	b.disabled = false;
				    	b.style.background = "#4CAF50";
				    }
				  }
				  function checkAge7(){
				  	var r = document.getElementById("relationship7").value;
				  	var dob = document.getElementById("abc237").value;

 					var x = document.getElementById("relation7");
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
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else if (r==5 || r==6){
				    	const d = new Date();
				    	var newDate = new Date(d.setYear(d.getFullYear()-18)).toISOString().split('T')[0];
				    	if (newDate > dob) {
				    		x.innerHTML = "Invalid Over 18 Years";
				    		x.style.visibility = "visible";

				    		b.disabled = true;
				    		b.style.background = "lightgrey"; //"#dc3545";
				    	} else {
				    		x.innerHTML = "";
				    		x.style.visibility = "hidden";

				    		b.disabled = false;
				    		b.style.background = "#4CAF50";
				    	}
				    } else {
				    	x.innerHTML = "";
				    	x.style.visibility = "hidden";

				    	b.disabled = false;
				    	b.style.background = "#4CAF50";
				    }
				  }
				  function changeAttachmentLabel1(){
				  	var t = document.getElementById("applicantType1").value;
				  	var l = document.getElementById("attachmentLabel1");
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
				  function changeAttachmentLabel2(){
				  	var t = document.getElementById("applicantType2").value;
				  	var l = document.getElementById("attachmentLabel2");
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
				  function changeAttachmentLabel3(){
				  	var t = document.getElementById("applicantType3").value;
				  	var l = document.getElementById("attachmentLabel3");
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
				  function changeAttachmentLabel4(){
				  	var t = document.getElementById("applicantType4").value;
				  	var l = document.getElementById("attachmentLabel4");
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
				  }function changeAttachmentLabel5(){
				  	var t = document.getElementById("applicantType5").value;
				  	var l = document.getElementById("attachmentLabel5");
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
				  }function changeAttachmentLabel6(){
				  	var t = document.getElementById("applicantType6").value;
				  	var l = document.getElementById("attachmentLabel6");
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
				  }function changeAttachmentLabel7(){
				  	var t = document.getElementById("applicantType7").value;
				  	var l = document.getElementById("attachmentLabel7");
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