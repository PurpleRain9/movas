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
				<div class="card-body">
					
						<h2 class="text-center my-4">Inprocess Form Detail</h2>
						<hr style="max-width: 200px; margin: auto; color: gray;">
					
					<div class="row mt-4">
						<div class="col-md-10 col-sm-6">						
							<p>
							<strong>ရက်စွဲ : {{ \Carbon\Carbon::parse($data->profile->FinalApplyDate)->format('d M Y') }}</strong>
						</p>
							<p><strong>အကြောင်းအရာ ။ {{$data->profile->CompanyName}} မှ {{$data->Subject}}</strong></p>
							
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
										
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			
		</div>

@endsection
