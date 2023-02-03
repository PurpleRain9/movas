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
					<button class="accordion "><span class="ms-3" id="title" > <strong>Undertaking</span> </strong></button>
					<div class="panel ">
						
						<div class="border border-dark" id="ruleTwo">
							<div class="mt-3" style="margin-left:2rem; ">
								<p style="line-height: 30px">ကုမ္ပဏီ၏  Letter Head  ဖြင့် အဖွဲ့ခေါင်းဆောင်သို့ လိပ်မူ၍ အလုပ်လုပ်ခွင့် လျှောက်ထားသူ နိုင်ငံခြားသားအနေဖြင့် အမည်မည်းကင်းရှင်း‌ကြောင်း နိုင်ငံရေးလှုပ်ရှားမှုများတွင် ပါဝင်ဆောင်ရွက်မှု မရှိကြောင်း၊ ပြစ်မှုကင်းရှင်းပြီး မြန်မာနိုင်ငံ၏ တည်ဆဲဥပဒေများကို လေးစားလိုက်နာမည်ဖြစ်ကြောင်း နှင့် ၎င်းနိုင်ငံခြားသားနှင့် ပတ်သတ်သည့် ကိစ္စအဝဝအား ကုမ္ပဏီ၏ ဒါရိုက်တာ အဖွဲ့မှ တာဝန်ယူမည်ဖြစ်ပါကြောင်း တင်ပြစာအား (အောက်ဖော်ပြပါ နမူနာပုံစံ အတိုင်း) တွဲပေးပါရန်</p>
								<div class="text-center">
									<iframe width="80%" height="900px" src="{{asset('public/undertakingPdf/poUndertakingLetter.pdf#toolbar=0')}}" frameborder="0"></iframe>
									
								</div>
								<div class="btnDiv row ">
									<div class="col-md-6">

									</div>
									<div class="col-md-6 mt-2 mb-3">
										<a href="/wordDownload" class="btn btn-info" style="font-size: 0.9rem;">(WORD) ဒေါင်းလုပ်ရ ယူရန်</a>
										<a href="/pdfDownload" class="btn btn-success ms-1" style="font-size: 0.9rem;">(PDF) ဒေါင်းလုပ်ရ ယူရန်</a>
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
					
		

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
		<script>

			// $(document).ready(function(){
			// 	$('#ruleTwo').hide();
			// })
			// $(document).on('click', '#ruleChange', function(){
			// 	$('#ruleOne').hide()
			// 	$('#ruleTwo').show();		
			// 	$('#homeSearch').hide();	
			// 	$('#homeTable').hide();
			// })
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