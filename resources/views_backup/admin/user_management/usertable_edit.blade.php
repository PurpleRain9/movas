@extends('admin.layout')
@section('content')
<style type="text/css">
    .container
    {
        width: 70%;   
        margin: 8px 0;  
        padding: 12px 20px;   
        border-radius: 5px;
        display: inline-block;   
        border: 1px solid green;   
        box-sizing: border-box; 
        margin-left: 160px;  
    }
    
    .label
    {
        font-family: arial;
        font-size: 15px;
        font-weight: normal;
    }
    
    .formInput{
        font-family: arial;
        font-size: 15px;
        font-weight: normal;
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
            <p class="label mt-3">Edit User Information</p>
        </div>
        <br>
        <font face="verdana" color="red" size="1" style="display:none"><b>Message Show</b></font>

        <div class="content">
            <form  action="{{route('user.update',$user->id)}}" method="post" >
						@csrf
                 <div class="row control mt-3">
                    <div class="col-md-3 lable">
                        <span class="label">User Name</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control formInput" name="name" value="{{$user->name}}">
                    </div>
                </div>

                <div class="row control mt-3">
                    <div class="col-md-3 lable">
                        <span class="label">Email</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control formInput" name="email"  value="{{$user->email}}">
                    </div>
                </div>

                <div class="row control mt-3">
                    <div class="col-md-3 lable">
                        <span class="label">Phone Number</span>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control formInput" name="phone_no" value="{{$user->phone_no}}">
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
                        <a href="{{ route('user.index') }}" class="btn btn-danger btn-lg" style="margin-left: 28%; font-size:15px;">Back</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    </div>
</div>
</div>
@endsection