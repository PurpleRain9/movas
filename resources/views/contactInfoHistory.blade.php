@extends('layout')
@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border: 1px solid green;border-radius: 10px;color: green;">
                    <h1 style="margin-top: 30px; text-align: center;font-size: 20px;"><span class="eng">Change Contact Info<span class="mm">အသုံးပြုသူအချက်အလက်ပြောင်းရန်</span></h1>

                <div class="card-body">
                    <form method="POST" action="{{ route('contactInfoHistory.store') }}">
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
                            <label for="name" class="col-md-4 col-form-label text-md-right"><span class="eng"> New Name</span><span class="mm">အမည်အသစ်</span></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" autocomplete="name" style="border-radius: 5px;" value="{{ auth()->user()->name }}">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-right"><span class="eng">New Phone Number</span><span class="mm">ဖုန်းနံပါတ်အသစ်</span></label>

                            <div class="col-md-6">
                                <input id="phone_no" type="text" class="form-control" name="phone_no" autocomplete="phone_no" style="border-radius: 5px;" value="{{ auth()->user()->phone_no }}">
                            </div>
                        </div>

                        <div class="row  mt-4 mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <span class="eng">Update User Info</span><span class="mm">အချက်အလက် ပြောင်းလဲမည်</span>
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