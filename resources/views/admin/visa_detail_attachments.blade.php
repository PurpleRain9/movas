@extends('admin.layout')
@section('content')

            <div class="d-xl-flex justify-content-between align-items-start">
              <h2 class="text-dark font-weight-bold mb-2"> Visa Application Detail Attachments</h2>
            </div>

    <div class="container mt-5"> 
		@if (isset($visa_detail))
			<h4>Applicant Name - {{$visa_detail->PersonName}}</h4> 
		@endif
    
		@php
			$i = 1;
		@endphp
		<table class="table table-inverse">
			<thead>
				<tr>
					<th>No</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			@if($visa_detail->passport_attach !=null || $visa_detail->passport_attach != '')
				<tr>
					<td class="col-md-1">{{$i++}}</td>
					<td>Passport</td>
					<td class="col-md-1"><a href="{{$visa_detail->passport_attach}}" class="btn btn-outline-primary">View File</a></td>
				</tr>
			@endif
			@if($visa_detail->	formcfile_attch !=null || $visa_detail->formcfile_attch != '')
				<tr>
					<td class="col-md-1">{{$i++}}</td>
					<td>FormC Address</td>
					<td class="col-md-1"><a href="{{$visa_detail->formcfile_attch}}" class="btn btn-outline-primary">View File</a></td>
				</tr>
			@endif
			@if($visa_detail->applicant_form_attach !=null || $visa_detail->applicant_form_attach != '')
				<tr>
					<td class="col-md-1">{{$i++}}</td>
					<td>Undertaking</td>
					<td class="col-md-1"><a href="{{$visa_detail->applicant_form_attach}}" class="btn btn-outline-primary">View File</a></td>
				</tr>
			@endif
			@if($visa_detail->person_type_id == 1)
				@if($visa_detail->extract_form_attach != null || $visa_detail->extract_form_attach != '' )
					<tr>
						<td class="col-md-1">{{$i++}}</td>
						<td>Extract Form</td>
						<td class="col-md-1"><a href="{{$visa_detail->extract_form_attach}}" class="btn btn-outline-primary">View File</a></td>
					</tr>
				@endif
				@if($visa_detail->labour_card_attach !=null || $visa_detail->labour_card_attach !='' )
					<tr>
						<td class="col-md-1">{{$i++}}</td>
						<td>Labour Card</td>
						<td class="col-md-1"><a href="{{$visa_detail->labour_card_attach}}" class="btn btn-outline-primary">View File</a></td>
					</tr>
				@endif
			@elseif($visa_detail->person_type_id == 3)
				@if($visa_detail->mic_approved_letter_attach !=null || $visa_detail->mic_approved_letter_attach !='')
					<tr>
						<td class="col-md-1">{{$i++}}</td>
						<td>MIC Approved Letter</td>
						<td class="col-md-1"><a href="{{$visa_detail->mic_approved_letter_attach}}" class="btn btn-outline-primary">View File</a></td>
					</tr>
				@endif
				@if($visa_detail->labour_card_attach !=null || $visa_detail->labour_card_attach !='' )
					<tr>
						<td class="col-md-1">{{$i++}}</td>
						<td>Labour Card</td>
						<td class="col-md-1"><a href="{{$visa_detail->labour_card_attach}}" class="btn btn-outline-primary">View File</a></td>
					</tr>
				@endif
			@else
				@if($visa_detail->mic_approved_letter_attach != null ||  $visa_detail->mic_approved_letter_attach != '')
					<tr>
						<td class="col-md-1">{{$i++}}</td>
						<td>MIC Approved Letter of Technician</td>
						<td class="col-md-1"><a href="{{$visa_detail->mic_approved_letter_attach}}" class="btn btn-outline-primary">View File</a></td>
					</tr>
				@endif
				@if($visa_detail->technician_passport_attach != null ||  $visa_detail->technician_passport_attach != ''  )
					<tr>
						<td class="col-md-1">{{$i++}}</td>
						<td>Technician Passport</td>
						<td class="col-md-1"><a href="{{$visa_detail->technician_passport_attach}}" class="btn btn-outline-primary">View File</a></td>
					</tr>
				@endif
				@if($visa_detail->evidence_attach != null || $visa_detail->evidence_attach != '' )
					<tr>
						<td class="col-md-1">{{$i++}}</td>
						<td>Evidence</td>
						<td class="col-md-1"><a href="{{$visa_detail->evidence_attach}}" class="btn btn-outline-primary">View File</a></td>
					</tr>
				@endif	
			@endif
			@if (isset($visa_detail_attachments))
				@forelse ($visa_detail_attachments as $vde)
					<tr>
						<td class="col-md-1">{{$i++}}</td>
						<td>{{$vde->Description}}</td>
						<td class="col-md-1"><a href="{{$vde->FilePath}}" class="btn btn-outline-primary">View File</a></td>
					</tr>
				@empty
					<tr>
						<td colspan="3" style="font-weight: bold;" class="text-danger text-center">No Additional Attachment .</td>
					</tr>
				@endforelse
			@endif
			</tbody>
		</table>

    </div>

@endsection