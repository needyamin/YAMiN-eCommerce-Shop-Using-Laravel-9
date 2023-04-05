@extends('layout')
@section('title') bKash Payment @endsection
@section('keywords') eCommerce, Store, Product, onlineshop,bdshop @endsection
@section('description') Introducing world famous exclusive imported products. @endsection
@section('content')

<style>
#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}

/** FiX SEARCH BAR AND LOGO MOBILE RESPONSIVE */
@media (min-width: 300px) and (max-width: 600px) {
#maxwidth{margin:0 auto;text-align:left;}
}

@media (min-width: 600px) and (max-width: 1900px) {
#maxwidth{width:30rem;margin:0 auto;text-align:left;}
}

</style>

<section class="container mt-2">
	<div class="main-content">
    <div class="container" style="margin:0 auto;">
	

    
<div class="card text-center">
  <div class="card-header">
  <h2 class="black-text col-12" style="font-weight:bold;" align="center">bKash Payment</h2>
  </div>
  <div class="card-body">

  <div class="card" id="maxwidth">
  <ul class="list-group list-group-flush">
    <li class="list-group-item"><h5 class="p-2">Amount: <span style="color: red;">{{ $price }} tk</h5></li>
    <li class="list-group-item"><h5 class="p-2">Payment Reference: <span style="color: red;">{{ $id }}</span></h5></li>

    <li class="list-group-item">
        <center> <img class="mt-2" src="{{ url('bkash_me.png')}}" width="40%" onclick="openPopUp()">  </center> 
    </li>

    <li class="list-group-item">  
    <center> <a href="" class="btn" onclick="openPopUp();" style="background: #f42862; color:white;">Click Here For Payment</a>  </center> </li>
  </ul>
</div>

<script>
      // function to open the popup window
      function openPopUp() {
         let url = "https://shop.bkash.com/";
         let height = 600;
         let width = 1200;
         var left = ( screen.width - width ) / 2;
         var top = ( screen.height - height ) / 2;
         var newWindow = window.open( url, "center window", 'resizable = yes, width=' + width + ', height=' + height + ', top='+ top + ', left=' + left);
      }
   </script>


  </div>
  <div class="card-footer text-muted">
    
<p class="card-text" style="padding-left:5px;">* Please copy above amount, payment reference number and paste it into bkash paymentlink</p>

  </div>
</div>







        </div>
    </div>
</section>
@endsection