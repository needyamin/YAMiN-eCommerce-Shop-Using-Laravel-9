@extends('layout')
@section('title') SubCategory Feed @yield('title') @endsection
@section('keywords'){{ $subcategory->keywords }}@endsection
@section('description'){{ $subcategory->description }}@endsection
@section('content')

<style>#headerProductsx,#Categoriesx{display: none;}</style>

<div class="d-flex justify-content-center"><span>.</span></div>
<!--  wow animated fadeInUpBig fast -->
<section id="SubCategories" align="center" class="px-1" style="max-width:1400px; margin:0 auto;">
<h3 class="black-text" align="center" style="font-weight:bold;">All {{ $subcategory->name }} Products</h3> 


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
         <!--   
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
                               @endif  
                                     
                                      <br>   -->


 @if($item->quantity == 0)
 <button type="button" class="btn btncart btn-danger btn" disabled>Request For Stock</button>
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

     @endforeach
    </div>
   
    @php if ($Products->count() == 0) {
    echo "<div class='d-flex justify-content-center'><h2>'", $Products->count(), "' PRODUCT FOUND HERE</h2></div>";}
    @endphp


    <div class="container">
    <div class="d-flex justify-content-center">
            <p>{{ $Products->links("pagination::bootstrap-4")}}</p>
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