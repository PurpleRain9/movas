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
                <span class="text-dark font-weight-bold mb-2 text-center" style="font-size: 20px;"> Profile List </span>
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
            @if (!$admin->rank_id == 0)
                <div class="col-md-5 text-end">
                    <a href="{{ route("deleted.showprofiles") }}" class="btn btn-secondary" style="padding: 0.65rem 0.35rem;">Show Deleted Profiles <i class="fa fa-eye text-danger"></i></a>
                </div>
            @endif
        </div>
        <div class="">
            <table class="table table-bordered">
                <thead>
                    <th>No.</th>
                    <th>Company Name</th>
                    <th>Business Type</th>
                    <th>Township</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($profiles as $key => $profile)
                        <tr>
                            <td>{{ $key +1 }}</td>
                            <td class="text-wrap" style="line-height: 24px">{{ $profile->CompanyName }}</td>
                            <td class="text-wrap" style="line-height: 24px">{{ $profile->BusinessType }}</td>
                            <td class="text-wrap" style="line-height: 24px">{{ $profile->Township }}</td>
                            <td>
                                <a onclick="return confirm('You sure to delete profile?');" href="deleteProfile/{{ $profile->id }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    <div class="paginate">
        
        <span>{{ $profiles->withQueryString()->links('pagination::bootstrap-4') }}</span>
    </div>
@endsection
