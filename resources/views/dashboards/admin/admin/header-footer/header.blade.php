<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
<meta name="keywords" content="@yield('keywords')">
<meta name="description" content="@yield('description')">

<link rel="stylesheet" href="{{asset('admin/assets/css/bootstrap.min.css')}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
<link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ url('css/alertify.min.css') }}"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<link href="{{asset('assets/img/favicon.ico')}}" rel="icon" type="image/x-icon">
<link href="{{asset('assets/img/favicons.png')}}" rel="apple-touch-icon">

<style>
a:hover{
  text-decoration: none;
}

* {
scrollbar-width: none; /* Firefox implementation */
}


.border-left{
  border-left: 2px solid var(--primary) !important;
}


.sidebar{
  top: 0;
  left : 0;
  z-index : 100;
  overflow-y: auto;
}

.sidebar::-webkit-scrollbar{display:none;}

.overlay{
  background-color: rgb(0 0 0 / 45%);
  z-index: 99;
}

/* sidebar for small screens */
@media screen and (max-width: 767px){
  
  .sidebar{
    max-width: 18rem;
    transform : translateX(-100%);
    transition : transform 0.4s ease-out;
  }
  
  .sidebar.active{
    transform : translateX(0);
  }
  
}
</style>

<div class="container-fluid">
  <div class="row">