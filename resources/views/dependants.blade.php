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
	.top-two{
		display: flex;
		flex-direction: row;
		justify-content: space-around;
	}
</style>
<div class="">
	<div class="mx-5 mt-3 mb-4">
		<h3 class="title text-center mt-3 mb-5"><span class="mm">မှီခိုများ</span><span
				class="eng">Dependants</span></h3>

		

		{{--
		Rejected => 0
		Active => 1
		Resign Applied => 2
		Resigned => 3
		--}}
		<!-- Tabs navs -->
		
		<!-- Tabs navs -->


		<!-- Tabs content -->
		<div class="row mb-3 tab-pane fade show active" id="employee_table">
			<div class="top-two">
				
				<div class="">
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
				<div class="">
					<a href="{{route('DP.create')}}" class="btn btn-success float-end">Add New <i class="fas fa-user-plus"></i></a>
				</div>
			</div>
			<div class="row mt-4 ms-2">
				<table class="table table-hover" id="test">
					<thead>
						<tr>
							<th><span class="mm">နံပါတ်</span><span class="eng">No</span></th>
							<th><span class="mm">ဓာတ်ပုံ</span><span class="eng">Photo</span></th>
							<th><span class="mm">အမည်</span><span class="eng">Name</span></th>
							<th><span class="mm">ရာထူး</span><span class="eng">Rank</span></th>
							<th><span class="mm">အရည်အချည်း</span><span class="eng">Qualification</span></th>
							<th><span class="mm">Form C <br> လိပ်စာ</span><span class="eng">Form C <br> Address</span></th>
							<th><span class="mm">အမြဲတမ်းလိပ်စာ</span><span class="eng">Permanent <br> Address</span></th>
							<th><span class="mm">ဖုန်း နံပါတ်</span><span class="eng">Phone <br> No</span></th>
							<th><span class="mm">ပက်စ်ပို့ နံပါတ်</span><span class="eng">Passport <br> No</span></th>
							<th><span class="mm">အခြေအနေ</span><span class="eng">Status</span></th>
							<th><span class="mm">လုပ်ဆောင်ချက်</span> <span class="eng">Action</span></th>
						</tr>
					</thead>


					<tbody id="dependents_list">

					</tbody>
				</table>
			</div>
		</div>
		<!-- Tabs content -->


		<!-- Resign Modal -->
		
		
	</div>
	</form>

	<script src="{{ asset('js/mdb.min.js') }}"></script>
	<script>
		$(document).ready(function () {

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

			
			$.ajax({
				type: "GET",
				url: "{{ route('DP.list') }}",
				data: data,
				dataType: "JSON",
				success: function (response) {
					var output = '';
					$.each(response, function (index, value) {
						let file = value.formc_file_name;
						if(file){
							file = value.formc_file_name;
						}else{
							file = '';
						}

						output += `
							<tr style="vertical-align: middle;">
								<td>${++index}</td>
									
								<td><a href=""><img src="public/${value.image}" height="90px" width="90px" style="object-fit: contain"></a> </td>
								<td>${value.name}</td>
								<td>${value.rank}</td>
								<td>${value.qualification}</td>
								<td style="white-space: normal;line-height: 1.6;">
									${value.formc_file_name == null ?
										`<label class="badge badge-danger">No Have</label>`
										:`<a href='public/${value.formc_file_name}'>${value.formc_address}</a>`}
									
									
								</td>
								<td style="white-space: normal;line-height: 1.6;">
									${value.permanent_address}
								</td>
								
								
								<td>${value.phone_no}</td>
								<td>${value.passport_no}</td>
								
								<td>
									${value.Status == 1 ? 
										`<label class="badge badge-success">Active</label>` 
									: '<label class="badge badge-success">active</label>'}
								</td>
									
								<td>
									<a href="/dependant/${value.id}" class="btn btn-primary" style="min-width:120px">Edit <i class="fas fa-user-edit"></i></a>
									<a type="button" class="btn btn-danger mt-2" href="/dependantdelete/${value.id}"  style="min-width:120px">
										Delete <i class="fas fa-user-minus"></i>
									</a>
								</td>
							</tr>
						`;
					});
					$('#dependents_list').html(output);
				}
			});
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
				url: "{{ route('DP.search') }}",
				data: {'search':search, 'profile_id':profile_id, 'status': status},
				dataType: "JSON",
				success: function (response) {
					
					if(response.length == 0){
						var no_result = `
							<p class="text-danger my-5" style="position: absolute; left: 50%; transform: translateX(-50%)">No Data Here ...</p>
						`;
						$('#dependents_list').html(no_result);
					}else{
						var output = '';
						$.each(response, function (index, value) {
							let file = value.formc_file_name;
							if(file){
								file = value.formc_file_name;
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
										<a href="${value.image}"><img src="public/${value.image}" height="100px" width="100px" style="object-fit: contain"></a><br>
										<span class="text-danger">${reject_comment}</span>
									</td>

									<td>${value.name}</td>
									<td>${value.rank}</td>
									<td>${value.qualification}</td>
									<td>
										${value.form_c_filename == null ?
											`<label class="badge badge-danger">No Have</label>`
											:`<a href='public/${value.formc_file_name}'>${value.formc_address}</a>`}
									</td>
									<td>
										${value.home_address}
									
									<td>${value.phone_no}</td>
									<td>${value.passport_no}</td>
				
									<td>
										<label class="badge badge-${status_color}">
											${status_text}
										</label>
									</td>

									<td>
										<a href="/dependant/${value.id}" class="btn btn-primary" style="min-width:120px">Edit<i class="fas fa-user-edit"></i></a>
										<a href="/dependantdelete/${value.id}">
											<button type="button" class="btn btn-danger mt-2" onclick="return confirm('Are you sure to delete?')" value="${value.id}" style="min-width:120px">
												Delete <i class="fas fa-user-minus"></i>
											</button>
										</a>
									</td>
										
									

								</tr>
							`;
						});
						$('#dependents_list').html(output);
					}

				}
			});
		});

		});

		
	</script>
	
	@endsection