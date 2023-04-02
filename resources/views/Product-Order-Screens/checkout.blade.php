@extends('order_page_layout.new_layout')
@section('title') Checkout @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Checkout Page @endsection
@section('content')
 

<!--<div class="px-5 py-2">
<h5 class="my-2">  <a href="/" class="black-text" style="font-size:14px;">Home</a> <strong class="black-text"> / <a href="{{url('cart')}}" class="black-text" >Cart </a> / <a href="" class="black-text" >Check out </a> </strong> </h5>   
</div>-->

<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>

<h2 align="center" id="writetitle" class="black-text mt-4" style="font-weight:bold;">Order Summary</h2>
<div align="center"><p class="col-md-2" style="border-bottom: 2px solid #003399;"></p></div>

<script>
    function Continue()
    {
      event.preventDefault();
      const CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        url:"Shipping_Payment_Screen",
        type:"get",
        data:{
          CSRF_TOKEN
        },
        success:function (data)
        {
          window.scroll({top: 0, left: 0,behavior: 'smooth'  });
          //console.log(data)
          $('#dynamic_content').html(data)
          $('#writetitle').html('Shipping & Payment Details') 
        }
      })
    }
</script>

@if (session('invalid'))
      <script>
          $(document).ready(function () {
           alertify.set('notifier','position','top-right');
           alertify.alert("Reponse","You Entered Invalid Promo Code");
          });
     </script>
@endif  

@if (session('valid'))
      <script>
          $(document).ready(function () {
           alertify.set('notifier','position','top-right');
           alertify.success("Promo Code Applied Succesfully");
          });
     </script>
@endif 

<div class="container">
<div class="row"> 
<div class="col-lg-6 card"> 

<table class="table">

    @if(session('cart'))
      <?php $total=0;$count=0;$delivery_charges=0; $i=1; ?>
      @foreach(session('cart') as $id => $details)
      <?php $count=$count +1 ;
      $total += $details['Final_Price'] * $details['item_quantity'] ?>
      @endforeach
                     
           <tr> 
            <th>SL</th>
            <th>Image </th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th style="text-align: center;">Price</th>
           </tr>
    
            
     @foreach(session('cart') as $id => $details)
  <tr>  
    <td style="text-align:center;width:50px;"> #<?php echo $i++;?> </td>
    <td style="text-align:center;"> <img src="{{asset('Uploads/Products/'.$details['item_image'].'') }}" width="40px"> </td>
    <td> {{$details['item_name']}} </td>
    <td style="text-align:center;"> {{$details['item_quantity']}} </td> 
    <td style="text-align:center;width:100px;"> {{number_format($details['Final_Price'],2)}} TK</td>
    <?php $delivery_charges = $delivery_charges; ?>
    <!--php $delivery_charges = $delivery_charges + $details['delivery_charges'] -->
   </tr>
     @endforeach
</table>


 <table class="table table-bordered no-footer"> 

  <tr>
   <td> SubTotal: <span class="text-muted">(without Delivery Charge)</span></td>  
   @if(session('promocode'))
     <td style="text-align: center;">
        <span class="cart-grand-total-price">
        <strike class="red-text" style="font-size:20px;">{{ $total }}/-</strike> </span>
        <span class="green-text" style="font-size:20px;">{{ $total -session('discount') * $total / 100 }} TK </span>
     <br>
        <span class="green-text" style="font-size:15px;">{{session('discount')}} {{session('message')}}</span>               
     </td>  
    @else 
    <td style="text-align: right; padding-right:25px;">{{number_format($total, 2)}} TK </td>
    </tr>   
    @endif

  <tr>
    <td>Delivery Charges</td>
    <td style="text-align: right;padding-right:25px;"><p id="dl_charge">0 TK</p></td>
  </tr>

  <!--<tr>
       <td><a href="" data-toggle="modal" data-target="#modalDiscount" style="color:blue;">Have a PromoCode?</a> </td>
       <td> </td>
    </tr>--> 
                                
    <tr>
      <td><p align="left" style="float:left; font-size:20px;">Total:</p></td>
      <td><h4 align="right" ><strong id="result">TK {{ $total +  $delivery_charges - session('discount') * $total / 100 }} </strong></h4></td>
        </tr>    
          @endif

  </table>

              </div>




<div class="col-lg-6">
<h2 align="center" class="black-text mt-3 d-lg-none" style="font-weight:bold;padding:5px;"> Delivery Information </h2>
<form method="POST" action="order-proceed">
        @csrf
        <!--Form Data For Shippping and Payment Details Started at  Here -->
        <div class="card p-3 animated fadeInUp" >
            <div class="row">


            <div class="col-md-12">
          <div class="form-group">
              <label><span style="color:red;">*</span> Your Name</label> 
              <input type="username" placeholder="Your Name" name="username" class="form-control" value="{{ Auth::user()->name=='' ? Auth::user()->username:Auth::user()->name }}" required>
                    </div></div>


                <div class="col-md-12">
                    <div class="form-group"> 
                    <label><span style="color:red;">*</span> Address</label>       
                    <textarea name="Door_No"  placeholder="Apartment No./Door No" value="{{Auth::user()->address1 }}" class="form-control" onclick="myFunctionXXX()" required>{{Auth::user()->address1 }}</textarea>
                    <p class="text-muted" id="MessageD" style="display: none;font-size:small;"><b>Example:</b> House# 38, Road# 1, Dhanmondi, Dhaka -1209</p>
  <script>function myFunctionXXX() {document.getElementById("MessageD").style.display = "block"; }</script>
                    </div>
                       </div>

    <input type="hidden" name="LandMark" placeholder="LandMark" value="{{Auth::user()->address2 }}" class="form-control">
                         </div>

 <div class="row">
  <div class="col-md-12">
    <div class="form-group">    

    <label><span style="color:red;">*</span> City</label> 
    <!--<input type="text" placeholder="City" name="city" value="{{Auth::user()->city}}" class="form-control">-->
      
    <select name="city" class="form-control" id="city" value="{{Auth::user()->city }}" onchange="updateText(this.value)" required>
       @php
       $del_r=App\Models\delivery_charges::latest()->get(); 
 
       @endphp

			<option>Select City Name</option>
            @foreach ($del_r as $item)
			<option value="{{$item->city}}">{{$item->city}}</option>
            @endforeach
		  </select>

      @if (session('errorCity'))<p style="color:red;">* Please choose your city name..</p>@endif
          </div>

  <input type="hidden" id="adv1" class="form-control" disabled>
  <input type="hidden" id="adv3" class="form-control" disabled>   
                </div>
                

<!--<div class="col-md-6">
    <div class="form-group">
      <label><span style="color:red;">*</span> Postal Code</label>    
    <input type="text" placeholder="Postal Code" name="pincode" value="{{Auth::user()->pincode}}" class="form-control" onclick="myFunctionPostal()" required>

   <p class="text-muted" id="MessageDPostal" style="display: none;font-size:small;">Area Zip/Post Code. <b>Example:</b> Dhaka-1200</p>
  <script>function myFunctionPostal() {document.getElementById("MessageDPostal").style.display = "block"; }</script>
 </div></div>-->


 <div class="col-md-6 d-lg-none">
      <div class="form-group" style="color:blue;"> 
        <span id="dl_charge_mobile"></span>
          </div> </div>
            
  <input type="hidden" placeholder="State" name="state" value="{{Auth::user()->state}}" class="form-control">
      
  <div class="col-md-12">
    <div class="form-group">
        <input type="hidden" placeholder="Country" name="country" value="Bangladesh"  class="form-control" disabled>
           </div>
              </div>
            
        
    <div class="col-md-12">
          <div class="form-group">
              <label><span style="color:red;">*</span> Phone Number</label> 
              @if(Auth::user()->mobile_no == '')
              <!-- if number is missing -->
              <input type="number" placeholder="Mobile No" name="mobile_no" class="form-control" value="{{Auth::user()->mobile_no}}" required>

              @else
              <!-- if number exiests -->
              <input type="number" placeholder="Mobile No" class="form-control" value="{{Auth::user()->mobile_no}}" disabled>
              @endif

              @if (session('DuplicatePhoneNumber'))<p style="color:red;">{{ session('DuplicatePhoneNumber') }}</p>@endif   
                    </div></div>

  <div class="col-md-12">
      <div class="form-group">
         <label>Alternative Number <span class="text-muted">(Optional)</span></label> 
            <input type="number" name="alternativemno" placeholder="Alternative Mobile Number"  class="form-control" value="{{Auth::user()->mnumber}}">
                    </div>
                       </div>
            
  
    
<div class="col-md-12"><strong>Payment Method: </strong></div>
            
<div class="col-md-12 mt-1">
    <div class="form-group">
     <label style="display: inline-block;width:100%">
       <div class="form-group" style="background: beige; padding:15px;">
        <input type="checkbox" class="checkboxx" name="Payment_Method" value="COD" > Cash On Delivery 
        <span style="float:right;"> <img src="{{ asset('CODSQUAR.png')}}" style="width:60px;margin-top: -13px;padding-left:10px;"></span>
         </div></label>
         </div>

    <div class="form-group" style="margin-top: -35px;">
     <label style="display: inline-block;width:100%">
       <div class="form-group" style="background: beige; padding:15px;">
        <input type="checkbox" class="checkboxx" name="Payment_Method" value="OnlinebKash"> bKash
         <span style="float:right;"> <img src="{{ asset('bkashSQUAR.png')}}" style="width:45px;margin-top: -5px;padding-left:10px;"></span>
         </div></label>
            </div>


    <!--<div class="col-12">
       <label style="display: inline-block;width:100%">
        <div class="form-group" style="background: beige; padding:10px;">
        <input type="checkbox" class="checkboxx" name="Payment_Method" value="Online"> Online <img src="{{ asset('bkash.png')}}" style="width:80px; padding-left:10px;">
          </div></label>
      </div>-->
    
 <style>input[type=checkbox]{accent-color: orange;}</style>              
 <script>$('input.checkboxx').on('change', function() {$('input.checkboxx').not(this).prop('checked', false);});</script>          
  </div></div>


         <!--Form Data For Shippping and Payment Details Ended Here -->
         <!--Form Data For Order Details,....Starts Here-->
         
           @if(session('cart'))
                <?php $total=0;$count=0;$order_details='';$delivery_charges=0;?>
            @foreach(session('cart') as $id => $details)
                 <?php $count=$count +1 ;
                $total += $details['Final_Price'] * $details['item_quantity'] ?>
                  



@php
$dhaka=App\Models\delivery_charges::where('city','=','Dhaka')->first();
$Chottogram=App\Models\delivery_charges::where('city','=','Chottogram')->first();
@endphp

<script>
    updateText();
     function updateText(val) {
      var $el = document.getElementById("adv1");

       // Dhaka Cost
      if(val == '{{ $dhaka->city }}'){
       $el.value = "Delivery Charge: {{ $dhaka->cost }} TK";
       $value1 = "{{ $total }}";
       $value2 = "{{ $dhaka->cost }}";
       $answer = parseInt($value1) + parseInt($value2);
       $("#del_CHARGE").val($value2);
       $("#adv2").val($answer);
       $('#result').html('' + parseFloat($answer).toFixed(2)+'TK');
       $('#dl_charge').html('' + parseFloat($value2).toFixed(2)+' TK');
       $('#dl_charge_mobile').html('Delivery Charge: ' + parseFloat($value2).toFixed(2) +' TK');
      } 

      // Chottogram Cost
      else if(val == '{{ $Chottogram->city }}'){
      $el.value = "Delivery Charge: {{ $Chottogram->cost }} TK";
       $value1 = "{{ $total }}";
       $value2 = "{{ $Chottogram->cost }}";
       $answer = parseInt($value1) + parseInt($value2);
       $("#del_CHARGE").val($value2);
       $("#adv2").val($answer);
       $('#result').html('' + parseFloat($answer).toFixed(2)+'TK');
       $('#dl_charge').html('' + parseFloat($value2).toFixed(2)+' TK');
       $('#dl_charge_mobile').html('Delivery Charge: ' + parseFloat($value2).toFixed(2) +' TK');
      } 

      // Other All Cost
      else {
       $el.value = "Delivery Charge: 120 TK";
       $value1 = "{{ $total }}";
       $value2 = "120";
       $answer = parseInt($value1) + parseInt($value2);
       $("#del_CHARGE").val($value2);
       $("#adv2").val($answer);
       $('#result').html('' + parseFloat($answer).toFixed(2) +' TK');
       $('#dl_charge').html('' + parseFloat($value2).toFixed(2)+' TK');
       $('#dl_charge_mobile').html('Delivery Charge: ' + parseFloat($value2).toFixed(2) +' TK');
      }
     }

     //parseFloat(yourString).toFixed(2)
    </script>


    <?php $delivery_charges = $delivery_charges + $details['delivery_charges'] ?>
     @php  
     $order_details=$order_details.'<br>'.
     ('Product Name:'.$details["item_name"].', Quantity: '.$details["item_quantity"].
     '<br> Price:'.$details["Final_Price"]);
     @endphp 
     @endforeach
                
               
     @endif  
     @if(session('promocode'))
          <input type="hidden" value="{{ $total + $delivery_charges - session('discount') * $total / 100 }}" class="form-control" name="Amount" >
     @else
            <!-- hidden amount-->
            <input type="hidden" id="del_CHARGE" name="del_CHARGE" class="form-control">
           <input type="hidden" id="adv2" name="Amount" class="form-control">
     @endif
            <textarea  hidden class="form-control">{{ isset($order_details) ? $order_details : '' }}</textarea>
            <input type="hidden" value="{{session('promocode')}}" class="form-control">


            <div class="col-12" style="text-align:left;">
                            <label class="text-muted">Delivery Time </label>
                            <ul>
                                <li> Dhaka city up to 3 Working days </li>
                                <li>
                                    Outside Dhaka up to 5 working days
                                </li>
                            </ul>
                        </div>

                        <div class="col-12" style="text-align:left;">
                            <label> <input type="checkbox"> I agree to these <a href="{{ url('Terms-and-Conditions') }}" target="_blank" rel="noopener noreferrer">Terms of Services</a>, <a href="{{ url('Shipping-and-Returns')}}" target="_blank" rel="noopener noreferrer">Return &amp; Refund Policy</a> and  <a href="{{ url('privacy-policy')}}" target="_blank" rel="noopener noreferrer"> Privacy Policy</a>  </label>
                              </div>

            <div align="center" class="col-md-12">

            <button type="submit" class="btn btn-lg" style="width:80%;" id="user_home_btn">PLACE ORDER</button>  
            
            </div>



        <!--Form Data For Order Details,....Ended Here-->
    </form>
    <!-- form code end for 2nd-->


</div>

</div>
</div><br>



      <!--Modal: modalDiscount-->
      <div class="modal fade right" id="modalDiscount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" data-backdrop="true">
        <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-danger" role="document">
          <!--Content-->
          <div class="modal-content">
            <!--Header-->
            <div class="modal-header" id="user_home_btn">
              <p class="heading">Have a Promo Code<strong></strong></p>
  
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">&times;</span>
              </button>
            </div>  
  
 <form method="POST" action="apply-promocode">
      @csrf
            <!--Body-->
            <div class="modal-body">
  
              <div class="row">
                <div class="col-12">
                  <p></p>
                  <p class="text-center">
                    <i class="fas fa-gift fa-4x" id="color_code_chackout_icon"></i>
                  </p>
                </div>
  
                <div class="col-12">
                  <input type="text" class="form-control" name="promo_code" placeholder="Enter Promo Code ">
                  
                </div>
              </div>
            </div>
  
            <!--Footer-->
            <div class="modal-footer flex-center">
              <button type="submit" class="btn" id="user_update_profile">Apply 
                <i class="far fa-gem ml-1 white-text"></i>
              </button>
              <a type="button" class="btn btn-outline-grey" data-dismiss="modal">No, thanks</a>
            </div>
  </form>
          </div>
          <!--/.Content-->
        </div>
      </div>
      <!--Modal: modalDiscount-->
      
      
      
   @if ($errors->any())<script>$(document).ready(function () {$('#centralModalfailure').modal('show');});</script>@endif
   
  <!-- Central Modal Medium Failure -->
  <div class="modal fade" id="centralModalfailure" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header" id="user_home_btn"">
        <p class="heading lead">Error</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <div class="text-center">
          <i class="fas fa-exclamation-circle fa-4x mb-3 animated rotateIn"></i>
          <h3 style="color: red"> Some Errors are Found! </h3>
         
          <ul align="left"  >
           @foreach ($errors->all() as $error)
          <li class="text-danger">{{ $error }}</li>
           @endforeach
          </ul>

        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
          <p class="close" data-dismiss="modal" aria-label="Close">
        <button class="btn" id="user_update_profile">Try Again  <i class="fa fa-refresh" aria-hidden="true"></i>
</button>
        </p>
        
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Medium Failure-->
</div>
@endsection
