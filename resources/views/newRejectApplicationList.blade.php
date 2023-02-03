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
    
		<div class="container" style="padding: 6px 12px; margin-bottom: 40px;">
			
			<div class="card mt-5">
            
				<div class="card-body mx-5">
            
						<h2 class="text-center my-4">Resubmit Applicant List</h2>
						<hr style="max-width: 200px; margin: auto; color: gray;">
					
					<div class="row mt-4">
						<div class="col-md-10 col-sm-6">						
							<p>
							<strong>ရက်စွဲ : {{ \Carbon\Carbon::parse($visa_head->profile->FinalApplyDate)->format('d M Y') }}</strong>
						    </p>
							<p><strong>အကြောင်းအရာ ။ {{$visa_head->profile->CompanyName}} မှ {{$visa_head->Subject}}</strong></p>
                            <p>Reject Comment ။  <span class="text-danger"> {{$visa_head->RejectComment}}</span </p>

						</div>
                
					</div>

					<div class="row mt-3">
						<table class="table table-bordered table-responsive" id="TableHeader">
							<thead>
								<tr>
									<th>စဉ်</th>
									<th>အမည်/ရာထူး</th>
									<th>နိုင်ငံသား</th>
									<th>နိုင်ငံကူး<br>လက်မှတ်</th>
									<th>စတင်ခန့်ထား<br>သည့်ရက်စွဲ</th>
									<th>နေထိုင်ခွင့် <br>ကုန်ဆုံးမည့်နေ</th>
									<th>ပြည်ဝင်ခွင့်</th>
									<th>နေထိုင်ခွင့်</th>
									<th>အလုပ်သမားကဒ်/<br>သက်တမ်း</th>
                                    <th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php
									$y=1
								@endphp
								@foreach ($visa_details as $vd)
								{{-- <h1>{{$vd->visa_detail_attachments}}</h1> --}}
									<tr>
										<td>{{$y++}}</td>
										<td>

											{{$vd->PersonName}} /@if (!is_null($vd->person_type))

											
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
										<td>{{$vd->labour_card_type->LabourCardTypeMM ?? ''}}/{{$vd->labour_card_duration->LabourCardDurationMM ?? '-'}}</td>
										<td class="d-flex">
											<a href="{{route('editApplicant',['id'=>  $vd->id,'editId'=>2])}}" class="btn btn-sm btn-warning">Edit</a> 
											<a href="{{ route('deleteAplicant',['id' => $vd->id, 'deleteId'=>2]) }}" class="btn btn-sm btn-danger ms-1" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
										</td>
										
									</tr>
								@endforeach
							</tbody>
						</table>
                        <p class="text-danger"> *<small> Edit Button ကိုနှိပ်၍ပြင်ဆင်ခိုင်းသည်များကိုပြင်ဆင်ပါ </small></p>
					</div>
                    <div class="row mt-1">
                        <div class="mb-3 d-flex justify-content-end">
                            <a href="{{ route('home') }}" class="btn btn-danger button "  style="margin-right: 10px;" >Cancel</a>
                            <a class="bg-success  btn btn-success button"  id="applySubmit"  data-toggle="modal" data-target="#applicationModal" style="margin-right: 30px;"> Submit </a>
                        </div>  
                    </div>
                  
				</div>
           
			</div>
			
			
		</div>
		<div class="modal fade" id="applicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
			<div class="modal-dialog modal-lg" role="document">
			  <div class="modal-content">
				<div class="modal-header">
				  <h7 class="modal-title" id="exampleModalLabel">ဖြည့်သွင်းထားသော အချက်အလက်များအား အောက်တွင် ဖော်ပြထားသော ဇယားနှင့် တိုက်ဆိုင်စစ်ဆေးပါရန်</h7>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<form action="{{route('rejectApplicantUpdate')}}" method="POST" enctype="multipart/form-data">
			  @csrf
			  <div class="modal-body">
				<input type="text" hidden value="{{$visa_head->id}}" name="headId">
				{{-- <input type="text" value="{{ $visa_head->ReviewerSubmitted }}" name="headStatus"> --}}
				<table class="table table-bordered table-responsive mt-2" id="TableHeader">
				  <thead>
					<tr>
					  <th>စဉ်</th>
					  <th>အမည်/ရာထူး</th>
					  <th>နိုင်ငံသား</th>
					  <th>နိုင်ငံကူးလက်မှတ်</th>
					  <th>စတင်ခန့်ထားသည့်ရက်စွဲ</th>
					  <th>နေထိုင်ခွင့် ကုန်ဆုံးမည့်နေ့</th>
					  <th>ပြည်ဝင်ခွင့်</th>
					  <th>နေထိုင်ခွင့်</th>
					  <th>အလုပ်သမားကဒ်/သက်တမ်း</th>
					</tr>
				  </thead>
				  <tbody >
					@php $i=1 @endphp
					@foreach ($applicants as $applicant)
						<tr>
						  <td>{{$i++}}</td>
						  <td>{{$applicant->PersonName}}</td>
						  <td>{{$applicant->nationality->NationalityName}}</td>
						  <td>{{$applicant->PassportNo}}</td>
						  <td>{{$applicant->StayAllowDate}}</td>
						  <td>{{$applicant->StayExpireDate}}</td>
						  <td>@if($applicant->visa_type) {{$applicant->visa_type->VisaTypeNameMM}} @else - @endif</td>
						  <td>@if($applicant->stay_type) {{$applicant->stay_type->StayTypeNameMM}} @else - @endif </td>
						  <td>@if($applicant->labour_card_type) {{$applicant->labour_card_type->LabourCardTypeMM}}/ {{$applicant->labour_card_duration->LabourCardDurationMM}} @else - @endif </td>
						</tr>
					@endforeach
				  </tbody>
				</table>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button class="btn btn-primary" disabled style="display:none;" id="loadingGif">
				  <i class="fas fa-1x fa-spinner fa-pulse"></i> Uploading...
				</button>	
				<button type="submit" class="btn mybutton1" id="btnsave" style="background-color: #4CAF50;" onclick="showDiv();">Confirm & Apply</button>
			  </div>
		  </form>
			  </div>
			</div>
		  </div>
  
  <script>
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
  </script>
@endsection
