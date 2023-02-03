@extends('admin.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    @if(Session::has('alert'))

    <div class="alert alert-success form-group">

        {{ Session::get('alert') }}

        @php

        Session::forget('alert');

        @endphp
    </div>

    @endif


    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{ $error }}</div>
    @endforeach

    <div id="wrapper">
        <div class="header" style="text-align: center;">
            <h1><span class="eng" id="eng">Create Admin</span><span class="mm" id="mm">Create Admin</span></h1>
        </div>
        <br>
        <font face="verdana" color="red" size="1" style="display:none"><b>Message Show</b></font>

        <div class="content">
            <form action="{{route ('admin.create') }}" method="post">
                @csrf

                <div class="row control">
                    <div class="col-md-2 lable">
                        <span>Name</span> :
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="username" required>
                    </div>
                </div>

                <div class="row mt-3 control">
                    <div class="col-md-2 lable">
                        <span>UserID</span> :
                    </div>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="UserID" required>
                    </div>
                </div>

                <div class="row mt-3 control">
                    <div class="col-md-2 lable">
                        <span>Password</span> :
                    </div>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="password" required>
                    </div>

                    
                </div>
                <div class="row mt-3 control">
                    <div class="col-md-2 lable">
                        <span>Confirm Password</span> :
                    </div>
                    <div class="col-md-10">
                        <input type="password" class="form-control" name="confirmpassword" required>
                    </div>
                </div>

                <div class="row mt-3 control">
                    <div class="col-md-2 lable">
                        <span>Ranks</span> :
                    </div>
                    <div class="col-md-10">

                        <select class="form-control" name="rank_id" required>
                            <option value="">Choose</option>
                            @foreach($ranks as $r)
                            <option value="{{$r->id}}">{{$r->RankName}} ( {{$r->RankNameMM}} )</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-lg" style="margin-left: 126px;">
                            <span class="eng">Save</span><span class="mm">Save</span>
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
</div>
</div>
@endsection