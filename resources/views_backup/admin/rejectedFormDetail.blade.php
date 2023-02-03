@extends('admin.layout')
@section('content')
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
	<div class="container" style="border: 1px solid #ccc; padding: 6px 12px; margin-bottom: 40px;">

	<div>
	  <div class="d-xl-flex justify-content-between align-items-start">
	  <p class="mt-3 mb-2 ml-2">ရုံးတွင်းစာအကျဉ်းချုပ် <br>သို့မဟုတ် စာကြမ်းရေးရန်အတွက် </p>
	</div>

	<div class="container">
			<div class="row">
				<div class="col-md-10">
					
				</div>
				
				<div class="col-md-2">
					<p>
						ရက်စွဲ : {{ \Carbon\Carbon::parse($data->profile->FinalApplyDate)->format('d M Y') }}
					</p>
				</div>
				
			</div>

			<div class="row mt-3">
				<div class="col-md-2">
					<p>အကြောင်းအရာ ။</p>
				</div>
				<div class="col-md-10">
					<p><strong>{{$data->profile->CompanyName}} မှ {{$data->Subject}}</strong></p>
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

			<br>

			<p class="mt-4" style="font-weight: bold;">စိစစ်တင်ပြချက်</p>

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
								<td>{{$vd->labour_card_type->LabourCardTypeMM ?? ''}}/{{$vd->labour_card_duration->LabourCardDurationMM ?? '-'}}</td>
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

@endsection