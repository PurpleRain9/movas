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

.modal{
	top: 50%;
	transform: translateY(-20%);
}

#TableHeader th{background-color: #e0f0fe;}
//th{color: blue;font-weight: bold;}

</style>

<div class="container">
	<div class="tab">

        <div class="container mb-4">
            <div class="row">
				<div class="col-md-10">
					
				</div>
				
				<div class="col-md-2">
					<p>
						ရက်စွဲ : {{ \Carbon\Carbon::parse($technician->final_apply_date)->format('d-m-Y') }}
					</p>
				</div>
				
			</div>

            <div class="row mt-3">
                <div class="col-md-2">
                    <p>အကြောင်းအရာ ။</p>
                </div>
                <div class="col-md-10">
					<p>
                        <strong>
                            <a data-toggle="modal" data-target="#userModal" class="companyName">{{$technician->profile->CompanyName}}</a> မှ Foreign Employee <a data-toggle="modal" data-target="#resignedTechnicianModal" class="resignedName">{{$technician->Name}}</a> ကို Resign လုပ်ရန် တင်ပြလာခြင်း။
                        </strong>
                    </p>
				</div>
				<!-- Company Modal -->
				<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
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
										<td>{{ $technician->profile->user->name }}</td>
										<td>{{ $technician->profile->user->email }}</td>
										<td>{{ $technician->profile->user->phone_no }}</td>
									</tr>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>

                <!-- Resigned Technician Modal -->
				<div class="modal fade" id="resignedTechnicianModal" tabindex="-1" role="dialog" aria-labelledby="resignedTechnicianModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="resignedTechnicianModalLabel">Resigned Technician Info</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<table class="table table-bordered">
									<tr>
										<th>Name</th>
										<th>Rank</th>
										<th>Passport</th>
									</tr>
									<tr>
										<td>{{ $technician->Name }}</td>
										<td>{{ $technician->Rank }}</td>
										<td>{{ $technician->PassportNo }}</td>
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
                    <p>{{$technician->profile->CompanyName}}</p>
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
                    <p>{{$technician->profile->BusinessType}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <p>၃။</p>
                </div>
                <div class="col-md-2">
                    <p>အလုပ်သမားအမည် : </p>
                </div>
                <div class="col-md-9">
                    <p>{{$technician->Name}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <p>၄။</p>
                </div>
                <div class="col-md-2">
                    <p>ရာထူး : </p>
                </div>
                <div class="col-md-9">
                    <p>{{$technician->Rank}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <p>၅။</p>
                </div>
                <div class="col-md-2">
                    <p>အရည်အချင်း : </p>
                </div>
                <div class="col-md-9">
                    <p>{{$technician->Qualification}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <p>၆။</p>
                </div>
                <div class="col-md-2">
                    <p>လိပ်စာ : </p>
                </div>
                <div class="col-md-9">
                    <p>{{$technician->address}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <p>၇။</p>
                </div>
                <div class="col-md-2">
                    <p>ဖုန်းနံပါတ် : </p>
                </div>
                <div class="col-md-9">
                    <p>{{$technician->phone_no}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <p>၈။</p>
                </div>
                <div class="col-md-2">
                    <p>Passport နံပါတ် : </p>
                </div>
                <div class="col-md-9">
                    <p>{{$technician->PassportNo}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <p>၉။</p>
                </div>
                <div class="col-md-2">
                    <p>လိင်အမျိုးအစား : </p>
                </div>
                <div class="col-md-9">
                    <p>{{ucfirst($technician->Gender)}}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <p>၁၀။</p>
                </div>
                <div class="col-md-2">
                    <p>မွေးဖွားသည့်ရက် : </p>
                </div>
                <div class="col-md-9">
                    <p>{{$technician->DateOfBirth}}</p>
                </div>
            </div>

            
            
            <p class="mt-4" style="font-weight: bold;">Required Attachments</p>
            
            @if ($technician->mic_copy_resigned_letter_filename != '')
                <div class="row mt-4" style="border-bottom: 1px solid lightgrey;">
                    <div class="col">
                        <span>Copy of resigned letter submitted to MIC</span>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ asset('foreign_tech_photo/foreign_mic_copy_resigned_letters/'.$technician->mic_copy_resigned_letter_filename) }}" class="btn btn-sm btn-outline-primary ml-5">View File</a>
                    </div>
                </div>
            @endif

            @if ($technician->passport_filename != '')
                <div class="row mt-4" style="border-bottom: 1px solid lightgrey;">
                    <div class="col">
                        <span>Passport</span>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ asset('foreign_tech_photo/foreign_passports/'.$technician->passport_filename) }}" class="btn btn-sm btn-outline-primary ml-5">View File</a>
                    </div>
                </div>
            @endif

            @if ($technician->mic_permit_filename != '')
                <div class="row mt-4" style="border-bottom: 1px solid lightgrey;">
                    <div class="col">
                        <span>MIC Work Permit</span>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ asset('foreign_tech_photo/foreign_mic_permits/'.$technician->mic_permit_filename) }}" class="btn btn-sm btn-outline-primary ml-5">View File</a>
                    </div>
                </div>
            @endif


            @if ($technician->air_ticket_filename != '')
                <div class="row mt-4" style="border-bottom: 1px solid lightgrey;">
                    <div class="col">
                        <span>Air Ticket</span>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ asset('foreign_tech_photo/foreign_air_tickets/'.$technician->air_ticket_filename) }}" class="btn btn-sm btn-outline-primary ml-5">View File</a>
                    </div>
                </div>
            @endif

            @if ($technician->Status == 2)    
            <form action="{{ route('rejectFoeignResign', $technician->id) }}" method="POST">
                @csrf
                <div class="row my-5">
                    <div class="col-md-2 lable">မှတ်ချက်ထည့်သွင်းရန် : </div>
                    <div class="col-md-8">
                        <textarea name="reject_comment" style="height: 200px; width: 800px;" class="form-control box option2"></textarea>
                    </div>
                </div>
                @if ($ad->Status == 1)
                    <a href="{{ route('approveForeignResign', $technician->id) }}" class="btn btn-success" style="font-size: 1rem;">လက်ခံမည်</a>
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger mx-3" style="font-size: 1rem; background: red;" id="reject_btn" >ပယ်ချမည်</button>
                @else
                    <button class="btn btn-success" disabled style="font-size: 1rem;">လက်ခံမည်</button>
                    <button class="btn btn-danger" disabled style="font-size: 1rem;">ပယ်ချမည်</button>
                @endif
                
            </form>
            @endif
        </div>
	</div>

    <script>
    </script>
@endsection