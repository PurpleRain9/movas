@extends('layout')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border: 1px solid green;border-radius: 10px;color: green;">
                    <h1 style="margin-top: 30px; text-align: center;font-size: 20px;"><span class="eng">Change Email</span><span class="mm">အီးမေး လိပ်စာပြောင်းရန်</span></h1>

                <div class="card-body">
                    <form method="POST" action="{{ route('changeEmailStore') }}">
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
                        
                        <div class="row mt-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><span class="eng">Old Email</span><span class="mm">လက်ရှိ အီးမေး</span></label>

                            <div class="col-md-6">
                                <input id="currentEmail" type="email" class="form-control" name="currentEmail" autocomplete="currentEmail" value="{{ $useremail }}" style="border-radius: 5px;" disabled>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><span class="eng">New Email</span><span class="mm">အီးမေး အသစ်</span></label>
                            <div class="col-md-6">
                                <input id="newEmail" type="email" class="form-control" name="newEmail" autocomplete="newEmail" style="border-radius: 5px;">
                            </div>
                        </div>
                        <div class="row  mt-4 mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <label for=""><span class="eng">Update Email</span><span class="mm">အီးမေး အသစ်တင်မည်</span></label>
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