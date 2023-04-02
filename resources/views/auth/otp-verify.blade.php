@extends('order_page_layout.new_layout')
@section('title') Verify OTP Login @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@section('content')


@if(Auth::user()->status == '1')
<script>window.location.href = "/dashboard"; </script>
@endif

@if($timeOut == '200')
<script>window.location.href = "/otp/verification/{{ Auth::user()->id }}"; </script>
@endif

<br>
<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>
<div class="container-fluid">
<br>
    <div class="row justify-content-center">


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
                            <label for="mobile_no" class="col-md-4 col-form-label text-md-end" style="text-align: center;">{{ __('Mobile No') }}</label>

                             <style>/* Chrome, Safari, Edge, Opera */
                                input::-webkit-outer-spin-button,
                                input::-webkit-inner-spin-button {-webkit-appearance: none;margin: 0;}
                                /* Firefox */
                                input[type=number] {-moz-appearance: textfield;}
                                </style>


                            <div class="col-md-6">
                    
                               @if(Auth::user()->mobile_no == '')
                               <div class="input-group" id="formnumber">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">+88</span></div>
                                <input id="mobile_no" type="number" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" placeholder="Enter Your Registered Mobile Number">
                                </div> 
                                @else
                                <div class="input-group" id="formnumber">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">+88</span></div>
                                <input id="mobile_no" type="number" class="form-control" name="mobile_no" value="{{ auth()->user()->mobile_no }}" placeholder="Enter Your Registered Mobile Number" readonly>
                                </div> 

<!-- display email and phone number start -->
  <div class="input-group" id="display_choose">
     <div class="input-group-prepend">
       <select name="chooseOPtion" class="form-control">
        <option>{{ auth()->user()->mobile_no }}</option>
        <option>{{ auth()->user()->email }}</option>
            </select>
<!-- display email and phone number end-->

<script type="text/javascript">
  $(document).ready(function(){
    $('#display_choose').hide().delay(50000).fadeIn('slow');
    $('#formnumber').children().delay(50000).fadeOut(800); 
  });
</script>
     </div>
@endif 


                         
			@error('mobile_no') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 
                            </div>
                        </div>

    <style>
 button{
    display:table;
    margin:0 auto;
    }
</style>     
                  
                        
                        <div class="row mb-3">
                        <div class="col-md-12">
                                <div class="input-group" id="formnumber">
                                <div class="input-group-prepend" style="text-align: center;">
                                <button type="submit"  class="form-control" id="auth_login_btn">
                                    {{ __('Send OTP') }}
                                </button>
                            </div></div></div>
                          </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><br>



</div>
<br>

@if (session('status'))
      <script>
        $(document).ready(function () {
        $('#centralModalSuccess').modal('show');
        });
      </script>
    @endif
      
    @if($errors->any())
      <script>
        $(document).ready(function () {
        $('#centralModaldanger').modal('show');
       });
        </script>
      @endif
	  
<!-- Central Modal Medium Successs -->
 <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <div class="modal-content">
       <div class="modal-header" id="user_home_btn">
         <p class="heading lead">OTP Verification</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <div class="modal-body">
         <div class="text-center">
           <i class="fa fa-exclamation-triangle fa-4x mb-3 animated rotateIn"></i>
           <p>{{session('status')}} </p>
         </div>
       </div>

       <div class="modal-footer justify-content-center">
         <a type="button" id="user_update_profile" class="btn" data-dismiss="modal">Close</a>
       </div>
     </div>
   </div>
 </div>
 <!-- Central Modal Medium Success-->





@endsection