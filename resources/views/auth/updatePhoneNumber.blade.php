@extends('order_page_layout.new_layout')
@section('title') Update Phone Number @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@section('content')

<br>
<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>
<div class="container" style="width: 90%;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Phone Number') }}</div>

                <div class="card-body">

                    @if (session('error'))
                    <div class="alert alert-danger" role="alert"> {{session('error')}} 
                    </div>
                    @endif

                    <form method="POST" action="{{ route('otp.updatePhoneNumberPOST') }}">
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
                               <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">+88</span></div>
                                <input id="mobile_no" type="number" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" placeholder="Enter Your Registered Mobile Number">
                                </div> 
                 
								
								  @error('mobile_no') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 
                            </div>
							
							
                        </div>

                        

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn" id="auth_login_btn">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
         <p class="heading lead">Update Phone Number</p>

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