@extends('layout')
@section('content')
<link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
<style>
	@import url('https://fonts.googleapis.com/css2?family=Nunito&family=Poppins:wght@300;400;500&display=swap');

	.title {
		font-family: 'Nunito', sans-serif;
		font-weight: 600;
	}

	form,
	input[type=file] {
		font-size: .9rem;
	}

	.badge {
		display: inline-block;
		padding: .25em .4em;
		font-size: 75%;
		font-weight: 700;
		line-height: 1;
		text-align: center;
		white-space: nowrap;
		vertical-align: baseline;
		border-radius: .25rem
	}

	.badge:empty {
		display: none
	}

	.btn .badge {
		position: relative;
		top: -1px
	}

	.badge-pill {
		padding-right: .6em;
		padding-left: .6em;
		border-radius: 10rem
	}

	.badge-primary {
		color: #fff;
		background-color: #007bff
	}

	.badge-primary[href]:focus,
	.badge-primary[href]:hover {
		color: #fff;
		text-decoration: none;
		background-color: #0062cc
	}

	.badge-secondary {
		color: #fff;
		background-color: #6c757d
	}

	.badge-secondary[href]:focus,
	.badge-secondary[href]:hover {
		color: #fff;
		text-decoration: none;
		background-color: #545b62
	}

	.badge-success {
		color: #fff;
		background-color: #28a745
	}

	.badge-success[href]:focus,
	.badge-success[href]:hover {
		color: #fff;
		text-decoration: none;
		background-color: #1e7e34
	}

	.badge-info {
		color: #fff;
		background-color: #17a2b8
	}

	.badge-info[href]:focus,
	.badge-info[href]:hover {
		color: #fff;
		text-decoration: none;
		background-color: #117a8b
	}

	.badge-warning {
		color: #212529;
		background-color: #ffc107
	}

	.badge-warning[href]:focus,
	.badge-warning[href]:hover {
		color: #212529;
		text-decoration: none;
		background-color: #d39e00
	}

	.badge-danger {
		color: #fff;
		background-color: #dc3545
	}

	.badge-danger[href]:focus,
	.badge-danger[href]:hover {
		color: #fff;
		text-decoration: none;
		background-color: #bd2130
	}

	.badge-light {
		color: #212529;
		background-color: #f8f9fa
	}

	.badge-light[href]:focus,
	.badge-light[href]:hover {
		color: #212529;
		text-decoration: none;
		background-color: #dae0e5
	}

	.badge-dark {
		color: #fff;
		background-color: #343a40
	}

	.badge-dark[href]:focus,
	.badge-dark[href]:hover {
		color: #fff;
		text-decoration: none;
		background-color: #1d2124
	}
</style>
<div class="">
	<div class="mx-5 mt-3 mb-4">
		<h3 class="title text-center mt-3 mb-5"><span class="mm">နိုင်ငံခြားသားနည်းပညာရှင်/ကျွမ်းကျင်လုပ်သား</span><span
				class="eng">Foreign Technician/Skilled Labour</span></h3>

		<a href="{{route('FT.create')}}" class="btn btn-success float-end">Add New <i class="fas fa-user-plus"></i></a>

		{{--
		Rejected => 0
		Active => 1
		Resign Applied => 2
		Resigned => 3
		--}}
		<!-- Tabs navs -->
		<ul class="nav nav-tabs mb-3" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#employee_table" role="tab"
					data-id="1">
					Active <i class="fas fa-users"></i>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#employee_table" role="tab" data-id="2">
					Resign Applied <i class="fas fa-user-cog"></i>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#employee_table" role="tab" data-id="3">
					Resigned <i class="fas fa-user-minus"></i>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" href="#employee_table" role="tab" data-id="0">
					Resubmitted <i class="fas fa-user-times"></i>
				</a>
			</li>
		</ul>
		<!-- Tabs navs -->


		<!-- Tabs content -->
		<div class="row mb-3 tab-pane fade show active" id="employee_table">
			<div class="row">
				<div class="col-md-3 offset-md-9 p-0">
					<form action="">
						<div class="input-group mb-3">
							<input type="hidden" name="hidden_status" id="hidden_status">
							<input type="text" class="form-control" name="search" id="search"
								placeholder="Search by Name" />
							<button class="btn btn-outline-success" type="submit" id="search_btn"
								data-mdb-ripple-color="dark">
								Search
							</button>
						</div>
					</form>
				</div>
			</div>
			<div class="row mt-4">
				<table class="table table-hover" id="test">
					<thead>
						<tr>
							<th><span class="mm">နံပါတ်</span><span class="eng">No</span></th>
							<th><span class="mm">ဓာတ်ပုံ</span><span class="eng">Photo</span></th>
							<th><span class="mm">အမည်</span><span class="eng">Name</span></th>
							<th><span class="mm">ရာထူး</span><span class="eng">Rank</span></th>
							<th><span class="mm">အရည်အချည်း</span><span class="eng">Qualification</span></th>
							<th><span class="mm">Form C လိပ်စာ</span><span class="eng">Form C Address</span></th>
							<th><span class="mm">အမြဲတမ်းလိပ်စာ</span><span class="eng">Permanent Address</span></th>
							<th style="width: 150px;"><span class="mm">အလုပ်သမား ကဒ်</span><span class="eng">Labour Card</span></th>
							<th style="width: 160px;"><span class="mm">Micမှ ခန့်ထားခွင့်ပြုသည့်စာ</span><span class="eng">Mic Approved Letter</span></th>
							<th><span class="mm">ဖုန်း နံပါတ်</span><span class="eng">Phone No</span></th>
							<th><span class="mm">ပက်စ်ပို့ နံပါတ်</span><span class="eng">Passport No</span></th>
							<th><span class="mm">အခြေအနေ</span><span class="eng">Status</span></th>
							<th></th>
						</tr>
					</thead>


					<tbody id="technician_list">

					</tbody>
				</table>
			</div>
		</div>
		<!-- Tabs content -->


		<!-- Resign Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="max-width: 60%;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Foreign Technician Resign</h5>
						<button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
					</div>
					<form action="" id="resignForm" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="modal-body">
							<h6 class="text-danger text-center border border-3 p-3 mb-3">Resign form အား MIC သို့
								တင်ပြပြီးမှသာ ဖြည့်သွင်းရမည်ဖြစ်ပါသည်။</h6>
							<div class="info mt-2 mb-4" id="info">

							</div>

							<div class="row my-5">
								<div class="col">
									<label class="form-label" for="customFile"><span class="eng">Copy of Resigned Letter
											Submitted to MIC</span> <span class="mm">MIC သို့ တင်ပြသည့် နှုတ်ထွက်စာ
											မိတ္တူ</span></label>
									<input type="file" class="form-control" name="mic_copy_resigned_letter"
										id="customFile" accept="application/pdf" required />
								</div>
								<div class="col">
									<label class="form-label"  for="customFile"><span class="eng">Passport</span> <span
											class="mm">နိုင်ငံကူးလက်မှတ်</span></label>
									<input type="file" class="form-control" name="passport" id="customFile"
										accept="application/pdf" required />
								</div>
							</div>

							<div class="row">
								<div class="col">
									<label class="form-label" for="customFile"><span class="eng">MIC Approve
											Letter</span> <span class="mm">MIC မှ ခန့်ထားခွင့်ပြုသည့်စာ</span></label>
									<input type="file" class="form-control" name="mic_permit" id="customFile"
										accept="application/pdf" required />
								</div>
								<div class="col">
									<label class="form-label" for="customFile"><span class="eng">Air Ticket</span> <span
											class="mm">လေယာဉ်လက်မှတ်</span></label> (If any)
									<input type="file" class="form-control" name="air_ticket" id="customFile"
										accept="application/pdf" />
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	</form>

	<script src="{{ asset('js/mdb.min.js') }}"></script>
	<script>
		$(document).ready(function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

		const profile_id = "{{ auth()->user()->profile->id }}";

		data = {
            'profile_id': profile_id,
            'status': '1'
        }
		
		// Fetch data when document ready
		$.ajax({
			type: "GET",
			url: "{{ route('FT.list') }}",
			data: data,
			dataType: "JSON",
			success: function (response) {
				var output = '';
				$.each(response, function (index, value) {
					let file = value.form_c_filename;
					if(file){
						file = value.form_c_filename;
					}else{
						file = '';
					}

					output += `
						<tr style="vertical-align: middle;">
							<td>${++index}</td>
								
							<td><a href=""><img src="public/${value.Image}" height="100px" width="100px" style="object-fit: contain"></a> </td>

							<td>${value.Name}</td>
							<td>${value.Rank}</td>
							<td>${value.Qualification}</td>
							<td>
								${value.form_c_filename == null ?
									`<label class="badge badge-danger">No Have</label>`
									:`<a href='public/${value.form_c_filename}'>${value.address}</a>`}
								
								
							</td>
							<td>
								${value.home_address}
							</td>
							<td>
								${value.labour_card == null ?
									`<label class="badge badge-danger">No Have</label>`
									:`<a href='public/${value.labour_card}'>show</a>`}
							</td>
							<td>
								${value.mic_aprroved_letter == '' || value.mic_aprroved_letter == null? 
								`<label class="badge badge-danger">No Have</label>`
								:`<a href='public/${value.mic_aprroved_letter}'>Yes</a>`}
							</td>
							<td>${value.phone_no}</td>
							<td>${value.PassportNo}</td>
							
							<td>
								${value.Status == 1 ? 
									`<label class="badge badge-success">Active</label>` 
								: '<label class="badge badge-danger">In Process</label>'}
							</td>
								
							<td>
								<a href="/foreign/${value.id}" class="btn btn-primary">Edit <i class="fas fa-user-edit"></i></a>
								<button type="button" class="btn btn-danger mt-2" onclick="fetchUser(this)" value="${value.id}" data-mdb-toggle="modal" data-mdb-target="#exampleModal" style="min-width:110px">
									Resign <i class="fas fa-user-minus"></i>
								</button>
							</td>
						</tr>
					`;
				});
				$('#technician_list').html(output);
			}
		});


		// When user click tab, run this function
		$(document).on('click', '.nav-link', function(){
			var status = $(this).attr('data-id');

			$('#hidden_status').val(status);

			status_id = status;
			// console.log(status_id)

			$('#search').val('');

			const loading = `
			<img src="images/Loading_icon.gif" alt="" width="200px" height="200px" style="object-fit: contain; position: absolute; left: 50%; transform: translateX(-50%)" class="loading">
			`;
			$('#technician_list').html(loading);

			// Also Fatch Data when user click tab
			$.ajax({
				type: "GET",
				url: "{{ route('FT.list') }}",
				data: {'profile_id':profile_id, 'status':status},
				dataType: "JSON",
				success: function (response) {

					
					if(response.length == 0){
						var no_result = `
							<p class="text-danger my-5" style="position: absolute; left: 50%; transform: translateX(-50%)">No Data Here ...</p>
						`;
						$('#technician_list').html(no_result);
					}else{
						var output = '';
						$.each(response, function (index, value) {
							let file = value.form_c_filename;
							if(file){
								file = value.form_c_filename;
							}else{
								file = '';
							}
						
							// Status Badge
							let status_text = '';
							let status_color = '';
							if(value.Status == 1){
								status_text = 'Active';
								status_color = 'success';
							}else if(value.Status == 2){
								status_text = 'In Process';
								status_color = 'warning';
							}else if(value.Status == 3){
								status_text = 'Resigned';
								status_color = 'primary';
							}else{
								status_text = 'Resubmitted';
								status_color = 'danger';
							}
	
							// Button Text
							let btn_text = '';
							if(value.Status == 0){
								btn_text = 'Reapply'
							}else{
								btn_text = 'Resign'
							}
	
							// Hide Actions
							let hide_btn = '';
							if(value.Status == 2 || value.Status == 3){
								hide_btn = 'style="display: none;"'
							}

							// Reject Comment
							let reject_comment = '';
							if(value.Status == 0){
								if(value.reject_comment){
									reject_comment = value.reject_comment;
								}else{
									reject_comment = ''
								}
							}
	
							output += `
								<tr style="vertical-align: middle;">
									<td>${++index}</td>
										
									<td>
										<a href="public/${value.Image}"><img src="${value.Image}" height="100px" width="100px" style="object-fit: contain"></a><br>
										<span class="text-danger">${reject_comment}</span>
									</td>
	
									<td>${value.Name}</td>
									<td>${value.Rank}</td>
									<td>${value.Qualification}</td>
									<td>
										${value.form_c_filename == null ?
											`<label class="badge badge-danger">No Have</label>`
											:`<a href='public/${value.form_c_filename}'>${value.address}</a>`}

									</td>
									<td>
										${value.home_address}
									</td>
									<td>
										${value.labour_card == null ?
										`<label class="badge badge-danger">No Have</label>`
										:`<a href='public/${value.labour_card}'>show</a>`}
									</td>
									<td>
										${value.mic_aprroved_letter == '' || value.mic_aprroved_letter == null? 
										`<label class="badge badge-danger">No Have</label>`
										:`<a href='public/${value.mic_aprroved_letter}'>Show</a>`}
									</td>
									<td>${value.phone_no}</td>
									<td>${value.PassportNo}</td>
									
										
									
									<td>
										<label class="badge badge-${status_color}">
											${status_text}
										</label>
									</td>
										
									<td ${hide_btn}>
										<a href="/foreign/${value.id}" class="btn btn-primary">Edit <i class="fas fa-user-edit"></i></a>
										<button type="button" class="btn btn-danger mt-2" onclick="fetchUser(this)" value="${value.id}" data-mdb-toggle="modal" data-mdb-target="#exampleModal" style="min-width:110px">
											${btn_text} <i class="fas fa-user-minus"></i>
										</button>
									</td>
								</tr>
							`;
						});
						$('#technician_list').html(output);
					}

				}
			});

		})


		// Search Resign Section By Name
		$('#search_btn').on('click', function(e){
			e.preventDefault();
			var search = $('#search').val();

			// var status_id = $('#hidden_status').val();
			// status_id = '1';
			// console.log(status_id)
			var status = $('#hidden_status').val();
			if(status == ''){
				status = '1'
			}

			$.ajax({
				type: "GET",
				url: "{{ route('FT.search') }}",
				data: {'search':search, 'profile_id':profile_id, 'status': status},
				dataType: "JSON",
				success: function (response) {
					console.log(response);
					if(response.length == 0){
						var no_result = `
							<p class="text-danger my-5" style="position: absolute; left: 50%; transform: translateX(-50%)">No Data Here ...</p>
						`;
						$('#technician_list').html(no_result);
					}else{
						var output = '';
						$.each(response, function (index, value) {
							let file = value.form_c_filename;
							if(file){
								file = value.form_c_filename;
							}else{
								file = '';
							}
						
							// Status Badge
							let status_text = '';
							let status_color = '';
							if(value.Status == 1){
								status_text = 'Active';
								status_color = 'success';
							}else if(value.Status == 2){
								status_text = 'In Process';
								status_color = 'warning';
							}else if(value.Status == 3){
								status_text = 'Resigned';
								status_color = 'primary';
							}else{
								status_text = 'Resubmitted';
								status_color = 'danger';
							}

							// Button Text
							let btn_text = '';
							if(value.Status == 0){
								btn_text = 'Reapply'
							}else{
								btn_text = 'Resign'
							}

							// Hide Actions
							let hide_btn = '';
							if(value.Status == 2 || value.Status == 3){
								hide_btn = 'style="display: none;"'
							}

							// Reject Comment
							let reject_comment = '';
							if(value.Status == 0){
								if(value.reject_comment){
									reject_comment = value.reject_comment;
								}else{
									reject_comment = ''
								}
							}

							output += `
								<tr style="vertical-align: middle;">
									<td>${++index}</td>
										
									<td>
										<a href="${value.Image}"><img src="public/${value.Image}" height="100px" width="100px" style="object-fit: contain"></a><br>
										<span class="text-danger">${reject_comment}</span>
									</td>

									<td>${value.Name}</td>
									<td>${value.Rank}</td>
									<td>${value.Qualification}</td>
									<td>
										${value.form_c_filename == null ?
											`<label class="badge badge-danger">No Have</label>`
											:`<a href='public/${value.form_c_filename}'>${value.address}</a>`}
									</td>
									<td>
										${value.home_address}
									</td>
									<td>
									${value.labour_card == null ?
										`<label class="badge badge-danger">No Have</label>`
										:`<a href='public/${value.labour_card}'>show</a>`}
										</td>
									<td>
										${value.mic_aprroved_letter == '' || value.mic_aprroved_letter == null? 
										`<label class="badge badge-danger">No Have</label>`
										:`<a href='public/${value.mic_aprroved_letter}'>Yes</a>`}
									</td>
									<td>${value.phone_no}</td>
									<td>${value.PassportNo}</td>
				
									<td>
										<label class="badge badge-${status_color}">
											${status_text}
										</label>
									</td>
										
									<td ${hide_btn}>
										<a href="/foreign/${value.id}" class="btn btn-primary">Edit <i class="fas fa-user-edit"></i></a>
										<button type="button" class="btn btn-danger text-sm mt-2" onclick="fetchUser(this)" value="${value.id}" data-mdb-toggle="modal" data-mdb-target="#exampleModal" style="min-width:110px">
											${btn_text} <i class="fas fa-user-minus"></i>
										</button>
									</td>
								</tr>
							`;
						});
						$('#technician_list').html(output);
					}

				}
			});
		})

	})

	// function to fetch user data and plug into the modal
	function fetchUser(ele){
		var user_id = ele.value;
		var output = '';

		var files = document.querySelectorAll('#customFile');

		files.forEach(file => {
			file.value = ''
		});

		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

		$.ajax({
			type: "GET",
			url: "/foreign_technicians/show",
			data: {'id':user_id},
			dataType: "JSON",
			success: function (response) {
				output += `
					<div class="d-flex justify-content-center align-items-center gap-5">
						<div>
							<img src="${response.Image}" alt="" width="200px" height="200px" style="object-fit:contain;">
						</div>
						<div class="profile">
							<p>
								<span class="fw-bold eng">Name</span>: <span id="name">${response.Name}</span>
							</p>
							<p>
								<span class="fw-bold eng">Date of Birth</span>: <span id="dob">${response.DateOfBirth}</span>
							</p>
							<p>
								<span class="fw-bold eng">Gender</span>: <span id="gender">${response.Gender.toUpperCase()}</span>
							</p>
							<p>
								<span class="fw-bold eng">Qualification</span>: <span id="rank">${response.Qualification}</span>
							</p>
							<p>
								<span class="fw-bold eng">Permanent Address</span>: <span id="rank">${response.home_address}</span>
							</p>
							<p>
								<span class="fw-bold eng">Form C Address</span>: <span id="rank">${response.address}</span>
							</p>
							<p>
								<span class="fw-bold eng">Phone No</span>: <span id="rank">${response.phone_no}</span>
							</p>
							<p>
								<span class="fw-bold eng">Rank</span>: <span id="rank">${response.Rank}</span>
							</p>
							<p class="mb-0">
								<span class="fw-bold eng">Passport</span>: <span id="passport">${response.PassportNo}</span>
							</p>
						</div>
					</div>
				`;

				$('#info').html(output);


				var route = `/foreign_technicians/${response.id}/resignApply`;
				$('#resignForm').attr('action', route);
			}
		});

	}
	</script>
	@endsection