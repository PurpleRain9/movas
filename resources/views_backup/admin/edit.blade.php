@extends('admin.layout')
@section('content')
<style type="text/css">
    .container
    {
         width: 70%;   
        margin: 8px 0;  
        padding: 12px 20px;   
        border-radius: 10px;
        display: inline-block;   
        border: 2px solid green;   
        box-sizing: border-box; 
        margin-left: 160px;  
    }
</style>
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
            <h2><span class="eng" id="eng">Edit Admin Information</span><span class="mm" id="mm">Edit Admin Information</span></h2>
        </div>
        <br>
        <font face="verdana" color="red" size="1" style="display:none"><b>Message Show</b></font>

        <div class="content">
            <form action="{{route ('admin.update',$admin->id) }}" method="post">
                @csrf

                 <div class="row  control">
                    <div class="col-md-3 lable">
                        <span style="font-size:20px;">Admin ID</span> :
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" style="font-size:18px;" required value="{{$admin->UserID}}" readonly>
                    </div>
                </div>

                <div class="row mt-3 control">
                    <div class="col-md-3 lable">
                        <span style="font-size:20px;">Admin Name</span> :
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" style="font-size:18px;" name="username" required value="{{$admin->username}}">
                    </div>
                </div>

               

                <div class="row mt-3 control">
                    <div class="col-md-3 lable">
                        <span style="font-size:20px;">Ranks</span> :
                    </div>
                    <div class="col-md-9">
                        <select class="form-control" style="font-size:18px;" name="rank_id" required>
                            <option value="" selected>Choose</option>
                            @foreach($ranks as $r)
                                <option value="{{ $r->id }}" {{$admin->rank_id == $r->id  ? 'selected' : ''}}>{{$r->RankName}} ( {{$r->RankNameMM}} )</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-lg" style="margin-left: 80%; font-size: 15px;">
                            <span class="eng">Save</span><span class="mm">Save</span>
                        </button>
                    </div>

                    <div class="col-md-4">
                        <!-- <button type="submit" class="btn btn-danger btn-lg" style="margin-left: 28%;">
                            <span class="eng">Back</span><span class="mm">Back</span>
                        </button> -->
                        <a href="{{ URL::previous() }}" class="btn btn-danger btn-lg" style="margin-left: 28%; font-size:15px;">Back</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
</div>
</div>
@endsection