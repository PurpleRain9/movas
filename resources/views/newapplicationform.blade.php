@php
    $isEdit = Request::route()->getName() === "editApplicant" ;
@endphp
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

<form class="form-inline" method="POST" action="{{ route('newApplyform.store') }}" enctype="multipart/form-data" id="myForm"  onsubmit="return true;">
	@csrf

	<div class="container mt-3 mb-4">
		@if(session()->has('error'))
			<div class="alert alert-danger m-2">
				{{ session()->get('error') }}
			</div>
		@endif
		{{-- <h3 class="text-center">Application Form</h3> --}}
		{{-- <p class="text-danger text-center d-none" id="disableMsg"> <strong>Please wait until your previous form approve!</strong></p> --}}

		
		
		<div class="tabcontent" >
			<h3 class="text-center mt-4" style="text-transform: uppercase;">APPLICANT INFORMATION</h3>
			<br/>

			<div class="row">
				<div class="col-6">
					<fieldset class="form-group">	
						<label ><span class="mm">အမည်</span><span class="eng">Name</span></label>
						<input type="text" class="form-control" name="PersonName"  id="PersonName" @if($isEdit) value="{{$applicant->PersonName}}" @endif required>
					</fieldset>
				</div>

				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">နိုင်ငံသား</span><span class="eng">Nationality</span></label>
						<select class="form-control" name="nationality_id" required id="nationality_id">
							<option value="">Choose</option>
							@foreach($nationalities as $n)
							<option value="{{$n->id}}"  @if($isEdit) {{$applicant->nationality_id == $n->id ? 'selected':''}}  @endif >{{$n->NationalityName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-4" id="passportDiv">
					<fieldset class="form-group">
						<label for="pxq13"><span class="mm">ပက်စ်ပို့နံပါတ်</span><span class="eng">Passport No</span></label>
						<input type="text" class="form-control PassportNo mt-1" name="PassportNo" id="pxq13" @if($isEdit) value="{{$applicant->PassportNo}}" @endif  required>
					</fieldset>
				</div>
				<div class="col-4" id="micApprovedDiv">
					<fieldset class="form-group">
						<label for="pxq14"><span class="mm">MIC မှအတည်ပြုသည့်ရက်စွဲ</span><span class="eng">MIC Approve Date</span></label>
						<input type="date" class="form-control StayAllowDate mt-1" name="StayAllowDate" id="pxq14"  @if($isEdit) value="{{$applicant->StayAllowDate}}" @endif>
					</fieldset>
				</div>
				<div class="col-4" id="stayexpDiv">
					<fieldset class="form-group">
						<label for="pxq15"><span class="mm">နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</span><span class="eng">Stay Expire Date</span><span id="TwoMonthWarning" style="color:red;visibility: hidden;"><small><span class="mm">နှစ်လမတိုင်ခင်ထက်မစောစေရ</span><span class="eng">No More Than Two Months Ahead</span></small></span></label>
						<input type="date" class="form-control StayExpireDate mt-1"  @if($isEdit) value="{{$applicant->StayExpireDate}}" @endif  name="StayExpireDate" id="StayExpireDate" onchange="checkTwoMonth('StayExpireDate','TwoMonthWarning','stay_type_id')" required>
					</fieldset>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col">
					<fieldset class="form-group">
						<label ><span class="mm">
						လျှောက်ထားသူအမျိုးအစား</span><span class="eng">Applicant Type</span></label>
						<select class="form-control mt-1" name="person_type_id" id="applicantType" onchange="checkApplicantType(this.value);changeAttachmentLabel()" required>
							<option value="null">Choose</option>
							@foreach($person_types as $pt)
							<option value="{{$pt->id}}"  @if($isEdit) {{$applicant->person_type_id == $pt->id ? 'selected':''}}  @endif>{{$pt->PersonTypeName}}</option>
							@endforeach
						</select>
					</fieldset>
				</div>
				<div class="col">
					<fieldset class="form-group">
						<label for="dateOfBirth"><span class="mm">မွေးနေ့</span><span class="eng">Date Of Birth</span></label>
						<input type="date" class="form-control mt-1" @if($isEdit) value="{{$applicant->DateOfBirth}}" @endif  name="DateOfBirth" id="dateOfBirth" onchange="checkAge('relationship','dateOfBirth','relation')" required>
					</fieldset>
				</div>
				<div class="col col-md-3">
					<fieldset class="form-group">
						<label ><span class="mm">
						ကျား၊မ</span><span class="eng">Gender</span></label>
						<div class="radio">
							<label>
								<input type="radio" id="Gender" name="Gender" value="Male"  @if($isEdit) {{$applicant->Gender == 'Male' ? 'checked':''}}   @else checked @endif required>
								Male
							</label>
							<label>
								<input type="radio" name="Gender" value="Female" @if($isEdit) {{$applicant->Gender == 'Female' ? 'checked':''}} @endif required>
								Female
							</label>
						</div>
					</fieldset>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col">
					<label ><span class="mm">Visa အမျိုးအစား</span><span class="eng">Visa Type</span></label>
					<select class="form-control" name="visa_type_id" id="visa_type_id">
						<option value="">Not Apply</option>
						@foreach($visa_types as $vt)
						<option value="{{$vt->id}}"  @if($isEdit) {{$applicant->visa_type_id == $vt->id ? 'selected':''}} @endif>{{$vt->VisaTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Stay Duration</span><small id="alertmsg1" class="d-none text-danger"> * </small></label>
					<select class="form-control" name="stay_type_id" id="stay_type_id" onchange="checkTwoMonth('StayExpireDate','TwoMonthWarning','stay_type_id')">
						<option value="">Not Apply</option>
						@foreach($stay_types as $st)
						<option value="{{$st->id}}" @if($isEdit) {{$applicant->stay_type_id == $st->id ? 'selected':''}} @endif>{{$st->StayTypeName}}</option>
						@endforeach
					</select>
				</div>
				<div class="col" id="labour_type">
					<label ><span class="mm">
					အလုပ်သမားကတ်အမျိုးအစား</span><span class="eng">Labour Card Type</span><small class="text-danger d-none" id="labouralert1"> * </small></label>
					<select class="form-control" name="labour_card_type_id" id="labour_card_type_id">
						<option value="">Not Apply</option>
						@foreach($labour_card_types as $lct)
						<option value="{{$lct->id}}" @if($isEdit) {{$applicant->labour_card_type_id == $lct->id ? 'selected':''}} @endif> {{$lct->LabourCardTypeName}}</option>
						@endforeach
					</select>
					
				</div>
				<div class="col" id="labourduration" style="display: none;">
					<label ><span class="mm">နေထိုင်ရန်ကြာချိန်</span><span class="eng">Labour Stay Duration </span></label>
					<select class="form-control" name="labour_card_duration" id="labour_card_duration">
						@foreach($labour_card_duration as $lcd)
						<option value="{{$lcd->id}}" @if($isEdit) {{$applicant->labour_card_duration_id == $lcd->id ? 'selected':''}} @endif>{{$lcd->LabourCardDuration}}</option>
						@endforeach
					</select>
				</div>
			</div>

			<div style="display: none" id="dependant">
				<div class="row mt-5" >
					<div class="col-md-6">
						<label ><span class="mm">ဆွေမျိုး</span><span class="eng">Relationship</span> <span id="relation" style="color:red;"><small></small></span></label>
						<select class="form-control" name="relation_ship_id" id="relationship" onchange="checkAge('relationship','dateOfBirth','relation')">
							<option value="">Choose</option>
							@foreach($relation_ships as $rs)
							<option value="{{$rs->id}}"  @if($isEdit) {{$applicant->relation_ship_id == $rs->id ? 'selected':''}} @endif>{{$rs->RelationShipName}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="abc125">Relation with (eg. Mr. John Smith)</label>
							<textarea type="text" class="form-control" name="Remark" id="abc125"> @if($isEdit)  {{$applicant->Remark}} @endif</textarea>
						</fieldset>
					</div>
				</div>
			</div>
			{{-- Added Form C Address --}}
			<div id="formcAddress" class="mt-5">
				<div class="from-group">
					<label for="FormC"><span class="eng">Form C Address</span><span class="mm">Form C တိုင်သည့်လိပ်စာ</span></label>
					<textarea name="FormC" id="FormC" class="form-control" rows="3" >@if($isEdit) {{ $applicant->FormC }} @endif</textarea>
				</div>
			</div>
			@if($isEdit)
				<input type="text" value="{{$applicant->id}}" name="detailId" hidden>
			@endif
			@if($isEdit)

				<div class="row mt-2">
					<div class="col-6 {{$applicant->passport_attach == null ? 'd-none':''}}">
						<div class="row mt-3">
							<div class="col-md-9">
								<label ><span class="mm">Passport </span><span class="eng">Passport </span></label>
							</div>
							<div class="col-md-3">
								<a href="{{ URL::to('/public'.$applicant->passport_attach) }}" class="btn btn-primary ">View</a>      
							</div>
						</div>
					</div>
					<div class="col-6 {{ $applicant->formcfile_attch == null ? 'd-none': '' }}">
						<div class="row mt-3">
							<div class="col-md-9">
								<label> <span class="mm">FormC Address</span><span class="eng">FormC Address</span></label>
							</div>
							<div class="col-md-3">
								<a href="{{ URL::to('/public'.$applicant->formcfile_attch) }}" class="btn btn-primary ">View</a>
							</div>
						</div>
					</div>
					<div class="col-6 {{$applicant->applicant_form_attach == null ? 'd-none':''}}">
						<div class="row mt-3">
							<div class="col-md-9">
								<label ><span class="mm">Undertaking </span><span class="eng">Undertaking </span></label>
							</div>
							<div class="col-md-3">
								<a href="{{ URL::to('/public'.$applicant->applicant_form_attach) }}" class="btn btn-primary ">View</a>                 
							</div>
						</div>
					</div>
					
					@if($applicant->person_type_id == 3 )
						<div class="col-6 {{$applicant->mic_approved_letter_attach == null ? 'd-none':''}}">
							<div class="row mt-3">
								<div class="col-md-9">
									<label ><span class="mm">MIC Approved Letter </span><span class="eng">MIC Approved Letter </span></label>
								</div>
								<div class="col-md-3">
									{{-- <a href="{{ URL::to('/public'.$applicant->mic_approved_letter_attach) }}" class="btn btn-primary ">View</a>              --}}
									<a href="{{ URL::to($applicant->mic_approved_letter_attach) }}" class="btn btn-primary ">View</a>
								</div>
							</div>
						</div>
						<div class="col-6 {{$applicant->labour_card_attach == null ? 'd-none':''}}">
							<div class="row mt-3">
								<div class="col-md-9">
									<label ><span class="mm">Labour Card </span><span class="eng">Labour Card </span></label>
								</div>
								<div class="col-md-3">
									{{-- <a href="{{ URL::to('/public'.$applicant->labour_card_attach) }}" class="btn btn-primary ">View</a>   --}}
									<a href="{{ URL::to($applicant->labour_card_attach) }}" class="btn btn-primary ">View</a>           
								</div>
							</div>
						</div>
					@elseif($applicant->person_type_id == 1)
						<div class="col-6 {{$applicant->extract_form_attach == null ? 'd-none':''}}">
							<div class="row mt-3">
								<div class="col-md-9">
									<label ><span class="mm">Extract Form</span><span class="eng">Extract Form</span></label>
								</div>
								<div class="col-md-3">
									<a href="{{ URL::to('/public'.$applicant->extract_form_attach) }}" class="btn btn-primary ">View</a>             
								</div>
							</div>
						</div>
						<div class="col-6 {{$applicant->labour_card_attach == null ? 'd-none':''}}">
							<div class="row mt-3">
								<div class="col-md-9">
									<label ><span class="mm">Labour Card </span><span class="eng">Labour Card </span></label>
								</div>
								<div class="col-md-3">
									<a href="{{ URL::to('/public'.$applicant->labour_card_attach) }}" class="btn btn-primary ">View</a>             
								</div>
							</div>
						</div>
					@else
						<div class="col-6 {{$applicant->mic_approved_letter_attach == null ? 'd-none':''}}">
							<div class="row mt-3">
								<div class="col-md-9">
									<label ><span class="mm">MIC Approved Letter </span><span class="eng">MIC Approved Letter </span></label>
								</div>
								<div class="col-md-3">
									<a href="{{ URL::to('/public'.$applicant->mic_approved_letter_attach) }}" class="btn btn-primary ">View</a>             
								</div>
							</div>
						</div>
						<div class="col-6 {{$applicant->technician_passport_attach == null ? 'd-none':''}}">
							<div class="row mt-3">
								<div class="col-md-9">
									<label ><span class="mm">Technician Passport </span><span class="eng">Technician Passport </span></label>
								</div>
								<div class="col-md-3">
									<a href="{{ URL::to('/public'.$applicant->technician_passport_attach) }}" class="btn btn-primary ">View</a>             
								</div>
							</div>
						</div>
						<div class="col-6 {{$applicant->evidence_attach == null ? 'd-none':''}}">
							<div class="row mt-3">
								<div class="col-md-9">
									<label ><span class="mm">Evidence </span><span class="eng">Evidence </span></label>
								</div>
								<div class="col-md-3">
									<a href="{{ URL::to('/public'.$applicant->evidence_attach) }}" class="btn btn-primary ">View</a>             
								</div>
							</div>
						</div>
						
					@endif
				</div>
			@endif
			<br/>
			<div class="row mt-3">
				<h3 class="text-center mt-3">APPLICANT ATTACHMENT</h3>
			</div>
			<div class="row mt-3">
				<span class="mm" style="color:red;"><b>မှတ်ချက်</b>: အောက်ပါအချက်များကို ပူးတွဲတင်ပြရန် (PDF ဖိုင်ဖြင့်သာ)</span><span class="eng" style="color:red;"><b>Note</b>: The following documents need to be attached (PDF File Only) </span>
				<br>
				<p id="attachmentLabel">Necessary Documents of the Applicant</p>
				<div class="row mt-2 appDivFirst">
					<div class="col-6 passport">
						<fieldset class="form-group">
							<label ><span class="mm">Passport </span><span class="eng">Passport </span></label>
							<input type="file" class="form-control " name="passport" accept="application/pdf" >
						</fieldset>
					</div>
					<div class="col-6 letter">
						<fieldset class="form-group">
							<label class="AppLetter"><span class="mm">MIC Approved Letter </span><span class="eng">MIC Approved Letter </span></label>
							<label class="techAppLetter"><span class="mm">MIC Approved Letter of Techanician </span><span class="eng">MIC Approved Letter  of Techanician  </span></label>
							<input type="file"   class="form-control " name="micLetter" accept="application/pdf" >
						</fieldset>
					</div>
					<div class="col-6 extract">
						<fieldset class="form-group">
							<label ><span class="mm">Extract Form</span><span class="eng">Extract Form</span></label>
							<input type="file"   class="form-control " name="extract" accept="application/pdf" >
						</fieldset>
					</div>
				</div>
				<div class="row mt-2 appDivLast">
					<div class="col-6 labourCard">
						<fieldset class="form-group">
							<label ><span class="mm">Labour Card </span><span class="eng">Labour Card </span></label>
							<input type="file"   class="form-control " name="labourCard" accept="application/pdf" >
						</fieldset>
					</div>
					<div class="col-6 undertaking">
						<fieldset class="form-group">
							<label ><span class="mm">Undertaking Form</span><span class="eng">Undertaking Form</span></label>
							<input type="file"   class="form-control " name="underTaking" accept="application/pdf" >
						</fieldset>
					</div>
					<div class="col-6 techPassport">
						<fieldset class="form-group">
							<label ><span class="mm">Technician Passport </span><span class="eng">Technician Passport </span></label>
							<input type="file"   class="form-control " name="techPassport" accept="application/pdf" >
						</fieldset>
					</div>
					<div class="col-6 evidence mt-2">
						<fieldset class="form-group">
							<label ><span class="mm">Evidence </span><span class="eng">Evidence </span></label>
							<input type="file"   class="form-control " name="evidence" accept="application/pdf" >

						</fieldset>
					</div>
					<div class="col-6 formCfile mt-2">
						<fieldset>
							<label for=""><span class="mm">Form C</span><span class="eng">Form C</span></label>
							<input type="file" class="form-control" name="formcfile" accept="application/pdf">
						</fieldset>
					</div>
				</div>
				{{-- <input type="text" value=""> --}}
                <div class="row mt-1">
                    <div class="mb-3 d-flex justify-content-end">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-danger button" id="cancel"  style="margin-right: 10px;" >Cancel</a>
                        <button class="bg-success  btn btn-success button" name="submitButton" value="{{$id}}" id="applySubmit"  type="submit" style="margin-right: 30px;">@if($isEdit) Update  @else Save Draft @endif</button>
			    	</div>  
                </div>
			</div>
		
			{{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
		</div>
	</form>
</div>
<script>
	
</script>

<script src="{{ asset('js/newApplyForm.js') }}"></script>
<script src="{{ asset('js/newApplicantAttach.js') }}"></script>
<script>


</script>


@if($isEdit)
<script src="{{ asset('js/newRejectApplicantAttach.js') }}"></script>

@endif



<script type="text/javascript">

	$("#myForm").submit(function () {
		$('#applySubmit').hide();
		$('#cancel').hide();
	});
	
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
	$('#labour_card_type_id').change(function(){
		if($(this).val() != '' ){
			$('#labourduration').show();
		}else{
			$('#labourduration').hide();
		}
	})

	var reject={{$id}};
	// နေထိုင်ခွင့်သက်တမ်းမကုန်ခင် stay ၂ လ ကြိုလျှောက်
	// must apply two month before stay expire date
	function checkTwoMonth(expireDateID,sourceID,stayDurationID){
    	var staySelected = document.getElementById(stayDurationID);
    	var expireDate = document.getElementById(expireDateID).value;
	
		const d = new Date();
		var newDate = new Date(d.setMonth(d.getMonth()+2)).toISOString().split('T')[0];
		var b = document.getElementById("applySubmit");
    	if (staySelected.value != '') {
    		if (newDate < expireDate) {
				b.disabled = true;
		    	b.style.background = "lightgrey"; //"#dc3545";
		    	document.getElementById(sourceID).style.visibility = "visible";
		    } else {
		    	b.disabled = false;
		    	b.style.background = "#4CAF50";
		    	document.getElementById(sourceID).style.visibility = "hidden";
		    }
    	} else {
	    	b.disabled = false;
	    	b.style.background = "#4CAF50";
	    	document.getElementById(sourceID).style.visibility = "hidden";
    	}
	}
	

	function checkAge(relationship,dateOfBirth,relation){
		var r = document.getElementById(relationship).value;
		var dob = document.getElementById(dateOfBirth).value;
		var x = document.getElementById(relation);
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
				b.style.background = "lightgrey"; //"#dc3545"
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

	function changeAttachmentLabel(){
	
		var t = document.getElementById('applicantType').value;
		var l = document.getElementById('attachmentLabel');

		if (t == 1 || t == 4) {
			$('#micApprovedDiv').hide();
			$('#passportDiv').addClass('col-6');
			$('#stayexpDiv').addClass('col-6');
			$("#pxq14").prop('required',false);
		}
		if(t == 3){
			$('#micApprovedDiv').show();
			$('#passportDiv').removeClass("col-6");
			$('#stayexpDiv').removeClass("col-6");
			$("#pxq14").prop('required',true);
		}
		switch(t){
			case "1":
			l.innerHTML = "Passport, Company Registration Card, Extract Form";
			break;
			case "3":
			l.innerHTML = "Passport, MIC Approved Letter, Labour Card (if any)";
			break;
			case "4":
			l.innerHTML = "Passport, Evidence (eg. Marriage Contract, Birth Certificate), MIC Approved Letter and Technician/Skill Labour's Passport (if Relation with Technician/Skill Labour)";
			break;
			case "":
			l.innerHTML = "Necessary Documents of the Applicant";
			break;
		}
	}

	

</script>

@endsection