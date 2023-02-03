@extends('layout')
@section('content')

    <style>
    	/* Style the tab */
		.tab {
		  overflow: hidden;
		  border: 1px solid #ccc;
		  background-color: #f1f1f1;
		}

		/* Style the buttons inside the tab */
		.tab button {
		  background-color: inherit;
		  float: left;
		  border: none;
		  outline: none;
		  cursor: pointer;
		  padding: 14px 16px;
		  transition: 0.3s;
		  font-size: 17px;
		}

		/* Change background color of buttons on hover */
		.tab button:hover {
		  background-color: #ddd;
		}

		/* Create an active/current tablink class */
		.tab button.active {
		  background-color: #00ab46;
		  color: white;
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

		/*accordion*/
		.accordion {
		  background-color: #eee;
		  color: #444;
		  cursor: pointer;
		  padding: 18px;
		  width: 100%;
		  border: none;
		  text-align: left;
		  outline: none;
		  font-size: 15px;
		  transition: 0.4s;
		}

		.active, .accordion:hover {
		  background-color: #00ab46;
		  color: white;
		  font-weight: bold;
		}

		.accordion:after {
		  content: '\002B';
		  color: #777;
		  font-weight: bold;
		  float: right;
		  margin-left: 5px;
		}

		.myaccordion.active:after {
		  content: "\2212";
		}

		ul.mytype{
			list-style: square;
		}

		.panel {
		  padding: 0 18px;
		  background-color: white;
		  max-height: 0;
		  overflow: hidden;
		  transition: max-height 0.2s ease-out;
		}

		label{
			font-weight: bold;
		}
    </style>

		<div class="container">
			<h2 class="mt-4"><span class="mm">ကုမ္ပဏီအချက်အလက်</span><span class="eng">Company Profile</span></h2>
			<!-- <p style="color: #b69746; font-weight: bold;"><span class="mm">ကုမ္ပဏီ အမည်</span><span class="eng">Company Name</span> - Test Company.</p> -->

			<div class="tab mt-4">
			  <button class="tablinks" onclick="openCity(event, 'Profile')" id="defaultOpen"><span class="eng">PROFILE</span> <span class="mm">ကုမ္ပဏီအချက်အလက်</span></button>
			  <button class="tablinks" onclick="openCity(event, 'INVESTMENT')" id="defaultOpen"><span class="eng">INVESTMENT CAPITAL</span> <span class="mm">INVESTMENT CAPITAL</span></button>
			  <button class="tablinks" onclick="openCity(event, 'Staffs')" id="defaultOpen"><span class="eng">LABOURS/STAFFS</span> <span class="mm">အရာရှိများ</span></button>
			  <button class="tablinks" onclick="openCity(event, 'ITEMS')" id="defaultOpen"><span class="eng">ITEMS</span> <span class="mm">ITEMS</span></button>
			  <button class="tablinks" onclick="openCity(event, 'Others')"><span class="eng">OTHER</span> <span class="mm">အခြား</span></button>
			</div>

			<div id="Profile" class="tabcontent">
			  <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
			  <h3 style="color: #00ab46;">Profile</h3>
			  <div class="row mt-3">
			  	<div class="col">
			  	   <label>Name : </label> ABCDEFG
			  	</div>
			  	<div class="col">
			  	   <label>Name in Myanmar : </label> ABCDEFG
			  	</div>
			  	<div class="col">
			  		<label>MIC No : </label> 1234567
			  	</div>
			  </div>

			  <div class="row mt-4">
			  	<div class="col">
			  		<label>Registration Date : </label> 12.2.21
			  	</div>
			  	<div class="col">
			  	   <label>Principle Place : </label> Myanmar
			  	</div>
			  	<div class="col">
			  	   <label>Registered Place : </label> No.342  Suelay Pagoda Street Yangon
			  	</div>
			  </div>

			  <div class="row mt-3 mb-4">
			  	<div class="col">
			  	   <label>Company Type : </label> Public Company
			  	</div>
			  	<div class="col">
			  	   <label>Foreign Company : </label> No
			  	</div>
			  	<div class="col">
			  		<label>Small Company : </label> Yes
			  	</div>
			  </div>
			</div>

			<div id="INVESTMENT" class="tabcontent">
			  <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
			  <h3 style="color: #00ab46;">Investment Capital</h3>
			  <label class="mt-3">Dollar : </label>15000
			</div>

			<div id="Staffs" class="tabcontent">
			  <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
			  <h3 style="color: #00ab46;">Staffs</h3>

			  <table class="table table-hover table-inverse mt-4 mb-4">
			  	<thead>
			  		<tr>
			  			<th>Name</th>
			  			<th>Type</th>
			  			<th>Nationality</th>
			  			<th>N.R.C</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<tr>
			  			<td>U Mya</td>
			  			<td>Director</td>
			  			<td>Myanmar</td>
			  			<td>*************123</td>
			  		</tr>
			  		<tr>
			  			<td>U Ko Ko</td>
			  			<td>Director</td>
			  			<td>Myanmar</td>
			  			<td>*************444</td>
			  		</tr>
			  		<tr>
			  			<td>U Win Bo</td>
			  			<td>Director</td>
			  			<td>Myanmar</td>
			  			<td>*************256</td>
			  		</tr>
			  	</tbody>
			  </table>
			</div>

			<div id="ITEMS" class="tabcontent">
			  <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
			  <h3 style="color: #00ab46;">Items</h3>
			  <table class="table table-hover table-inverse mt-4 mb-4">
			  	<thead>
			  		<tr>
			  			<th>Name</th>
			  			<th>Qty</th>
			  			<th>Price</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<tr>
			  			<td>Car</td>
			  			<td>11</td>
			  			<td>1.1M</td>
			  		</tr>
			</div>

			

			<div id="Others" class="tabcontent">
			  <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
			  <h3 style="color: #00ab46;">Other</h3>

			  <div class="row mt-3 mb-4">
			  	<div class="col">
			  	   <label>Status : </label> Active
			  	</div>
			  	<div class="col">
			  	   <label>Annual Return Due Date : </label> 12/12/2022
			  	</div>

			  </div>
			</div>
		</div>

<script>
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


			var acc = document.getElementsByClassName("accordion");
			var i;

			for (i = 0; i < acc.length; i++) {
			  acc[i].addEventListener("click", function() {
			    this.classList.toggle("active");
			    var panel = this.nextElementSibling;
			    if (panel.style.maxHeight) {
			      panel.style.maxHeight = null;
			    } else {
			      panel.style.maxHeight = panel.scrollHeight + "px";
			    } 
			  });
			}

			checkLan();
</script>

@endsection