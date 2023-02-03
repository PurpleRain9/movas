@extends('admin.layout')
@section('content')

    <div class="d-xl-flex justify-content-between align-items-start" style="border-bottom: 1px solid lightblue;">
        <p class="text-dark mb-2"> Profile List </p>

        </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <table class="table table-hover table-bordered" id="test">
                        <thead class="bg-primary text-white">
                            <th>No</th>
                            <th>Company Name</th>
                            <th>Name</th>
                            <th>First Apply Date</th>
                            <th>Final Apply Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            {{-- {{ $technicians->profile->CompanyName }} --}}
                            @foreach ($technicians as $key => $technician)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $technician->profile?->CompanyName ?? '' }}</td>
                                    {{-- {{ dd($technician->profile->CompanyName = null) }} --}}
                                    <td>{{ $technician->Name }}</td>
                                    <td>{{ date('d F, Y', strtotime($technician->first_apply_date)) }}</td>
                                    <td>{{ date('d F, Y', strtotime($technician->final_apply_date)) }}</td>
                                    <td>
                                        @if($technician->Status == 2)
                                            <span class="badge badge-warning"> In Process</span>
                                        @elseif($technician->Status == 3)
                                            <span class="badge badge-success"> Accepted</span>
                                        @elseif($technician->Status == 0)
                                            <span class="badge badge-danger"> Resubmitted</span>
                                        @endif
                                    <td >
                                        <a href="{{ route('resignShow', $technician->id) }}" class="btn btn-sm rounded btn-primary button" href="">Show</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>

    $(document).ready(function() {
        $('#test').DataTable({});
    });
</script>
@endsection




