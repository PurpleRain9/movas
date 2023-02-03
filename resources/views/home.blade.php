@extends('layout')
@section('content')
<script type="text/javascript" src="{{ asset('wintouni/tlsDebug.js') }}"></script>
<script type="text/javascript" src="{{ asset('wintouni/tlsMyanmarConverter.js') }}"></script>
<script type="text/javascript" src="{{ asset('wintouni/tlsMyanmarConverterData.js') }}"></script>
<style>
	.button {
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  //margin: 4px 2px;
}
.accordion {
  cursor: pointer;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
  height: 40px;
  background-color: #cdc8c8;
}

.active, .accordion:hover {
  background-color: #9f9b9b;
}

.accordion:after {
  content: "x";
  color: black;
  font-weight: bold;
  float: right;
  margin-right: 20px;
}

.active:after  {
  content: "+";
}

	.badge{display:inline-block;padding:.25em .4em;font-size:75%;font-weight:700;line-height:1;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25rem}.badge:empty{display:none}.btn .badge{position:relative;top:-1px}.badge-pill{padding-right:.6em;padding-left:.6em;border-radius:10rem}.badge-primary{color:#fff;background-color:#007bff}.badge-primary[href]:focus,.badge-primary[href]:hover{color:#fff;text-decoration:none;background-color:#0062cc}.badge-secondary{color:#fff;background-color:#6c757d}.badge-secondary[href]:focus,.badge-secondary[href]:hover{color:#fff;text-decoration:none;background-color:#545b62}.badge-success{color:#fff;background-color:#28a745}.badge-success[href]:focus,.badge-success[href]:hover{color:#fff;text-decoration:none;background-color:#1e7e34}.badge-info{color:#fff;background-color:#17a2b8}.badge-info[href]:focus,.badge-info[href]:hover{color:#fff;text-decoration:none;background-color:#117a8b}.badge-warning{color:#212529;background-color:#ffc107}.badge-warning[href]:focus,.badge-warning[href]:hover{color:#212529;text-decoration:none;background-color:#d39e00}.badge-danger{color:#fff;background-color:#dc3545}.badge-danger[href]:focus,.badge-danger[href]:hover{color:#fff;text-decoration:none;background-color:#bd2130}.badge-light{color:#212529;background-color:#f8f9fa}.badge-light[href]:focus,.badge-light[href]:hover{color:#212529;text-decoration:none;background-color:#dae0e5}.badge-dark{color:#fff;background-color:#343a40}.badge-dark[href]:focus,.badge-dark[href]:hover{color:#fff;text-decoration:none;background-color:#1d2124}
</style>
    <script type="text/javascript">
    	$(document).ready(function() {
			  window.setTimeout(function() {
			    $(".myalert").fadeTo(2000, 500).slideUp(500, function(){
			        $(this).remove(); 
			    });
			}, 3000);
		});

        function changeLanguage(val) {
            sessionStorage.setItem("language", val);

            if (val == "eng") {
                $('.mm').hide();
                $('.eng').show();

            } else {
                $('.eng').hide();
                $('.mm').show();
            }
        }

        function checkLan() {
            var lan = sessionStorage.getItem("language");
            if (lan) {
                changeLanguage(lan);
            } else {
                changeLanguage("eng");
            }
        }      

    </script>
    @php
    $r_from_date = request()->from_date === null? '' : request()->from_date;
    $r_to_date = request()->to_date === null? '' : request()->to_date;
    $r_person_type_id = request()->person_type_id === null? '' : request()->person_type_id;
    if(old()){
        $r_from_date = old('from_date');
        $r_to_date = old('to_date');
        $r_person_type_id = old('person_type_id');
    }
    @endphp
	
		<div class="container mt-4">
			{{-- <div class="alert alert-success alert-dismissible myalert" role="alert">
				
			  <strong>Keep your information up to date.To update your profile information! <a href="{{ route('editprofile') }}" class="btn btn-outline-success">Click Here</a></strong>
			  <button type="button" class="close btn btn-outline-danger" style="margin-left: 50px;" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div> --}}
			<div class="row">
				<div class="col-md-12">
					<button class="accordion "><span class="ms-3" id="title" > <strong> Rule And Regulation</span> </strong></button>
					<div class="panel ">
						<div class="border border-dark">
							<ul class="mt-3">
								<li class="mt-2">MOVAS System တွင် ဝင်ရောက်လျှောက်ထားမည့် နိုင်ငံခြားသားများ၏ဗီဇာသည် Business ဗီဇာ ဖြစ်ရပါမည်။</li>
								<li class="mt-2">နိုင်ငံခြားသားများ၏ နေထိုင်ခွင့်သက်တမ်း ကုန်ဆုံးရက်မတိုင်မီ ၂လ ကြိုတင်လျှောက်ထားနိုင်ပါသည်။ </li>
								<li class="mt-2">MOVAS တွင် ဒုတိယအကြိမ် နေထိုင်ခွင့်သက်တမ်းတိုးပါက အလုပ်သမား မှတ်ပုံတင်ကတ်အား သက်တမ်းတိုးလျှောက်ထားရမည်ဖြစ်ပါသည်။</li>
								<li class="mt-2">နိုင်ငံခြားသားများ၏ မှီခိုသူများလျှောက်ထားရာတွင် လက်ထက်ထားသောဇနီး၊ သားသမီးအရင်းအခြာများ နှင့် မိဘအရင်းအခြာများသာလျှောက်ထားရန်။ <br>
									(သားသမီးများအား ၁၈နှစ်အောက်နှင့် မိဘများအား ၆၀ နှစ်အထက် ထိသာလျှောက်ထားနိုင်ပါသည်။) </li>
		
								<li>
									နေထိုင်ခွင့်ရက်ကျော်လွန်နေသော(Overstay) နိုင်ငံခြားသားများအား  MOVAS system မှ လက်ခံဆောင်ရွက်ပေးမည်မဟုတ်ပါကြောင်း အသိပေးအပ်ပါသည်။
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="row mb-3 mt-4">
					<div class="col-md-10 col-sm-6">
						<form class="navbar-form" action="{{ route('home') }}" method="get">
			              <div class="input-group no-border">
			              	<label class="mt-2" style="margin-right: 10px;">Status</label>
			              	<select class="form-control" name="status" style="border-radius: 3px;">
								<option value="">Choose</option>
								<option value="0">In-Process</option>
								<option value="1">Approved</option>
								<option value="2">Resubmitted</option>
                            </select>
			                {{-- <input type="text" id="search" class="form-control" placeholder="Search..." name="query"> --}}
			                <label class="mt-2" style="margin-left: 10px;margin-right: 10px;">From</label>
			                <input type="date" id="search" class="form-control" style="border-radius: 3px;" name="from_date" value="{{$r_from_date}}">
			                <label class="mt-2" style="margin-left: 10px;margin-right: 10px;">To</label>
			                <input type="date" id="search" class="form-control" style="border-radius: 3px;" name="to_date" value="{{$r_to_date}}">

			                <button type="submit" style="margin-left: 10px;margin-right: 10px;border-radius: 3px;" class="btn btn-primary btn-round btn-just-icon">
			                  <i class="fa fa-search"></i>
			                  <div class="ripple-container"></div>
			                </button>

			                <label class="text-danger"><b>{{$errors->first('from_date')}}</b></label>
		                    <label class="text-danger"><b>{{$errors->first('to_date')}}</b></label>
			              </div>
			            </form>
					</div>
				</div>
			<table class="table table-hover table-bordered">
				<thead>
					<tr style="background: #e4f7eb;">
						<th style="font-weight: normal;text-align: center;" width="70">No</th>
						<th style="font-weight: normal;text-align: center;" width="170">First Apply Date</th>
						<th style="font-weight: normal;text-align: center;" width="170">Final Apply Date</th>
						<th style="font-weight: normal;text-align: center;" >Description</th>
						<th style="font-weight: normal;text-align: center;" width="100">Status</th>
						<th style="font-weight: normal;text-align: center;" width="150">Action</th>
					</tr>
				</thead>
				<tbody>
				@php
                  $i=1;
                  $ia=1;
                  $ib=1;
                  $ic=1;
                  $id=1;
                  $ie=1;
                  $if=1;
                  $aa=1;
                  $ab=1;
                  $ac=1;
                  $ad=1;
                  $ae=1;
                  $af=1;
                  $ba=1;
                  $bb=1;
                @endphp
                @foreach ($visa_heads as $key => $value)
                
				@if ($value->Status == 1)
				<input type="text" hidden id="approveLetterNo_sourceID{{$ia++}}" value="{{$value->ApproveLetterNo}}" /> 
				<input type="text" hidden id="approveDate_sourceID{{$ib++}}" value="{{ \Carbon\Carbon::parse($value->ApproveDate)->format('d-m-Y') }}" />
					<script>
					$(document).ready(function() {
						var al{{$aa++}} = document.getElementById("approveLetterNo_sourceID{{$ic++}}").value;
						var ad{{$ab++}} = document.getElementById("approveDate_sourceID{{$id++}}").value;  

						document.getElementById("ApproveLetterNo{{$ie++}}").innerHTML = "မရက-၉/OSS/န-ဗီဇာ/" + uniConvert(al{{$ac++}});      
						document.getElementById("ApproveDate{{$if++}}").innerHTML = uniConvert(ad{{$ad++}});
					});
						
					</script>
				@endif

						<tr>
							<td class="text-center">{{$visa_heads->firstItem() + $key}}</td>
							{{-- <td>
								{{$value->FirstApplyDate}}
							</td> --}}
							<td class="text-center">{{ \Carbon\Carbon::parse($value->FirstApplyDate)->format('j F, Y') }}</td>
							<td class="text-center">
								{{-- @php
									echo date("d/m/Y");
								@endphp --}}
								@if ($value->FinalApplyDate)
									{{ \Carbon\Carbon::parse($value->FinalApplyDate)->format('j F, Y') }}
								@else
									&nbsp;
								@endif
								
							</td>
							<td class="text-wrap">
								{{$value->Subject}}<br>@if ($value->Status == 2)
									<span class="text-danger">{{$value->RejectComment}}</span>
								@endif
							</td>
							<td class="text-center">
								@if ($value->Status == 0 || $value->Status == 3)
									<label class="badge badge-info">In-Process</label>
									<td class="text-center"><a class="btn btn-sm rounded btn-primary button" href="{{ route('visa.detail',$value->id) }}">Show</a></td>
								@endif
								@if($value->Status == 1)
									<label class="badge badge-success">Approved</label>
									<td class="text-center"><button type="button" data-toggle="modal" data-target="#exampleModal{{$ba++}}" id="showApproveModal" class="btn btn-sm rounded btn-primary button" style="font-weight: lighter; font-size: 15px;" data-id="{{ $value->id }}">Show</button></td>

									

									<!-- Modal -->
									<div class="modal fade" id="exampleModal{{$bb++}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" style="max-width: 80%" role="document">
										  <div class="modal-content">
											<div class="modal-header">
											  <h5 class="modal-title" id="exampleModalLabel">Approved Date & Approve Letter No</h5>
											  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											  </button>
											</div>
											<div class="modal-body">
												<form>
												  <div class="form-group">
													  {{-- <p>{{$value->id}}</p> --}}
													  <p  id="ApproveDate{{$ae++}}">{{ \Carbon\Carbon::parse($value->ApproveDate)->format('d-m-Y') }}</p><br><p id="ApproveLetterNo{{$af++}}">á€…á€¬á€¡á€™á€¾á€á€ºáŠ á€™á€›á€€-á‰/oss/á€”-á€—á€®á€‡á€¬/{{$value->ApproveLetterNo}}</p>
													  <div class="row mt-5 mb-2 fw-bold">
														<p class="col">စဉ်</p>
														<p class="col-2">အမည်/ရာထူး</p>
														<p class="col">နိုင်ငံသား</p>
														<p class="col">နိုင်ငံကူးလက်မှတ်</p>
														<p class="col">စတင်ခန့်ထားသည့်ရက်စွဲ</p>
														<p class="col">နေထိုင်ခွင့်ကုန်ဆုံးမည့်နေ</p>
														<p class="col">ပြည်ဝင်ခွင့်</p>
														<p class="col">နေထိုင်ခွင့်</p>
														<p class="col">အလုပ်သမားကဒ်/သက်တမ်း</p>

													  </div>
													  @foreach ($value->visa_details as $key => $vd)
														<div class="row">
															<p class="col">{{ ++$key }}</p>
															<p class="col-2">
																{{ $vd->PersonName }} <br>
																(
																	@if ($vd->person_type_id == 4)
																		{{ $vd->person_type->PersonTypeName }}({{ $vd->relation_ship->RelationShipName }})
																	@else
																		{{ $vd->person_type->PersonTypeName }}
																	@endif
																)
															</p>
															<p class="col">{{ $vd->nationality->NationalityName }}</p>
															<p class="col">{{ $vd->PassportNo }}</p>
															<p class="col">{{ $vd->StayAllowDate }}</p>
															<p class="col">{{ $vd->StayExpireDate }}</p>
															<p class="col">
																@if ($vd->visa_type_id)
																	{{ $vd->visa_type->VisaTypeNameMM }}
																@endif
															</p>
															<p class="col">
																@if ($vd->stay_type_id)
																	{{ $vd->stay_type->StayTypeNameMM }}
																@endif
															</p>
															<p class="col">
																@if ($vd->labour_card_type_id)
																	{{ $vd->labour_card_type->LabourCardTypeMM }}
																@endif
																/
																@if ($vd->labour_card_duration_id)
																	{{ $vd->labour_card_duration->LabourCardDurationMM }}
																@endif
															</p>

														</div>
													  @endforeach
													</div>
											   
											<div class="modal-footer">
											  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
												</form>
										  </div>
										</div>
									  </div>
								  </div>
  
									
									{{-- <td style="line-height: 24px; width: 300px;"><span  id="ApproveDate{{$ae++}}">{{ \Carbon\Carbon::parse($value->ApproveDate)->format('d-m-Y') }}</span><br><span id="ApproveLetterNo{{$af++}}">စာအမှတ်၊ မရက-၉/oss/န-ဗီဇာ/{{$value->ApproveLetterNo}}</span></td> --}}
								@endif
								@if($value->Status == 2)
									<label class="badge badge-danger">Resubmitted</label>
									<td class="text-center"><a class="btn btn-sm rounded btn-primary button" href="{{ route('applyFormReject',$value->id) }}">Show</a>
									<a href="{{ route('visa.delete',$value->id) }}" class="btn btn-sm rounded btn-primary button btn-danger"  onclick="return confirm('Are you sure you want to delete?')" > Delete</a></td>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			{{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" style="max-width: 80%" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Approved Date & Approve Letter No</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>
								<span id="ApproveDate"></span>
							</p>
							<br>
							<p>
								စာအမှတ်၊ မရက-၉/oss/န-ဗီဇာ/<span id="ApproveLetterNo"></span>
							</p>
							<table class="table table-border">
								<thead>
									<tr>
										<th>စဉ်</th>
										<th>အမည်/ရာထူး</th>
										<th>နိုင်ငံသား</th>
										<th>နိုင်ငံကူးလက်မှတ်</th>
										<th>စတင်ခန့်ထားသည့်ရက်စွဲ</th>
										<th>နေထိုင်ခွင့်သက်တမ်း ကုန်ဆုံးမည့်‌နေ့</th>
										<th>ပြည်ဝင်ခွင့်</th>
										<th>နေထိုင်ခွင့်</th>
										<th>အလုပ်သမားကဒ်/သက်တမ်း</th>
									</tr>
								</thead>
								<tbody id="details">

								</tbody>
							</table>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div> --}}
		</div>
		{{ $visa_heads->withQueryString()->links() }}
		<script>
			// $(document).on('click', '#showApproveModal', function(){
			// 	var id = $(this).attr('data-id')

			// 	var data = {id: id};

			// 	$.ajax({
			// 		type: "GET",
			// 		url: "/approvedVisa",
			// 		data: data,
			// 		dataType: "JSON",
			// 		success: function (response) {
			// 			console.log(response)
			// 			$('#ApproveDate').text(response.visa_head.ApproveDate)
			// 			$('#ApproveLetterNo').text(response.visa_head.ApproveLetterNo)

			// 			var output = '';
			// 			// console.log(response.visa_details)
			// 			$.each(response.visa_details, function (index, value) { 
			// 				output += `
			// 					<tr>
			// 						<td>${++index}</td>
			// 						<td>${value.PersonName}</td>
			// 						<td>${value.nationality_id}</td>
			// 						<td></td>
			// 						<td></td>
			// 						<td></td>
			// 						<td></td>
			// 						<td></td>
			// 					</tr>
			// 				`;

			// 				$('#details').html(output);
			// 			});
			// 		}
			// 	});
			// })
			$(document).ready(function () {
				$(".panel").show();
				var title=document.getElementById('title');
				title.style.color='white';
			});
		</script>
		<script>
			var acc = document.getElementsByClassName("accordion");
			var i;
			
			for (i = 0; i < acc.length; i++) {
			  acc[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var title=document.getElementById('title');
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight) {
				  panel.style.maxHeight = null;
				  title.style.color='white';
				  $(".panel").show();
				} else {
				  panel.style.maxHeight = panel.scrollHeight + "px";
				  title.style.color='black';
				  panel.classList.remove("d-none");
				  $(".panel").hide();
				} 
			  });
			}
			</script>
@endsection