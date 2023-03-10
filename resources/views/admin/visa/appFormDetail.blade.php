@extends('admin.layout')
@section('content')
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

#TableHeader th{background-color: #e0f0fe;}
//th{color: blue;font-weight: bold;}

</style>
@if (Auth::user()->rank->id <= 5)
<input type="text" hidden id="approveLetterNo_sourceID" value="{{$data->ApproveLetterNo}}" /> 
<input type="text" hidden id="approveDate_sourceID" value="{{ \Carbon\Carbon::parse($data->ApproveDate)->format('d-m-Y') }}" />
<input type="text" hidden id="firstApplyDate_sourceID" value="{{ \Carbon\Carbon::parse($data->FinalApplyDate)->format('d-m-Y') }}">
<input type="text" hidden id="permitDateY_sourceID" value="{{ \Carbon\Carbon::parse($data->PermittedDate)->format('Y') }}" />
<input type="text" hidden id="permitDateM_sourceID" value="{{ \Carbon\Carbon::parse($data->PermittedDate)->format('m') }}" />
<input type="text" hidden id="permitDateD_sourceID" value="{{ \Carbon\Carbon::parse($data->PermittedDate)->format('d') }}" />

<script type="text/javascript">
  $(document).ready(function() {
  	var al = document.getElementById("approveLetterNo_sourceID").value;
  	var ad = document.getElementById("approveDate_sourceID").value;
  	var fd = document.getElementById("firstApplyDate_sourceID").value;

  	var py = document.getElementById("permitDateY_sourceID").value;
  	var pm = document.getElementById("permitDateM_sourceID").value;
  	var pd = document.getElementById("permitDateD_sourceID").value;

	document.getElementById("ApproveLetterNo").innerHTML = "?????????-???/OSS/???-????????????/" + uniConvert(al);			
	document.getElementById("ApproveDate").innerHTML = "????????????????????? " + uniConvert(ad);
	document.getElementById("FinalApplyDate").innerHTML = uniConvert(fd);

	document.getElementById("PermitDate").innerHTML = uniConvert(py) + " ????????????????????? " + MonthNameMM(pm) + " (" + uniConvert(pd) + ") ??????????????????";			
			
  });

	function MonthNameMM(n){
		switch(n) {
			case '01':
				return "???????????????????????????"
				break;
			case '02':
				return "?????????????????????????????????"
				break;
			case '03':
				return "????????????"
				break;
			case '04':
				return "???????????????"
				break;
			case '05':
				return "?????????"
				break;
			case '06':
				return "???????????????"
				break;
			case '07':
				return "????????????????????????"
				break;
			case '08':
				return "?????????????????????"
				break;
			case '09':
				return "???????????????????????????"
				break;
			case '10':
				return "?????????????????????????????????"
				break;
			case '11':
				return "???????????????????????????"
				break;
			case '12':
				return "????????????????????????"
				break;
		} 
	}
</script>



	<div class="container">
	<div class="tab">
	  <button class="tablinks notesheet" onclick="openCity(event, 'NoteSheet')" id="defaultOpen">Note Sheet</button>
	  <button class="tablinks replyletter" onclick="openCity(event, 'ReplyLetter')">Reply Letter</button>
	</div>

	<div id="NoteSheet" class="tabcontent">
	  <div class="d-xl-flex justify-content-between align-items-start">
	  <p class="mt-3 mb-2 ml-2">?????????????????????????????????????????????????????????????????? <br>??????????????????????????? ?????????????????????????????????????????????????????? </p>
	</div>

	<div class="container">
			<div class="row">
				<div class="col-md-10">
					
				</div>
				
				<div class="col-md-2">
					<p>
						?????????????????? : {{ \Carbon\Carbon::parse($data->profile->FinalApplyDate)->format('d M Y') }}
					</p>
				</div>
				
			</div>

			<div class="row mt-3">
				<div class="col-md-2">
					<p>????????????????????????????????? ???</p>
				</div>
				<div class="col-md-10">
					<p><strong>{{$data->CompanyName}} ?????? {{$data->Subject}}</strong></p>
				</div>
			</div>

			<div class="row">
		    	<div class="col-md-1">
					<p>??????</p>
				</div>
				<div class="col-md-2">
					<p>????????????????????????????????? : </p>
				</div>
				<div class="col-md-9">
					<p>{{$data->CompanyName}}</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
					<p>??????</p>
				</div>
				<div class="col-md-2">
					<p>?????????????????????????????????????????????????????? : </p>
				</div>
				<div class="col-md-9">
					<p>{{$data->BusinessType}}</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
					<p>??????</p>
				</div>
				<div class="col-md-2">
					@if ($data->profile->permit_type_id == 1)
						<p>?????????????????????????????????????????????????????? : </p>
					@else
						<p>??????????????????????????????????????????????????? : </p>
					@endif
				</div>
				<div class="col-md-9">
					<p>{{$data->PermitNo}}</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
					<p>??????</p>
				</div>
				<div class="col-md-2">
					<p>????????????????????? : </p>
				</div>
				<div class="col-md-9">
					<p>{{$data->Township}}</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
					<p>??????</p>
				</div>
				<div class="col-md-2">
					<p>?????????????????????????????????????????????????????? : </p>
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
					<p>??????</p>
				</div>
				<div class="col-md-11">
					<p>???????????????????????????????????? ???????????????????????????????????? ??????????????????????????????????????????????????? ?????????????????????????????? ??????????????????????????????????????????????????????????????? ????????????????????????????????????????????????????????????????????? -</p>
				</div>
			</div>

			<div class="row mt-4">
				<table class="table table-inverse">
					<thead>
						<tr>
							<th></th>
							<th style="font-weight: bold;">???????????????????????????????????????</th>
							<th style="font-weight: bold;">?????????????????????</th>
							<th style="font-weight: bold;">??????????????????????????????</th>
							<th style="font-weight: bold;">?????????????????????????????????</th>
							<th style="font-weight: bold;">?????????????????????????????????</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>????????????????????????????????????????????????</td>
							<td>{{$data->StaffLocalProposal}}</td>
							<td>{{$data->StaffLocalSurplus}}</td>
							<td>{{$total_local}}</td>
							<td>{{$data->StaffLocalAppointed}}</td>
							<td>{{$available_local}}</td>
							<td></td>
						</tr>
						<tr>
							<td>???????????????????????????????????????????????????????????????</td>
							<td>{{$data->StaffForeignProposal}}</td>
							<td>{{$data->StaffForeignSurplus}}</td>
							<td>{{$total_foreign}}</td>
							<td>{{$data->StaffForeignAppointed}}</td>
							<td>{{$available_foreign}}</td>
							<td><a href="{{ route('foreignTech',$data->profile->id) }}" class="btn btn-outline-primary">. . .</a></td>
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
					<span>Description : {{$d->Description}}</span>
				</div>
				<div class="col-md-4">
					<a href="/public{{$d->FilePath}}" class="btn btn-sm btn-outline-primary ml-5">View File</a>
				</div>
				
			</div>
			@endforeach
			<br>

			<p class="mt-4" style="font-weight: bold;">??????????????????????????????????????????</p>

			<div class="row mt-3">
				<table class="table table-bordered table-responsive" id="TableHeader">
					<thead>
						<tr>
							<th>?????????</th>
							<th>????????????/???????????????</th>
							<th>??????????????????????????????</th>
							<th>???????????????????????????????????????????????????</th>
							<th>???????????????????????????????????????????????????????????????</th>
							<th>???????????????????????????????????? ??????????????????????????????????????????</th>
							<th>????????????????????????????????????</th>
							<th>????????????????????????????????????</th>
							<th>????????????????????????????????????</th>
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
								<td>{{$vd->labour_card_type->LabourCardTypeMM ?? '-'}}</td>
								<td>
									<a href="{{ route('visa_detail_attach',$vd->id) }}" class="btn btn-outline-primary" >. . .</a>
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
							<p style="text-decoration: underline;">??????????????????????????????</p>
						</div>
						<div class="col-md-4">
							<p style="text-decoration: underline;">??????????????????????????????</p>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-2">
							???????????? -
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
							??????????????? -
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
							???????????????????????? -
						</div>
						<div class="col-md-10">
							<p>{{$r->Remark}}</p>
						</div>
					</div>
					<div class="row mt-3 mb-2">
						<div class="col">
							<small style="color: blue;">Sent : {{Carbon\Carbon::parse($r->created_at)->format('d M Y H:i:s')}}</small>
						</div>
					</div>
				</div>
			@endforeach
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
		<!--	<p><strong>???????????????????????????????????????????????????????????????????????????????????????????????????</strong></p>-->
		<!--	<p><strong>??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</strong></p>-->
		<!--	<p><strong>????????????????????????????????????????????????????????????????????????????????????????????????</strong></p>-->
		<!--	<p>???????????????????????????????????? ????????? ????????????????????????????????????????????????????????? </p>-->
		<!--	<p>?????????????????????????????????????????????????????? ????????????????????????????????????????????????????????????????????????????????????</p>-->
		<!--</div>-->
		<div class="col-md-7 text-center col-sm-7" style="font-size: 17px;">
			<strong>?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</strong><br><br>
			<strong>??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</strong><br><br>
			<strong>????????????????????????????????????????????????????????????????????????????????????????????????</strong><br><br>
			???????????????????????????????????? ????????? ?????????????????????????????????????????????????????? <br><br>
			?????????????????????????????????????????????????????? ????????????????????????????????????????????????????????????????????????????????????<br><br>
		</div>		
		<div class="col-md-2 mr-3 col-sm-2">
			<img src="{{ asset('images/stamp1.png') }}" height="200">
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-md-8">
			<p><sapn style="font-family: wingdings;"></sapn> ??????-??????????????????</p>
		</div>
		<div class="col">
			<p id="ApproveLetterNo">???????????????????????? ?????????-???/oss/???-????????????/{{$data->ApproveLetterNo}}</p>
			<p id="ApproveDate">????????????????????? {{ \Carbon\Carbon::parse($data->ApproveDate)->format('d-m-Y') }}</p>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			????????????
		</div>
	</div>
	<!--<div class="row">-->
	<!--	<div class="col">-->
	<!--		<p class="ml-5">???????????????????????????????????????</p>-->
	<!--		<p class="ml-5">?????????????????????????????????????????????????????????????????????????????????</p>-->
	<!--		<p class="ml-5">????????????????????????????????????????????????????????????????????????????????????????????????</p>-->
	<!--		<p class="ml-5">???????????????????????????????????????</p>-->
	<!--		<p class="ml-5">???????????????????????????????????????????????????????????????????????????????????????</p>-->
	<!--		<p class="ml-5">????????????????????????????????????????????????????????????????????????????????????????????????</p>-->
	<!--	</div>-->
	<!--</div>-->
	<div class="row">
		<div class="col">
			<div class="ml-5 mt-2">??????????????????????????????????????? (
				@if ($data->OssStatus == 3)
				????????????????????????????????????????????????????????????????????????????????????/??????????????????????????????????????????????????????????????????????????????????????????
				@endif
				@if ($data->OssStatus == 2)
					??????????????????????????????????????????????????????????????????????????????????????????
				@endif
				@if ($data->OssStatus == 1)
					????????????????????????????????????????????????????????????????????????????????????
				@endif
		)</div>
			<div class="ml-5 mt-2">????????????????????????????????????????????????????????????????????????????????????????????????</div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-2">
			<span>????????????????????????????????????</span>		
		</div>
		<div class="col">
			<span style="font-weight: bold;">{{$data->CompanyName}}  ?????? {{$data->Subject}}</span>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-md-2">
			<span>??????????????????????????????????????????</span>		
		</div>
		<div class="col" style="font-weight: bold;">
			<span>{{$data->CompanyName}} ??? (</span>
			<span id="FinalApplyDate"></span>
			<span>) ??????????????????????????????</span>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col" style="text-align: justify;
  text-justify: inter-word;">
			<span>??????	 </span>
			<span class="ml-5" style="line-height:200%;">{{$data->CompanyName}} ????????? {{$data->Township}} ???????????? {{$data->profile->permit_type->PermitType}} ??? 
			</span>
			<span id="PermitDate"></span>
			<span> ???????????????????????? @if ($data->profile->permit_type_id == 1)
						???????????????????????????????????????
					@else
						????????????????????????????????????
					@endif ??????????????? {{$data->PermitNo}} ?????? {{$data->BusinessType}} ????????? ??????????????????????????? ???????????????????????????????????????</span>		
		</div>
	</div>

	<div class="row mt-3">
		<div class="col" style="text-align: justify;
  text-justify: inter-word;">
			<span>??????	 </span>
			<span class="ml-5" style="line-height:200%;">??????????????????????????? ?????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????? ???????????????????????????????????????????????????????????????@if (count($data->visa_details) > 1)????????????@endif????????? ??????????????????????????????????????? ????????????????????????????????????????????????????????? ????????????????????????????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????????????????????????????? ?????????????????????????????? ??????????????????????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????</span>		
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-md-12">
			<table class="table table-inverse table-responsive table-bordered">
				<thead>
					<tr>
						<th>?????????</th>
						<th>????????????/???????????????</th>
						<th>??????????????????????????????</th>
						<th>??????????????????????????????????????????????????????????????????</th>
						<th>???????????????????????????????????? ??????????????????????????????????????????????????????????????????</th>
						<th>????????????????????????????????????</th>
						<th>????????????????????????????????????</th>
						<th>????????????????????????????????????</th>
						<th></th>
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
								<td>{{$vd->labour_card_type->LabourCardTypeMM ?? '-'}}</td>
								
								<td><a href="{{ route('visa_detail_attach',$vd->id) }}" class="btn btn-outline-primary" >. . .</a></td>
							</tr>
						@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col">
			
		</div>
		<div class="col-md-4" style="text-align: center;">
			@if ($data->approve_rank_id == 4)
				<img src="{{ asset('images/mko_sign.png') }}" width="100">
			@else
				<img src="{{ asset('images/tah_sign.jpg') }}" width="100">
			@endif
			
		</div>
	</div>
	<div class="row">
		<div class="col">
			
		</div>
		<div class="col-md-4" style="text-align: center;">
			@if ($data->approve_rank_id == 4)
				<span>????????????????????????????????????????????????(????????????????????????)</span>
			@else
				<span>{{$data->admin->username}}</span>
			@endif
			
		</div>
	</div>

	<div class="row">
		<div class="col">
			
		</div>
		<div class="col-md-4" style="text-align: center;">
			@if ($data->approve_rank_id == 4)
				<span>({{$data->admin->username}}???{{$data->admin->rank->RankNameMM}})</span>
			@else
				<span>(????????????????????????????????????????????????)</span>
			@endif
			
		</div>
	</div>

	<div class="row mt-3">
		<!--<button type="submit" class="ml-3 btn btn-success">Accept</button>-->
		<a href="{{ route('print.pdf',$data->id) }}" class="ml-3 btn btn-success" target="_blank">Print</a>
		<button type="button" class="ml-3 btn btn-primary mytab22">Back</button>
	</div>
	<br>
	</div>

	
</div>
<br><br>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function(){
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

@else
<input type="text" hidden id="approveLetterNo_sourceID" value="{{$data->ApproveLetterNo}}" /> 
<input type="text" hidden id="approveDate_sourceID" value="{{ \Carbon\Carbon::parse($data->ApproveDate)->format('d-m-Y') }}" />
<input type="text" hidden id="firstApplyDate_sourceID" value="{{ \Carbon\Carbon::parse($data->FinalApplyDate)->format('d-m-Y') }}">
<input type="text" hidden id="permitDateY_sourceID" value="{{ \Carbon\Carbon::parse($data->PermittedDate)->format('Y') }}" />
<input type="text" hidden id="permitDateM_sourceID" value="{{ \Carbon\Carbon::parse($data->PermittedDate)->format('m') }}" />
<input type="text" hidden id="permitDateD_sourceID" value="{{ \Carbon\Carbon::parse($data->PermittedDate)->format('d') }}" />

<script type="text/javascript">
  $(document).ready(function() {
  	var al = document.getElementById("approveLetterNo_sourceID").value;
  	var ad = document.getElementById("approveDate_sourceID").value;
  	var fd = document.getElementById("firstApplyDate_sourceID").value;

  	var py = document.getElementById("permitDateY_sourceID").value;
  	var pm = document.getElementById("permitDateM_sourceID").value;
  	var pd = document.getElementById("permitDateD_sourceID").value;

	document.getElementById("ApproveLetterNo").innerHTML = "?????????-???/OSS/???-????????????/" + uniConvert(al);			
	document.getElementById("ApproveDate").innerHTML = "????????????????????? " + uniConvert(ad);
	document.getElementById("FinalApplyDate").innerHTML = uniConvert(fd);

	document.getElementById("PermitDate").innerHTML = uniConvert(py) + " ????????????????????? " + MonthNameMM(pm) + " (" + uniConvert(pd) + ") ??????????????????";			
			
  });

	function MonthNameMM(n){
		switch(n) {
			case '01':
				return "???????????????????????????"
				break;
			case '02':
				return "?????????????????????????????????"
				break;
			case '03':
				return "????????????"
				break;
			case '04':
				return "???????????????"
				break;
			case '05':
				return "?????????"
				break;
			case '06':
				return "???????????????"
				break;
			case '07':
				return "????????????????????????"
				break;
			case '08':
				return "?????????????????????"
				break;
			case '09':
				return "???????????????????????????"
				break;
			case '10':
				return "?????????????????????????????????"
				break;
			case '11':
				return "???????????????????????????"
				break;
			case '12':
				return "????????????????????????"
				break;
		} 
	}
</script>
<div class="container" style="border: 1px solid #ccc; padding: 6px 12px; margin-bottom: 40px;">
	<div class="row">
		<div class="col-md-2 col-sm-2">
			<img src="{{ asset('images/MIC_Logo.jpg') }}" height="200">
		</div>
		<!--<div class="col-md-7 text-center col-sm-7">-->
		<!--	<p><strong>???????????????????????????????????????????????????????????????????????????????????????????????????</strong></p>-->
		<!--	<p><strong>??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</strong></p>-->
		<!--	<p><strong>????????????????????????????????????????????????????????????????????????????????????????????????</strong></p>-->
		<!--	<p>???????????????????????????????????? ????????? ????????????????????????????????????????????????????????? </p>-->
		<!--	<p>?????????????????????????????????????????????????????? ????????????????????????????????????????????????????????????????????????????????????</p>-->
		<!--</div>-->
		<div class="col-md-7 text-center col-sm-7" style="font-size: 17px;">
			<strong>?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</strong><br><br>
			<strong>??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</strong><br><br>
			<strong>????????????????????????????????????????????????????????????????????????????????????????????????</strong><br><br>
			???????????????????????????????????? ????????? ?????????????????????????????????????????????????????? <br><br>
			?????????????????????????????????????????????????????? ????????????????????????????????????????????????????????????????????????????????????<br><br>
		</div>		
		<div class="col-md-2 mr-3 col-sm-2">
			<img src="{{ asset('images/stamp1.png') }}" height="200">
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-md-8">
			<p><sapn style="font-family: wingdings;"></sapn> ??????-??????????????????</p>
		</div>
		<div class="col">
			<p id="ApproveLetterNo">???????????????????????? ?????????-???/oss/???-????????????/{{$data->ApproveLetterNo}}</p>
			<p id="ApproveDate">????????????????????? {{ \Carbon\Carbon::parse($data->ApproveDate)->format('d-m-Y') }}</p>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			????????????
		</div>
	</div>
	<!--<div class="row">-->
	<!--	<div class="col">-->
	<!--		<p class="ml-5">???????????????????????????????????????</p>-->
	<!--		<p class="ml-5">?????????????????????????????????????????????????????????????????????????????????</p>-->
	<!--		<p class="ml-5">????????????????????????????????????????????????????????????????????????????????????????????????</p>-->
	<!--		<p class="ml-5">???????????????????????????????????????</p>-->
	<!--		<p class="ml-5">???????????????????????????????????????????????????????????????????????????????????????</p>-->
	<!--		<p class="ml-5">????????????????????????????????????????????????????????????????????????????????????????????????</p>-->
	<!--	</div>-->
	<!--</div>-->
	<div class="row">
		<div class="col">
			<div class="ml-5 mt-2">??????????????????????????????????????? (
				@if ($data->OssStatus == 3)
				????????????????????????????????????????????????????????????????????????????????????/??????????????????????????????????????????????????????????????????????????????????????????
				@endif
				@if ($data->OssStatus == 2)
					??????????????????????????????????????????????????????????????????????????????????????????
				@endif
				@if ($data->OssStatus == 1)
					????????????????????????????????????????????????????????????????????????????????????
				@endif
		)</div>
			<div class="ml-5 mt-2">????????????????????????????????????????????????????????????????????????????????????????????????</div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-2">
			<span>????????????????????????????????????</span>		
		</div>
		<div class="col">
			<span style="font-weight: bold;">{{$data->CompanyName}}  ?????? {{$data->Subject}}</span>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-md-2">
			<span>??????????????????????????????????????????</span>		
		</div>
		<div class="col">
			<span style="font-weight: bold;"><span>{{$data->CompanyName}} ??? (</span>
			<span id="FinalApplyDate"></span>
			<span>) ??????????????????????????????</span>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col" style="text-align: justify;
  text-justify: inter-word;">
			<span>??????	 </span>
			<div class="col">
			<span>??????	 </span>
			<span class="ml-5" style="line-height:200%;">{{$data->CompanyName}} ????????? {{$data->Township}} ???????????? {{$data->profile->permit_type->PermitType}} ??? 
			</span>
			<span id="PermitDate"></span>
			<span> ???????????????????????? @if ($data->profile->permit_type_id == 1)
						???????????????????????????????????????
					@else
						????????????????????????????????????
					@endif ??????????????? {{$data->PermitNo}} ?????? {{$data->BusinessType}} ????????? ??????????????????????????? ???????????????????????????????????????</span>		
		</div>		
		</div>
	</div>

	<div class="row mt-3">
		<div class="col" style="text-align: justify;
  text-justify: inter-word;">
			<span>??????	 </span>
			<span class="ml-5" style="line-height:200%;">??????????????????????????? ?????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????? ???????????????????????????????????????????????????????????????@if (count($data->visa_details) > 1)????????????@endif????????? ??????????????????????????????????????? ????????????????????????????????????????????????????????? ????????????????????????????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????????????????????????????????????? ?????????????????????????????? ??????????????????????????????????????????????????????????????????????????? ??????????????????????????????????????????????????????</span>		
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-md-12">
			<table class="table table-inverse table-responsive table-bordered">
				<thead>
					<tr>
						<th>?????????</th>
						<th>????????????/???????????????</th>
						<th>??????????????????????????????</th>
						<th>??????????????????????????????????????????????????????????????????</th>
						<th>???????????????????????????????????? ??????????????????????????????????????????????????????????????????</th>
						<th>????????????????????????????????????</th>
						<th>????????????????????????????????????</th>
						<th>????????????????????????????????????</th>
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
								<td>{{$vd->labour_card_type->LabourCardTypeMM ?? '-'}}</td>
							</tr>
						@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col">
			
		</div>
		<div class="col-md-4" style="text-align: center;">
			@if ($data->approve_rank_id == 4)
				<img src="{{ asset('images/mko_sign.png') }}" width="100">
			@else
				<img src="{{ asset('images/tah_sign.jpg') }}" width="100">
			@endif
			
		</div>
	</div>
	<div class="row">
		<div class="col">
			
		</div>
		<div class="col-md-4" style="text-align: center;">
			@if ($data->approve_rank_id == 4)
				<span>{{$data->admin->username}} ({{$data->admin->rank->RankNameMM}})</span>
			@else
				<span>{{$data->admin->username}}</span>
			@endif
			
		</div>
	</div>

	<div class="row">
		<div class="col">
			
		</div>
		<div class="col-md-4" style="text-align: center;">
			@if ($data->approve_rank_id == 4)
				<span>( ???????????????????????????????????????????????? (????????????????????????) )</span>
			@else
				<span>( ???????????????????????????????????????????????? )</span>
			@endif
			
		</div>
	</div>

	<div class="row mt-3">
		@if (Auth::user()->rank_id == 6 && $data->LabourActionStatus == 0)
			<a href="{{ route('ossl.approve',$data->id) }}" class="btn btn-success ml-3" style="font-weight: lighter; font-size: 15px;" onclick="return confirm('are you sure?');">?????????????????????????????????</a>
		@endif
		@if (Auth::user()->rank_id == 7 && $data->IntegrationActionStatus == 0)
			<a href="{{ route('ossi.approve',$data->id) }}" class="btn btn-success ml-3" style="font-weight: lighter; font-size: 15px;" onclick="return confirm('are you sure?');">?????????????????????????????????</a>

			<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-danger ml-3" style="font-weight: lighter; font-size: 15px;">????????????????????????</button>

						<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">????????????????????????????????????????????????????????????</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      	<form action="{{ route('ossi.reject',$data->id) }}" method="get">
								@csrf
								{{-- <input type="hidden" name="visa_application_head_id" value="{{$data->id}}"> --}}
						        <div class="form-group">
						            <textarea class="form-control" name="cmt" style="height: 300px;" placeholder="Reject Reasons go here...." required></textarea>
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
		@endif
		
		

		<a href="{{ route('print.pdf',$data->id) }}" class="ml-3 btn btn-primary" target="_blank">Print</a>
		{{-- <button type="button" class="ml-3 btn btn-primary mytab22">Back</button> --}}
	</div>
	
</div>
@endif

@endsection