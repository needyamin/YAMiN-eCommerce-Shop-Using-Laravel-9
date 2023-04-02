@extends('order_page_layout.new_layout')
@section('title') OTP Login @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@section('content')

<br>
<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>
<div class="container">
    <div class="row justify-content-center mt-2">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('OTP Login') }}</div>

                <div class="card-body">

                    @if (session('error'))
                    <div class="alert alert-danger" role="alert"> {{session('error')}} 
                    </div>
                    @endif

                    <form method="POST" action="{{ route('otp.generate') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="mobile_no" class="col-md-4 col-form-label text-md-end">{{ __('Mobile No') }}</label>

                            <div class="col-md-6">
                                <input id="mobile_no" type="number" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" autofocus placeholder="Enter Your Registered Mobile Number">

                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" id="auth_login_btn">
                                    {{ __('SEND OTP') }}
                                </button>

                                @if (Route::has('login'))
                                    <a class="btn" id="btn_color2" href="{{ route('login') }}">
                                        {{ __('Login With Password') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection