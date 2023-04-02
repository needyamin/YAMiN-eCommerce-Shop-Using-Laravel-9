@extends('order_page_layout.new_layout')
@section('title') OTP Verification @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@section('content')

<br>
<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Using OTP') }}</div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert"> {{session('success')}} 
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger" role="alert"> {{session('error')}} 
                    </div>
                    @endif

                    <form method="POST" action="{{ route('otp.getlogin') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user_id}}" />
                        <div class="row mb-3">
                            <label for="mobile_no" style="text-align: right;" class="col-md-4 col-form-label text-md-end">{{ __('OTP Code') }}</label>

                            <div class="col-md-6">
                                <input id="otp" type="text" class="form-control @error('otp') is-invalid @enderror" name="otp" value="{{ old('otp') }}" required autocomplete="otp" autofocus placeholder="Enter OTP">

                                @error('otp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" style="background: #017661;color:white;">
                                    {{ __('Verify') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

    
               
@php
$verificationCode = App\Models\VerificationCode::where('user_id','=', $user_id)->latest()->first();
$now = \Carbon\Carbon::now();
@endphp
 
<div id="formnumberxx card" style="color: red; padding:10px;"> 
 <span>
    @if (!$now->isAfter($verificationCode->expire_at))
 * We sent a OTP code to you. Please wait {{ \Carbon\Carbon::parse($verificationCode->expire_at)->diffForHumans() }} for re-generate another OTP request. 
@else 
<p> Your OTP has Expired <a href="{{ url('otp/verify') }}" id="display_choose" style="color: blue;">{{ __('Resend OTP') }}</a> </p>
@endif </span>
    </div>

<div  id="display_choose" style="color: red; padding:10px;">* Please <a href="{{ url('Contact') }}">contact us </a> for technical support if you don't get any OTP code.. </a></div>



<script>
    $(document).ready(
 function() {
 setInterval(function() {
  $('#formnumberxx').text('Test' + {{ \Carbon\Carbon::parse($verificationCode->expire_at)->diffForHumans() }});
 }, 2000);  //Delay here = 2 seconds 
});.
</script>
  
 
 <script type="text/javascript">
  $(document).ready(function(){
    $('#display_choose').hide().delay(10000).fadeIn('slow');
    $('#formnumberxx').children().delay(50000).fadeOut(800); 
    
  });
</script>

            </div>
        </div>
    </div>
</div>
<br>
@endsection