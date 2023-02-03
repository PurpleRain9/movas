<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script type="text/javascript" src="{{ asset('wintouni/tlsDebug.js') }}"></script>
<script type="text/javascript" src="{{ asset('wintouni/tlsMyanmarConverter.js') }}"></script>
<script type="text/javascript" src="{{ asset('wintouni/tlsMyanmarConverterData.js') }}"></script>
<script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') }}"></script>

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

	document.getElementById("ApproveLetterNo").innerHTML = "မရက-၉/OSS/န-ဗီဇာ/" + uniConvert(al);			
	document.getElementById("ApproveDate").innerHTML = "ရက်စွဲ၊ " + uniConvert(ad);
	document.getElementById("FinalApplyDate").innerHTML = uniConvert(fd);

	document.getElementById("PermitDate").innerHTML = uniConvert(py) + " ခုနှစ်၊ " + MonthNameMM(pm) + " (" + uniConvert(pd) + ") ရက်နေ့";			
		window.print();	
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

	<style type="text/css">
	body {
		background: rgb(204, 204, 204);
	}

	page {
		background: white;
		display: block;
		margin: 0 auto;
		margin-bottom: 0.5cm;
		/*box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);*/
	}
	page[size="A4"] {
  /*width: 21cm;
  height: 29.7cm;*/
  width: 210mm;
  height: 297mm;	
}

@media print {
	body,
	page {
		margin: 0;
		box-shadow: 0;
	}
}

#margin_tp_l
{
	margin-top: 50px;
}

.row {
	display: flex;
	flex-direction:row;
}

.column {
	flex: 1 1 0px;
	border: 1px solid black;
}

#tb
{
	padding-top: 1	0px;
	padding-left: 4px;

}
body
{
	font-family: "Arial", sans-serif;
	font-size: 13px;
}

#tb2
{
	height: 60px;
	width: ;
	padding-left: 4px;
}

#tb2_space
{
	width: 420px;
}
#float_left
{
	text-align: left;
}

.pad_left
{
	padding-left: 5px;

	
}

.div_height
{

}

.list_table
{
	border: 1px solid black;
	border-collapse: collapse;
	padding: 4px;
	text-align: center;
}

.list_table_head
{

	border: 1px solid black;
	border-collapse: collapse;
	padding: 4px;
	text-align: center;
	font-size: 12px;
}

.alignLeft
{

	text-align: left;
}


.margin_l
{
	margin-left: 82%;
}

.margin_l_2
{
	margin-left: 77%;
	text-align: center;
}


</style>
</head>

<body>
	<script type="text/javascript"></script>
	<page size="A4">
		
		<div class="pad_left">
			<table id="tb">
				<tr>
					<th>
						<img src="{{ asset('/images/MIC_Logo.jpg') }}" style="height:150px;margin-left: 60px;">
					</th>
					<th>
						ပြည်ထောင်စုသမ္မတမြန်မာနိုင်ငံတော်
						<br>မြန်မာနိုင်ငံရင်းနှီးမြုပ်နှံမှုကော်မရှင်
						<br>ငှာနဆိုင်ရာပူးပေါင်းလုပ်ငန်းအဖွဲ့
						<br>မြေကွက်အမှတ် ၄၉ ၊ စိမ်းလဲ့မေလမ်းသွယ်
						<br>ကမ္ဘာအေးဘုရားလမ်း၊ ရန်ကင်းမြို့နယ်၊ ရန်ကုန်မြို့
						<th>
							<img src="{{ asset('/images/stamp1.png') }}" style="height:150px;">
						</th>
					</tr>
				</table>

				<table id="tb2">
					<tr>
						<th>၀၁-၆၅၈၂၆၃</i></th>
						<th id="tb2_space"></th>
						<th id="float_left"><span id="ApproveLetterNo">စာအမှတ် ၊ မရက-၉/OSS/န-ဗီဇာ/{{$data->ApproveLetterNo}}</span>
							<br><span id="ApproveDate">ရက်စွဲ၊ {{ \Carbon\Carbon::parse($data->ApproveDate)->format('d-m-Y') }}</span>
						</th>
					</tr>
				</table>
				<div class="div_height">
					<dl>
						<dt>သို့</dt>
						<dd>တာဝန်ခံအရာရှိ @if ($data->OssStatus == 1)
						( လူဝင်မှုကြီးကြပ်ရေးဦးစီးဌာန )
						@elseif ($data->OssStatus == 2)
						( အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန )
						@elseif ($data->OssStatus == 3)
						( လူဝင်မှုကြီးကြပ်ရေးဦးစီးဌာန/အလုပ်သမားညွှန်ကြားရေးဦးစီးဌာန )
					@endif</dd>
						<dd> ဌာနဆိုင်ရာပူးပေါင်းလုပ်ငန်းအဖွဲ့</dd>
					</dl>
				</div>
				<!-- <br> -->
				<table id="tb3">
					<tr>
						<td style="vertical-align: top;">အကြောင်းအရာ။</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td><b>{{$data->CompanyName}}  မှ {{$data->Subject}}</b></td>
					</tr>
					<tr>
						<td>ရည်ညွှန်းချက်။</td>
						<td>&nbsp;&nbsp;&nbsp;</td>
						<td>
							<b>{{$data->CompanyName}} ၏ (<span id="FinalApplyDate"></span>) ရက်စွဲပါစာ</b>
						</td>
					</tr>
				</table>
				<!-- <br> -->
				<p>
					<span>၁။</span>
					<span style="margin-left: 50px; text-align: justify; text-justify: inter-word;">{{$data->CompanyName}} သည် {{$data->Township}} တွင် {{$data->profile->permit_type->PermitType}} ၏ 
			</span>
			<span id="PermitDate"></span>
			<span> ရက်စွဲပါ @if ($data->profile->permit_type_id == 1)
						ခွင့်ပြုမိန့်
					@else
						အတည်ပြုမိန့်
					@endif အမှတ် {{$data->PermitNo}} အရ {{$data->BusinessType}} ကို ဆောင်ရွက် လျက်ရှိပါသည်။</span>
				</p>
				<p style="margin-top: -10px; text-align: justify; text-justify: inter-word;">
					<span>၂။</span>
					<span style="margin-left: 50px;">ကုမ္ပဏီမှ ရည်ညွှန်းပါစာဖြင့် တင်ပြလျှောက်ထားလာသည့် အောက်ပါနိုင်ငံခြားသား@if (count($data->visa_details) > 1)များ@endifအား ဇယားပါအတိုင်း ပြုလုပ်ခွင့်ရရှိရေးတည်ဆဲဥပဒေများနှင့် ညီညွတ်ပါကကန့်ကွက်ရန်မရှိပါကြောင်းနှင့် လိုအပ်သလိုဆက်လက်ဆောင်ရွက်နိုင်ပါရန် အကြောင်းကြားပါသည်။
				</p>

				<table class="list_table" id="pad_right">
					<tr class="list_table_head">
						<th style="width: 30px;">စဉ်</th>
						<th class="list_table_head" style="width: 250px;">အမည်/ရာထူး</th>
						<th class="list_table_head" style="width: 80px;">နိုင်ငံသား</th>
						<th class="list_table_head" style="width: 80px;">နိုင်ငံကူးလက်မှတ် အမှတ်</th>
						<th class="list_table_head" style="width: 100px;">နေထိုင်ခွင့်သက်တမ်း ကုန်ဆုံးမည့်နေ့</th>
						<th class="list_table_head" style="width: 50px;">ပြည်ဝင်ခွင့် </th>
						<th class="list_table_head" style="width: 50px;">နေထိုင်ခွင့်</th>
						<th class="list_table_head" style="width: 80px;">အလုပ်သမား<br>ကဒ်/သက်တမ်း</th>
					</tr>
						@php
						$i=1;
						@endphp
						@foreach ($data->visa_details as $vd)
							<tr class="list_table">

								<td class="list_table">{{$i++}}</td>
								<td class="list_table alignLeft">{{$vd->PersonName}} /@if (!is_null($vd->person_type))
										{{$vd->person_type->PersonTypeName}}
									@endif
									
									@if ($vd->person_type_id == 4)
									<br>
											@if (!is_null($vd->relation_ship_id))
											{{$vd->relation_ship->RelationShipName}}
											@endif
										<br>တော်စပ်ပုံ : @if (!is_null($vd->Remark)){{$vd->Remark}}@endif
									@endif</td>
								<td class="list_table">{{$vd->nationality->NationalityName}}</td>
								<td class="list_table">{{$vd->PassportNo}}</td>
								<td class="list_table">{{ \Carbon\Carbon::parse($vd->StayExpireDate)->format('d M Y') }}</td>
								<td class="list_table">{{$vd->visa_type->VisaTypeNameMM ?? '-'}}</td>
								<td class="list_table">{{$vd->stay_type->StayTypeNameMM ?? '-'}}</td>
								<td class="list_table">{{$vd->labour_card_type->LabourCardTypeMM ?? ''}}/{{$vd->labour_card_duration->LabourCardDurationMM ?? '-'}}</td>
							</tr>
						@endforeach
				</table>
				<br><br>
				<div class="margin_l">
					@if ($data->approve_rank_id == 4)
						<img src="{{ asset('images/mko_sign.png') }}" width="100">
					@else
						<img src="{{ asset('images/tah_sign.jpg') }}" width="100">
					@endif
				</div>
				<div class="margin_l_2">@if ($data->approve_rank_id == 4)
				{{$data->admin->username}} ({{$data->admin->rank->RankNameMM}})
			@else
				{{$data->admin->username}}
			@endif<br>
					@if ($data->approve_rank_id == 4)
						<span>( အဖွဲ့ခေါင်းဆောင် (ကိုယ်စား) )</span>
					@else
						<span>( အဖွဲ့ခေါင်းဆောင် )</span>
					@endif
		</div>
				
			</div>
		</page>

	</body>
	</html>