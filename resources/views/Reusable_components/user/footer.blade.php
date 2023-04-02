

<!-- Footer -->

<!--<footer id="footer" class="page-footer font-small  pt-4" style="background:#0a2929;">-->
<footer id="footer" class="page-footer font-small  pt-4" style="background:#04244D;">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Footer links -->
    <div class="row text-center text-md-left mt-3 pb-3 wow">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">

  
              <a href="/" class="logo footer-logo">
                <img class="brand-logo-big" src="{{asset('assets/img/footer.png')}}" alt="biolife logo" style="width:320px;margin-top: -20px;"></a>
                
                        <div class="footer-phone-info" style="text-align:center;">
                            <p class="r-info">
                                <span>Hotline: </span>
                                <span> 01878578504</span>
                            </p>
                        </div>
       

      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Pages</h6>
        <p><a href="{{url('about-us')}}" target="_blank">About Us</a></p>
        <p><a href="{{url('Contact')}}" target="_blank">Contact Us</a></p>
        <p><a href="{{url('Terms-and-Conditions')}}" target="_blank">Terms of Services</a></p>
       
      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>

        <p><a href="{{url('Frequently-Asked-Questions')}}" target="_blank">FAQs</a></p>
        <p><a href="{{url('privacy-policy')}}" target="_blank">Privacy Policy</a></p>
        <p><a href="{{url('Shipping-and-Returns')}}" target="_blank">Return & Refunds Policy</a></p>



      </div>

      <!-- Grid column -->
      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
        <p><i class="fas fa-home mr-1"></i> Place Your Address Here</p>
        <p><i class="fas fa-envelope mr-1"></i> needyamin@ansnew.com</p>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Footer links -->

    <!--<div class="container wow" style="text-align: center;">
<img src="{{url('Img/SSLCOMMERZ%20_Pay%20_With.png')}}" class="img-fluid" >
     <br>
    </div>-->
    <hr>

    <!-- Grid row -->
    <div class="row d-flex align-items-center">

      <!-- Grid column -->
      <div class="col-md-7 col-lg-8">

        <!--Copyright-->
        <p class="text-center text-md-left"><i class="fa fa-copyright" aria-hidden="true"></i>
 {{ now()->year }} Copyright:
          <a href="#">
            <strong>ANSNEW INC. by Md. Yamin Hossain</strong>
          </a>
  
        </p>


       

      </div>
      
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-5 col-lg-4 ml-lg-0">

        <!-- Social buttons -->
        <div class="text-center text-md-right">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a href="https://www.facebook.com/" class="btn-floating btn-sm rgba-white-slight mx-1" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>

            <li class="list-inline-item">
              <a href="https://www.instagram.com" class="btn-floating btn-sm rgba-white-slight mx-1" target="_blank">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.linkedin.com/company/" class="btn-floating btn-sm rgba-white-slight mx-1" target="_blank">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </li>
          </ul>
        </div>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->



  </div>
  <!-- Footer Links -->


  
</footer>
<!-- Footer -->




<style>


.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: green;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>




<!-- MENU NAV for user panel start -->
<div id="mySidenavMenu" class="sidenav" style="background: white; z-index:900000000000000000000000000">
  <a href="javascript:void(0)" class="closebtn" onclick="closeMenu()">&times;</a>

  <ul style="list-style: square;">

  @php
      $category=App\Models\category::orderBy('name')->get();
      $chocolate=App\Models\category::where('name','=','chocolate')->first();
      $subcategory=App\Models\subcategory::where('category_id','=','14')->get();
      @endphp
      @foreach ($category as $menu)
      
      @if($menu->slug =='chocolate')
      <!-- yes got chocolate -->
      <li><a href="{{url('category')}}/{{$chocolate->id}}">{{  $chocolate->name  }} </a>
                  <ul>
                    @foreach ($subcategory as $subline)
                       <li><a href="{{ url('category/sub/') }}/{{ $subline->id }}">{{ $subline->name }}</a></li>
                    @endforeach
                    </ul>
      @else
      <!-- No got chocolate -->
      <li><a href="{{url('category')}}/{{$menu->id}}">{{ $menu->name }} </a>
      @endif

      @endforeach

</ul>



</div>





<!-- Profile NAV for user panel start -->
<div id="mySidenav" class="sidenav" style="background: white;">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <ul style="list-style: none; text-align:left;">
  <li><a href="/"><i class="fas fa-home"></i>  Home</a></li>

  @if (Route::has('login'))
        @auth
       
    @if (\Auth::user()->role == 'admin')
      <li><a href="{{url('admin/dashboard')}}"><i class="fa-solid fa-robot"></i> ADMIN</a></li>
      @endif

    @if (\Auth::user()->role == 'moderator')
      <li><a href="{{url('admin/dashboard')}}"><i class="fa-solid fa-robot"></i> Moderator</a></li>
      @endif

      <li><a href="{{url('dashboard')}}"><i class="fas fa-tachometer-alt"></i>  Dashboard</a></li>
                 <li><a href="{{url('profile')}}"><i class="fas fa-user"></i>  Profile</a></li>
                 
                   <li><a href="{{url('Orders')}}"> <i class="fas fa-table"></i> Orders</a></li>
                 <!--<li><a href="{{url('Payments')}}" ><i class="fas fa-receipt"></i> Transactions</a></li>-->
                <a   href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> 
                <i class="fas fa-sign-in-alt"></i> {{ __('Logout') }}</a>        
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                      </li>                         
                      
                  
                    </li>

                @else
                <li> <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a> </li>
                    @if (Route::has('register'))
                    <li> <a href="{{ route('register') }}"><i class="fas fa-registered"></i> Register</a> </li>
                    @endif
                @endauth
                @endif
          
<li>
</ul>

</div>
<!-- Profile NAV for user panel end -->


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
}

function openMenu() {
  document.getElementById("mySidenavMenu").style.width = "350px";
}
function closeMenu() {
  document.getElementById("mySidenavMenu").style.width = "0";
}
</script>



<style>
header, .stickyfooter {
  background: #ccc;
  padding: 5px;
  text-align: center;
}
.stickyfooter {
  position: fixed;
  width: 100%;
  bottom: 0;
  box-sizing: border-box;
  z-index: 10001;
}

 </style>   
 
 <div class="d-lg-none">
<div class="stickyfooter">
  
<div class="row">
  <div class="col"><a href="#" style="color:#111"><i class="fa fa-list" onclick="openNav()"></i><br>Menu</a></div>
  
  <div class="col">
  <a href="{{url('cart')}}" style="margin-left:15px;color:#111"> <i class="fas fa-shopping-cart fa-1x"></i>
     <span class="basket-item-count" style="margin-left:-4px;">
       <span class="badge badge-pill green"> {{ count((array) session('cart')) }}  </span>
          </span></a><br>Cart
          </div>
  

<div class="col"> 
@if (Route::has('login'))
@auth
<div class="col"> <a href="{{url('profile')}}" style="color:#111"><span class="fa fa-user-circle"></span><br>Profile</a> 

@else
 <a href="{{ route('login') }}" style="color:#111"><span class="fa fa-sign-in"></span><br>Login</a> </div>

@if (Route::has('register'))
   <div class="col">    <a href="{{ route('register') }}" style="color:#111"><span class="fa fa-user-plus"></span><br>Register</a> </div>

@endif
@endauth
@endif


</div>

</div>


</div></div>

