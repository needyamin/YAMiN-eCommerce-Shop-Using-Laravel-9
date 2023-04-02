@extends('layout')
@section('title') Profile @endsection
@section('keywords') Bishuddhota, Store, Product, onlineshop,bdshop  @endsection
@section('description') Introducing world famous exclusive imported products.  @endsection
@section('content')
 
@if ($errors->any())<script>$(document).ready(function () {$('#centralModalfailure').modal('show');});</script>@endif

@if (session('passwordwontmatch'))
<script>$(document).ready(function () {alertify.set('notifier','position','top-right');alertify.alert("Warning","Password Wont Match");});</script>
@endif

@if (session('successstatus'))
  <script>$(document).ready(function () {$('#centralModalSuccess').modal('show');});</script>
@endif

<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>

<div class="container mt-4">
<div class="card p-3">
    <h4 class="py-2"><i class="fa fa-user" aria-hidden="true"></i> My Profile</h4>
               <div class="row ">
                 <div class="col-md-12">
              
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<form action="{{url('my-profile-update')}}" method="POST" enctype="multipart/form-data">
   {{ csrf_field() }}

      
<span class="p-3 text-muted">Account Created On: {{Auth::user()->created_at->format('d M, Y')}} ( {{Auth::user()->created_at->diffForHumans()}} ) </span>

           <div class="card-body">
                       <div class="row">
                           <div class="col-md-4">

   <div class="form-group">
   <label> Name</label>
   <input type="text" value="{{Auth::user()->name}}" class="form-control" name="name" placeholder="Enter Your Name"> 
   </div></div>
                           
   <div class="col-md-4">
   <div class="form-group">
       <label> Mobile Number</label>
             @if(Auth::user()->mobile_no == '')
              <input type="number" placeholder="Mobile No" name="mobile_no" class="form-control">
              @else
              <input type="number" placeholder="Mobile No" name="mobile_no" class="form-control" value="{{Auth::user()->mobile_no}}" disabled>
              @endif
              
           
    @error('mobile_no') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 

   </div>
    
  </div>

   <div class="col-md-4">
   <div class="form-group">
       <label> Email Address</label>

       @if(Auth::user()->email == '')
         <input type="email" class="form-control" name="email" placeholder="example@mail.com" required>
       @else
          <input type="email" placeholder="Email" class="form-control" name="email" value="{{Auth::user()->email}}" disabled>
       @endif
    
       @error('email') <p style="font-size:13px;color:red"> {{ $message }}</p>@enderror 

   </div></div>

   <!--
  <div class="col-md-3">
   @if(Auth::user()->image=='')
   <img src="{{ url('Img/user.png') }}"  alt="User Image"  class="rounded-circle mx-5" style="width:50%">
                   
   @else
       <img src="{{asset('Uploads/profiles/'.Auth::user()->image.'')}}"  alt="{{Auth::user()->image}}"  class="img-fluid mx-5" style="width:50%">
   @endif
   <input type="file" name="image" class="px-5"></div>
-->


  <div class="col-md-12 py-2">
   
   <div class="form-group" style="margin: 0 auto;">
         <button type="submit" id="user_update_profile" class="btn btn-md"> Update My Profile </button>
           <a  data-toggle="modal" data-target="#openpasswordmodel" class="btn btn-outline-green btn-md"> Change Password </a>
   </div>
      </div>
           </div>
               </div>
                  </div>
      
          
 <div class="p-3">       <hr>         
    <h4 class="py-3"><i class="fa fa-address-book" aria-hidden="true"></i> Delivery Address</h4>
    
           <div class="card-body">
                       <div class="row "  >
                       
  <div class="col-md-12">
  <div class="form-group">
  <label> Address 1 ( Door No: )</label>
  <textarea type="text" name="address1" class="form-control" placeholder="House Number, Road Name, Thana, District" onclick="myFunctionXXX()">{{Auth::user()->address1}}</textarea>
  <p class="text-muted" id="MessageD" style="display: none;font-size:small;"><b>Example:</b> House# 38, Road# 1, Dhanmondi, Dhaka -1209</p>
  <script>function myFunctionXXX() {document.getElementById("MessageD").style.display = "block"; }</script>
  </div>
  </div>
  
                           
</div>
       
   <div class="row">
    <div class="col-md-4">
   <div class="form-group">
    <label> City</label>

    <select name="city" class="form-control" id="city" value="{{Auth::user()->city }}" onchange="updateText(this.value)">
       @php
       $del_r=App\Models\delivery_charges::all();
       @endphp
       
       <option disable>{{Auth::user()->city }}</option>
            @foreach ($del_r as $item)
			     <option value="{{$item->city}}">{{$item->city}}</option>
            @endforeach

		  </select>

   </div></div>
  
   <div class="col-md-4">
   <div class="form-group">
    <label>District</label>
   
    <select name="state" class="form-control">
        @if (!auth()->user()->state) 
        <option selected>Your District Name</option> 
        @else <option selected>{{Auth::user()->state}}</option> @endif
   
         <option value="Chattagram">Chattagram</option>
         <option value="Rajshahi">Rajshahi</option>
         <option value="Khulna">Khulna</option>
         <option value="Barisal">Barisal</option>
         <option value="Sylhet">Sylhet</option>
         <option value="Dhaka">Dhaka</option>
         <option value="Rangpur">Rangpur</option>
         <option value="Mymensingh">Mymensingh</option>
         </select>
      
   
   </div></div>
                           
   <div class="col-md-4">
   <div class="form-group">
    <label>Postcode</label>
   <input type="text" value="{{Auth::user()->pincode}}" placeholder="Enter Postcode" name="pincode" class="form-control">
   </div>                 
  </div>
                           
<div class="col-md-4">
<div class="form-group">
 <label>Country</label>
<input type="text" placeholder="Country" name="country" value="Bangladesh" class="form-control" disabled>
</div>          
</div>
                           
<div class="col-md-4">
   <div class="form-group">
    <label>Mobile No</label>
   <input type="text" value="{{Auth::user()->mnumber}}" name="mno" placeholder="Mobile Number" class="form-control">
   </div></div>

                           
   <div class="col-md-4">
   <div class="form-group">
    <label>Alternative Mobile No</label>
   <input type="text" value="{{Auth::user()->alternativemno}}" name="alternativemno" placeholder="Another Number" class="form-control">
   </div></div>

   <div class="col-md-12">
   <div class="form-group">
          <button type="submit" class="btn btn-lg w-100" id="btn_color1"> Update Delivery Address </button>
</div>      
   </div>        
       </div>
           </div>
               </div>
                  </form>
                       </div>
                           </div>
                                </div>
                                    <br>









  <!-- Central Modal Medium Failure -->
  <div class="modal fade" id="centralModalfailure" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header" style="color:black;background:#017661;">
        <p class="heading lead">Error</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <div class="text-center">
          <i class="fas fa-exclamation-circle fa-4x mb-3 animated rotateIn"></i>
          <h3 style="color: red"> Profile Not Updated </h3>
         <ul align="left"  >
                @if($errors->any())
                   @foreach ($errors->all() as $error)
                        
 <li  class="text-danger">{{ $error }}</li>
                    @endforeach
                @endif
            </ul>
            {{session('passwordwontmatch')}}
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <p   class="close" data-dismiss="modal" aria-label="Close"  >
        <button  class="btn" style="color:white;background:#017661;">Try Again<i class="far fa-gem ml-1 text-white"></i></button>
        </p>
        
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Medium Failure-->

 <!-- Central Modal Medium Success -->
 <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header" id="user_home_btn">
         <p class="heading lead"> Success</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
           <p>{{session('successstatus')}} </p>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         
         <a type="button" class="btn btn-outline-grey waves-effect" data-dismiss="modal">Close</a>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Success-->
 
 
 <!--  Password Model Starts Here -->
 <form method="POST" action="update-password">
     @csrf
 <div class="modal fade" id="openpasswordmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-primary" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header" id="user_home_btn">
         <p class="heading lead">Update Your Password</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-key fa-4x mb-3 animated rotateIn"></i>
           <input type="password" class="form-control" name="newpass" placeholder="Enter New Password"><br>
            <input type="password" class="form-control" name="confirm_new_Pass" placeholder="Re-Enter Password">
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         
         <button type="submit" class="btn waves-effect" id="user_update_profile">Update</button>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Password Model Closed Here-->
 </form>
@endsection
