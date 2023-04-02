@extends('layout')
@section('title'){{$Product->name}}@endsection
@section('keywords'){{$Product->keywords}}@endsection
@section('description'){{$Product->meta_description}}@endsection
@section('image'){{asset('assets/img/bishuddhota_logo.svg')}}@endsection
@section('og_image'){{asset('Uploads/Products/'.$Product->image2)}}@endsection
@section('content')




 
<style>
#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}
.item{padding: 5px;}
</style>

<link href='//cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css' rel='stylesheet' type='text/css'/>
<script src='//cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js'></script>
<link rel="stylesheet" href="{{asset('assets/css/product_page.css')}}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<style>strong,b{font-weight: bold;}</style>

<div id="YAMiNPRODUCT"> </div>

<script>
$("#categorybishuddhota").hide().fadeIn(8000); 
$("#productdescriptionboxbishuddhotax").hide().fadeIn(8000); 
</script>

<div align="left" class="container px-5 py-2" style="margin-top:5px; max-width:1900px;" id="categorybishuddhota">
<p class="my-2" style="font-weight:bold;"><a href="{{url('/')}}" class="black-text">Home /</a> <span> 
<a href="../category/{{$Product->category->slug ?? '/'}}">{{$Product->category->name ?? 'Uncategorized'}}</a></span> /
@if (!$Product->subcategory_id)
@else
@php 
$fetch=App\Models\subcategory::where('id','=',$Product->subcategory_id)->first();
@endphp
<a href="{{ url('category/sub/')}}/{{ $fetch->slug }}">{{ $fetch['name'] }}</a>/
@endif


@if (session('status_request4'))<div class="alert alert-danger" role="alert">{{ session('status_request4') }}</div>
@endif

@if (session('status'))<div class="alert alert-success" role="alert">{{ session('status') }}</div>@endif

@if (session('updatePrice'))<div class="alert alert-success" role="alert">{{ session('updatePrice') }}</div>@endif

<span class="text-muted my-3">{{$Product->name}}</span> </p>
</div>

<!--<div class="pd-wrap">-->
<div class="">
	<div class="container" id="productdescriptionboxbishuddhotax">
	   <div class="row">	
    
		<!-- big image !-->
          <div class="col-md-6">
		  @csrf
		  <div id="slider" class="owl-carousel product-slider" style="pointer-events: auto; z-index:300; ">
              @if($Product->image2 == '' && $Product->image3 == '' && $Product->image4 == '')
                   @else
				 
			<a href="{{asset('Uploads/Products/'.$Product->image2)}}" data-fancybox="gallery" data-caption="{{ $Product->image2 }}">
			<div class="item"><img src="{{asset('Uploads/Products/'.$Product->image2)}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';" style="max-height:1024px;max-width:1024px;"></div>
			 </a>
				   
              @endif
             
				   
          <!--@if($Product->image2 == '')
                  @else
                  <div class="item"><img src="{{asset('Uploads/Products/'.$Product->image2)}}"></div>
                  @endif-->
                  
                  
        @if($Product->image3 == '')
               @else
<a href="{{asset('Uploads/Products/'.$Product->image3)}}" data-fancybox="gallery" data-caption="{{ $Product->image3 }}">	  
<div class="item"><img src="{{asset('Uploads/Products/'.$Product->image3)}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';" style="max-height:1024px;max-width:1024px;"></div>
</a>
        @endif
                        
        @if($Product->image4 == '')
        @else

<a href="{{asset('Uploads/Products/'.$Product->image4)}}" data-fancybox="gallery" data-caption="{{ $Product->image4 }}"><div class="item"><img src="{{asset('Uploads/Products/'.$Product->image4)}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';" style="max-height:1024px;max-width:1024px;"></div></a>
        @endif

        @if($Product->image5 == '')
        @else

     <a href="{{asset('Uploads/Products/'.$Product->image5)}}" data-fancybox="gallery" data-caption="{{ $Product->image5 }}">		  
     <div class="item"><img src="{{asset('Uploads/Products/'.$Product->image5)}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';" style="max-height:1024px;max-width:1024px;"></div>
     </a>
        @endif

        @if($Product->image6 == '')
        @else
	
	<a href="{{asset('Uploads/Products/'.$Product->image6)}}" data-fancybox="gallery" data-caption="{{ $Product->image6 }}">		  
    <div class="item"><img src="{{asset('Uploads/Products/'.$Product->image6)}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';" style="max-height:1024px;max-width:1024px;"></div>
	</a>			  
        @endif

	</div> 
				

<script>
$('[data-fancybox="gallery"]').fancybox({
buttons: [
    "slideShow",
    "thumbs",
    "zoom",
    "fullScreen",
    "share",
    "close"
  ],
  loop: false,
  protect: true
});
</script>


<br>
    
       <!-- Thumb Image !-->  
		<div id="thumb" class="owl-carousel product-thumb">
        
          @if($Product->image2 == '' && $Product->image3 == '' && $Product->image4 == '')
                  @else
        <div class="item"><img  src="{{asset('Uploads/Products/'.$Product->image2)}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"></div>
                   @endif
                 
          <!--@if($Product->image2 == '')
                  @else
        <div class="item"><img  src="{{asset('Uploads/Products/'.$Product->image2)}}"></div>
                  @endif-->
                  
                  
          @if($Product->image3 == '')
                  @else
        <div class="item"><img  src="{{asset('Uploads/Products/'.$Product->image3)}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"></div>
                  @endif
                   
                    
          @if($Product->image4 == '')
                  @else
         <div class="item"><img  src="{{asset('Uploads/Products/'.$Product->image4)}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"></div>
                  @endif


          @if($Product->image5 == '')
                  @else
          <div class="item"><img  src="{{asset('Uploads/Products/'.$Product->image5)}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"></div>
                  @endif


          @if($Product->image6 == '')
                  @else
           <div class="item"><img  src="{{asset('Uploads/Products/'.$Product->image6)}}" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"></div>
                  @endif
			</div></div>



	        	<div class="col-md-6">
	        		<div class="product-dtl">
        				<div class="product-info">
		        			<div class="product-name mt-2">{{ $Product->name }}

<!-- this is for super admin role 14-1-2023 start-->							
	  @auth
      @if (\Auth::user()->role == 'admin')
      <span class="text-muted">( <a href="{{url('admin/product-edit/')}}/{{$Product->id}}" style="font-family:Cairo; font-weight:600;font-size: 16px; color:#017661;" target="_blank"><i class="fa-solid fa-user-pen"></i> Edit Post</a> )</span>
      @endif
	  @endauth
<!-- this is for super admin role 14-1-2023 end-->	
  
							</div>
		           	         
							 <div class="reviews-counter">
		
								@if($Product->rating==1)
								<div class="rate">
								    <input type="radio" id="star5" name="rate" value="5"/>
								    <label for="star5" title="text">5 stars</label>
								    <input type="radio" id="star4" name="rate" value="4"  />
								    <label for="star4" title="text">4 stars</label>
								    <input type="radio" id="star3" name="rate" value="3"  />
								    <label for="star3" title="text">3 stars</label>
								    <input type="radio" id="star2" name="rate" value="2" />
								    <label for="star2" title="text">2 stars</label>
								    <input type="radio" id="star1" name="rate" value="1" checked/>
								    <label for="star1" title="text">1 star</label>
								  </div>
								<span>1 Stars</span>
                          
                          @elseif($Product->rating==2)
                          <div class="rate">
								    <input type="radio" id="star5" name="rate" value="5"/>
								    <label for="star5" title="text">5 stars</label>
								    <input type="radio" id="star4" name="rate" value="4"/>
								    <label for="star4" title="text">4 stars</label>
								    <input type="radio" id="star3" name="rate" value="3"/>
								    <label for="star3" title="text">3 stars</label>
								    <input type="radio" id="star2" name="rate" value="2" checked/>
								    <label for="star2" title="text">2 stars</label>
								    <input type="radio" id="star1" name="rate" value="1"/>
								    <label for="star1" title="text">1 star</label>
								  </div>
								<span>2 Stars</span>
                            
                            @elseif($Product->rating==3)
							<div class="rate">
								    <input type="radio" id="star5" name="rate" value="5"/>
								    <label for="star5" title="text">5 stars</label>
								    <input type="radio" id="star4" name="rate" value="4" />
								    <label for="star4" title="text">4 stars</label>
								    <input type="radio" id="star3" name="rate" value="3" checked />
								    <label for="star3" title="text">3 stars</label>
								    <input type="radio" id="star2" name="rate" value="2" />
								    <label for="star2" title="text">2 stars</label>
								    <input type="radio" id="star1" name="rate" value="1" />
								    <label for="star1" title="text">1 star</label>
								  </div>
								<span>3 Stars</span>
                          
                            @elseif($Product->rating==4)
							<div class="rate">
								    <input type="radio" id="star5" name="rate" value="5" />
								    <label for="star5" title="text">5 stars</label>
								    <input type="radio" id="star4" name="rate" value="4" checked />
								    <label for="star4" title="text">4 stars</label>
								    <input type="radio" id="star3" name="rate" value="3"  />
								    <label for="star3" title="text">3 stars</label>
								    <input type="radio" id="star2" name="rate" value="2" />
								    <label for="star2" title="text">2 stars</label>
								    <input type="radio" id="star1" name="rate" value="1" />
								    <label for="star1" title="text">1 star</label>
								  </div>
								<span>4 Stars</span>
                            @else
							<div class="rate">
								    <input type="radio" id="star5" name="rate" value="5" checked />
								    <label for="star5" title="text">5 stars</label>
								    <input type="radio" id="star4" name="rate" value="4"  />
								    <label for="star4" title="text">4 stars</label>
								    <input type="radio" id="star3" name="rate" value="3"  />
								    <label for="star3" title="text">3 stars</label>
								    <input type="radio" id="star2" name="rate" value="2" />
								    <label for="star2" title="text">2 stars</label>
								    <input type="radio" id="star1" name="rate" value="1" />
								    <label for="star1" title="text">1 star</label>
								  </div>
								<span>5 Stars</span>
                            @endif
							</div>

		

	<div class="product-price-discount"><span>
	<!-- my logic @needyamin-->
         @if($Product->discount > 0)
		 TK {{ number_format($Product['price'] - $Product['price'] * $Product['discount'] / 100 , 2)}} 
            @else
          {{$Product['contentforofferprice']}}
          @endif
     <!-- needyamin -->
			
		</span>
		@if(!$Product->discount) {{ number_format($Product->price, 2 )}} TK  
		@else  
		<span class="line-through"><span class="red-text"> {{ number_format($Product->price, 2 )}} TK</span></span>
		@endif


<!-- this is for super admin role 21-03-2023 start-->							
     @auth
      @if (\Auth::user()->role == 'admin' or \Auth::user()->role == 'marketing')
     <span id="myBtn"><i class="fa-solid fa-pencil"></i></span>

<style>
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 999999999999999999999999999999999999999999999999999999999999999999999999999999500; 
  padding-top: 100px; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%; 
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close" onclick="document.getElementById('myModal').style.display='none'">&times;</span>
<div style="text-align: center;">

<form action="{{ url('shop/frontEnd/updatePrice') }}" method="POST">
@csrf
  <label for="price">Price</label><br>
  <input type="hidden" id="id" name="id" value="{{ $Product->id }}">
  <input type="number" id="price" name="price" value="{{ $Product->price }}"><br>
  <label for="quantity">Quantity</label><br>
  <input type="number" name="quantity" value="{{ $Product->quantity }}"><br><br>
  <input type="submit" value="Update">
</form> 
</div>

</div>

</div>

<script>
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
var modal = document.getElementById("myModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {modal.style.display = "block";}
span.onclick = function() {modal.style.display = "none";}
window.onclick = function(event) {if (event.target == modal) {modal.style.display = "none";}}
</script>
@endif
@endauth
<!-- this is for super admin role 14-1-2023 end-->	

</div>

</div>


 @if($Product->quantity == 0)

<!-- EXTRA START -->	   
<p style="margin-top: -10px;" class="mt-2"><span style="font-weight:bold;"> SKU :</span> {{$Product->sku}}</p>
  <p style="margin-top: -10px;"><span style="font-weight:bold;">Category :</span> <a href="../category/{{$Product->category->slug ?? '/'}}">{{$Product->category->name ?? 'Uncategorized'}}</a> </p>
  <p style="margin-top: -10px;"><span style="font-weight:bold;"> Item Code :</span> A-{{$Product->id}}</p>
  <p style="margin-top: -10px;">{{$Product->description}}  <a href="#description-tab">more info..</a></p>
<!-- EXTRA END -->	

 <button type="button" class="btn btn-danger btn-lg" disabled>Stock Out</button>
 <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#reqforstock">Request For stock</button>
   
<!--Modal REQ FOR STOCK: START-->
<div class="modal fade" id="reqforstock" tabindex="-1" role="dialog" aria-labelledby="reqforstockLabel"
  aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Header-->
      <div class="modal-header darken-3 white-text" id="base_color_background">
        <h4 class="title"><i class="fas fa-users"></i> Request For Stock</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>

      <!--Body-->
      <div class="modal-body mb-0 text-center">
      Request for: <br><span class='text-muted'>{{$Product->name}}</span><br>
            <form method="POST" action="{{ url('request4stock') }}">
                @csrf    
				<input type="hidden" name="name" value="@auth{{ Auth::user()->username }}@endauth" required>
                <input type="hidden" name="mobile_nox" value="@auth{{ Auth::user()->mobile_no }}@endauth">
				<input type="hidden" name="email" value="@auth{{ Auth::user()->email }}@endauth">
                
      @unless (Auth::check())
        <input type="text" min="4" max="20" class="form-control"  name="name" placeholder="Your Name" value="@auth{{ Auth::user()->username }}@endauth" required><br>
        
		<input type="email"  class="form-control"  name="email" value="@auth{{ Auth::user()->email }}@endauth" placeholder="Your Email Address" required><br>

      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">+88</div>
        </div>
        <input type="number" class="form-control" name="mobile_nox" placeholder="Phone Number" required>
      </div>
       @endunless

                <textarea name="message" class="form-control" placeholder="How Many Quantity You Want?"></textarea> <br>
                <input type="hidden" name="product_id" value="{{$Product->id}}">
                <input type="hidden" name="quantity" class="form-control" value="1">     
                <button class="btn text-white" id="base_color_background">Submit</button>

                @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
       </form>
      </div>

    </div>
   

  </div>
</div>
<!--Modal REQ FOR STOCK: END-->  

 @else

@if($Product->price == 0)
<p style="color:red;"> Price Will Be Updated Soon </p>
<style> #availability,#quantity{display:none} </style>
 @endif

<!-- ################################## -->	   
<p style="font-weight:bold;" id="availability">Availability :<span id="resultQTBTN"></span> </p>

 <p style="margin-top: -10px;"><span style="font-weight:bold;"> SKU :</span> {{$Product->sku}}</p>
  <p style="margin-top: -10px;"><span style="font-weight:bold;">Category :</span> <a href="../category/{{$Product->category->slug ?? '/'}}">{{$Product->category->name ?? 'Uncategorized'}}</a> </p>
  <p style="margin-top: -10px;"><span style="font-weight:bold;"> Item Code :</span> A-{{$Product->id}}</p>
  <p style="margin-top: -10px;" id="quantity"><span style="font-weight:bold;">Quantity Left:</span> <span class="text-danger" id="resultQT"> </span></p>
  <p style="margin-top: -10px;">{{$Product->description}}  <a href="#description-tab">more info..</a></p>
  
 
  @if($Product->price > 0)
  <span class="product_data product-count">
	@csrf  
	<input type="hidden" name="product_id" min="0" value="{{$Product->id}}" required class="form-control product_id">
	
	<span style="display: inline-block;background-color: #ececec;width:100%; padding:5%;"> 
	<label for="size" style="padding-left: 5px;margin-left:1em;font-weight:bold;">Quantity</label>
	<input type="number" class="form-control quantity" id="getQT" name="quantity" min="1" value="1" max="{{$Product->quantity}}" class="qty" style="width:20%;0 auto;border: none;background-color: #ffffff;font-size: 16px;width: 119px;padding: 7px 33px 6px 10px;color: #000000;text-align: center;border-radius: 9999px;height: 43px;" oninput="myFunctionresultQT()">  


<script>
document.getElementById("resultQT").innerHTML = "{{$Product->quantity}} items. Hurry up!";
document.getElementById("resultQTBTN").innerHTML = "<button type='button' class='btn btn-success btn-sm' style='padding: .1rem 0.6rem;font-size: .64rem;'>In Stock </button>";

function myFunctionresultQT() {
  let text = document.getElementById("getQT").value;
  let maxNum = parseInt({{$Product->quantity}});
  let result = maxNum - text + " items. Hurry up!";

  if(text >= maxNum){
	document.getElementById("resultQT").innerHTML = "Stock Out";
	document.getElementById("resultQTBTN").innerHTML = "<button type='button' class='btn btn-danger btn-sm' style='padding: .1rem 0.6rem;font-size: .64rem;'>Stock Out</button>";
  } else{

  document.getElementById("resultQT").innerHTML = result;
  document.getElementById("resultQTBTN").innerHTML = "<button type='button' class='btn btn-success btn-sm' style='padding: .1rem 0.6rem;font-size: .64rem;'>In Stock </button>";
  }
  
  //setTimeout(function(){window.location.reload();}, 3000);
}
</script>

    
		<!-- Button+Message start-->				
		<button class="addToCart_Product add-to-cart-btn">Add to Cart </button>
		<button class="addToCart_Product book-now-btn">Order Now</button>

        <p><div id="showloading"></div></p>
        <p><div align="left" class="alert alert-danger" id="msg_diverr2" style="display: none;"><span id="triggererrors"></span> In our stock available only {{$Product->quantity}} items. </p>
    
		</div></span>

<!-- Button+Message start-->	
<!-- ################################## -->


@unless (Auth::check())
<button class="btn btn-primary" style="width: 100%;margin-top:10px;" data-toggle="modal" data-target="#oneclickOrder"><i class="fa-solid fa-bag-shopping"></i> One Click Order </button>

   <!--Modal ONE CLICK ORDER: START-->
   <div class="modal fade" id="oneclickOrder" tabindex="-1" role="dialog" aria-labelledby="oneclickOrderLabel"
	 aria-hidden="true">
	 <div class="modal-dialog cascading-modal" role="document">
   
	   <div class="modal-content">
   
		 <div class="modal-header darken-3 white-text" id="base_color_background">
		   <h4 class="title"><i class="fa-solid fa-bag-shopping"></i> One Click Order</h4>
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
			   aria-hidden="true">&times;</span></button>
		 </div>
   
		 <div class="modal-body mb-0 text-center">
			   <form method="POST" action="{{ url('oneclickOrder') }}">
				   @csrf

	<div class="col-auto">
      <div class="input-group mb-2">
        <div class="input-group-prepend">
          <div class="input-group-text">+88</div>
        </div>
        <input type="number" class="form-control" name="mobile_no" placeholder="Phone Number" required>
      </div>
    </div>

	<div class="col-auto">
      <div class="input-group mb-2">
	  <input type="text" min="4" max="20" class="form-control"  name="name" placeholder="Your Name" required>
      </div>
    </div>

	<div class="col-auto">
      <div class="input-group mb-2">
	  <textarea name="delivery_address" class="form-control" placeholder="Delivery Address"></textarea>
      </div>
    </div>

	<input type="hidden" name="product_id" value="{{$Product->id}}">
	<input type="hidden" name="quantity" class="form-control" value="1">     
	<button class="btn text-white" id="base_color_background">Place Order</button>
  
		  </form>
		 </div>
   
	   </div>
	  
   
	 </div>
   </div>

   @endif  
<!--Modal ONE CLICK ORDER: END-->  

<!--
<a href="{{ route('facebook.login') }}" class="btn btn-primary" style="width: 100%;" rel="nofollow">
   <i class="fab fa-facebook-f fa-fw"></i>
   Login with Facebook
</a>
 -->

@endunless
@if (session('status'))<div class="alert alert-success" role="alert">{{ session('status') }}</div> @endif

@if (session('status'))
<script>$(document).ready(function () {$('#centralModalSuccessOneCLick').modal('show');});</script>@endif

   <!--Modal ONE CLICK ORDER: START-->
   <div class="modal fade" id="centralModalSuccessOneCLick" tabindex="-1" role="dialog" aria-labelledby="centralModalSuccessOneCLickLabel"
	 aria-hidden="true">
	 <div class="modal-dialog cascading-modal" role="document">
	   <div class="modal-content">
   
		 <div class="modal-header darken-3 white-text" id="base_color_background">
		   <h4 class="title"><i class="fa-solid fa-thumbs-up"></i> Success</h4>
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
			   aria-hidden="true">&times;</span></button>
		 </div>
   
		 <div class="modal-body mb-0 text-center">
			<h2> <div class="alert alert-success" role="alert">We received your request. Our Agent will contact you soon..</div> </h2>
		 </div>
   
	   </div>
	  
   
	 </div>
   </div>
<!--Modal ONE CLICK ORDER: END-->  


<style>
.iconShare{margin-right: 1em; margin-top: 0.5em;color:#017661}
.iconShare:hover{color: #4285f4 !important;}
.shareMAX{width:100%; margin:0 auto;}
.sharei{width:100%; margin:0 auto ;}
</style>

<div style="text-align: center;">

  <a href="https://wa.me/?text={{ url('/shop').'/'.$Product->url}}" class="sharei" rel="nofollow" target="_blank"><i class="iconShare fab fa-3x fa-whatsapp"></i></a>

  <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('/shop').'/'.$Product->url}}" class="sharei" rel="nofollow" target="_blank"><i class="iconShare fab fa-3x fa-facebook-square"></i></a>

  <a href="https://twitter.com/intent/tweet?text={{ $Product->name}}&url={{ url('/shop').'/'.$Product->url}}" class="sharei" rel="nofollow" target="_blank"><i class="iconShare fab fa-3x fa-twitter-square"></i></a>

  <a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url={{ url('/shop').'/'.$Product->url}}&title={{ $Product->name}}&summary={{ $Product->meta_description}}" class="sharei" rel="nofollow" target="_blank"> <i class="iconShare fab fa-3x fa-linkedin"></i>
</a>

</div> 


   
<input class="sharei" style="margin-top: 0.5em;width:80%" rel="nofollow" type="text" value="{{ url('/shop').'/'.$Product->url}}" id="myInput">
<button onclick="CopyLink()" style="background:#017661; color:white; border:3px solid #017661" rel="nofollow">Copy Link</button>


<script>
function CopyLink() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices
  navigator.clipboard.writeText(copyText.value);
  //alert("Copied the text: " + copyText.value);
  alertify.set('notifier','position','top-center');
  alertify.success('Link Copied successfully');
}
</script>


</div>


@endif

 </div>

	        			</div>
	        		</div>
	        	</div>
	        </div>





			<div class="container">
	        <div class="product-info-tabs">
		      
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				  	<li class="nav-item">
				    	<a class="nav-link active" id="description-tab" data-toggle="tab" role="tab" aria-controls="description" href="#description" aria-selected="true">Description</a>
				  	</li>

 	                 <li class="nav-item">
				    	<a class="nav-link" id="additional_info" data-toggle="tab" href="#additional_infos" role="tab" aria-controls="additional_info" aria-selected="false">Additional information</a>
				  	</li>


				  	<!--<li class="nav-item">
				    	<a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews (0)</a>
				  	</li>-->

				</ul>

		
					<div class="tab-content" id="myTabContent">
				  	<div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
				
					  <p style="color: black; margin-top:-35px;">{!! $Product->additional_info !!}</p>
				  	</div>

					  <div class="tab-pane fade" id="additional_infos" role="tabpanel" aria-labelledby="additional_info">
				  	
				  		
						<table class="table table-bordered" style="color:#7a7a7a;margin-top:-15px;">
							<tr> 
								<th style="font-weight:bold;padding-left:15px;" width="150px">Name</th>
							     <th>{{ $Product->name }}</th>
						       </tr>
							   
							   <tr>
								<td style="font-weight:bold;">Price</td>
								<td> 	
									@if(!$Product->discount) {{$Product->price}} TK  
									@else  
									<span class="line-through"><span class="red-text"> {{$Product->price}} TK</span></span>
									@endif
								    </td>
							   </tr>
							   

							   <tr>
								<td style="font-weight:bold;">Availability</td>
								<td>@if($Product->quantity == 0) Out Of Stock  @else 
									In Stock 
									@endif 
								</td>
							   </tr>
							   
							   <tr>
								<td style="font-weight:bold;">SKU</td>
								<td>{{$Product->sku}}</td>
							   </tr>

							   <tr>
								<td style="font-weight:bold;">Item Code</td>
								<td>A-{{$Product->id}}</td>
							   </tr>


							   <tr>
								<td style="font-weight:bold;">Category </td>
								<td><a href="../category/{{$Product->category->id ?? '/'}}">{{$Product->category->name ?? 'Uncategorized'}}</a></td>
							   </tr>

							   <tr>
								<td style="font-weight:bold;">SubCategory </td>
								<td>
									@if (!$Product->subcategory_id)
									---
									@else
									@php 
									$fetch=App\Models\subcategory::where('id','=',$Product->subcategory_id)->first();
									@endphp
									<a href="{{ url('category/sub/')}}/{{ $Product->subcategory_id }}">{{ $fetch['name'] }}</a>@endif</td>
							   </tr>

							   <tr>
								<td style="font-weight:bold;">Delivery charge </td>
								<td>Our delivery charge would be 60 BDT (Inside Dhaka) and 120 BDT (Outside Dhaka) </td>
							   </tr>
						 </table>

           
						  </div>


				  	<div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
				  		<div class="review-heading">REVIEWS</div>
				  		<p class="mb-20">There are no reviews yet.</p>
				  		<form class="review-form">
		        			<div class="form-group">
			        			<label>Your rating</label>
			        			<div class="reviews-counter">
									<div class="rate">
									    <input type="radio" id="star5" name="rate" value="5" />
									    <label for="star5" title="text">5 stars</label>
									    <input type="radio" id="star4" name="rate" value="4" />
									    <label for="star4" title="text">4 stars</label>
									    <input type="radio" id="star3" name="rate" value="3" />
									    <label for="star3" title="text">3 stars</label>
									    <input type="radio" id="star2" name="rate" value="2" />
									    <label for="star2" title="text">2 stars</label>
									    <input type="radio" id="star1" name="rate" value="1" />
									    <label for="star1" title="text">1 star</label>
									</div>
								</div>
							</div>
		        			<div class="form-group">
			        			<label>Your message</label>
			        			<textarea class="form-control" rows="10"></textarea>
			        		</div>
			        		<div class="row">
				        		<div class="col-md-6">
				        			<div class="form-group">
					        			<input type="text" name="" class="form-control" placeholder="Name*">
					        		</div>
					        	</div>
				        		<div class="col-md-6">
				        			<div class="form-group">
					        			<input type="text" name="" class="form-control" placeholder="Email Id*">
					        		</div>
					        	</div>
					        </div>
					        <button class="round-black-btn">Submit Review</button>
			        	</form>
				  	</div>
				</div>
			</div>
			

		</div>
	</div>
</div>
	













<style>
	@media (max-width: 768px) {
    .carousel-inner .carousel-item > div {
        display: none;
    }
    .carousel-inner .carousel-item > div:first-child {
        display: block;
    }
}

.carousel-inner .carousel-item.active,
.carousel-inner .carousel-item-next,
.carousel-inner .carousel-item-prev {
    display: flex;
}

/* display 3 */
@media (min-width: 768px) {
    
.carousel-inner .carousel-item-right.active,
.carousel-inner .carousel-item-next {
 transform: translateX(33.333%);
    }
    
 .carousel-inner .carousel-item-left.active, 
 .carousel-inner .carousel-item-prev {
 transform: translateX(-33.333%);
    }
}

.carousel-inner .carousel-item-right,
.carousel-inner .carousel-item-left{ 
  transform: translateX(0);
}

</style>






<!-- test condition 12-13-2022 22122 -->
@if(count($related_product) < 3)                                 
@else
<div class="container text-center my-3">
  
    <h3 class="black-text" style="font-weight:bold;" align="center">Related Products</h3>
	
    <div align="center">
        <p class="col-md-2" style="border-bottom: 2px solid #003399;"></p>
    </div>

    <div class="row mx-auto my-auto">
        
	<div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
        <div class="carousel-inner w-100" role="listbox">
            
	
	<div class="carousel-item active"></div>

    @foreach ($related_product as $xitem)
	<div class="carousel-item">
        <div class="col-md-4">
					
	   <a href="{{route('producthomename',$xitem->url)}}">
      <img src="{{asset('Uploads/Products/'.$xitem->image1)}}" alt="{{$xitem->name}}" class="img-fluid" style="max-height:300px;max-width:300px; margin-top:5px;" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"></a>
	  <br>
	  <span>{{ $xitem->name }}</span>
	  
	 <br>
	 <span style="font-weight:bold;">Price: TK {{ number_format($xitem->price,2) }}</span>
	 <br>

     </div>
     </div>
		@endforeach
        </div>

            <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>

        </div>
    </div>
   
</div>

<br>

@endif

<script>
	$('#recipeCarousel').carousel({
  interval: 10000
})

$('.carousel .carousel-item').each(function(){
    var minPerSlide = 20;
    var next = $(this).next();
    if (!next.length) {
    next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));
    
    for (var i=0;i<minPerSlide;i++) {
        next=next.next();
        if (!next.length) {
        	next = $(this).siblings(':first');
      	}
        
        next.children(':first-child').clone().appendTo($(this));
      }
});
</script>















	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="	sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    
    $('.item').click(function() {
    $('.item').css("border","none");    
     // this border from other  image   
    $(this).css("border","2px solid #017661");     
    });

  $(document).ready(function() {
		    var slider = $("#slider");
		    var thumb = $("#thumb");
		    var slidesPerPage = 4; //globaly define number of elements per page
		    var syncedSecondary = true;
		    slider.owlCarousel({
		        items: 1,
		        slideSpeed: 2000,
		        nav: false,
		        autoplay: false, 
		        dots: false,
		        loop: true,
		        responsiveRefreshRate: 200
		    }).on('changed.owl.carousel', syncPosition);
		    thumb
		        .on('initialized.owl.carousel', function() {
		            thumb.find(".owl-item").eq(0).addClass("current");
		        })
		        .owlCarousel({
		            items: slidesPerPage,
		            dots: false,
		            nav: true,
		            item: 4,
		            smartSpeed: 200,
		            slideSpeed: 500,
		            slideBy: slidesPerPage, 
		        	navText: ['<svg width="18px" height="18px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="25px" height="25px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
		            responsiveRefreshRate: 100
		        }).on('changed.owl.carousel', syncPosition2);
		    function syncPosition(el) {
		        var count = el.item.count - 1;
		        var current = Math.round(el.item.index - (el.item.count / 2) - .5);
		        if (current < 0) {
		            current = count;
		        }
		        if (current > count) {
		            current = 0;
		        }
		        thumb
		            .find(".owl-item")
		            .removeClass("current")
		            .eq(current)
		            .addClass("current");
		        
				var onscreen = thumb.find('.owl-item.active').length - 1;
		        var start = thumb.find('.owl-item.active').first().index();
		        var end = thumb.find('.owl-item.active').last().index();
		       

				if (current > end) {
		            thumb.data('owl.carousel').to(current, 100, true);
		        }
		        
				if (current < start) {
		            thumb.data('owl.carousel').to(current - onscreen, 100, true);
		        }
		    }
		    function syncPosition2(el) {
		        if (syncedSecondary) {
		            var number = el.item.index;
		            slider.data('owl.carousel').to(number, 100, true);
		        }
		    }
		    thumb.on("click", ".owl-item", function(e) {
		        e.preventDefault();
		        var number = $(this).index();
		        slider.data('owl.carousel').to(number, 300, true);
		    });


            $(".qtyminus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    if (parseInt(now) -1> 0)
                    { now--;}
                    $(".qty").val(now);
                }
            })            
            $(".qtyplus").on("click",function(){
                var now = $(".qty").val();
                if ($.isNumeric(now)){
                    $(".qty").val(parseInt(now)+1);
                }
            });
		});
    </script>

@endsection

