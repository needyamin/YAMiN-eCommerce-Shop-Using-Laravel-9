@extends('layout')
@section('title'){{ $category->name }} Category Feed @yield('title') @endsection
@section('keywords'){{ $category->keywords }}@endsection
@section('description'){{ $category->description }}@endsection
@section('og_image'){{asset('Uploads/Category')}}/{{$category->image}}@endsection
@section('content')

<style>#headerProductsx,#SubCategoriesx{display: none;}</style>

<div class="d-flex justify-content-center"><span>.</span></div>

<?php $current_input = request()->all;?>
@if ($current_input == 'fetch')
<style> #view_all_li{display: none;}</style>
@endif


<!--  wow animated fadeInUpBig fast -->
<section id="Categories" align="center" class="px-1" style="max-width:1400px; margin:0 auto;">

@if($pCateGID->isEmpty())
@else 
<!-- subcategory start-->
<h3 class="black-text" align="center" style="font-weight:bold;">Related Sub-Categories</h3> 
<div align="center"><p class="col-md-2" style="border-bottom: 2px solid #003399;"></p></div>
    
<div class="container-fluid" style="margin-top: 20px;"> 
<div class="card-columns">

@foreach($pCateGID as $itemX)
  <div class="card bg" style="border:4px solid #017661">
    <div class="card-body text-center">
        <h4 class="card-title"><a href="{{ url('category/sub/'.$itemX->slug) }}" style="color:#017661;">{{ $itemX->name }} <img src="{{ url('click_here.png')}}" width="40px"></a></h4>
    </div>
  </div>
@endforeach
  
  </div>
<!-- subcategory End-->
<br>
@endif


<h3 class="black-text" align="center" style="font-weight:bold; @if($pCateGID->isEmpty()) @else margin-top:1%; @endif">{{ $ProductsCount }} Products Found On {{ $category->name }}</h3> 

    <div align="center">
        <p class="col-md-2" style="border-bottom: 2px solid #003399;"></p>
    </div>
    
  <div class="row my-3 px-3" style="max-width:1400px; margin:0 auto;" align="center">
  
  <style>
     .coverpadding{} 
     .coverpadding:hover{
      border-radius: 10px;
      box-shadow: 0 0 11px rgba(33,33,33,.2);
      border: 0;
      transition: all 0.5s ease-in-out 0s;
      transform: translateY(-10px);} 
  </style>


      @foreach($Products as $item)
      <!--<div class="coverpadding col-md-3 px-2 my-2 wow animated fadeInUpBig fast" style="min-height:500px;">-->
     <div class="coverpadding col-md-3 px-2 my-2" style="min-height:500px;">

       <div class="yaminMAKE">
    
      @if($item->quantity == 0)
      <div class="position-absolute bg-danger text-white  px-2 m-2 disabled">Stock Out!</div>
      @endif   

    <a href="{{route('producthomename',$item->url)}}">
      <img src=" {{asset('Uploads/Products/'.$item->image1)}}" alt="{{$item->name}}" class="img-fluid" style="max-height:300px;max-width:280px;margin-top:5px;" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';">
      

    <div class="py-2" style="background:white;">
    <span class="black-text my-3" style="font-weight:bold;">{{$item->name}}<br>
    <span class="text-muted my-3">{{$item->category->name ?? 'Uncategorized'}}</span></a><br>


<!--- item price start -->
    @if(!$item->discount) 
    <span style="font-weight:700"> Price: TK {{number_format($item->price,2)}}</span>
    @else  
		       <strike class="line-through"><span class="red-text"> {{number_format($item->price,2)}} TK</strike></span>
           <br>
    @endif
  
    <span>
      @if($item->discount > 0)
      <span style="font-weight:700"> Price: TK {{ number_format($item['price'] - $item['price'] * $item['discount'] / 100,2)}} </span>
      @else
           {{$item['contentforofferprice']}}
      @endif		
		</span>
     </br>
<!--- item price end -->

         <style>.checked {color: orange;}</style>
           <!-- @if($item->rating==1) 
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
                               @endif  
                                     
                                      <br>-->


 @if($item->quantity == 0)
 <button type="button" class="btn btncart btn-danger" data-toggle="modal" data-target="#reqforstock_{{$item->id}}">Request For Out</button>
 @else                           


 @if($item->price > 0)
 <!--- product add to cart start ################-->
 <form id="SubmitForm_{{$item->id}}" action="" method="POST" style="margin-top: 20px;">
	<input type="hidden" id="product_id{{$item->id}}" min="0" value="{{$item->id}}" required class="form-control">
  <input type="hidden" class="form-control" id="quantity{{$item->id}}" value="1" class="qty">  
  <span id="addMessage{{$item->id}}">  
  <button type="submit" class="btn btncart" id="base_color_addtoCart">Add to cart</button>
  <span class="text-danger" id="status_{{$item->id}}"></span>
  </form>
  @else 
<span class="btn btncart" id="base_color_addtoCart" style="margin-top: 20px;"> Prices will be updated soon.. </span>
@endif 


<script type="text/javascript">
$('#SubmitForm_{{$item->id}}').on('submit',function(e){
    e.preventDefault();

    let product_id = $('#product_id{{$item->id}}').val();
    let quantity = $('#quantity{{$item->id}}').val();

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

        $('#addMessage{{$item->id}}').html("<i class='fa fa-spinner' aria-hidden='true'></i><br><span class='text-success'>Item added to cart</span>").load(document.URL +  ' #addMessage{{$item->id}}').delay(6000);

   
        $('#updateheader').load(document.URL +  ' #updateheader');
        $('.stickyfooter').load(document.URL +  ' .stickyfooter');
        alertify.set('notifier','position', 'top-right');
        alertify.set('notifier','delay', 1);
        alertify.success(response.status);

        $('#status{{$item->id}}').show();
        console.log(response);
      },
      error: function(response) {
        $('#nameErrorMsg').text(response.responseJSON.errors.name);
      },
      });
    });
  </script>

    @endif
<!-- product add to cart end ################-->


          </div>
        </div>
     </div>  




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
                <input type="text" min="4" max="20" class="form-control"  name="name" placeholder="Your Name" required><br>
                <input type="email"  class="form-control"  name="email" placeholder="Your Email Address" required><br>
                {{--<input type="hidden" name="mobile_no" value="{{ Auth::user()->mobile_no }}">--}}

                <input type="hidden" name="mobile_no" value="{{$item->id}}">
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
   
    @php if ($Products->count() == 0) {
    echo "<div class='d-flex justify-content-center'><h2>No Product Found Here</h2></div>";}
    @endphp


    <div class="container">
    <div class="d-flex justify-content-center">
            <p>{{ $Products->links("pagination::bootstrap-4")}}</p>

      <li class="page-item" id="view_all_li" style="list-style: none;"><a class="page-link waves-effect waves-effect" href="{{ url()->current().'?all=fetch' }}">View All</a></li>
        </div>
        </div>

    
<hr class="col-md-6"> 
</section>


<!--- stick header code start -->
<style>
.stickyheaderclass {
  position: fixed;
  top: 0;
  width: 100%;
  background: white;
  z-index: 100000000000;
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

@endsection
