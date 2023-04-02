
<!-- Footer -->
<footer id="footer" class="page-footer font-small  pt-4" style="background:#0a2929;">

  <!-- Footer Links -->
  <div class="container text-center text-md-left">

    <!-- Footer links -->
    <div class="row text-center text-md-left mt-3 pb-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">

  
                        <a href="/" class="logo footer-logo">
                <img class="brand-logo-big" src="{{asset('assets/img/bishuddhota_logo.svg')}}" alt="biolife logo" width="180" height="96"></a>
                        <div class="footer-phone-info">
                            <i class="biolife-icon icon-head-phone"></i>
                            <p class="r-info">
                                <span>Hotline</span>
                                <span>01848 333 123</span>
                            </p>
                        </div>
       

      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Products</h6>
        <p>
          <a href="{{url('#')}}" target="_blank">Link Will Be Added</a>
        </p>
       
      </div>
      <!-- Grid column -->

      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Useful links</h6>
        <p>
          <a href="{{url('about')}}" target="_blank">About Us</a>
        </p>
       
        <p>
          <a href="{{url('Help')}}" target="_blank">Help</a>
        </p>

      </div>

      <!-- Grid column -->
      <hr class="w-100 clearfix d-md-none">

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
        <p><i class="fas fa-home mr-3"></i>House # 38, Road # 16(new), 27(old) Dhanmondi, Dhaka -1209, Bangladesh</p>
        <p><i class="fas fa-envelope mr-3"></i> contact@bishuddhotabd.com</p>
      </div>
      <!-- Grid column -->

    </div>
    <!-- Footer links -->

    <hr>

    <!-- Grid row -->
    <div class="row d-flex align-items-center">

      <!-- Grid column -->
      <div class="col-md-7 col-lg-8">

        <!--Copyright-->
        <p class="text-center text-md-left">© {{ now()->year }} Copyright:
          <a href="#">
            <strong>bishuddhotabd.com</strong>
          </a>
          <br>
</p>
       
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-5 col-lg-4 ml-lg-0">

        <!-- Social buttons -->
        <div class="text-center text-md-right">
          <ul class="list-unstyled list-inline">
            <li class="list-inline-item">
              <a href="https://www.facebook.com/bishuddhotathepurity" class="btn-floating btn-sm rgba-white-slight mx-1" target="_blank">
                <i class="fab fa-facebook-f"></i>
              </a>
            </li>

            <li class="list-inline-item">
              <a href="https://www.instagram.com/bishuddhotabd/" class="btn-floating btn-sm rgba-white-slight mx-1" target="_blank">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.linkedin.com/company/bishuddhota/" class="btn-floating btn-sm rgba-white-slight mx-1" target="_blank">
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
  color: #f1f1f1;
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


<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <li><a href="/"><i class="fas fa-home"></i>  Home</a></li>

  @if (Route::has('login'))
        @auth
       
      <li><a href="{{url('dashboard')}}"><i class="fas fa-tachometer-alt"></i>  Dashboard</a></li>
                 <li><a href="{{url('profile')}}"><i class="fas fa-user"></i>  Profile</a></li>
                 <li><a href="{{url('Orders')}}"> <i class="fas fa-table"></i> Orders</a></li>
                 <li><a href="{{url('Payments')}}" ><i class="fas fa-receipt"></i> Transactions</a></li>
                <a   href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fas fa-sign-in-alt"></i> {{ __('Logout') }}</a>
                
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                      </li>                         
                      </ul>
                    </li>

                @else
                <li> <a href="{{ route('otp.login') }}"><i class="fas fa-sign-in-alt"></i> Login</a> </li>
                    @if (Route::has('register'))
                    <li> <a href="{{ route('register') }}"><i class="fas fa-registered"></i> Register</a> </li>
                    @endif
                @endauth
                @endif
          
<li>


</div>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
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
  opacity: 1;
}

 </style>   
 
 <div class="d-lg-none">
<div class="stickyfooter">
  
<div class="row">
  <div class="col"><span class="fa fa-bars" onclick="openNav()"></span><br>Menu</div>
  
  <div class="col">
  <a href="{{url('cart')}}" style="margin-left:15px;"> <i class="fas fa-shopping-cart fa-1x"></i>
     <span class="basket-item-count" style="margin-left:-4px;">
       <span class="badge badge-pill red"> {{ count((array) session('cart')) }}  </span>
          </span></a><br>Cart
          </div>
  


<div class="col"> 
@if (Route::has('login'))
@auth
<div class="col"> <a href="{{url('profile')}}"><span class="fa fa-user-circle"></span><br>Profile</a> 

@else
 <a href="{{ route('otp.login') }}"><span class="fa fa-sign-in"></span><br>Login</a> </div>

@if (Route::has('register'))
   <div class="col">    <a href="{{ route('register') }}"><span class="fa fa-user-plus"></span><br>Register</a> </div>

@endif
@endauth
@endif


</div>

</div>

</div></div>
