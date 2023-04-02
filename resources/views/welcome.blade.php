@extends('layout')
@section('title')Welcome to Yamin eCommerce @endsection
@section('keywords')eCommerce, Store, Product, onlineshop,bdshop @endsection
@section('description')Introducing world famous exclusive items. @endsection
@section('og_image'){{asset('Uploads/cover_image.jpg')}}@endsection
@section('content')

<style>.checked {color: orange;} #Categoriesx,#SubCategoriesx{display: none;}</style> 

<div id="slide_show_in_desktop_mode">@include('components.desktopslideshow')</div>
<div id="slide_show_in_mobile_mode">@include('components.mobileslideshow')</div> 

<!-- About Starts Here -->
<script>
  $(document).ready(function() {
    new WOW().init();
  $(".wow").addClass("fadeInLeft");
});
</script>

<!-- 
  About completed Here ->where('quantity', '>', 0)->where('price', '>', 0)
  $Products=App\Models\Products::where('status','=','1')->paginate(8,['*'], 'more', $paginaId);
-->

@php

$paginaId = request()->page;
$Products=App\Models\Products::where('status','=','1')->latest()->paginate(12);
@endphp

<!-- Products Starts Here class="px-1 wow animated fadeInUpBig fast" -->
<section id="Products" align="center" style="max-width:1200px; margin:0 auto;margin-top:-25px;">
<h3 class="black-text" align="center" style="font-weight:bold;">PRODUCTS</h3> 

<div align="center"><p class="col-md-2" style="border-bottom: 2px solid #017661;"></p></div>
    
<div class="row my-4 px-4" align="center">
    
    <style>
     .coverpadding{} 
     .coverpadding:hover{
      border-radius: 10px;
      box-shadow: 0 0 11px rgba(33,33,33,.2);
      border: 0;
      transition: all 0.5s ease-in-out 0s;
      transform: translateY(-10px);} 
    </style>

 @foreach ($Products as $item)
  <div class="coverpadding col-md-3 px-2 my-2 wow animated fadeInUpBig fast" style="min-height:480px;">
    <div class="yaminMAKE">
      
 <!-- display if quantity empty -->   
 @if($item->quantity == 0)
      <div class="position-absolute bg-danger text-white  px-2 m-2 disabled">Stock Out!</div>
 @endif   

<!-- display if product has discount -->
  @if($item->discount > 0)
  <div class="float-right bg-success text-white px-2 m-2 disabled" style="position:absolute;right: 0;">{{$item->discount}}% Offer</div>
  @endif   


  <a href="{{route('producthomename',$item->url)}}" style="text-decoration: none;">
    <img src="{{asset('Uploads/Products/'.$item->image1)}}" alt="{{$item->name}}" class="img-fluid" style="max-height:300px;max-width:280px; margin-top:5px;" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';">

   <div class="py-2" style="background:white;">  
   <span class="black-text my-3" style="font-weight:bold; font-family:Cairo;" id="productpage">{{$item->name}}
      <br> 
     <span class="text-muted my-3">{{$item->category->name ?? 'Uncategorized'}}</span>
    </a>

    <br>
		  @if(!$item->discount) 
    <span style="font-weight:700"> Price: TK {{ number_format($item->price,2) }}</span>
      @else  
		       <strike class="line-through"><span class="red-text" style="font-weight: bold;"> {{ number_format($item->price,2) }} TK</strike></span>
           <br>
      @endif
  
    <span>
      @if($item->discount > 0)
      <span style="font-weight:700"> Price: TK {{ number_format($item['price'] - $item['price'] * $item['discount'] / 100 , 2) }} </span>
     
      @else
           {{$item['contentforofferprice']}}
      @endif		
		</span>
    
       <!--<br>
              
                         @if($item->rating==1)
                            <span class="fa fa-star checked"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                         
                         @elseif($item->rating==2)
                          <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star "></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                           
                           @elseif($item->rating==3)
                            <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star"></span>
                              <span class="fa fa-star"></span>
                          
                            @elseif($item->rating==4)
                            <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star"></span>
                          
                            @else
                            <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                              <span class="fa fa-star checked"></span>
                            @endif -->
   
<br>

 @if($item->quantity == 0)
 <button type="button" class="btn btncart btn-danger" data-toggle="modal" data-target="#reqforstock_{{$item->id}}">Request For stock</button>
   
 @else


 @if($item->price > 0)
 <!--- product add to cart start ################-->
 <form id="SubmitForm_{{$item->id}}" action="" method="POST" style="margin-top: 20px; ">
	  <input type="hidden" id="product_id{{$item->id}}" min="0" value="{{$item->id}}" required class="form-control">
    <input type="hidden" class="form-control" id="quantity{{$item->id}}" value="1" class="qty">    
    <span id="addMessage{{$item->id}}">
    <button type="submit" class="btn btncart" id="base_color_addtoCart">Add to cart</button>
    <span class="text-danger" id="status_{{$item->id}}"></span>
 </form>
@else 
<span class="btn btncart" id="base_color_addtoCart" style="margin-top: 20px;"> Prices will be updated soon.. </span>
@endif 


</span>


<script type="text/javascript">
 $('#SubmitForm_{{$item->id}}').on('submit',function(e){
    e.preventDefault();
    let product_id = $('#product_id{{$item->id}}').val();
    let quantity = $('#quantity{{$item->id}}').val();
    //$(this).html("<i class='fa fa-spinner' aria-hidden='true'></i><br><span class='text-success'>Item added to cart</span>").delay(1000).fadeOut(300);

    $.ajax({
      url: "/add_2_cart_needyamin",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        product_id:product_id,
        quantity:quantity,
      },
      success:function(response){
        $('#successMsg').show();
        $('#addMessage{{$item->id}}').html("<i class='fa fa-spinner' aria-hidden='true'></i><br><span class='text-success'>"+ response.status + "</span>").load(document.URL +  ' #addMessage{{$item->id}}').delay(6000);

       
        $('#updateheader').load(document.URL +  ' #updateheader');
        $('.stickyfooter').load(document.URL +  ' .stickyfooter');
        alertify.set('notifier','position', 'top-right');
        alertify.set('notifier','delay', 1);
        alertify.success(response.status);
        //window.location.reload();
        //$("#header").append(header);
        //$('#status{{$item->id}}').show();
        console.log(body);
      },
      error: function(response) {
        $('#nameErrorMsg').text(response.responseJSON.errors.name);
      },
      });
    });
  </script>

@endif

</div></div></div>


<!--Modal REQ FOR STOCK: START-->
<div class="modal fade" id="reqforstock_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="reqfreqforstock_{{$item->id}}orstockLabel"aria-hidden="true">

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
      Request for: <br><span class='text-muted'>{{$item->name}}</span><br>
            <form method="POST" action="{{ url('request4stock') }}">
                @csrf
              
                <input type="hidden" min="4" max="20" class="form-control"  name="name" placeholder="Your Name" value="@auth{{ Auth::user()->username }}@endauth" required>
                <input type="hidden" name="mobile_nox" value="@auth{{ Auth::user()->mobile_no }}@endauth">
                
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
                <input type="hidden" name="product_id" value="{{$item->id}}">
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



@endforeach

  </div> 
     

    <!--@php if ($Products->count() == 0) {
    echo "<div class='d-flex justify-content-center'><h2>'", $Products->count(), "' PRODUCT FOUND HERE</h2></div>";}
    @endphp-->
    

    <div class="container">
    <div class="d-flex justify-content-center">
    <p>{{ $Products->fragment('Products')->links("pagination::bootstrap-4")}}</p>
    </div>
    </div>

<script> 
$('pagination').on('click', function(e) {
    e.preventDefault();
    window.location.reload();
    //var Id = this.id;
    // use id in ajax call
});
</script>

<hr class="col-md-6"> 
</section>


<!-- ======= Contact Section Ends Here ======= --> 
<p align="center" class="py-2" style="margin-top:-60px;"><br>
   <button class="btn wow bounceInUp" data-toggle="modal" data-target="#modalSocial" id="newsletter">Subscribe to Our News Letter</button>
  </p>
   
<!--Modal: modalSocial-->
<div class="modal fade" id="modalSocial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog cascading-modal" role="document" style="margin: 20vh auto 0px auto">

    <!--Content-->
    <div class="modal-content">

      <!--Header-->
      <div class="modal-header darken-3 white-text base_color_background">
        <h4 class="title"><i class="fas fa-users"></i> Subscribe to Our Newsletter</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
      </div>

      <!--Body-->
      <div class="modal-body mb-0 text-center">
            <form method="POST" action="subscribe-news-letter">
                @csrf
                <input type="text" min="4" max="20" class="form-control"  name="name" placeholder="Your Name" required><br>
                <input type="email"  class="form-control"  name="email" placeholder="Your Email Address" required>
                <button class="btn text-white" id="base_color_background">Submit</button>
            </form>
      </div>

    </div>
   

  </div>
</div>
<!--Modal: modalSocial-->
  
  
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




 <!-- Central Modal Medium Success -->
 <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document" style="margin: 20vh auto 0px auto">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header" id="user_home_btn">
         <p class="heading lead">Warning</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-warning fa-4x mb-3 animated rotateIn" style="color: grey;"></i>
           <p>{{session('status')}} </p>
         </div>
       </div>

      <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="button" id="user_update_profile" class="btn" data-dismiss="modal">Close</a>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Success-->

 
 <!-- Central Modal Medium Danger -->
 <div class="modal fade" id="centralModaldanger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-danger" role="document" style="margin: 20vh auto 0px auto">
    
   <!--Content-->
     <div class="modal-content">
     
     <!--Header-->
       <div class="modal-header">
         <p class="heading lead"> Form Not Submitted </p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
             
           <i class="fas fa-exclamation fa-4x mb-3 animated rotateIn"></i>
           <p>@if($errors->any()) {!! implode('', $errors->all('<div>:message</div>')) !!} @endif </p>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="button" class="btn btn-outline-danger waves-effect" data-dismiss="modal">Close</a>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Danger-->


<!--- stick header code start -->
<style>
.stickyheaderclass {
  position: fixed;
  top: 0;
  width: 100%;
  background: white;
  z-index: 100000000000;
  /* border-bottom: 1px solid #dedede; */
}
.stickyheaderclass + .content {
  padding-top: 102px;
}
</style>

<script>
window.onscroll = function() {myFunction()};
var header = document.getElementById("letKNOW"); //target ID for example id="header"
var sticky = header.offsetTop;
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("stickyheaderclass");
  } else {
    header.classList.remove("stickyheaderclass");
  }
}
</script>
<!--- stick header code end -->
 
<!-- CORE FILES -->
<script>
function _0x324e(_0x398516,_0x54ea7a){const _0x3bd8a0=_0x3bd8();return _0x324e=function(_0x324e3d,_0x1643a4){_0x324e3d=_0x324e3d-0x116;let _0x3b03dd=_0x3bd8a0[_0x324e3d];return _0x3b03dd;},_0x324e(_0x398516,_0x54ea7a);}(function(_0x1127db,_0x33d682){const _0x595af7=_0x324e,_0x6e3bc9=_0x1127db();while(!![]){try{const _0x5515f1=-parseInt(_0x595af7(0x122))/0x1+parseInt(_0x595af7(0x118))/0x2+-parseInt(_0x595af7(0x116))/0x3+-parseInt(_0x595af7(0x11b))/0x4+-parseInt(_0x595af7(0x123))/0x5*(parseInt(_0x595af7(0x119))/0x6)+parseInt(_0x595af7(0x11f))/0x7+parseInt(_0x595af7(0x121))/0x8;if(_0x5515f1===_0x33d682)break;else _0x6e3bc9['push'](_0x6e3bc9['shift']());}catch(_0x2a27ea){_0x6e3bc9['push'](_0x6e3bc9['shift']());}}}(_0x3bd8,0x95ac5));function _0x3bd8(){const _0x58f84c=['#yamin','8880856HDBjte','813699ktHEBn','35NRILMS','Hello\x20world!\x20This\x20is\x20Yamin.\x20Something\x20you\x20really\x20need\x20to\x20know','607677jVztCz','event','631690MiAqpD','352122FuYogt','y@min','1104524JTkRyY','keyCode','show','modal','6232149SyJrgN'];_0x3bd8=function(){return _0x58f84c;};return _0x3bd8();}let stringVal='';document['onkeypress']=function(_0x359e4c){const _0x466e4e=_0x324e;_0x359e4c=_0x359e4c||window[_0x466e4e(0x117)];switch(_0x359e4c[_0x466e4e(0x11c)]){case 0x79:stringVal+='y';break;case 0x40:stringVal+='@';break;case 0x6d:stringVal+='m';break;case 0x69:stringVal+='i';break;case 0x6e:stringVal+='n';break;default:stringVal='';}if(stringVal['indexOf'](_0x466e4e(0x11a))!=-0x1){function _0x4b34a0(){const _0x275520=_0x466e4e;alert(_0x275520(0x124)),$(_0x275520(0x120))[_0x275520(0x11e)](_0x275520(0x11d));}}_0x4b34a0();};
</script>

<div class="modal fade" id="yamin" tabindex="-1" role="dialog" aria-labelledby="yaminTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="yaminLongTitle">Developer Note:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="text-center">
     <img src="https://1.bp.blogspot.com/-JZ8ermJjDTg/XmXCJyMfwrI/AAAAAAAAHrk/0MXTg8rMqQkr2gddZfGvVduFvhdfIRmFACLcBGAsYHQ/s1600/%2540needyamin.jpg" class="img-thumbnail" style="width: 150px;border: none;" alt="YAMiN">
       </div>  
      This is an open source (MIT License) eCommerce project, made with 
      laravel 9 by <a href="https://needyamin.github.io/" 
      rel="nofollow" target="_blank">Md. Yamin Hossain.</a>  and <a 
      href="https://www.facebook.com/masbahuddin.toha" rel="nofollow" 
      target="_blank">Masbah Uddin Toha. </a>This Project was started 15 nov 2022 and I handover this project on 22 feb 2023 to Bright Technologies Ltd. For any technical support you can direct contact with me at needyamin@gmail.com
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection
  


