@extends('admin.layout')
@section('content')

            {{-- <div class="d-xl-flex justify-content-between align-items-start" style="border-bottom: 1px solid lightblue;">
              <p class="text-dark mb-2"> Visa Application Rejected List </p>

            </div> --}}

        <div class="row mt-3">
          <div class="col-md-12">
            <table class="table table-hover table-bordered">
              <thead>
                <tr style="background: #d7d8fd;color: black;">
                  <th width="10">No</th>
                  <th width="300">Name</th>
                  <th>Sectors</th>
                  <th width="40"></th>
                </tr>
              </thead>
              <tbody>
                @php
                  $i=1;
                @endphp
                @foreach ($admins as $a)
                  <tr>
                    <td>{{$i++}}</td>
                    <td>{{$a->username}}</td>
                    <td class="text-wrap">
                      @foreach ($a->sectors as $as)
                        <label class="badge badge-info" style="margin-top: 1px;">{{$as->SectorNameMM}}</label>
                      @endforeach
                    </td>
                        
                    <td><a href="{{ route('adminsector.edit',$a->id) }}" style="color: blue;"><i class="fa fa-edit"></i></a></td>
                  </tr>
                  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

<br><br>
@endsection