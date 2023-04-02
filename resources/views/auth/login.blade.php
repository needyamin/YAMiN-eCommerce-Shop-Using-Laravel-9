@extends('order_page_layout.new_layout')
@section('title') Login @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@section('content')

<br>





<!-- start login code start 9-1-2023-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<script src="{{asset('login_core/registration.js')}}"> </script> 
<link rel="stylesheet" href="{{asset('login_core/registration.css')}}">

<div class="containerx">
  <input type="checkbox" id="flipx">
  <div class="coverx">
    <div class="frontx">
      
      <div class="text">
          <img src="{{asset('login_core/footer.png')}}" alt="">
      </div>
    </div>
	
    <div class="backx">
      
      <div class="text">
          <img class="backImg" src="{{asset('login_core/footer.png')}}" alt="">
      </div>
    </div>
  </div>
  <div class="formsx">
      <div class="form-contentx">
        <div class="login-formx">
          <div class="titlex">Login</div>
        

          <form method="POST" action="{{ route('login') }}">
                        @csrf
          <div class="input-boxesx">
            
           <div class="input-boxx">
              <i class="fas fa-phone"></i>
              <input id="mobile_no" type="text" class="@error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Register Phone Number" required autocomplete="mobile_no" autofocus>
            </div>


            <div class="input-boxx">
              <i class="fas fa-lock"></i>
              
              <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="current-password">

            </div>

           
          @error('mobile_no') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 
          @error('password') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 


          <input class="form-check-input" type="hidden" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

            <div class="text"><a style="color: #017661;" href="{{ route('otp.login') }}">
                                {{ __('Forgot Your Password?') }}</a></div>

            <div class="button input-boxx">
              <input type="submit" value="Login">
            </div>
            <div class="text sign-up-text">Don't have an account? <label for="flipx">
				<a href="#" onclick="location.href='{{ url('register') }}';"> Create New Account</a></label></div>


<!--<div class="form-contentx" style="margin-top: 10px;">           
 <a href="{{ route('facebook.login') }}" class="btn btn-primary btn-user btn-block">
   <i class="fab fa-facebook-f fa-fw"></i>
   Login with Facebook
</a>
</div>-->

          </div>
      </form>
    </div>


      <div class="signup-formx">
        <div class="titlex">Create New Account</div>
        <form method="POST" action="{{ route('register') }}">
        @csrf
          <div class="input-boxesx">
            <div class="input-boxx">
              <i class="fas fa-phone"></i>
              <input id="mobile_no" type="number" name="mobile_no" placeholder="Enter Phone Number" required autocomplete="mobile_no" autofocus>
            </div>

             @error('mobile_no') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 

        <div class="input-boxx">
          <i class="fas fa-envelope"></i>
          <input id="email" type="email" name="email" placeholder="example@site.com" required autocomplete="email" autofocus>
        </div>

         @error('email') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 


            <div class="input-boxx">
              <i class="fas fa-lock"></i>
              <input id="password" type="password" name="password" placeholder="Enter Password" required autocomplete="new-password">
            </div>
          @error('password') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 
          <p style="font-size:13px;color:red" id="errorONAJAX"> </p>

            <div class="button input-boxx">
              <button type="submit" class="btn" id="auth_login_btn">
                                    {{ __('Register') }}
                                </button>
            </div>
            <div class="text sign-up-textx">Already have an account? <label for="flipx">Login now</label></div>
          </div>
         </form>

         <!--<div class="form-contentx" style="margin-top: 10px;">           
 <a href="{{ route('facebook.login') }}" class="btn btn-primary btn-user btn-block">
   <i class="fab fa-facebook-f fa-fw"></i>
   Login with Facebook
</a>
</div>-->
       



   </div>
  </div>
  </div>
</div>

<!--- end code login page design 9-1-2023 --->

<br>




























<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>
<div class="container" style="display: none;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Login') }} 
                    <a class="btn-link" style="padding-left:15px;text-decoration: none;color:#212529;" href="{{ route('register') }}">
                    {{ __('Register') }} 
                                </a>


                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number') }}</label>

                            <div class="col-md-6">
                                <input id="mobile_no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" placeholder="Register Phone Number" required autocomplete="mobile_no" autofocus>

                                @error('mobile_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">

                            
                                <button type="submit" class="btn" id="auth_login_btn">
                                    {{ __('Login') }} 
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}

                                <a class="btn btn-link" style="padding-right:10px;" href="{{ route('otp.login') }}">
                                {{ __('Forgot Your Password?') }}
                                </a>
                                

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
