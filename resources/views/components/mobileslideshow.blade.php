<style>.bottom-left {position: absolute;bottom: 8px;left: 80px;}</style>

<img class="" src="{{asset('Uploads/cover_mobile.jpg')}}" width="100%">

<!--<div align="center" id="carousel-example-multi" class="carousel slide carousel-multi-item v-2" data-ride="carousel">
    <br>
  <div class="carousel-inner py-2" role="listbox">
    <div class="carousel-item" >
        <div class="col-12 col-md-3" style="border-radius:10px;">
                <div class="container">
                          <div class="card mb-2">
                          <img class="card-img-top animated pulse infinite slow" src="{{asset('slideshow/Mobile/2.webp')}}"
                                alt="Card image cap" style="border-radius:10px;">
                          </div>
                    <div class="bottom-left"  >
                        <button class="btn" id="base_color_background" onclick="services()">Book Now</button>
                    </div>
                </div>
        </div>
      </div>   
    
  <div class="carousel-item" >
      <div class="col-12 col-md-3" style="border-radius:10px;">
          <div class="container">
              <div class="card mb-2">
               <img class="card-img-top animated pulse infinite slow" src="{{asset('slideshow/Mobile/3.webp')}}" alt="Card image cap" style="border-radius:10px;">
                    </div>
                    <div class="bottom-left">
                </div>
            </div>
        </div>
    </div>   


       <div class="carousel-item">
         <div class="col-12 col-md-3" style="border-radius:10px;">
            <div class="container">
               <div class="card mb-2">
                   <img class="card-img-top animated pulse infinite slow" src="{{asset('slideshow/Mobile/4.webp')}}"
                    alt="Card image cap" style="border-radius:10px;">
                      </div>
                      <div class="bottom-left mx-5">
                           <button class="btn" id="base_color_background" onclick="services()">Book Now</button>
                    </div>
                  </div>
                </div>
              </div>   
      
      
  </div> 
</div>     
<br>-->

@php
$Orders=App\Models\category::get();
@endphp  
<!-- class="px-1 wow animated fadeInUpBig fast" -->
<section id="Categories" align="center" style="margin:0 auto;">
<h3 class="black-text" align="center" style="font-weight:bold;">Categories</h3> 

    <div align="center">
        <p class="col-md-2" style="border-bottom: 2px solid #003399;"></p>
    </div>
    
  <style>.coverpadding{} .coverpadding:hover{border:1px solid #cdcdcd;} </style>  

<hr class="col-md-6"> 
</section>


<div class="container">
  <div class="row" align="center">
  @foreach ($Orders as $item)
    <div class="col-6">
     <a href="category/{{$item->slug}}" style="text-decoration: none;color:black;"> 
     <div class="coverpadding">
     <img src="{{asset('Uploads/Category/'.$item->image)}}" alt="{{$item->image}}" class="card-img-top animated pulse infinite slow" style="max-width:100px;margin-top:5px;"">
     <br>
     <span class="text-muted my-3" style="font-size:12px;">{{$item->Products->count()}} items</span>
     <p style="font-weight:bold;">{{$item->name}}</p> 
     </div>
     </a>
         
    </div>  
     @endforeach
    </div>  </div>



</div>

