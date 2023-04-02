
 <div class="mt-2">
 <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="{{asset('Uploads/cover_image.jpg')}}" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="{{asset('Uploads/cover_image.jpg')}}" alt="Second slide">
    </div>
  </div>

  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
  <i class="fas fa-long-arrow-alt-left fa-2x" style="background:black;color:white;padding:5px;border-radius:20px;"></i>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
  <i class="fas fa-long-arrow-alt-right fa-2x" style="background:black;color:white;padding:5px;border-radius:20px;"></i>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
 
<script> 
$('.carousel-control-prev').hide();
setTimeout(function() { $('.carousel-control-prev').show(); }, 3000);
$('.carousel-control-next').hide();
setTimeout(function() { $('.carousel-control-next').show(); }, 3000);
</script>
 
<!-- Slideshow completed Here -->

<br>
@php
$Orders=App\Models\category::orderBy('short_list', 'asc')->get();
@endphp  

<!-- class="px-1 wow animated fadeInUpBig fast" -->
<section id="Categories" align="center" style="max-width:1200px; margin:0 auto;">
<h3 class="black-text" align="center" style="font-weight:bold;">Categories</h3> 

<div align="center">
        <p class="col-md-2" style="border-bottom: 2px solid #017661;"></p>
    </div>

    
  <style>
  .coverpaddingx{} 
  .coverpaddingx:hover{
    /*filter: drop-shadow(0 0 0.75rem gray);*/
    transform: scale(1.1);
  }
  #hoverman{} #hoverman:hover{transform: scale(1.5);}
  </style>  

  <div class="row my-3 px-3 wow animated fadeInUpBig fast" align="center">
  @foreach ($Orders as $item)
    <div class="col-md-4 px-2 my-2">
     <a href="category/{{$item->slug}}" style="text-decoration: none;color:black;"> 
     <div class="coverpaddingx">
     <img src="{{asset('Uploads/Category/'.$item->image)}}" alt="{{$item->image}}" class="card-img-top animated pulse infinite slow" style="width:100px;margin-top:5px;" id="hoverman" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';">
     <br>
     <span class="text-muted my-3" style="font-size:12px;">{{$item->Products->count()}} items</span>
     <p style="font-weight:bold;">{{$item->name}}</p> 
     </div>
     </a>
         
    </div>  
     @endforeach

    </div>
   

<hr class="col-md-6"> 
</section>


