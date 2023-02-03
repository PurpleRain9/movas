@extends('admin.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border: 1px solid green;border-radius: 10px;color: green;">
                    <h1 style="margin-top: 30px; text-align: center;font-size: 20px;"><span class="eng">Change Password</span><span class="mm">စကားဝှက်ကိုပြောင်းရန်</span></h1>

                <div class="card-body">
                    <form method="POST" action="{{ route('change.adminpassword') }}">
                        @csrf

                        @if(Session::has('alert'))

                        <div class="alert alert-success form-group">

                            {{ Session::get('alert') }}

                            @php

                            Session::forget('alert');

                            @endphp
                        </div>

                        @endif
                        @foreach ($errors->all() as $error)
                        <p class="text-danger">{{ $error }}</p>
                        @endforeach

                        <div class="row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><span class="eng">Current Password</span><span class="mm">လက်ရှိစကားဝှက်</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password" style="border-radius: 5px;">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><span class="eng">New Password</span><span class="mm">စကားဝှက်အသစ်</span></label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password" style="border-radius: 5px;">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><span class="eng">New Confirm Password</span><span class="mm">အတည်ပြုစကားဝှက်အသစ်</span></label>

                            <div class="col-md-6">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password" style="border-radius: 5px;">
                            </div>
                        </div>

                        <div class="row  mt-4 mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <span class="eng">Update Password</span><span class="mm">စကားဝှက် ပြောင်းလဲမည်</span>
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