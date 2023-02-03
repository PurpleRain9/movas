@extends('admin.layout')
@section('content')
    <!-- <div class="d-xl-flex justify-content-between align-items-start">
                  <h2 class="text-dark font-weight-bold mb-2"> Admin List </h2>

              </div> -->
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

    <div class="container">

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
                <p class="alert alert-danger mx-auto" style="width: 100%; margin-top:20px;">
                    {{ session('error') }}
                </p>        
             @endif
            <div class="col-md-5">
                <span class="text-dark font-weight-bold mb-2 text-center" style="font-size: 20px;">Users Deleted List</span>
            </div>

        </div>
        <div class="row my-3">
            <div class="col-md-7 ">
                <form class="navbar-form" action="{{ route('deleted.showusers') }}" method="get">
                    <div class="input-group no-border">
                        <input type="text" id="search" class="form-control"
                            placeholder="User name/Email/Company name..." style="border-radius: 3px; width: 0px;"
                            name="search">

                        <button type="submit" style="margin-left: 10px;width: 40px;" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                            <!--<div class="ripple-container"></div>-->
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-5 text-end">
                <a href="{{ route("user.index") }}" class="btn btn-secondary" style="padding: 0.65rem 0.35rem;"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
            
        </div>
        <div class="row">
            <table class="table table-sm table-responsive table-bordered" id="size">
                <thead>
                    <tr>
                        <th style="font-size:15px"class="col-md-1">No</th>
                        <th style="font-size:15px"class="col-md-2">User Name</th>
                        <th style="font-size:15px"class="col-md-1">Phone</th>
                        <th style="font-size:15px"class="col-md-1">Email</th>
                        <th style="font-size:15px">Company Name</th>
                        <th style="font-size:15px">Reject Comment</th>
                        <th style="font-size:15px">Date</th>
                        <th style="font-size:15px">Time</th>
                        <th style="font-size:15px">Admin Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $user)
                        <tr>
                            <td style="font-size:15px">{{ $users->firstItem() + $key }}</td>
                            <td style="font-size:15px">{{ $user->name }}</td>
                            <td style="font-size:15px">{{ $user->phone_no }}</td>
                            <td style="font-size:15px">{{ $user->email }}</td>
                            <td style="font-size:15px" class="text-wrap">{{ $user->CompanyName }}</td>
                            <td style="font-size:15px" class="text-wrap">
                                @if ($user->Status == 0 && !is_null($user->RejectComment))
                                    <small class="text-danger font-weight-bold">Reject comment-
                                        {{ $user->RejectComment }}</small>
                                @endif
                                @if ($user->Status == 1 && !is_null($user->RejectComment))
                                    <small class="text-danger font-weight-bold">Reject comment-
                                        {{ $user->RejectComment }}</small>
                                @endif
                            </td>
                             <td><?php echo date_format(date_create($user->created_at), 'd/m/Y'); ?></td>
                             <td><?php echo date_format(date_create($user->created_at), 'h:s:i A'); ?></td>
                            <td style="font-size: 15px;font-weight:bold;">{{ $user->admin_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </table>
        </div>
    </div>
    <br>
    <span>{{ $users->withQueryString()->links('pagination::bootstrap-4') }}</span>
@endsection
