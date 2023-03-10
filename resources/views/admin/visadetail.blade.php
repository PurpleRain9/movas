@extends('admin.layout')
@section('content')
{{-- WinToUni --}}
<script type="text/javascript" src="{{ asset('wintouni/tlsDebug.js') }}"></script>
<script type="text/javascript" src="{{ asset('wintouni/tlsMyanmarConverter.js') }}"></script>
<script type="text/javascript" src="{{ asset('wintouni/tlsMyanmarConverterData.js') }}"></script>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border-bottom: 1px solid #ccc;
  //background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: #9894e5;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 14px;
  color: white;
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
  border: 1px solid #ccc;
  border-top: none;
}

/* Style the close button */
.topright {
  float: right;
  cursor: pointer;
  font-size: 28px;
}

.topright:hover {color: red;}

p{line-height: 200%; font-size: 17px;}

.modal.contactInfo{
	top: 50%;
	transform: translateY(-20%);
}

#TableHeader th{background-color: #e0f0fe;}
//th{color: blue;font-weight: bold;}

</style>

<div class="container">

<input type="text" hidden id="approveLetterNo_sourceID" value="{{$data->ApproveLetterNo}}" /> 
<input type="text" hidden id="approveDate_sourceID" value="{{ \Carbon\Carbon::parse($data->ApproveDate)->format('d-m-Y') }}" />
<input type="text" hidden id="firstApplyDate_sourceID" value="{{ \Carbon\Carbon::parse($data->FirstApplyDate)->format('d-m-Y') }}">
<input type="text" hidden id="permitDateY_sourceID" value="{{ \Carbon\Carbon::parse($data->profile->PermittedDate)->format('Y') }}" />
<input type="text" hidden id="permitDateM_sourceID" value="{{ \Carbon\Carbon::parse($data->profile->PermittedDate)->format('m') }}" />
<input type="text" hidden id="permitDateD_sourceID" value="{{ \Carbon\Carbon::parse($data->profile->PermittedDate)->format('d') }}" />

<!-- <script type="text/javascript">
</script> -->

<script type="text/javascript">
  $(document).ready(function() {
  	var al = document.getElementById("approveLetterNo_sourceID").value;
  	var ad = document.getElementById("approveDate_sourceID").value;
  	var fd = document.getElementById("firstApplyDate_sourceID").value;

  	var py = document.getElementById("permitDateY_sourceID").value;
  	var pm = document.getElementById("permitDateM_sourceID").value;
  	var pd = document.getElementById("permitDateD_sourceID").value;

	document.getElementById("ApproveLetterNo").innerHTML = "မရက-၉/OSS/န-ဗီဇာ/" + uniConvert(al);			
	document.getElementById("ApproveDate").innerHTML = "ရက်စွဲ၊ " + uniConvert(ad);
	document.getElementById("FinalApplyDate").innerHTML = uniConvert(fd);

	document.getElementById("PermitDate").innerHTML = uniConvert(py) + " ခုနှစ်၊ " + MonthNameMM(pm) + " (" + uniConvert(pd) + ") ရက်နေ့";			
			
  });

	function MonthNameMM(n){
		switch(n) {
			case '01':
				return "ဇန်နဝါရီလ"
				break;
			case '02':
				return "ဖေဖော်ဝါရီလ"
				break;
			case '03':
				return "မတ်လ"
				break;
			case '04':
				return "ဧပြီလ"
				break;
			case '05':
				return "မေလ"
				break;
			case '06':
				return "ဇွန်လ"
				break;
			case '07':
				return "ဇူလိုင်လ"
				break;
			case '08':
				return "သြဂုတ်လ"
				break;
			case '09':
				return "စက်တင်ဘာလ"
				break;
			case '10':
				return "အောက်တိုဘာလ"
				break;
			case '11':
				return "နိုဝင်ဘာလ"
				break;
			case '12':
				return "ဒီဇင်ဘာလ"
				break;
		} 
	}
</script>

	<div class="tab">
	  <button class="tablinks notesheet" onclick="openCity(event, 'NoteSheet')" id="defaultOpen">Note Sheet</button>
	  <button class="tablinks replyletter" onclick="openCity(event, 'ReplyLetter')">Reply Letter</button>
	</div>

	<div id="NoteSheet" class="tabcontent">
		@if (session('errors'))
			<div class="alert alert-success">
				{{ session('errors') }}
			</div>
		@endif
	  <div class="d-xl-flex justify-content-between align-items-start">
	  <p class="mt-3 mb-2 ml-2">ရုံးတွင်းစာအကျဉ်းချုပ် <br>သို့မဟုတ် စာကြမ်းရေးရန်အတွက် </p>
	</div>

	<div class="container">
			<div class="row">
				<div class="col-md-10">
					
				</div>
				
				<div class="col-md-2">
					<p>
						ရက်စွဲ : {{ \Carbon\Carbon::parse($data->FinalApplyDate)->format('d-m-Y') }}
					</p>
				</div>
				
			</div>

			<div class="row mt-3">
				<div class="col-md-2">
					<p>အကြောင်းအရာ ။</p>
				</div>
				<div class="col-md-10">
					<p><strong><a data-toggle="modal" data-target="#userModal" class="companyName">{{$data->profile->CompanyName}}</a> မှ {{$data->Subject}}</strong></p>
				</div>
				<!-- Modal -->
				<div class="modal fade contactInfo" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="userModalLabel">Contact Info</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<table class="table table-bordered">
									<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Phone Number</th>
									</tr>
									<tr>
										<td>{{ $data->user->name }}</td>
										<td>{{ $data->user->email }}</td>
										<td>{{ $data->user->phone_no }}</td>
									</tr>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
					<p>၁။</p>
				</div>
				<div class="col-md-2">
					<p>ကုမ္ပဏီအမည် : </p>
				</div>
				<div class="col-md-9">
					<p>{{$data->profile->CompanyName}}</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
					<p>၂။</p>
				</div>
				<div class="col-md-2">
					<p>လုပ်ငန်းအမျိုးအစား : </p>
				</div>
				<div class="col-md-9">
					<p>{{$data->profile->BusinessType}}</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
					<p>၃။</p>
				</div>
				<div class="col-md-2">
					@if ($data->profile->permit_type_id == 1)
						<p>ခွင့်ပြုမိန့်အမှတ် : </p>
					@else
						<p>အတည်ပြုမိန့်အမှတ် : </p>
					@endif
					
				</div>
				<div class="col-md-9">
					<p>{{$data->profile->PermitNo}}</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
					<p>၄။</p>
				</div>
				<div class="col-md-2">
					<p>တည်နေရာ : </p>
				</div>
				<div class="col-md-9">
					<p>{{$data->profile->Township}}</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
					<p>၅။</p>
				</div>
				<div class="col-md-2">
					<p>စီးပွားဖြစ်စတင်နေ့ : </p>
				</div>
				<div class="col-md-9">
					<p>
						@if (!is_null($data->profile->CommercializationDate))
							{{ \Carbon\Carbon::parse($data->profile->CommercializationDate)->format('d M Y') }}
						@else
							-
						@endif
					</p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-1">
					<p>၆။</p>
				</div>
				<div class="col-md-11">
					<p>အဆိုပြုချက်၊ ထပ်တိုးနှင့် လက်ရှိခန့်ထားပြီး ပြည်တွင်း၊ ပြည်ပဝန်ထမ်းစာရင်းမှာ အောက်ပါအတိုင်းဖြစ်ပါသည် -</p>
				</div>
			</div>

			<div class="row mt-4">
				<table class="table table-inverse">
					<thead>
						<tr>
							<th></th>
							<th style="font-weight: bold;">အဆိုပြုချက်ပါ</th>
							<th style="font-weight: bold;">ထပ်တိုး</th>
							<th style="font-weight: bold;">စုစုပေါင်း</th>
							<th style="font-weight: bold;">ခန့်ထားပြီး</th>
							<th style="font-weight: bold;">ခန့်ရန်ကျန်</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>ပြည်တွင်းဝန်ထမ်း</td>
							<td>{{$data->profile->StaffLocalProposal}}</td>
							<td>{{$data->profile->StaffLocalSurplus}}</td>
							<td>{{$total_local}}</td>
							<td>{{$data->profile->StaffLocalAppointed}}</td>
							<td>{{$available_local}}</td>
							<td></td>
						</tr>
						<tr>
							<td>နိုင်ငံခြားသားဝန်ထမ်း</td>
							<td>{{$data->profile->StaffForeignProposal}}</td>
							<td>{{$data->profile->StaffForeignSurplus}}</td>
							<td>{{$total_foreign}}</td>
							<td>{{$data->profile->StaffForeignAppointed}}</td>
							<td>{{$available_foreign}}</td>
							<td><a href="{{ route('foreignTech',$data->profile->id) }}" class="btn btn-outline-primary">. . .</a></td>
						</tr>
						<tr>
							<td>ဒါရိုက်တာ</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $directors_total }}</td>
							<td>-</td>
							<td>-</td>
							<td><a href="{{ route('directorsOnly',$data->profile->id) }}" class="btn btn-outline-primary">. . .</a></td>
						</tr>

						<tr>
							<td>မှီခို</td>
							<td>-</td>
							<td>-</td>
							<td>{{ $dependants_total }}</td>
							<td>-</td>
							<td>-</td>
							<td><a href="{{ route('dependantsOnly',$data->profile->id) }}" class="btn btn-outline-primary">. . .</a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>
			<p class="mt-4" style="font-weight: bold;">Company Attachment</p>
			
			@if ($data->profile->AttachPermit != '')
				<div class="row mt-4" style="border-bottom: 1px solid lightgrey;">
					<div class="col">
						<span>MIC Permit</span>
					</div>
					<div class="col-md-4">
						<a href="/public{{$data->profile->AttachPermit}}" class="btn btn-sm btn-outline-primary ml-5">View File</a>
					</div>
					
				</div>
			@endif

			@if ($data->profile->AttachProposal != '')
				<div class="row mt-4" style="border-bottom: 1px solid lightgrey;">
					<div class="col">
						<span>Proposal Employee List as per Proposal</span>
					</div>
					<div class="col-md-4">
						<a href="/public{{$data->profile->AttachProposal}}" class="btn btn-sm btn-outline-primary ml-5">View File</a>
					</div>
					
				</div>
			@endif

			@if ($data->profile->AttachAppointed != '')
				<div class="row mt-4" style="border-bottom: 1px solid lightgrey;">
					<div class="col">
						<span>Appointed Employee List (Local & Foreign)</span>
					</div>
					<div class="col-md-4">
						<a href="/public{{$data->profile->AttachAppointed}}" class="btn btn-sm btn-outline-primary ml-5">View File</a>
					</div>
					
				</div>
			@endif

			@if ($data->profile->AttachIncreased != '')
				<div class="row mt-4" style="border-bottom: 1px solid lightgrey;">
					<div class="col">
						<span>Increased Employee List</span>
					</div>
					<div class="col-md-4">
						<a href="/public{{$data->profile->AttachIncreased}}" class="btn btn-sm btn-outline-primary ml-5">View File</a>
					</div>
					
				</div>
			@endif
			

				@foreach ($data->visa_head_attachments as $d)
			<div class="row mt-4" style="border-bottom: 1px solid lightgrey;">
				<div class="col">
					<span>{{$d->Description}}</span>
				</div>
				<div class="col-md-4">
					<a href="/public{{$d->FilePath}}" class="btn btn-sm btn-outline-primary ml-5">View File</a>
				</div>
				
			</div>
			@endforeach
			<br>

			<p class="mt-4" style="font-weight: bold;">စိစစ်တင်ပြချက်</p>

			<div class="row mt-3" style="display: block;overflow-x: auto;white-space: nowrap;">
				<table class="table table-bordered" id="TableHeader">
					<thead>
						<tr>
							<th>စဉ်</th>
							<th>အမည်/ရာထူး</th>
							<th>နိုင်ငံသား</th>
							<th>နိုင်ငံကူး<br>လက်မှတ်</th>
							<th>စတင်ခန့်ထားသည့်<br>ရက်စွဲ</th>
							<th>နေထိုင်ခွင့်သက်တမ်း<br>ကုန်ဆုံးမည့်နေ့</th>
							<th>ပြည်ဝင်ခွင့်</th>
							<th>နေထိုင်ခွင့်</th>
							<th>အလုပ်သမားကဒ်/<br>သက်တမ်း</th>
							<th></th>
						</tr>
					</thead>
					
					<tbody>
						@php
							$y=1
						@endphp
						@foreach ($data->visa_details as $vd)
						{{-- <h1>{{$vd->visa_detail_attachments}}</h1> --}}
							<tr>
								<td>{{$y++}}</td>
								<td>
									{{$vd->PersonName}} <br><br>@if (!is_null($vd->person_type))
										{{$vd->person_type->PersonTypeName}}
										@if ($vd->person_type->id == 3)
											<div class="mt-2">
												@if($vd->Rank)
													({{ $vd->Rank }})
												@else
													(.....)
												@endif
											</div>
										@endif
									@endif
									
									@if ($vd->person_type_id == 4)
									<hr>
											@if (!is_null($vd->relation_ship_id))
											{{$vd->relation_ship->RelationShipName}} of
											@endif
										@if (!is_null($vd->Remark))
											{{$vd->Remark}}
										@endif
									@endif
								</td>
								<td>{{$vd->nationality->NationalityName}}</td>
								<td>{{$vd->PassportNo}}</td>
								<td>@if (!is_null($vd->StayAllowDate))
									{{ \Carbon\Carbon::parse($vd->StayAllowDate)->format('d M Y') }}
									@else
									-
								@endif</td>
								<td>{{ \Carbon\Carbon::parse($vd->StayExpireDate)->format('d M Y') }}</td>
								<td>{{$vd->visa_type->VisaTypeNameMM ?? '-'}}</td>
								<td>{{$vd->stay_type->StayTypeNameMM ?? '-'}}</td>
								<td>{{$vd->labour_card_type->LabourCardTypeMM ?? ''}}/{{$vd->labour_card_duration->LabourCardDurationMM ?? '-'}}</td>
								{{-- htet --}}
								<td>
									<a href="{{ route('visa_detail_attach',$vd->id) }}" class="btn btn-outline-primary" >. . .</a>
								</td>
								<td class="mb-1">
									<tr rowspan="2">
										<th colspan="1" class="fw-light">Form C Address</th>
										<th colspan="9" class="fw-light text-left bg-white">{{ $vd->FormC }}</th>
									</tr>
								</td>
							</tr>
							
						@endforeach
					</tbody>

				</table>
			</div>

			@foreach ($remarks as $r)
				<div class="container-fluid mt-5" style="border-bottom: 1px solid lightgrey;">
					<div class="row">
						<div class="col-md-2">
							
						</div>
						<div class="col-md-4">
							<p style="text-decoration: underline;">ရေးသွင်းသူ</p>
						</div>
						<div class="col-md-4">
							<p style="text-decoration: underline;">ကြီးကြပ်သူ</p>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-2">
							အမည် -
						</div>
						<div class="col-md-4">
							<p>{{$r->a1_name}}</p>
						</div>
						<div class="col-md-4">
							<p>{{$r->a2_name}}</p>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-2">
							ရာထူး -
						</div>
						<div class="col-md-4">
							<p>{{$r->r1_name}}</p>
						</div>
						<div class="col-md-4">
							<p>{{$r->r2_name}}</p>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-2">
							မှတ်ချက် -
						</div>
						<div class="col-md-10">
							<p>{{$r->Remark}}</p>
						</div>
					</div>
					<div class="row mt-3 mb-2" >
						<div class="col-10">
							<small style="color: blue;">Sent : {{Carbon\Carbon::parse($r->created_at)->format('d M Y H:i:s')}}</small>
						</div>
						<div class="col">
							@if ($ad->Status == 1)
								<a class="btn btn-sm rounded btn-danger button" href="{{ route('deleteRemark',$r->id) }}" onclick="return confirm('Are you sure to delete?')">Delete</a>
							@else
								<button class="btn btn-sm btn-danger button" disabled>Delete</button>
							@endif
						</div>
					</div>
				</div>
			@endforeach
					{{-- <table class="table">
						<thead>
							<tr>
								<th></th>
								<th ></th>
								<th style="text-decoration: underline;"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($remarks as $r)
							<tr>
								<td>အမည်</td>
								<td>{{$r->a1_name}}</td>
								<td>{{$r->a2_name}}</td>
							</tr>
							<tr>
								<td>ရာထူး</td>
								<td>{{$r->r1_name}}</td>
								<td>{{$r->r2_name}}</td>
							</tr>
							@endforeach
						</tbody>
					</table> --}}
				
			

			<form action="{{ route('visa.send') }}" method="POST">
				@csrf
				<input type="hidden" name="visa_application_head_id" value="{{$data->id}}">

            <div class="row mt-5">
                <div class="col-md-1 mt-3"></div>
                <div class="col-md-5 mt-3"><strong><u>စိစစ်သူ</u></strong></div>
                
                <div class="col-md-1 mt-3"></div>
                <div class="col-md-5 mt-3"><strong><u>ပေးပို့မည့်သူ</u></strong></div>
                
                <div class="col-md-1 mt-3">အမည်</div>
                <div class="col-md-5 mt-3">{{Auth::user()->username}}</div>
                
                <div class="col-md-1 mt-3">အမည်</div>
                <div class="col-md-5 mt-3">
                    <select class="form-control id" name="ToAdminID" style="font-size: 15px !important;" required>
                    	<option value="">Choose</option>
                    	@foreach ($admins as $ad)
                    		<option value="{{$ad->id}} " class="{{ $ad->Status == 0 ? 'd-none' : '' }}">{{$ad->username}}</option>
                    	@endforeach
                    </select>        
                </div>
                
                <div class="col-md-1 mt-3">ရာထူး</div>
                @if (Auth::user()->id==1)
                	<div class="col-md-5 mt-3">System Adminstrator</div>
                @else
                	<div class="col-md-5 mt-3">{{Auth::user()->rank->RankNameMM}}</div>
                @endif

                <div class="col-md-1 mt-3">ရာထူး</div>
                <div class="col-md-5 mt-3" ><input type="text" class="" name="ToRankID" id="torank" style="border: none; height: 30px;" readonly></div>
            </div>

			<div class="row mt-5" style="margin-top: 5px;">
				<div class="col-md-2 lable">မှတ်ချက် : </div>
					<div class="col-md-8 radio">
							<input type="radio" id="choose" name="Remark" value="option1" checked>
							<label for="choose">မှတ်ချက်ရွေးရန်</label>
                            &nbsp;&nbsp;
							<input type="radio" id="write" name="Remark" value="option2">
							<label for="write">မှတ်ချက်ထည့်သွင်းရန်</label>
							
						<select class="form-control col-md-8 box option1" name="Comment1" style="font-size: 15px !important;">
							<option value="-">Choose</option>
							<option value="တင်ပြအပ်ပါသည်။">တင်ပြအပ်ပါသည်။</option>
							<option value="ဆက်လက်ဆောင်ရွက်ပါ။">ဆက်လက်ဆောင်ရွက်ပါ။</option>
							<option value="ခွင့်ပြုသည်။">ခွင့်ပြုသည်။</option>
							<option value="ခွင့်မပြုပါ။">ခွင့်မပြုပါ။</option>
						</select>
						<div class="col-md-8"><textarea name="Comment2" style="height: 200px; width: 800px;" class="form-control box option2"></textarea></div>
					</div>
				</div> 
		
		    <br>
			<div class="row mt-3" style="display:flex;justify-content:end;">
				@if (Auth::user()->rank_id != 5)
					@if (!Auth::user()->Status == 0)
						<button type="submit" class="btn btn-primary" style="width:100px;">တင်ပြမည်</button>
					@else
						<button type="submit" class="btn btn-primary" style="width:100px;" disabled>တင်ပြမည်</button>
					@endif
				@endif

				@if (Auth::user()->rank_id == 1)
					@if (!Auth::user()->Status == 0)
						<button type="button" data-toggle="modal" data-target="#exampleModal1" class="btn btn-danger ms-3" style="width:100px;">ပယ်ချမည်</button>
					@else
						<button type="button" data-toggle="modal" data-target="#exampleModal1" class="btn btn-danger ms-3" style="width:100px;" disabled>ပယ်ချမည်</button>
					@endif
				@endif
			</form>
			<form action="{{ route('visa.approve') }}" method="POST">
					@csrf
					<input type="hidden" name="visa_application_head_id" value="{{$data->id}}">
					@if (Auth::user()->rank_id > 3)
						<button type="submit" class="btn btn-success ml-3" onclick="return confirm('Are you sure to approved!')"  style="font-weight: lighter; font-size: 15px;" @if($ad->Status == 0) disabled @endif>ခွင့်ပြုမည်</button>
					@endif
			</form>
				@if (Auth::user()->rank_id > 1)
					<button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-info ml-3 mt-1" style="font-weight: lighter; font-size: 15px;width:100px;" @if($ad->Status == 0) disabled @endif>ပြန်ချမည်</button>
				@endif
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="exampleModalLabel">မှတ်ချက်ထည့်သွင်းရန်</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				      	<form action="{{ route('visa.turnDown') }}" method="POST">
							@csrf
							<input type="hidden" name="visa_application_head_id" value="{{$data->id}}">
					        <div class="form-group">
					            <textarea class="form-control" name="Comment" style="height: 300px;" placeholder="Comments go here...." required></textarea>
					          </div>
					     
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">Submit</button>
				      </div>
				      	</form>
				    </div>
				  </div>
				</div>
			</div>
			@if (Auth::user()->rank_id == 1)
				
						<!-- Modal -->
					<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">မှတ်ချက်ထည့်သွင်းရန် နှင့် ပြင်ဆင်မည့်သူကိုရွေးချယ်ပါရန်</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      	<form action="{{ route('visa.reject') }}" method="POST">
								@csrf
								<input type="hidden" name="visa_application_head_id" value="{{$data->id}}">
								<div class="row">
								<table class="table table-bordered bg-white text-center mt-3 mx-2">
									<thead>
										<tr>
										  <th></th>
										  <th>လျှောက်ထားသည့်နိုင်ငံခြားသား</th>
										</tr>
									  </thead>
									<tbody>
									  @php
									  	$count=$data->visa_details->count();
									  @endphp
									  @foreach($data->visa_details as $vd)    
										  <tr>
											<td>
											  {{-- <input id="checkPerson" type="checkbox" name="detail{{$vd->id}}" class="mr-4" id="visaDetail{{$vd->id}}"  {{$count == 1 ? 'required':''}} value="{{ $vd->PersonName }}"> --}}
											  <input id="checkPerson" type="checkbox" name="detail{{$vd->id}}" class="mr-4" id="visaDetail{{$vd->id}}" value="{{ $vd->PersonName }}">
											</td>
											<td>
											  <label for="visaDetail{{$vd->id}}">{{$vd->PersonName}}</label>
											</td>
										  </tr>
									  @endforeach
									</tbody>
								  </table>
								</div>
						        <div class="form-group mt-2">
						            <textarea class="form-control" name="Comment" style="height: 250px;" placeholder="Reject Reasons go here...." id="rejectCommentBox" required ></textarea>
						          </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to resubmit ? No applicant has been selected!')">Resubmit</button>
					      </div>
					</form>
					
					    </div>
					  </div>
					</div>
				</div>
			@endif
			</div>
			<br>
		
	</div>
	</div>
	
	
	
	<!-- 	Reply Letter Tab	-->

	<div id="ReplyLetter" class="tabcontent">
	    <br><br>
	  <div class="row">
		<div class="col-md-2 col-sm-2">
			<img src="{{ asset('images/MIC_Logo.jpg') }}" height="200">
		</div>
		<!--<div class="col-md-7 text-center col-sm-7">-->
		<!--	<p><strong>ပြည်ထောင်စုသမ္မတမြန်မာနိုင်ငံတော်</strong></p>-->
		<!--	<p><strong>မြန်မာနိုင်ငံရင်းနှီးမြှုပ်နှံမှုကော်မရှင်</strong></p>-->
		<!--	<p><strong>ဌာနဆိုင်ရာပူးပေါင်းလုပ်ငန်းအဖွဲ့</strong></p>-->
		<!--	<p>မြေကွက်အမှတ် ၄၉၊ စိမ်းလဲ့မေလမ်းသွယ်၊ </p>-->
		<!--	<p>ကမ္ဘာအေးဘုရားလမ်း၊ ရန်ကင်းမြို့နယ်၊ရန်ကုန်မြို့</p>-->
		<!--</div>-->
		<div class="col-md-7 text-center col-sm-7" style="font-size: 17px;">
			<strong>ပြည်ထောင်စုသမ္မတမြန်မာနိုင်ငံတော်အစိုးရ</strong><br><br>
			<strong>မြန်မာနိုင်ငံရင်းနှီးမြှုပ်နှံမှုကော်မရှင်</strong><br><br>
			<strong>ဌာနဆိုင်ရာပူးပေါင်းလုပ်ငန်းအဖွဲ့</strong><br><br>
			မြေကွက်အမှတ် ၄၉၊ စိမ်းလဲ့မေလမ်းသွယ် <br><br>
			ကမ္ဘာအေးဘုရားလမ်း၊ ရန်ကင်းမြို့နယ်၊ရန်ကုန်မြို့<br><br>
		</div>		
		<div class="col-md-2 mr-3 col-sm-2">
			<img src="{{ asset('images/stamp1.png') }}" height="200">
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-md-8">
			<p>၀၁-၆၅၈၂၆၃</p>
		</div>
		<div class="col">
			<p id="ApproveLetterNo">စာအမှတ်၊ မရက-၉/oss/န-ဗီဇာ/{{$data->ApproveLetterNo}}</p>
			{{-- <p>ရက်စွဲ၊ {{ \Carbon\Carbon::parse($data->ApproveDate)->format('j F, Y') }}</p> --}}
			<p id="ApproveDate">ရက်စွဲ၊ {{ \Carbon\Carbon::parse($data->ApproveDate)->format('d-m-Y') }}</p>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			သို့
		</div>
	</div>
	<!--<div class="row">-->
	<!--	<div class="col">-->
	<!--		<p class="ml-5">တာဝန်ခံအရာရှိ</p>-->
	<!--		<p class="ml-5">လူဝင်မှုကြီးကြပ်ရေးဦးစီးဌာန</p>-->
	<!--		<p class="ml-5">ဌာနဆိုင်ရာပူးပေါင်းလုပ်ငန်းအဖွဲ့</p>-->
	<!--		<p class="ml-5">တာဝန်ခံအရာရှိ</p>-->
	<!--		<p class="ml-5">အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန</p>-->
	<!--		<p class="ml-5">ဌာနဆိုင်ရာပူးပေါင်းလုပ်ငန်းအဖွဲ့</p>-->
	<!--	</div>-->
	<!--</div>-->
	<div class="row">
		<div class="col">
			<div class="ml-5 mt-2">တာဝန်ခံအရာရှိ @if ($data->OssStatus == 1)
				( လူဝင်မှုကြီးကြပ်ရေးဦးစီးဌာန )
				@elseif ($data->OssStatus == 2)
				( အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန )
				@elseif ($data->OssStatus == 3)
				( လူဝင်မှုကြီးကြပ်ရေးဦးစီးဌာန/အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန )
			@endif</div>
			<div class="ml-5 mt-2">ဌာနဆိုင်ရာပူးပေါင်းလုပ်ငန်းအဖွဲ့</div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-2">
			<span>အကြောင်းအရာ။</span>		
		</div>
		<div class="col">
			<span style="font-weight: bold;">{{$data->profile->CompanyName}}  မှ {{$data->Subject}}</span>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-md-2">
			<span>ရည်ညွှန်းချက်။</span>		
		</div>
		<div class="col" style="font-weight: bold;">
			<span>{{$data->profile->CompanyName}} ၏ (</span>
			<span id="FinalApplyDate"></span>
			<span>) ရက်စွဲပါစာ</span>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col" style="text-align: justify;
  text-justify: inter-word;">
			<span>၁။	 </span>
			<span class="ml-5" style="line-height:200%;">{{$data->profile->CompanyName}} သည် {{$data->profile->Township}} တွင် {{$data->profile->permit_type->PermitType}} ၏ 
			</span>
			<span id="PermitDate"></span>
			<span> ရက်စွဲပါ @if ($data->profile->permit_type_id == 1)
						ခွင့်ပြုမိန့်
					@else
						အတည်ပြုမိန့်
					@endif အမှတ် {{$data->profile->PermitNo}} အရ {{$data->profile->BusinessType}} ကို ဆောင်ရွက် လျက်ရှိပါသည်။</span>		
		</div>
	</div>

	<div class="row mt-3">
		<div class="col" style="text-align: justify;
  text-justify: inter-word;">
			<span>၂။	 </span>
			<span class="ml-5" style="line-height:200%;">ကုမ္ပဏီမှ ရည်ညွှန်းပါစာဖြင့် တင်ပြလျှောက်ထားလာသည့် အောက်ပါနိုင်ငံခြားသား@if (count($data->visa_details) > 1)များ@endifအား ဇယားပါအတိုင်း ပြုလုပ်ခွင့်ရရှိရေး တည်ဆဲဥပဒေများနှင့်ညီညွတ်ပါက ကန့်ကွက်ရန်မရှိပါကြောင်းနှင့် လိုအပ်သလို ဆက်လက်ဆောင်ရွက်နိုင်ပါရန် အကြောင်းကြားပါသည်။</span>		
		</div>
	</div>

	<div class="row mt-5" >
		<div class="col-md-12" >
			<table class="table table-bordered" style="">
				<thead style="">
					<tr>
						<th>စဉ်</th>
						<th>အမည်/ရာထူး</th>
						<th>နိုင်ငံသား</th>
						<th>နိုင်ငံကူး<br>လက်မှတ်</th>
						<th>နေထိုင်ခွင့်သက်တမ်း<br>ကုန်ဆုံးမည့်နေ့</th>
						<th>ပြည်ဝင်ခွင့်</th>
						<th>နေထိုင်ခွင့်</th>
						<th>အလုပ်သမားကဒ်/<br>သက်တမ်း</th>
					</tr>
				</thead>
				<tbody>
					@php
							$e=1
						@endphp
						@foreach ($data->visa_details as $vd)
							<tr>
								<td>{{$e++}}</td>
								<td>
									{{$vd->PersonName}} <br><br>@if (!is_null($vd->person_type))
										{{$vd->person_type->PersonTypeName}}
										@if ($vd->person_type->id == 3)
											<div class="mt-2">
												@if($vd->Rank)
													({{ $vd->Rank }})
												@else
													(.....)
												@endif
											</div>
										@endif
									@endif
									
									@if ($vd->person_type_id == 4)
									<hr>
											@if (!is_null($vd->relation_ship_id))
											{{$vd->relation_ship->RelationShipName}} of
											@endif
										@if (!is_null($vd->Remark))
											{{$vd->Remark}}
										@endif
									@endif
								</td>
								<td>{{$vd->nationality->NationalityName}}</td>
								<td>{{$vd->PassportNo}}</td>
								<td>{{ \Carbon\Carbon::parse($vd->StayExpireDate)->format('d M Y') }}</td>
								<td>{{$vd->visa_type->VisaTypeNameMM ?? '-'}}</td>
								<td>{{$vd->stay_type->StayTypeNameMM ?? '-'}}</td>
								<td>{{$vd->labour_card_type->LabourCardTypeMM ?? ''}}/{{$vd->labour_card_duration->LabourCardDurationMM ?? '-'}}</td>
								
								<td><a href="{{ route('visa_detail_attach',$vd->id) }}" class="btn btn-outline-primary" >. . .</a></td>
							</tr>
						@endforeach
				</tbody>
			</table>
		</div>
	</div>

	{{-- <div class="row mt-3">
		<div class="col">
			
		</div>
		<div class="col-md-2">
			<img src="{{ asset('images/sign.png') }}" width="100">
		</div>
	</div>

	<div class="row">
		<div class="col">
			
		</div>
		<div class="col-md-3">
			@if ($data->approve_rank_id == 4)
				<span>အဖွဲ့ခေါင်းဆောင် (ကိုယ်စား)</span>
			@else
				<span>အဖွဲ့ခေါင်းဆောင်</span>
			@endif
			
		</div>
	</div>
	<div class="row">
		<div class="col">
			
		</div>
		<div class="col-md-4">
			<span>{{$data->admin->username}} ({{$data->admin->rank->RankNameMM}})</span>
		</div>
	</div> --}}

	<div class="row mt-3">
		<!--<button type="submit" class="ml-3 btn btn-success">Accept</button>-->
		<!--<button type="submit" class="ml-3 btn btn-danger">Reject</button>-->
		<div class="col-md-9"></div>
		<div class="col-md-3 text-end">
			<button type="button" class="ml-3 btn btn-primary mytab22">Back</button>
		</div>
	</div>
	<br>
	</div>

	
</div>
<br><br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	let rejectChecked = false;
	let checkArr = [];
	$(document).ready(function(){

		$( "input#checkPerson" ).on( "click", function(){

			let isCheck = this.checked;
			if(isCheck){
				checkArr.push(this.value);
			}else{
				checkArr.pop(this.value); 
			}
			
			console.log(checkArr)
			
			let preText = 'Reject ချမည့်သူများ :'
			// let preText = !rejectChecked ? 'Reject ချမည့်သူများ : ' : ', '
			var checkedPeople = preText + checkArr.toString();
			document.getElementById('rejectCommentBox').innerHTML = checkedPeople;
			
			rejectChecked = true;
		});


		$(document).on('change', '.id', function(e) {
        e.preventDefault();
        var id = $(this).val();
        // alert(id);

        if(id != 0) {
	        	$.ajax({
	            url: '/toname',
	            data: {
	                "_token": "{{ csrf_token() }}",
	                "id": id
	            },
	            type: 'post',
	            dataType: 'json',
	            success: function(result) {
	            	$('#torank').empty();
	                $.each(result, function(k, v) {
	                    var torank = document.getElementById('torank');

	                    torank.value = v.RankNameMM;

	                });

	            },
	            error: function() {
	                //handle errors
	                alert('error...');
	            }
	        });
        }else {
        	// $('#torank').empty();
        	$('#torank').val('');
        }

        
    });

			$(".option2").hide();

		    $('input[type="radio"]').click(function(){
		        var inputValue = $(this).attr("value");
		        var targetBox = $("." + inputValue);
		        $(".box").not(targetBox).hide();
		        $(targetBox).show();
		    });

		     $(document).on("click",".mytab11",function() {
		            // alert('hello');
		            $('#NoteSheet').hide();
		             $('#ReplyLetter').show();
		            
		            $(".notesheet").removeClass("active");
		            $(".replyletter").addClass("active");
		        });

		        $(document).on("click",".mytab22",function() {
		            // alert('hello');
		            $('#NoteSheet').show();
		             $('#ReplyLetter').hide();
		            
		            $(".replyletter").removeClass("active");
		            $(".notesheet").addClass("active");
		        });
		});

	function openCity(evt, cityName) {
	  var i, tabcontent, tablinks;
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
	    tabcontent[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
	    tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }
	  document.getElementById(cityName).style.display = "block";
	  evt.currentTarget.className += " active";
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();
		
</script>
@endsection