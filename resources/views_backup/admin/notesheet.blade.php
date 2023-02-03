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

<div class="container">
	<div class="tab">
	  <button class="tablinks notesheet" onclick="openCity(event, 'NoteSheet')" id="defaultOpen">Note Sheet</button>
	  <button class="tablinks replyletter" onclick="openCity(event, 'ReplyLetter')">Reply Letter</button>
	</div>

	<div id="NoteSheet" class="tabcontent">
	  <div class="d-xl-flex justify-content-between align-items-start">
	  <p class="mt-3 mb-2 ml-2">ရုံးတွင်းစာအကျဉ်းချုပ် <br>သို့မဟုတ် စာကြမ်းရေးရန်အတွက် </p>
	</div>

	<div class="container">
		<form>
			<div class="row">
				<div class="col-md-10">
					
				</div>
				
				<div class="col-md-2">
					<p>
						@php
							echo "ရက်စွဲ : " . date('d M Y');
						@endphp
					</p>
				</div>
				
			</div>

			<div class="row mt-3">
				<div class="col-md-2">
					<p>အကြောင်းအရာ ။</p>
				</div>
				<div class="col-md-10">
					<p><strong>Grand Enterprises Garment Co., Ltd. မှ နိုင်ငံခြားသားပညာရှင် 4 ဦး အား နေထိုင်ခွင့် သက်တမ်းတိုးမြှင့်ခွင့် ၊ တစ်ကြိမ် ပြည်ပြန်ဝင်ခွင့် ဗီဇာနှင့် အလုပ်သမားမှတ်ပုံတင်ကတ် အသစ်ပြုလုပ်ခွင့် ပေးပါရန် တင်ပြလာခြင်း</strong></p>
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
					<p>Company 1</p>
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
					<p>Livestock & Fisheries</p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-1">
					<p>၃။</p>
				</div>
				<div class="col-md-2">
					<p>ခွင့်ပြုမိန့်အမှတ် : </p>
				</div>
				<div class="col-md-9">
					<p>အမှတ် ၈၂၂/၂၀၁၄</p>
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
					<p>မြေကွက်အမှတ်-၂၆+၆၁+၆၂+၆၆၊ မြေတိုင်း ရပ်ကွက် အမှတ် ၁၁၃ ၊ ကနောင် မင်းသားကြီးလမ်း၊ ဒဂုံမြို့သစ် အရှေ့ပိုင်း စက်မှုဇုန်၊ ဒဂုံမြို့သစ် အရှေ့ပိုင်းမြို့နယ်၊ ရန်ကုန်တိုင်း ဒေသကြီး</p>
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
						@php
							echo date('Y M d');
						@endphp
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
							<th style="font-weight: bold;">ခန့်ထားပြီး</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>ပြည်တွင်းဝန်ထမ်း</td>
							<td>100</td>
							<td>50</td>
							<td>100</td>
							<td></td>
						</tr>
						<tr>
							<td>နိုင်ငံခြားသားဝန်ထမ်း</td>
							<td>200</td>
							<td>-</td>
							<td>200</td>
							<td><a href="#" class="btn"><i class="fa fa-dot-circle-o" aria-hidden="true"></i><i class="fa fa-dot-circle-o" aria-hidden="true"></i><i class="fa fa-dot-circle-o" aria-hidden="true"></i></a></td>
						</tr>
					</tbody>
				</table>
			</div>
			<br>

			<p class="mt-4" style="font-weight: bold;">စိစစ်တင်ပြချက်</p>

			<div class="row mt-3">
				<table class="table table-bordered" id="TableHeader">
					<thead>
						<tr>
							<th>စဉ်</th>
							<th>ခန့်ထားမည့်နိုင်ငံခြားသားအမည်</th>
							<th>ခန့်ထားမည့်နိုင်ငံသား</th>
							<th>နိုင်ငံကူးလက်မှတ်</th>
							<th>ခန့်ထားမည့်ကာလ</th>
							<th>စတင်ခန့်ထားသည့်ရက်စွဲ</th>
							<th>နေထိုင်ခွင့် ကုန်ဆုံးမည့်နေ</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Mr. ShiFaw</td>
							<td>Chinese</td>
							<td>EG 123456</td>
							<td>ခြောက်လ</td>
							<td>
								@php
									echo date('d M Y');
								@endphp
							</td>
							<td>
								@php
									echo date('d M Y');
								@endphp
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Mr. PhoneShin</td>
							<td>Chinese</td>
							<td>EG 123456</td>
							<td>ခြောက်လ</td>
							<td>
								@php
									echo date('d M Y');
								@endphp
							</td>
							<td>
								@php
									echo date('d M Y');
								@endphp
							</td>
						</tr>
					</tbody>
				</table>
			</div>

            <div class="row mt-5">
                <div class="col-md-1 mt-3"></div>
                <div class="col-md-5 mt-3"><strong><u>စိစစ်သူ</u></strong></div>
                
                <div class="col-md-1 mt-3"></div>
                <div class="col-md-5 mt-3"><strong><u>ပေးပို့မည့်သူ</u></strong></div>
                
                <div class="col-md-1 mt-3">အမည်</div>
                <div class="col-md-5 mt-3">ဦးမျိုးမင်းဝေ</div>
                
                <div class="col-md-1 mt-3">အမည်</div>
                <div class="col-md-5 mt-3">
                    <select class="form-control" name="Comment1">
                    	<option>Choose</option>
                    	<option>ဒေါ်ဆွေဆွေဝင်း</option>
                    	<option>ဒေါ်မေသူ</option>
            
                    </select>        
                </div>
                
                <div class="col-md-1 mt-3">ရာထူး</div>
                <div class="col-md-5 mt-3">Reviewer</div>
                
                <div class="col-md-1 mt-3">ရာထူး</div>
                <div class="col-md-5 mt-3">ဒုတိယညွှန်ကြားရေးမှူး</div>
            </div>

			<div class="row mt-5" style="margin-top: 5px;">
				<div class="col-md-2 lable">မှတ်ချက် : </div>
					<div class="col-md-8 radio">
							<input type="radio" id="choose" name="exampleRadios" value="option1" checked>
							<label for="choose">မှတ်ချက်ရွေးရန်</label>
                            &nbsp;&nbsp;
							<input type="radio" id="write" name="exampleRadios" value="option2">
							<label for="write">မှတ်ချက်ထည့်သွင်းရန်</label>
							
						<select class="form-control col-md-8 box option1" name="Comment1">
							<option>Choose</option>
							<option>တင်ပြအပ်ပါသည်။</option>
							<option>ဆက်လက်ဆောင်ရွက်ပါ။</option>
							<option>ခွင့်ပြုသည်။</option>
							<option>ခွင့်မပြုပါ။</option>
						</select>
						<div class="col-md-8"><textarea name="Comment2" style="height: 200px; width: 800px;" class="form-control box option2"></textarea></div>
					</div>
				</div> 
		
		    <br>
			<div class="row mt-3">
				<button type="submit" class="btn btn-primary">တင်ပြမည်</button>
				<button type="submit" class="btn btn-danger ml-3">ပယ်ချမည်</button>
			</div>
			<br>
		</form>
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
		<div class="col-md-7 text-center col-sm-7">
			<strong>ပြည်ထောင်စုသမ္မတမြန်မာနိုင်ငံတော်</strong><br><br>
			<strong>မြန်မာနိုင်ငံရင်းနှီးမြှုပ်နှံမှုကော်မရှင်</strong><br><br>
			<strong>ဌာနဆိုင်ရာပူးပေါင်းလုပ်ငန်းအဖွဲ့</strong><br><br>
			မြေကွက်အမှတ် ၄၉၊ စိမ်းလဲ့မေလမ်းသွယ်၊ <br><br>
			ကမ္ဘာအေးဘုရားလမ်း၊ ရန်ကင်းမြို့နယ်၊ရန်ကုန်မြို့<br><br>
		</div>		
		<div class="col-md-2 mr-3 col-sm-2">
			<img src="{{ asset('images/stamp1.png') }}" height="200">
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-md-8">
			<p><sapn style="font-family: wingdings;">(</sapn> ၀၁-၆၅၈၂၆၃</p>
		</div>
		<div class="col">
			<p>စာအမှတ်၊ မရက-၉/oss/န-ဗီဇာ/၂၀၂၁(၂၁၂၃၄)</p>
			<p>ရက်စွဲ၊ ၂၀၂၁ ခုနှစ် စက်တင်ဘာလ ၂၁ ရက်</p>
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
			<div class="ml-5 mt-2">တာဝန်ခံအရာရှိ</div>
			<div class="ml-5 mt-2">လူဝင်မှုကြီးကြပ်ရေးဦးစီးဌာန</div>
			<div class="ml-5 mt-2">ဌာနဆိုင်ရာပူးပေါင်းလုပ်ငန်းအဖွဲ့</div>
			<div class="ml-5 mt-4">တာဝန်ခံအရာရှိ</div>
			<div class="ml-5 mt-2">အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန</div>
			<div class="ml-5 mt-2">ဌာနဆိုင်ရာပူးပေါင်းလုပ်ငန်းအဖွဲ့</div>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-md-2">
			<span>အကြောင်းအရာ။</span>		
		</div>
		<div class="col">
			<span style="font-weight: bold;">Grand Enterprises Garment Co., Ltd. မှ နိုင်ငံခြားသားပညာရှင် ၄ ဦးအား နေထိုင်ခွင့် သက်တမ်းတိုးမြှင့်ခွင့် ၊ တစ်ကြိမ် ပြည်ပြန်ဝင်ခွင့် ဗီဇာနှင့် အလုပ်သမားမှတ်ပုံတင်ကတ် အသစ်ပြုလုပ်ခွင့် ပေးပါရန် တင်ပြလာခြင်း</span>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col-md-2">
			<span>ရည်ညွှန်းချက်။</span>		
		</div>
		<div class="col">
			<span style="font-weight: bold;">Grand Enterprises Garment Co., Ltd. ၏ @php
								echo date('d M Y');
							@endphp ရက်စွဲပါစာ</span>
		</div>
	</div>

	<div class="row mt-3">
		<div class="col">
			<span>၁။	 </span>
			<span class="ml-5" style="line-height:200%;">Grand Enterprises Garment Co., Ltd. သည် မြေကွက်အမှတ်- ၂၆+၆၁+၆၂+၆၆၊ မြေတိုင်းရပ်ကွက်အမှတ် ၁၁၃ ၊ ဒဂုံအရှေ့စက်မှုဇုန်၊ ဒဂုံမြို့သစ်အရှေ့ပိုင်းမြို့နယ်၊ ရန်ကုန်တိုင်း ဒေသကြီးတွင် CMP စနစ်ဖြင့် အထည်ချုပ်လုပ်ခြင်းလုပ်ငန်းကို မြန်မာနိုင်ငံရင်းနှီးမြှုပ်နှံမှု ကော်မရှင် ၏ ၂၀၁၄ ခုနှစ် အောက်တိုဘာလ ၂၈ ရက်စွဲပါ ခွင့်ပြုမိန့် အမှတ် ၈၂၂/၂၀၁၄ အရ ဆောင်ရွက် လျက်ရှိပါသည်။</span>		
		</div>
	</div>

	<div class="row mt-3">
		<div class="col">
			<span>၂။	 </span>
			<span class="ml-5" style="line-height:200%;">ကုမ္ပဏီမှ ရည်ညွှန်းပါစာဖြင့် တင်ပြလျှောက်ထားလာသည့် အောက်ပါနိုင်ငံခြားသား ပညာရှင်များအား နေထိုင်ခွင့် သက်တမ်းတိုးမြှင့်ခွင့်၊ တစ်ကြိမ်ပြည်ပြန်ဝင်ခွင့်ဗီဇာပြုလုပ်ခွင့်နှင့် အလုပ်သမားမှတ်ပုံတင်ကတ်အသစ်ပြုလုပ်ခွင့်ရရှိရေးတည်ဆဲဥပဒေများနှင့်ညီညွတ်ပါက ကန့်ကွက် ရန် မရှိပါကြောင်းနှင့် လိုအပ်သလို ဆက်လက်ဆောင်ရွက် နိုင်ပါရန် အကြောင်းကြားပါသည်-</span>		
		</div>
	</div>

	<div class="row mt-5">
		<div class="col-md-12">
			<table class="table table-inverse table-responsive">
				<thead>
					<tr>
						<th>စဉ်</th>
						<th>အမည်</th>
						<th>နိုင်ငံသား</th>
						<th>နိုင်ငံကူးလက်မှတ်အမှတ်</th>
						<th>နေထိုင်ခွင့် သက်တမ်းကုန်ဆုံးမည့်နေ့</th>
						<th>ခွင့်ပြုသည့် သက်တမ်း ကာလ</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Mr. Shu Shu</td>
						<td>Chinese</td>
						<td>EG 5798731</td>
						<td>@php
								echo date('d M Y');
							@endphp
						</td>
						<td>ခြောက်လ</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Mr. Fu Fu</td>
						<td>Chinese</td>
						<td>EG 4235324</td>
						<td>@php
								echo date('d M Y');
							@endphp
						</td>
						<td>ခြောက်လ</td>
					</tr>
					<tr>
						<td>3</td>
						<td>Mr. Hao La</td>
						<td>Chinese</td>
						<td>EG 4214124</td>
						<td>@php
								echo date('d M Y');
							@endphp
						</td>
						<td>ခြောက်လ</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="row mt-5">
		<div class="col">
			မိတ္တူကို
		</div>
	</div>
	<div class="row">
		<div class="col" style="margin-left: 60px;">
			<p>ညွှန်ကြားရေးမှူးချုပ်၊ ရင်းနှီးမြှုပ်နှံမှုနှင့်ကုမ္ပဏီများညွှန်ကြားမှုဦးစီးဌာန</p>
			<p>ညွှန်ကြားရေးမှူးချုပ်၊ လူဝင်မှုကြီးကြပ်ရေးဦးစီးဌာန</p>
			<p>ညွှန်ကြားရေးမှူးချုပ်၊ အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန</p>
			<p>ညွှန်ကြားရေးမှူးချုပ်၊ ပြည်တွင်းအခွန်များဦးစီးဌာန</p>
			<p>ညွှန်ကြားရေးမှူး၊ ရင်းနှီးမြှုပ်နှံမှုကြီးကြပ်ရေးဌာနခွဲ</p>
			<p>Grand Enterprises Garment Co., Ltd.</p>
			<p>(နိုင်ငံခြားသား၏ နေရပ်လိပ်စာပြောင်းလဲမှုရှိတိုင်း သက်ဆိုင်ရာနှင့် ဤရုံးသို့ချက်ချင်းအကြောင်းကြားရန်)</p>
			<p>ရုံးလက်ခံ/မျှောစာတွဲ</p>
		</div>
	</div>

	<div class="row mt-3">
		<!--<button type="submit" class="ml-3 btn btn-success">Accept</button>-->
		<!--<button type="submit" class="ml-3 btn btn-danger">Reject</button>-->
		<button type="button" class="ml-3 btn btn-primary mytab22">Back</button>
	</div>
	<br>
	</div>

	
</div>
<br><br>
<script>
	$(document).ready(function(){
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