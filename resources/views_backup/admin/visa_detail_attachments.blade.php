
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
                @if (isset($visa_detail_attachments))
                    @forelse ($visa_detail_attachments as $vde)
                <tr>
                    <td class="col-md-1">{{$i++}}</td>
                    <td>{{$vde->Description}}</td>
                    <td class="col-md-1"><a href="/public{{$vde->FilePath}}" class="btn btn-outline-primary">View File</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="font-weight: bold;" class="text-danger text-center">No Attachment Found.</td>
                </tr>
    			 @endforelse
                @endif
    		</tbody>
    	</table>
      
    </div>

@endsection