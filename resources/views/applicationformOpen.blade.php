@extends('layout')
@section('content')
 <style>
  .modal-dialog {
          max-width: 1000px; /* New width for default modal */
     }
 </style>
    <div id="headers-section" class="mx-auto" style="width: 90%; margin-top:20px;">
        <h4 class="text-secondary" style="margin-left: 70px;"><span class="eng">Visa Application</span> <span class="mm">လျှောက်လွှာတင်ရန်</span></h4>
    </div>

    @if (session('error'))
    <p class="alert alert-danger mx-auto" style="width: 90%; margin-top:20px;">
      {{ session('error') }}
    </p>        
    @endif

    <div id="buttons-section" class="d-flex mx-auto justify-content-end" style="width: 80%; max-width:1200px;">

        <a href="" class="btn btn-success me-3 {{$applicants->count() > 0 ? '':'d-none'}}" data-toggle="modal" data-target="#applicationModal" >Apply</a>
        <a href="{{route('newapplyform')}}" class="btn btn-outline-success">Create New Form</a>
    </div>
    
    <div id="data-table-section" class="mx-auto my-5" style="width: 80%; max-width:1200px;">
        <table class="table">
            <thead>
              <tr>
                <th scope="col" style="width: 10%;"><span class="eng">No.</span><span class="mm">စဥ်</span></th>
                <th scope="col" style="width: 30%;"><span class="eng">Name</span><span class="mm">အမည်</span></th>
                <th scope="col" style="width: 30%;"><span class="eng">Passport No.</span><span class="mm">နိုင်ငံကူးလက်မှတ်အမှတ်</span></th>
                <th scope="col" style="width: 20%;"><span class="eng">Nationality</span><span class="mm">နိုင်ငံသား</span></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($applicants as $applicant)
                <tr>
                  <th scope="row">{{ $i++ }}</th>
                  <td>{{$applicant->PersonName}}</td>
                  <td>{{$applicant->PassportNo}}</td>
                  <td>{{$applicant->nationality->NationalityName}}</td>
                  <td>
                      <div class="dropdown show">
                          <a class="btn btn-secondary rounded-pill action-button" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                          </a>
                        
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('editApplicant',['id'=>  $applicant->id,'editId'=>1])}}">Edit</a>
                            <form action="{{route('newApplyform.delete',$applicant->id)}}" method="post" class="dropdown-item">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="p-0 text-danger" style="border:none;background:transparent;"
                                  onclick="return confirm('Are you sure to delete?');">Delete</button>
                          </form>
                        
  
                          </div>
                        </div>
                  </td>
                </tr>
                @endforeach
                   
            </tbody>
          </table>
          <br><br><br>
    </div>

    <div class="modal fade" id="applicationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h7 class="modal-title" id="exampleModalLabel">ဖြည့်သွင်းထားသော အချက်အလက်များအား အောက်တွင် ဖော်ပြထားသော ဇယားနှင့် တိုက်ဆိုင်စစ်ဆေးပါရန်</h7>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
          <form action="{{route('applicationFormStore')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
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

