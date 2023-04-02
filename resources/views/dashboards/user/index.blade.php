@extends('layout')
@section('title') BishuddhotaStore User Dashboard @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@section('content')

<style>@media (max-width: 768px){#profileimage{width:60%;}}@media (min-width: 768px){ #profileimage{width:100%;}}</style>
<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>

<div class="container">


<!--@if (session('SHOPAUTH'))
<script>
setTimeout(function(){
window.history.back();
}, 2000);
</script>
@endif-->

<!-- MAHFUZ BHAI CODE 12-1-2023 start-->

<style>


.core12
{
    display: flex;
    margin-top: 60px;
    justify-content: center;
    align-items: center;
    min-height: 20vh;
}

.core12 .card12
{
    position: relative;
    width: 250px;
    height: 80px;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 40px 80px rgba(0, 0, 0,0.15);
    transition: 0.5s;
}

.core12 .card12:hover
{
    height: auto;
    width: 450px;
}
.imgBx12
{
    position: absolute;
    left: 50%;
    top: -50px;
    transform: translateX(-50%);
    width: 150px;
    height: 150px;
    background: #fff;
    border-radius: 100px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.35);
    overflow: hidden;
    transition: 0.5s;
}

.core12 .card12:hover .imgBx12
{
    width: 50px;
    height: 50px;
}

.imgBx12 img
{
    position: relative;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1000000;
}

.core12 .card12 .content
{
    position: relative;
    top: 0px;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: flex-start;
    overflow: hidden;
}

.core12 .card12 .content .details
{
    padding: 20px;
    text-align: left -50px;
    width: 100%;
    transition: 0.5s;
    transform: translateY(185px);
}
.core12 .card12:hover .content .details
{
    transform: translateY(0px);
}

.core12 .card12 .content .details h4
{
    font-size: 1.05em;
    margin-top: 20px;
    font-weight: 600;
    color: #555;
    line-height: 1.2em;
    overflow: hidden;
    padding: 10px;
}

.core12 .card12 .content .details h4 span
{
    font-size: 0.75em;
    font-weight: 500;
    opacity: 0.5;
    overflow: hidden;
}

.core12 .card12 .content .details .actionBtn
{
    margin-top: 15px;
    display: flex;
    justify-content: center;
}

.core12 .card12 .content .details .actionBtn button
{
    padding: 10px 30px;
    left: 50px;
    border-radius: 5px;
    border: none;
    outline: none;
    font-size: 1em;
    font-weight: 500;
    background-color:#017661;
    color: #fff;
    cursor: pointer;
}

.core12 .card12 .content .details .actionBtn button:hover
{
    background-color: #555;
}

.core12 .card12 .content .details .actionBtn button:nth-child(2)
{
    border: 1px solid;
    color: #999;
    background: #fff;
}

.head
{
    display: flex;
    justify-content: center;
    align-items: center;  
    margin-top: 30px;
}

.head h2
{
  color: #017661;
}

.button
{
    display: flex;
   
    background: #fff;
    aspect-ratio: 10/1;
    max-height: 20px;
    margin: 0 auto;
}

.button .btn
{
    display: flex;
    position: relative;
    width: 200px;
    height: 50px;
    border: 2px solid #017661;
    border-radius: 50px;
    background: #fff;
    z-index: 1;
}


.button .btn .circle
{
    position: absolute;
    width: 52px;
    height: 50px;
    background: #017661;
    border-radius: 50px;
    left: 0;
    top: -2px;
    z-index: 2;
    transition: .5s cubic-bezier(1,0,.8,1);
}

.button .btn:hover .circle
{
    width: 200px;
}

.button .btn .circle .arrow
{
    position: absolute;
    width: 13px;
    height: 13px;
    border-top: 3px solid #fff;
    border-right: 3px solid #fff;
    transform: rotate(45deg);
    top: 20px;
    left: 15px;
    transition: .5s;
}

.button .btn:hover .circle .arrow
{
    left: 40px;
}


.button .btn .circle .arrow:before
{
    content: '';
    position: absolute;
    width: 18px;
    height: 2px;
    background: #fff;
    transform: rotate(-45deg);
    left: -5px;
    top: 5px;
    opacity: 0;
    transition: 0.5s;
}

.button .btn .circle .arrow:before
{
    opacity: 1;
}

.button .btn .text{
    position: absolute;
    top: 20px;
    left: 65px;
    font-size: 12px;
    line-height: 10px;
    text-transform: uppercase;
    letter-spacing: 3px;
    font-weight: 600;
    z-index: 3;
    transition: .5s;
}

.button .btn:hover .text{
    color: #fff;
}



</style>


    <div class="head">
        <h2>
Dashboard
        </h2>
    </div>

    <div class="core12">
        <div class="card12">
            <div class="imgBx12">
                <img src="{{ asset('login_core/12-1-2023/fabicon.png') }}">
            </div>
            <div class="content">
                <div class="details">      
                    <span>
   <div style="text-align: center;">
       @if(!Auth::user()->name) @else  <span style="font-weight: bold; font-size:18px;"> {{Auth::user()->name}} </span>  <br> @endif
        @if(!Auth::user()->mobile_no) @else <span class="text-muted"> {{Auth::user()->mobile_no}} </span> <br> @endif 
         @if(!Auth::user()->email) @else  <span class="text-muted"> {{Auth::user()->email}} </span><br><br> @endif 
 
@if(!Auth::user()->address1) @else 
<span style="font-weight: bold; font-size:18px;"> Address:</span> <br>{{Auth::user()->address1 }} <br>@endif 
 </div>
                    </span>
               
                    <div class="actionBtn">
                        <a id="user_home_btn" style="padding:10px;" href="{{url('profile')}}">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
   


    <div align="center" class="col-md-12">
        <a href="{{url('cart')}}" id="user_home_btn" class="btn px-3 py-3 mx-3" style="border-radius: 50px; min-width:320px;">  
          <i class="fas fa-shopping-cart" style="font-size: large;"></i>
           <span class="basket-item-count">
            <span class="badge badge-pill" id="user_home_btn_session_count">{{ count((array) session('cart')) }} </span>
             </span> 
                 <span style="font-size:20px;">Go to Cart<i class="fas fa-long-arrow-alt-right mx-1"></i></span> 
                 </a> 
    </div>


    </div> 
<!-- code end -->

<br><br>










 

<!-- @NEEDYAMIN CODE 
<div class="container">
 <div class="row">
     <div class="col-md-1">
     </div>
     
     <div class="col-md-4">
         <p align="center">
          @if(Auth::user()->image=='')
          <img src="{{ url('Img/user.png') }}" alt="User Image" class="img-fluid">

          @else
             <img src="{{asset('Uploads/profiles/'.Auth::user()->image.'')}}"  alt="{{Auth::user()->image}}"   id="profileimage" class="img-fluid">
          @endif
          </p></div>

<div class="col-md-5 py-5 my-3">
    
 
   <div class="card wow fadeIn" id="userdashboardcontent">

<div class="card-body d-sm-flex justify-content-between">

    <ul style="list-style: none;">
            <li><strong>Name:</strong> {{Auth::user()->name}}</li>
            <li><strong>Mobile Number:</strong> {{Auth::user()->mobile_no}}</li>
            <li><strong>Email:</strong> {{Auth::user()->email}}</li>
            <li><strong>Address:</strong> {{Auth::user()->address1}},{{Auth::user()->address2}},
                                                        {{Auth::user()->city}} -
                                                        {{Auth::user()->pincode}},
                                                        {{Auth::user()->state}},
                                                        {{Auth::user()->country}}</li>
              </li>

                                    

    <li style="float:left;"><strong>Alternative Mobile No: </strong>{{Auth::user()->alternativemno}} <br>
         <a href="{{url('profile')}}" class="btaobtn btaobtn-outline-dark p-2">Edit</a>
          </li>
                                          
    </ul>

     </div></div></div>

    <div align="center" class="col-md-12">
        <a href="{{url('cart')}}" id="user_home_btn" class="btn px-3 py-3 mx-3">  
          <i class="fas fa-shopping-cart" style="font-size: large;"></i>
           <span class="basket-item-count">
            <span class="badge badge-pill" id="user_home_btn_session_count">{{ count((array) session('cart')) }} </span>
             </span> 
                 <span style="font-size:20px;">Go to Cart<i class="fas fa-long-arrow-alt-right mx-1"></i></span> 
                 </a> 
    </div>
                
       </div></div><br><br>

--> 
@endsection


