@extends('admin.layout')

@section('content')
    <div class="container">
        <style type="text/css">
            #mtop {
                margin-bottom: 150px;
            }
            #mm {
                margin-left: 120px;
            }
            .paginate{
                display: flex;
                flex-direction: row;
                justify-content: center;
            }
        </style>

        @if (Session::has('alert'))
            <div class="alert alert-success form-group">

                {{ Session::get('alert') }}

                @php
                    
                    Session::forget('alert');
                    
                @endphp

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
        <div class="row mb-5" id="mtop">
            @if (session('error'))
                <p class="alert alert-danger mx-auto" style="width: 90%; margin-top:20px;">
                    {{ session('error') }}
                </p>        
            @endif
            <div class="col-md-5">
                <span class="text-dark font-weight-bold mb-2 text-center" style="font-size: 20px;"> Profiles Deleted List </span>
            </div>

        </div>
        <div class="row my-3">
            <div class="col-md-7 ">
                <form class="navbar-form" action="" method="get">
                    <div class="input-group no-border">
                        <input type="text" id="search" class="form-control"
                            placeholder="Company name..." style="border-radius: 3px; width: 0px;"
                            name="search">
                            <button type="submit" style="margin-left: 10px;width: 40px;" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                                <!--<div class="ripple-container"></div>-->
                            </button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 text-end">
                <a href="{{ route("profile.index") }}" class="btn btn-secondary" style="padding: 0.65rem 0.35rem;"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
        </div>
        <div class="">
            <table class="table table-bordered">
                <thead>
                    <th>No.</th>
                    <th>Company Name</th>
                    <th>Business Type</th>
                    <th>Township</th>
                    <th>Date</th>
                    <td>Time</td>
                    <th>Admin Name</th>
                </thead>
                <tbody>
                    @foreach ($deleteProfiles as $key => $deleteProfile)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td class="text-wrap" style="line-height: 24px">{{ $deleteProfile->CompanyName }}</td>
                            <td class="text-wrap" style="line-height: 24px">{{ $deleteProfile->BusinessType }}</td>
                            <td class="text-wrap" style="line-height: 24px">{{ $deleteProfile->Township }}</td>
                            <td>{{ date_format($deleteProfile->created_at, 'd/m/Y') }}</td>
                            <td>{{ date_format($deleteProfile->created_at, 'h:s:i A') }}</td>
                            <td class="text-wrap" style="line-height: 24px; font-weight:bold;">{{ $deleteProfile->admin->username}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    <div class="paginate">
        <span>{{ $deleteProfiles->withQueryString()->links('pagination::bootstrap-4') }}</span>
    </div>
@endsection
