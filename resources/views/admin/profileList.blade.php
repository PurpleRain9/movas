@extends('admin.layout')
@section('content')

    <style>
        .modal {
            top: 50%;
            transform: translateY(-20%);
        }

        .modal-dialog {
            max-width: 50%;
        }
        #test-select{
          padding: 0.5rem 0.5rem;
          margin-bottom: 1rem; 
        }
        .dt-buttons button{
            background-color:#44CE42;
            color: #ffffff; 
        }

        .dataTables_length{
            margin-left: 1rem;
            margin-top: 0.1rem;
        }

        #profilelistTable_filter{
            display: none;
        }

        #profileSearch{

            margin: 0;
            z-index: 999;
        }
    </style>
    
   
    <div class="d-xl-flex row align-items-start" style="border-bottom: 1px solid lightblue;">
        
        
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-6">
                <label style="font-weight:bold;">Select</label>
                <select id="test-select" class="form-control">
                    <option value="">Select</option>
                    @foreach ( $permitype as $pmt)
                        <option value="{{ $pmt->PermitTypeNameMM }}">{{ $pmt->PermitTypeNameMM }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label style="font-weight:bold;">Search</label>
                <input type="text" class="form-control" id="profileSearch" name="profileSearch" placeholder="search..">
            </div>
          </div>
        </div>
        <div class="col-md-3 text-end">
          <h3 class="text-dark mb-0" style="margin-top:3rem;font-weight:bold;"> Profile List </h3>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            
            <table class="table table-hover table-bordered table-responsive" id="profilelistTable">
                
                
                <thead class="bg-primary text-white">
                    <th>
                        No
                    </th>
                    <th>
                        Company Name
                    </th>
                    <th>
                        Registration No
                    </th>
                    <th>
                        Permit Type
                    </th>
                    <th>
                        Permit No
                    </th>
                    <th>
                        Profile Status
                    </th>
                    <td>
                        Date
                    </td>
                    <th>
                        Actions
                    </th>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($profile as $result)
                        <tr>
                            <td class="text-wrap">{{ $i++ }}</td>
                            <td class="text-wrap">
                                @if ($result->user)
                                    {{-- {{ dd($result->user->id) }} --}}
                                    <a class="companyName" id="openModal" data-toggle="modal" data-target="#userModal"
                                        data-user-id="{{ $result->user->id }}">
                                        {{ $result->CompanyName }}
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="userModal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="userModalLabel">Contact Info</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
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
                                                            <td id="user_name"></td>
                                                            <td id="user_email"></td>
                                                            <td id="user_phone"></td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{ $result->CompanyName }}
                                @endif
                            </td>
                            <td class="text-wrap">{{ $result->CompanyRegistrationNo }}</td>
                            <td class="text-wrap" style="width: 300px;!important">
                                {{ $result->permit_type->PermitTypeNameMM }}</td>
                            <td class="text-wrap">{{ $result->PermitNo }}</td>
                            <td class="text-wrap">
                                @if ($result->Status == 2)
                                    <span class="badge badge-danger"> Resubmit</span>
                                @elseif($result->Status == 0)
                                    <span class="badge badge-warning"> Inprocess</span>
                                @else
                                    <span class="badge badge-success"> Approve</span>
                                @endif
                            </td>
                            <td>
                                @if ($result->Status == 1)
                                    <p>{{ $result->ApproveDate}}</p>
                                @elseif ($result->Status == 2)
                                    <p>{{ $result->Rejected_date}}</p>
                                @else
                                    <p>{{ $result->created_at->format('Y-m-d') }}</p>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm rounded btn-primary button"
                                href="{{ route('profileShow', $result->id) }}">Show</a>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <br>
    {{-- {{ $profile->withQueryString()->links() }} --}}
    <br><br>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#profilelistTable').DataTable({
                dom: "Blfrtip",
                buttons: [
                    
                    {
                        text: '<i class="fa fa-download"></i> Excel Export',
                        extend: 'excelHtml5',
                        className: "btn btn-sm btn-success",
                        filename: function(){
                            var d = new Date();
                            var n = d.getTime();
                            return 'Profilelist' + d;
                        },
                        exportOptions: {
                            columns: [0,1,2,3,4,5,6]
                        }
                    },
                ],
                columnDefs: [{
                    orderable: false,
                    targets: -2
                }] 

            });



            var oTable;
            oTable = $('#profilelistTable').dataTable();

            $('#test-select').change( function() { 
                oTable.fnFilter( $(this).val() );
                var label = $('#profilelistTable_filter').children('label');
                var input = label.children('input');
                var inputValue = input.val();
                // console.log(inputValue);
                inputValue.length = "";
            });

            $('#profileSearch').keyup(function(){
                oTable.fnFilter($(this).val());
            })



            $(document).on('click', '#openModal', function() {
                var user_id = $(this).attr('data-user-id');
                $.ajax({
                    type: "GET",
                    url: "/getCompanyUserInfo",
                    data: {
                        'id': user_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('#user_name').text(response.name)
                        $('#user_email').text(response.email)
                        $('#user_phone').text(response.phone_no)
                    }
                });
            });

        });
    </script>
@endsection
