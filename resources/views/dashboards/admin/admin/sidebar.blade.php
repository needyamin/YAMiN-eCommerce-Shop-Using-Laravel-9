


<!-- sidebar -->
<div class="col-md-3 col-lg-2 px-0 position-fixed h-100 bg-white shadow-sm sidebar" id="sidebar">
      <h1 class="text-primary d-flex my-4 justify-content-center">
      <a href="/" ><img src="{{asset('assets/img/bishuddhota_logo.svg')}}" alt="BishudhotaBD Logo" class="img-fluid" style="width:120px;" ></a>
	  </h1>
      
     <div class="list-group rounded-0">
        <a href="{{url('admin/dashboard')}}" class="list-group-item list-group-item-action active border-0 d-flex align-items-center">
        <i class="bi bi-speedometer"></i>
          <span class="ml-2">Dashboard</span>
        </a>


		<a href="{{url('admin-Orders')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-bag-heart-fill"></span>
          <span class="ml-2">Orders</span>
        </a>

        <a href="{{url('admin/guest/Orders')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-bag-dash-fill"></span>
          <span class="ml-2">Guest Orders</span>
        </a>
       

 
  @if (\Auth::user()->role == 'admin')
        <button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#products-collapse">
          <div>
            <span class="bi bi-cart-plus-fill"></span> 
            <span class="ml-2">Products</span>
          </div>
          <span class="bi bi-chevron-down small"></span>
        </button>


        <div class="collapse" id="products-collapse" data-parent="#sidebar">
          <div class="list-group">
            <a href="{{url('admin/products')}}" class="list-group-item list-group-item-action border-0 pl-5"><i class="bi bi-speedometer"></i> 
             <span class="ml-2"> All Products</span></a>

            <a href="{{url('admin/add-product')}}" class="list-group-item list-group-item-action border-0 pl-5">
             <i class="bi bi-bag-plus-fill"></i><span class="ml-2"> Add Product</span></a>

            <a href="{{url('admin-bin-products')}}" class="list-group-item list-group-item-action border-0 pl-5"><i class="bi bi-trash"></i> <span class="ml-2">Recycle Bin</span></a>
          </div>
        </div>



	<!--<a href="{{url('admin-Transactions')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-cash-coin"></span>
          <span class="ml-2">Transactions</span>
        </a>-->



        <button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#categorys-collapse">
          <div>
            <span class="bi bi-tag-fill"></span>
            <span class="ml-2">Categorys</span>
          </div>
          <span class="bi bi-chevron-down small"></span>
        </button>

        <div class="collapse" id="categorys-collapse" data-parent="#sidebar">
          <div class="list-group">

            <a href="{{url('admin-Category')}}" class="list-group-item list-group-item-action border-0 pl-5">
            <i class="bi bi-speedometer"></i>
            <span class="ml-2">All Categorys</span></a>

            <a href="{{url('admin-AddCategory')}}" class="list-group-item list-group-item-action border-0 pl-5">
            <i class="bi bi-plus-circle-fill"></i> 
            <span class="ml-2"> Add Category</span></a>
      
          </div>
        </div>

        <button class="list-group-item list-group-item-action border-0 d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#subCategory-collapse">
          <div>
            <span class="bi bi-tags-fill"></span>
            <span class="ml-2">SubCategorys</span>
          </div>
          <span class="bi bi-chevron-down small"></span>
        </button>

        <div class="collapse" id="subCategory-collapse" data-parent="#sidebar">
          <div class="list-group">
            <a href="{{url('admin-SubCategory')}}" class="list-group-item list-group-item-action border-0 pl-5">
              <i class="bi bi-speedometer"></i>
              <span class="ml-2">All SubCategory</span></a>
           
            <a href="{{url('admin-AddSubCategory')}}" class="list-group-item list-group-item-action border-0 pl-5">
            <i class="bi bi-plus-circle-fill"></i> 
            <span class="ml-2"> Add SubCategory</span></a>
      
          </div>
        </div>

        @endif

		<a href="{{url('admin/request4stock')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-question-diamond-fill"></span>
          <span class="ml-2">Request For Stock</span>
        </a>

		<a href="{{url('admin-news-letter')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-envelope-at-fill"></span>
          <span class="ml-2">NewsLetter</span>
        </a>


        @if (\Auth::user()->role == 'admin')    
		<a href="{{url('admin/admin-all-users')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-people-fill"></span>
          <span class="ml-2">Users</span>
        </a>


        <a href="{{ url('admin/delivery_charges')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-truck-flatbed"></span>
          <span class="ml-2">Transport cost</span>
        </a>


        <a href="{{ url('admin/search_feed')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-search-heart-fill"></span>
          <span class="ml-2">Search Activity</span>
        </a>
 
        <a href="{{ url('admin/logActivity')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-activity"></span>
          <span class="ml-2">Activity Log</span>
        </a>
 

        <a href="{{ url('admin/block_ip/')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-piggy-bank-fill"></span>
          <span class="ml-2">BLOCK IP</span>
        </a>

        <a href="{{ url('admin/themesettings')}}" class="list-group-item list-group-item-action border-0 align-items-center">
          <span class="bi bi-gear-fill"></span>
          <span class="ml-2">Theme Settings</span>
        </a>
 

 
@endif
        
      </div>
    </div>
    
			
			
			
		<!-- overlay to close sidebar on small screens -->
		<div class="w-100 vh-100 position-fixed overlay d-none" id="sidebar-overlay"></div>
    <!-- note: in the layout margin auto is the key as sidebar is fixed -->
    <div class="col-md-9 col-lg-10 ml-md-auto px-0">
      <!-- top nav -->
      <nav class="w-100 d-flex px-4 py-2 mb-4 shadow-sm">
        <!-- close sidebar -->
        <button class="btn py-0 d-lg-none" id="open-sidebar">
          <span class="bi bi-list text-primary h3"></span>
        </button>


<span id="SEARCHIDADMIN">
@if (\Auth::user()->role == 'admin')  
<!-- main search bar start -->
<span class="d-none d-lg-block">
<form action="{{url('admin/products')}}" method="GET" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-1" type="text" name="q" value="{{ request()->q }}" placeholder="Search all products by product name, price, item codes" style="width:500px">
      <button class="btn btn-outline-success my-2 my-sm-1" type="submit">Search</button>
</form>
</span>
</span>
<!-- main search bar end -->
@endif



        <div class="dropdown ml-auto">
          <button class="btn py-0 d-flex align-items-center" id="logout-dropdown" data-toggle="dropdown" aria-expanded="false">
            <p> <span class="bi bi-person text-primary h4"></span>
            <span class="text-muted"> {{ auth()->user()->role }} </span></p>
            <span class="bi bi-chevron-down ml-1 mb-2 small"></span>
          </button>
          <div class="dropdown-menu dropdown-menu-right border-0 shadow-sm" aria-labelledby="logout-dropdown">
          <a class="dropdown-item text-sm" href="{{ url('admin-Orders') }}">All Orders</a>

          <a class="dropdown-item text-sm" href="{{ url('admin/guest/Orders') }}">Guest Orders</a>
           @if (\Auth::user()->role == 'admin')<a class="dropdown-item text-sm" href="{{ url('admin/add-product') }}">Add Product</a>@endif

           <a  data-toggle="modal" data-target="#openpasswordmodel" class="dropdown-item text-sm"> Change Password </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"> <i class="fas fa-sign-in-alt"></i> {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            
          </div>







<!--  Password Model Starts Here -->
<form method="POST" action="{{ url('update-password') }}">
     @csrf
 <div class="modal fade" id="openpasswordmodel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-primary" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header" id="user_home_btn">
         <p class="heading lead">Update Your Password</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="bi bi-key mb-3 animated rotateIn" style="font-size:100px"></i>
           <input type="password" class="form-control" name="newpass" placeholder="Enter New Password" required><br>
            <input type="password" class="form-control" name="confirm_new_Pass" placeholder="Re-Enter Password" required>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         
         <button type="submit" class="btn btn-primary waves-effect" id="user_update_profile">Update Password</button>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </form>
 <!-- Password Model Closed Here-->

 @if (session('successstatus'))
<script>$(document).ready(function () {$('#centralModalSuccessOneCLick').modal('show');});</script>@endif
@if (session('passwordwontmatch'))
<script>$(document).ready(function () {$('#centralModalSuccessOneCLick').modal('show');});</script>@endif


   <!--Modal ONE CLICK ORDER: START-->
   <div class="modal fade" id="centralModalSuccessOneCLick" tabindex="-1" role="dialog" aria-labelledby="centralModalSuccessOneCLickLabel"
	 aria-hidden="true">
	 <div class="modal-dialog cascading-modal" role="document">
	   <div class="modal-content">
   
		 <div class="modal-header darken-3 white-text" id="base_color_background">
		   <h4 class="title"><i class="bi bi-check"></i> Message</h4>
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
			   aria-hidden="true">&times;</span></button>
		 </div>
   
		 <div class="modal-body mb-0 text-center">
			<h2> <div class="alert alert-success" role="alert">{{ session('successstatus') }}{{ session('passwordwontmatch') }}</div> </h2>
		 </div>
   
	   </div>
	  
   
	 </div>
   </div>
<!--Modal ONE CLICK ORDER: END-->  




        </div>
      </nav>
	  








