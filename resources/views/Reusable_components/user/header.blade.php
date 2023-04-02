
<style>

.alertify-notifier { z-index:999999999999999999999999999999999999999999999999 !important;}
body{font-family: Cairo;}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 900000;
}


.dropdown-cart-content {
  display: none;
  position: absolute;
  right:5px;
  top:50px;
  background-color: #f1f1f1;
  overflow: auto;
  width:390px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/** Product SEARCH DROPDOWN CONTENT BAR */
.product_search_bardrop {position: absolute; overflow: auto; width:100%;max-height:450px;margin-top: 10px;padding-right: 20px;}
.product_search_bardrop::-webkit-scrollbar{display:none;}
.dropdown-content::-webkit-scrollbar{display:none;}
.wrappercartpage::-webkit-scrollbar{display:none;}
.dropdown-cart-content::-webkit-scrollbar{display:none;}
.contentcart::-webkit-scrollbar{display:none;}
.wrappercartpage::-webkit-scrollbar{display:none;}

* {
scrollbar-width: thin; /* Firefox implementation */
}


.wrappercartpage {
  height: 100%;
  display: flex;
  flex-direction: column;
}
.header, .footer {

}
.contentcart {
  flex: 1;
  overflow: auto;
}


.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;

}

.dropdown-content a:hover {background-color: #ddd;}
.dropdown:hover .dropdown-content {display: block;}
.dropdown:hover .dropdown-cart-content {display: block;}
.dropdown:hover .dropbtn {background-color: #3e8e41;}


/* li mega menu yamin */
#hiddenul_li {display: none;}
#visible_li:hover #hiddenul_li {display: block;}

@media (min-width: 768px)
{
#needyamin_logo{margin-top:10px;}
#SearchIcon:hover{cursor:pointer;}
#header{min-height:215px;}


/* button hover yaminMake */
.btncart {display: none;}
    .yaminMAKE:hover img {}
    .yaminMAKE:hover .btncart {display: inline-block; width: 80%; 
  
}

}

.cartbtn{
padding:10px;border: none; width:100%;
}

@media screen and (max-width: 600px) {
  #base_color_addtoCart{width: 60%;}
  #base_color_addtoCart:hover{width: 60%;}
  #header{height:160px;}
  #needyamin_logo{margin-top:25px;margin-left: -30px;}
  #imageheader{width: 180px; }
  #SEARCHBOX{width: 210px;margin-left: -85px; border:1px #d7d7d7;}
  #edit_search{border: 1px solid #d7d7d7;border-radius: 5px;}
  #SearchIcon{background: red;}
  #SEARCHBOX:hover #edit_search{border:1px #d7d7d7;}
  #SearchDropDownRecoards{margin-left: -15px;}
  
  /** scrollTop button */
  #scrollTopbtn {
  display: none;
  position: fixed;
  bottom: 66px;
  left: 30px;
  z-index: 99000000000000000000000000000000000000;
  border:2px solid #017661;
  border-radius:50%;
  background:rgba(0,0,0,0);
  color:#555;
  width:50px;
  height:50px;
  text-align:center;
  line-height:40px;}

#searchResult,li{margin-top: 10px;}

/* input[type="text"] */
.product_search_bardrop{
position: absolute;
overflow: auto;
width: 340px;
max-height: 350px;
margin-top: 15px;
margin: 0 auto;
margin-left: -110px;

}
  
/*
#letKNOW:hover #needyamin_logo{visibility: hidden;}
img:hover{visibility:visible;}
*/

#letKNOW:hover #needyamin_logo{}
img:hover{}

  }


 
  @media screen and (max-width: 400px) {
  #header{height:160px;}
  #needyamin_logo{margin-top:15px;}
  }


  
@media screen and (max-width: 360px) {
#header{height:160px;}
#needyamin_logo{margin-top:15px;}
}


/** FiX SEARCH BAR AND LOGO MOBILE RESPONSIVE */
@media (min-width: 350px) and (max-width: 420px) {
#imageheader,#needyamin_logo{width: 120px;margin-top: 24px;}
#SEARCHBOX{width: 180px;
margin-left: -80px;
border: 1px #d7d7d7;}
}



/*################## */
@media (min-width: 1000px) and (max-width: 1200px) {
  #headerProductsx{display: none;}
  #header{min-height:245px;}
  /*.hero-container{height:00px;}*/
}


/*################## */
@media (min-width: 600px) and (max-width: 800px) {
  #headerProductsx{display: none;}
  #header{min-height:155px;}
  .hero-container{height:200px;}

}

/* ############# Search Bar DROPDOWN MENU XXXXXXXXXXXXXXX############# */
@media (min-width: 600px) and (max-width: 1200px) {

}


@media (min-width: 801px) and (max-width: 1000px) {
  #headerProductsx{display: none;}
  #header{min-height:140px;}
  .hero-container{height:200px;}
  #YProductID{width:100%;}

}

@media (min-width: 992px) and (max-width: 1000px) {
  #YAMiNPRODUCT{ margin-top: 10%;}
}




.mainnav ul {
    margin: 0;
    padding: 0;
    list-style-type: none;
    position: relative; 
  }
  
  .mainnav li {
    display: inline-block;
    position: relative; 
  }
  .mainnav a {
    color: #292929;
    text-decoration: none;
    padding: 15px 30px 15px 15px;
    display: block;
    position: relative;
    background: #fdfdfd; 
  }

  .mainnav ul ul {
    position: absolute;
    top: 100%;
    min-width: 200px;
    background: lightgrey;
    width:100%;
    display: none;
    border: 1px solid #bbb;
  
  }
  .mainnav ul ul ul {
    left: 100%;
    top: 0; 
    transition-delay:0.5s; /* 2 SEC SLOW dropdown categories menu */
  }
  .mainnav ul ul li {
    display: block;
    background: #e3e3e3;
  }
  .mainnav ul ul ul li {
    background: #eee;
  }
  
  .mainnav li i {
    color: #292929;
    float: right;
    padding-left: 20px;
  }
  .mainnav div {
    background: lightgrey;
    color: #292929;
    font-size: 24px;
    padding: 0.6em;
    cursor: pointer;
    display: none;
  }
  .hasDD > a:after {
    content: "";
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -3px;
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid #000;
    transition: all 0.5s linear;
  }
  
  
  .hasDDWhite > a:after {
    content: "";
    position: absolute;
    right: 10px;
    top: 50%;
    margin-top: -3px;
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid white;
    transition: all 0.5s linear;
    /* transition-delay:1s; */
  }
  
  
  .mainnav li:hover {
    border-top-color: red;
  }
  .hasDD.on > a:after {
    transform: rotate(180deg);
  }
  ul ul .hasDD.on > a:after {
    transform: rotate(-90deg);
  }
  
  .hasDDWhite.on > a:after {
    transform: rotate(180deg);
  }
  ul ul .hasDDWhite.on > a:after {
    transform: rotate(-90deg);
  }



  
#dropdownHoverXX{}
#dropdownHoverXX:hover{background: #f4f4f4;}

</style> 

<!--mobile header border -->
<div class="d-lg-none">
<p id="mh_borderx" onclick="openNav()"> <span class="fas fa-bars fa-1x"></span> Menu </p>
</div>

<!-- ======= Header ======= -->
<header id="header" style="max-width:1920px; margin:0 auto;margin-top:10px;">
<div class="d-none d-lg-block" align="center" style="overflow: hidden;margin-top: -10px;">   

<div class="container-fluid header" style="max-width: 1920px;">
  <div class="row"> 
    <div class="col-4 px-5" style="text-align:left; padding-left:20px;" id="contactbishuddhota"> 
      <a href="mailto:needyamin@ansnew.com" style="color:white;font-size:14px;padding-left: 20px;">
      <i class="fa fa-envelope" aria-hidden="true"></i> needyamin@ansnew.com</a>
    </div> 
    
<div class="col-4"> </div> 
  
  <div class="col-4 px-5" style="text-align: right;padding-right:20px;" id="socialbishuddhota"> 
    <span><a href="https://www.facebook.com/" target="_blank" style="color:white;padding-left:10px;padding-right:5px;font-size:14px;"><i class="fab fa-facebook" aria-hidden="true"></i></a></span> 
    <span><a href="https://www.linkedin.com/" target="_blank" style="color:white;padding-left:10px;padding-right:5px;font-size:14px;"><i class="fab fa-linkedin" aria-hidden="true"></i></a></span> 
    <span><a href="https://www.instagram.com/" target="_blank" style="color:white;padding-left:10px;padding-right:5px;font-size:14px;"><i class="fab fa-instagram" aria-hidden="true"></i></a></span> |
          


        @if (Route::has('login'))
        @auth
<a href="{{url('dashboard')}}" style="color:white;padding-left:5px;font-size:14px;"><i class="fas fa-user-alt"></i> 
{{ auth()->user()->mobile_no }}</a>
<a href="{{ route('logout') }}" style="color:white;padding-left:5px;font-size:14px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fas fa-sign-in-alt"></i> {{ __('Logout') }}</a>
        @else
<a href="{{ route('login') }}" style="color:white;padding-left:5px;font-size:14px;"><i class="fas fa-sign-out-alt"></i> Login</a>
        @if (Route::has('register'))
        @endif 
        @endauth 
        @endif
</div></div></div></div></div><p></p>


    <div class="container d-flex px-5" style="max-width: 1920px;" id="letKNOW">
          <div id="needyamin_logo" class="logo mr-auto">
            <a href="/" ><img src="{{asset('assets/img/header.png')}}" alt="BishudhotaBD Logo" class="img-fluid" style="max-width: 280px;margin-top:-10px;" id="imageheader"></a>
         </div>
      
      
<div class="col-4" id="searchbishuddhota">
     
  <form action="/search_feed" method="GET">
      <div class="input-group md-form form-sm" style="margin-top:15px;" id="SEARCHBOX">
       <!-- start content start from here -->    
       <!-- last edit or added style="" 5-1-2022-->
       <input class="form-control my-0 py-1 red-border searchstring" id="edit_search" placeholder="Search" aria-label="Search" name="q" autocomplete="off" style="border: 1px solid #ddd;">
                
    <div class="input-group-append" id="SearchIcon">
      <button type="submit" class="input-group-text lighten-3 fas fa-search text-grey" aria-hidden="true" id="basic-text1" style="background: #017662;color: white;"></button>
    </div>
  </form>


<div class="container" style="z-index:700" id="SearchDropDownRecoards">
<div class="product_search_bardrop" id="product_search_bardrop" style="scrollbar-width: none;">
<ul id="searchResult" class="container card" style="text-align:left;" align="center">
</ul>
</div></div>


<!-- ajax for called encode[json] data fetch/post start on 15-1-2023-->
<script type="text/javascript">

$("#contactbishuddhota").hide().fadeIn(3000);
$("#socialbishuddhota").hide().fadeIn(2000);
$("#searchbishuddhota").hide().fadeIn(4000);
$("#updateheader").hide().fadeIn(4000);


    $(document).ready(function(){
        $("#edit_search").keyup(function(){
            var search = $(this).val();
            if(search != ""){
              //$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    url: "/searchresult",
                    type: "POST",
                    data: {
                      "_token": "{{ csrf_token() }}",
                      search:search, 
                       type:2,
                      },
                    dataType: "json",
                    success:function(response){
                        var len = response.length;
                        $("#searchResult").empty();
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var name = response[i]['name'];
                            var image1 = response[i]['image1'];
                            var url = response[i]['url'];
                            var mainURL = "{{ url('shop')}}/"+url;
                            //var category = response[i]['category_id'];
                            var price = response[i]['price'];

                          $('#product_search_bardrop').css('display','block');  //if click ajax display showp
                          $("#searchResult").css('border','2px solid lightgrey');


                          $("#searchResult").append("<a href="+mainURL+" style='color: inherit;text-decoration: none;'><li value='"+id+"' id='dropdownHoverXX' style='text-align:justify;font-size:small;list-style:none;padding:5px;'><table><tr><td style='height:55px;width:50px; padding:2px;'><img src='{{asset('Uploads/Products/')}}/"+image1+"' style='height:60px;width:55px;'></table> "+name+" <br> <span class='text-muted'>Price: TK "+parseFloat(price).toFixed(2)+"</span></td></li></a><hr style='margin-top: 0.5rem;margin-bottom: 0.5rem;'>");
                        }

                        // binding click event to li
                        $("#searchResult li").bind("click",function(){
                            setText(this);
                           
                        });

                        //if click anywhere display block
                        $('#header').click(function(){
                          $('#product_search_bardrop').css('display','none');
                        });


                    }
                });
            }
        });
    });

</script>
<!-- ajax for called encode[json] data fetch/post end on 15-1-2023-->


</div></div>
<!-- serach content end here -->

<!--Mobile Nav Menu
<p class="mobile-nav-toggle"><i class="fas fa-bars"></i> </p>
-->
     <nav id="updateheader" class="nav-menu d-none d-lg-block contentfont"> 
            <ul style="margin-top:5px;">
              
            <li class=""><a href="/" style="font-size: 17px;font-family:Cairo; font-weight:600;display: inline-block;">Home</a></li>

              
            <li id="headerProductsx"><a href="{{url('#Products')}}" style="font-size: 17px;font-family:Cairo; font-weight:600;display: inline-block;"> Products</a></li> 

              
            <li id="Categoriesx"><a href="{{url('#Categories')}}" style="font-size: 17px;font-family:Cairo; font-weight:600;display: inline-block;"> Categories</a></li>    

              
            <li id="SubCategoriesx"><a href="{{url('#SubCategories')}}" style="font-size: 17px;font-family:Cairo; font-weight:600;display: inline-block;"> SubCategories</a></li>  
          
  @if (Route::has('login'))
  @auth
  <li class="drop-down"><a href="#" style="font-size: 17px;font-family:Cairo; font-weight:600;display: inline-block;"> <i class="far fa-user-circle "></i> My Account <i class="fa fa-caret-down"></i></a> 
    
<ul style="text-align:left;">

     @if (\Auth::user()->role == 'admin')
      <li><a href="{{url('admin/dashboard')}}" style="font-family:Cairo; font-weight:600;font-size: 16px;"><i class="fa-solid fa-robot"></i> ADMIN PANEL</a></li>
      @endif

      @if (\Auth::user()->role == 'admin' or \Auth::user()->role == 'marketing')
      <li><a href="{{url('marketingTeam/dashboard')}}" style="font-family:Cairo; font-weight:600;font-size: 16px;"><i class="fa fa-flag-checkered"></i> Price Update <small class="text-muted">Logs</small></a></li>
      @endif

    @if (\Auth::user()->role == 'moderator')
      <li><a href="{{url('admin/dashboard')}}" style="font-family:Cairo; font-weight:600;font-size: 16px;"><i class="fa-solid fa-robot"></i> Moderator PANEL</a></li>
      @endif


      <li><a href="{{url('dashboard')}}" style="font-family:Cairo; font-weight:600;font-size: 16px;"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
          
      <li><a href="{{url('profile')}}" style="font-family:Cairo; font-weight:600;font-size: 16px;"><i class="fas fa-user"></i> My Profile</a></li>
          
      <li><a href="{{url('Orders')}}" style="font-family:Cairo; font-weight:600;font-size: 16px;"> <i class="fas fa-table"></i> My Orders</a></li>
          
  
  <!--<li><a href="{{url('Payments')}}" style="font-family:Cairo; font-weight:600;font-size: 16px;"><i class="fas fa-receipt"></i> Transactions</a></li>-->
  
  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-family:Cairo; font-weight:600;font-size: 16px;"> <i class="fas fa-sign-in-alt"></i> {{ __('Logout') }}</a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>

</li>                         
  </ul>
      </li>

    @else
       <li><a href="{{ route('login') }}" style="font-size: 17px;font-family:Cairo; font-weight: ;display: inline-block;">Login</a></li>
    
    @if (Route::has('register'))
       <li><a href="{{ route('register') }}" style="font-size: 17px;font-family:Cairo; font-weight:600;display: inline-block;">Register</a></li>
    @endif @endauth @endif
          
<li>
<div class="dropdown" style="z-index: 100;">
  <a href="{{url('cart')}}" style="margin-left:15px;"> <i class="fas fa-shopping-cart fa-2x"></i>
     <span class="basket-item-count" style="margin-left:-4px;">
        <span class="badge badge-pill green"> {{ count((array) session('cart')) }}</span></span> </a>
               
<div class="dropdown-cart-content">
 <div class="wrappercartpage">
   <div class="header" id="cart_header_small"></div>
     <div class="contentcart">
       <div style="max-height:380px;" id="cartnotfound">

<!-- ################# -->
<div class="card">
  <div class="card-header">
    You Added
  </div>
  <div class="card-body">

  <!-- ################### -->

<style>
td{
    word-wrap: break-word;
    word-break: break-all;
    white-space: normal;
    font-family: Cairo;
}</style>

<table style="width: 100%; margin:0 auto; "> 
   @if(session('cart'))
   @foreach(session('cart') as $id => $details)
   <tr style=" word-wrap: break-word;">
   <td style="text-align:center;">
   <a href="{{ url('Shop', $details['item_url'] ) }}">
  <img src="{{asset('Uploads/Products/'.$details['item_image'].'') }}" style="height:100px; margin-top:5px; padding:5px;" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"></a>
  </td>
  
<td align="left" style="padding-left: 10px;font-family: Cairo; font-size:16px;">{{ substr($details['item_name'],0,100) }}<br>
Quantity: {{ $details['item_quantity'] }}<br>
<span style="font-weight:bold;">Price: TK {{ number_format($details['Final_Price'] * $details['item_quantity'] , 2)}}</span></a>

</td>
</tr>
@endforeach
@else
<td class="card-text">Your cart is currently empty.</td>@endif 
</table></div></div>
</div></div>

@if(session('cart'))
<div class="footer p-3">
  <div class="row"><div class="col"><button class="cartbtn rounded-pill" id="btn_color1" onClick="location.href='/cart'">View cart</button></div>
   <div class="col"><button class="cartbtn rounded-pill" id="btn_color2" onClick="location.href='/checkout'">Checkout</button></div></div></div>
@endif
</div></div></div>
</li></ul>
  
</nav>


<!-- .nav-menu -->     
</div>
        
<hr>


<div class="d-lg-none" style="margin-top: -17px;">
<style>
  nav.menu{
    display: flex;
    justify-content: space-between;
}
nav.menu ul{
    margin: 0;
    padding: 0;
    list-style: none;
    margin-top: 5px;
    padding-left: 8px;
    padding-right: 8px;

}
nav.menu ul li{
    display: inline-block;
    
}
</style>

<!-- mobile menu page start -->
<nav class="menu">
  <ul class="menu-left">
        <li id="mobileLi"><a href="#" style="color:white;font-weight:bold;" data-toggle="modal" data-target="#exampleModal"> <span class="fas fa-bars fa-1x" style="padding-left: 5px; padding-right:8px;"> </span>Categories</span></a></li>
    </ul>

    <ul class="menu-right" style='padding:8px;'>


     
    <li style="padding-right:10px;"><a href="{{url('cart')}}">
        <span style="">
    <i class="fas fa-shopping-cart fa-1x" style="font-size: 25px;color:#333333"></i>
        <span class="badge badge-pill green" style="font-size:10px;"> {{ count((array) session('cart')) }}</span></span>
      </a>
    </li>
    <li style="color:#333333"> <i class="fa fa-list" style="font-size: 25px;#333333" onclick="openMenu()"></i></li>  
    
    </ul>
</nav>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 100000000000;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<div class="modal-body">  
@php
$Orders=App\Models\category::orderBy('short_list', 'asc')->get();
@endphp  
  <div class="container">
  <div class="row" align="center">
  @foreach ($Orders as $item)
    <div class="col-6">
     <a href="{{ url('category').'/'.$item->slug}}" style="text-decoration: none;color:black;"> 
     <div class="coverpadding">
     <img src="{{asset('Uploads/Category/'.$item->image)}}" alt="{{$item->image}}" class="card-img-top animated pulse infinite slow" style="max-width:60px;margin-top:5px;"">
     <br>
     <span class="text-muted my-3" style="font-size:12px;">{{$item->Products->count()}} items</span>
     <p style="font-weight:bold;">{{$item->name}}</p> 
     </div>
     </a>
         
    </div>  
     @endforeach
    </div> </div>



      </div>

    </div>
  </div>
  
</div>
<!-- mobile menu page end -->


<hr style="margin-top: -1px;">

</div></div>


<div class="d-none d-lg-block" align="center" >
<div class="container" style="max-width: 1920px;"> 

<div class="row">
<div class="col-4" style="text-align: left; padding-left: 20px;">
<!-- mega menu start -->
<ul>
 <li style="list-style:none;">
 <span style="float:left;"> 

 <nav class="mainnav" >

  <ul style="z-index: 10000;margin-top:-5px;-webkit-margin-before: 3px;">
    <li class="hasDDWhite"> 
      <a href="#" id="categories"> <span class="fas fa-bars fa-1x" style="padding-right: 15px;"></span> Categories</a> 
      <ul>
       

     <!--<li class="hasDD"><a href="/category/14">Chocolate </a>
          <ul>
            <li><a href="{{ url('category/sub/6') }}">Kitkat</a></li>
            <li><a href="{{ url('category/sub/7') }}">Cadbury</a></li>
            <li><a href="{{ url('category/sub/8') }}">Toblerone</a></li>
            <li><a href="{{ url('category/sub/9') }}">Cavendish</a></li>

           <li class="hasDD"><a href="##">Milk Chocolate</a>
              <ul>
                <li><a href="##">Cadbury</a></li>
                <li><a href="##">Nestle Kitkat</a></li>
                <li><a href="##">Almond Breeze</a></li>
              </ul>
            </li>


          </ul>
        </li>-->

      
      <!--<li class="hasDD"><a href="##">Second Level </a>
          <ul>
            <li><a href="#">Product</a></li>
            <li class="hasDD"><a href="##">More Product</a>
              <ul>
                <li><a href="##">More Product 1</a></li>
                <li><a href="##">More Product 2</a></li>
              </ul>
            </li>
          </ul>
        </li>-->


      @php
      $categorys=App\Models\category::orderBy('short_list', 'asc')->get();

      ## subcategory 1
      $target1=App\Models\category::where('name','=','Spread, Jam & Jelly')->first();
      $subcategory1=App\Models\subcategory::where('category_id','=','3')->get();

      ## subcategory 2
      $target2=App\Models\category::where('name','=','Noodles, Pasta & Macaroni')->first();
      $subcategory2=App\Models\subcategory::where('category_id','=','9')->get();

      ## subcategory 3
      $target3=App\Models\category::where('name','=','Baby Items')->first();
      $subcategory3=App\Models\subcategory::where('category_id','=','19')->get();

      
      @endphp


      @foreach ($categorys as $category)
      
    <!-- subcategory 1 start -->
      @if($category->slug == 'spread-jam-jelly')
          <li class="hasDD"><a href="{{url('category')}}/{{$target1->slug}}">{{  $target1->name  }} </a>
            <ul>
              @foreach ($subcategory1 as $subcategory)
              <li><a href="{{ url('category/sub/') }}/{{ $subcategory->slug }}">{{ $subcategory->name }}</a></li>
              @endforeach
                </ul>
                  </li>
    <!-- subcategory 1 end -->


    <!-- subcategory 2 start -->
    @elseif($category->slug == 'noodles-pasta-macaroni')
          <li class="hasDD"><a href="{{url('category')}}/{{$target2->slug}}">{{  $target2->name  }} </a>
            <ul>
              @foreach ($subcategory2 as $subcategory)
              <li><a href="{{ url('category/sub/') }}/{{ $subcategory->slug}}">{{ $subcategory->name }}</a></li>
              @endforeach
                </ul>
                  </li>    
    <!-- subcategory 2 end -->                
                  


    <!-- subcategory 3 start -->
    @elseif($category->slug == 'baby-items')
          <li class="hasDD"><a href="{{url('category')}}/{{$target3->slug}}">{{  $target3->name  }} </a>
            <ul>
              @foreach ($subcategory3 as $subcategory)
              <li><a href="{{ url('category/sub/') }}/{{ $subcategory->slug}}">{{ $subcategory->name }}</a></li>
              @endforeach
                </ul>
                  </li>    
    <!-- subcategory 3 end -->  



      @else
      <!-- No got chocolate -->
      <li><a href="{{url('category')}}/{{$category->slug}}">{{ $category->name }} </a></li>
      @endif

  @endforeach

    </ul>
    </li>

  </ul>
</nav>

</span>
</div>

<div class="col-4"> </div>

<div class="col-4" style="text-align:right;font-size: 20px; padding-right:50px;"><span style="font-size: 20px;line-height: 20px;color: #333333;"> <i class="fa fa-phone-square color_code" style="font-size: 24px;" aria-hidden="true"></i> <b style="font-weight: bold;">01848 333 123</b></span></div>
</div>


<script>

  $(".mainnav div").click(function() {
  $("ul").slideToggle();
  $("ul ul").css("display", "none");
  $(".mainnav .on").toggleClass("on");
});


$(".hasDD").hover(function(e) {
  
  $(this)
    .find("> ul")
    .slideToggle();

  $(this)
    .find("> ul ul")
    .css("display", "none");
  $(this)
    .find("> ul li")
    .removeClass("on");
  $(this).toggleClass("on");
  e.stopPropagation();
});

$(".hasDDWhite").click(function(e) {
  $(this)
    .find("> ul")
    .slideToggle();

  $(this)
    .find("> ul ul")
    .css("display", "none");
  $(this)
    .find("> ul li")
    .removeClass("on");
  $(this).toggleClass("on");
  e.stopPropagation();
});
</script>
<!--- end code Category Dropdown Content -->

<hr>

</div>




</header>
<!-- End Header --> 

