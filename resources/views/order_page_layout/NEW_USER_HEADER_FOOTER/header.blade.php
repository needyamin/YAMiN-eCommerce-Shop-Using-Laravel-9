
<style>
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}


.dropdown-cart-content {
  display: none;
  position: absolute;
  right:5px;
  top:50px;
  background-color: #f1f1f1;
  overflow: auto;
  width:350px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/** Product SEARCH DROPDOWN CONTENT BAR */
.product_search_bardrop {position: absolute; overflow: auto; width:100%;max-height:350px;}
.product_search_bardrop::-webkit-scrollbar{display:none;}
.dropdown-content::-webkit-scrollbar{display:none;}
.wrappercartpage::-webkit-scrollbar{display:none;}
.dropdown-cart-content::-webkit-scrollbar{display:none;}
.contentcart::-webkit-scrollbar{display:none;}
.wrappercartpage::-webkit-scrollbar{display:none;}

* {
scrollbar-width: none; /* Firefox implementation */
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
{#needyamin_logo{margin-top:10px;}}#SearchIcon:hover{cursor:pointer;}
</style> 


<!-- ======= Header ======= -->
<header id="header" class="z-depth-1" style="min-height:220px; max-width:1400px; margin:0 auto;margin-top:10px;">


    <div class="d-none d-lg-block" align="center" style="overflow: hidden;margin-top: -10px;">   
  <div class="container-fluid" style="background:#EF9E29;padding:10px;color:wheat;"><div class="row"> 
    <div class="col-4"> <a href="mailto:contact@bishuddhotabd.com" style="color:white;font-size:14px;"><i class="fa fa-envelope" aria-hidden="true"></i> contact@bishuddhotabd.com</a>
    </div> 
    
    <div class="col-4"> </div> 

    <div class="col-4"> 
    <span><a href="https://www.facebook.com/bishuddhotathepurity" target="_blank" style="color:white;padding-left:10px;padding-right:5px;font-size:14px;"><i class="fab fa-facebook" aria-hidden="true"></i></a></span> 
    <span><a href="https://www.linkedin.com/company/bishuddhota/" target="_blank" style="color:white;padding-left:10px;padding-right:5px;font-size:14px;"><i class="fab fa-linkedin" aria-hidden="true"></i></a></span> 
  <span><a href="https://www.instagram.com/bishuddhotabd/" target="_blank" style="color:white;padding-left:10px;padding-right:5px;font-size:14px;"><i class="fab fa-instagram" aria-hidden="true"></i></a></span> |
          


@if (Route::has('login'))
@auth
<a href="{{url('dashboard')}}" style="color:white;padding-left:5px;font-size:14px;"><i class="fas fa-phone-alt"></i> {{ auth()->user()->mobile_no }}</a>
<a href="{{ route('logout') }}" style="color:white;padding-left:5px;font-size:14px;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fas fa-sign-in-alt"></i> {{ __('Logout') }}</a>
@else
<a href="{{ route('otp.login') }}" style="color:white;padding-left:5px;font-size:14px;"><i class="fas fa-sign-out-alt"></i> Login</a>
@if (Route::has('register'))
@endif @endauth @endif


</div></div>
</div></div></div></p>



  
    <div class="container d-flex" >
          <div id="needyamin_logo" class="logo mr-auto" >
            <a href="/" ><img src="{{asset('assets/img/bishuddhota_logo.svg')}}" alt="BishudhotaBD Logo" class="img-fluid" style="width:200px;margin-top:-15px;" ></a>
          </div>
      
        
    <div class="col-md-4">
    <form action="/search_feed" method="GET">
      <div class="input-group md-form form-sm" style="margin-top:15px;">

<!-- start content start from here -->   
           
<input class="form-control my-0 py-1 red-border searchstring" id="edit_search" onkeyup="javascript: find_my_div();" placeholder="Search" aria-label="Search" name="q" autocomplete="off">
                
<div class="input-group-append" id="SearchIcon">
<button  type="submit" class="input-group-text lighten-3 fas fa-search text-grey" aria-hidden="true" id="basic-text1"></button></div>
</form>

<div class="container" style="z-index:100">
<div class="product_search_bardrop">

<ul class="container card" style="text-align:left;" align="center">  
@php
$Products=App\Models\Products::where('status','=','1')->get();
@endphp
@foreach($Products as $item)

  <li style="display:none;" id="user_{{$item->id}}"> 
  
  <a href="{{route('producthomename',$item->url)}}" style="color:black;">
  <img src="{{asset('Uploads/Products/'.$item->image1)}}" alt="{{$item->name}}" class="img-fluid" style="height:40px; margin-top:5px;" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"> {{$item->name}} </a>

  <p class="text-muted"> {{$item->category->name}}</p>
  <hr>
  </li>
@endforeach
</ul>

</div>
</div>


<script>
function gid(a_id) {
	return document.getElementById (a_id)	;
}
  function close_all(){
    // hide all divs

  	for (i=0;i<7; i++) {
      // display content limits
  		var o = gid("user_"+i);
  		if (o) { 
        //checking for object if really exists
  			o.style.display = "none";
  		}
  	}
  }

  function find_my_div(){ 
  close_all(); 
  	
	var o_edit = gid("edit_search");
	var str_needle = edit_search.value;
	str_needle = str_needle.toUpperCase();
  
	if (str_needle != "") {
    //search for empty strings
		for (i=0;i<100; i++) {
	  	var o = gid("user_"+i);
	  	if (o) { 
	  		// search upper case and compare
	  		var str_haystack = o.innerHTML.toUpperCase();
	  		if (str_haystack.indexOf(str_needle) ==-1) {
	  			// not found, do nothing
	  		}
	  		else{
	  			// display found data
				 o.style.display = "block";
		  		}	
  			}
  		}
  	}
  }
</script>

</div></div>
<!-- serach content end here -->


<!--Mobile Nav Menu
<p class="mobile-nav-toggle"><i class="fas fa-bars"></i> </p>
-->
          
     <nav class="nav-menu d-none d-lg-block contentfont"> 
            <ul style="margin-top:5px;">
              <li class=""><a href="/" style="font-size: 17px;font-family:Cairo; display: inline-block;">Home</a></li>
              <li><a href="{{url('Help')}}" style="font-size: 17px;font-family:Cairo; display: inline-block;"> <i class="fas fa-headset"></i> Help</a></li>   
          
  @if (Route::has('login'))
  @auth
  <li class="drop-down"><a href="#" style="font-size: 17px;font-family:Cairo;display: inline-block;"> <i class="far fa-user-circle "></i> My Account <i class="fa fa-caret-down"></i></a> 
    
  <ul style="text-align:left;">
          <li><a href="{{url('dashboard')}}" style="font-family:Cairo;"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
          <li><a href="{{url('profile')}}" style="font-family:Cairo;"><i class="fas fa-user"></i> Profile</a></li>
          <li><a href="{{url('Orders')}}" style="font-family:Cairo;"> <i class="fas fa-table"></i> Orders</a></li>
          <li><a href="{{url('Payments')}}" style="font-family:Cairo;"><i class="fas fa-receipt"></i> Transactions</a></li>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="font-family:Cairo; font-weight:600;"> <i class="fas fa-sign-in-alt"></i> {{ __('Logout') }}</a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form></li>                         
                  </ul>
                    </li>

       @else
       <li><a href="{{ route('otp.login') }}" style="font-size: 17px;font-family:Cairo; font-weight:600;display: inline-block;">Login</a></li>
       @if (Route::has('register'))
      
       <li><a href="{{ route('register') }}" style="font-size: 17px;font-family:Cairo; font-weight:600;display: inline-block;">Register</a></li>
          @endif @endauth @endif
          

<li>
<div class="dropdown" style="z-index: 100;">
  <a href="{{url('cart')}}" style="margin-left:15px;"> <i class="fas fa-shopping-cart fa-2x"></i>
     <span class="basket-item-count" style="margin-left:-4px;">
        <span class="badge badge-pill orange"> {{ count((array) session('cart')) }}</span></span></a>
               
<div class="dropdown-cart-content">
 <div class="wrappercartpage">
   <div class="header" style="padding:1px; background:#EF9E29"></div>
     <div class="contentcart">
       <div style="max-height:350px;" id="cartnotfound">


<!-- ################# -->
<div class="card">
  <div class="card-header">
    You Added
  </div>
  <div class="card-body">
  <!-- ################### -->
<table> 
   @if(session('cart'))
   @foreach(session('cart') as $id => $details)
   <tr style=" word-wrap: break-word;"><td>
   <a href="{{ url('added-cart-product', $details['item_id'] ) }}">
  <img src="{{asset('Uploads/Products/'.$details['item_image'].'') }}" style="height:100px; margin-top:5px; padding:5px;" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';"></a>
  </td>
  
<td align="left">{{ substr($details['item_name'],0,24) }}<br>
Quantity: {{ $details['item_quantity'] }}<br>
Price: {{ $details['Final_Price'] * $details['item_quantity']}}৳</a></td>
</tr>

@endforeach
@else
<td class="card-text">Your cart is currently empty.</td>@endif 
</table></div></div>
</div></div>

@if(session('cart'))
<div class="footer">
  <div class="row"><div class="col"><button class="btn rounded-pill" style="background-color: #EF9E29;color:#fdfdfd"  onClick="location.href='/cart'">View cart</button></div>
   <div class="col"><button class="btn rounded-pill" style="background-color: #8C8B88;color:#fdfdfd"  onClick="location.href='/checkout'">Checkout</button></div></div></div>
@endif
</div></div></div>
</li></ul>
  
</nav>





<!-- .nav-menu -->     
</div>
        

<hr>
<div class="d-lg-none">
<div class="container d-flex bg-white" id="extra" >
<table align="center"> 
<tr> 
<td style="padding:5px;"> <a href="/" >Home</a> </td>
<td style="padding:5px;"> Product </td>

<td style="padding:5px;"> 
<div class="dropdown"><a href="">Categories</a>
  <div class="dropdown-content">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
</div>

</td>

<td style="padding:5px;"> Others </td>
<td style="padding:5px;"><a href="{{url('cart')}}" style="margin-left:15px;"><i class="fas fa-shopping-cart fa-1x"></i>
    <span class="basket-item-count" style="margin-left:-4px;">
      <span class="badge badge-pill red"> {{ count((array) session('cart')) }}  </span>
        </span></a> </td>
      </tr>
     </table>

</div></div>

<div class="d-none d-lg-block" align="center">
<div class="container-fluid"> 
<div class="row">

<div class="col-4" style="text-align: left;">
<!-- mega menu start -->
<ul>
 <li style="list-style:none;">
 <span style="float:left;"> 


 <nav class="mainnav">

  <ul style="z-index: 1;margin-top:-5px;">
    <li class="hasDDWhite"> 
      <a href="##" style="color:black;background:#EF9E29; font-weight:bold; padding:13px;color:white; width:300px;border-radius: 15px 15px 0px 0px;"> <span class="fas fa-bars fa-1x" style="padding-right: 15px;"></span> Categories</a> 
      <ul>
        <li class="hasDD"><a href="##">Second Level </a>
          <ul>
            <li><a href="#">Product</a></li>
            <li class="hasDD"><a href="##">More Product</a>
              <ul>
                <li><a href="##">More Product 1</a></li>
                <li><a href="##">More Product 2</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="##">Item</a></li>
        <li><a href="##">Item</a></li>
      </ul>
    </li>

  </ul>
</nav>

</span>
</div>

<div class="col-4"> </div>

<div class="col-4" style="text-align:right;font-size: 20px;"><span style="font-size: 20px;line-height: 20px;color: #333333;"> <i class="fa fa-phone-square" style="color:#EF9E29;font-size: 24px;" aria-hidden="true"></i> <b>01848333123</b></span></div>
</div>


<!--- start code Category Dropdown Content -->
<style>
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
}
.on > a,
.mainnav li:hover > a {
  background: lightgrey;
}
.mainnav ul ul {
  position: absolute;
  top: 100%;
  min-width: 200px;
  background: lightgrey;
  width:100%;
  display: none;
}
.mainnav ul ul ul {
  left: 100%;
  top: 0;
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
</style>

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



</div>
</header>
<!-- End Header --> 