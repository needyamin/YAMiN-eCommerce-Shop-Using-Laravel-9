@extends('layout')
@section('title') Bishuddhotabd - 404 Page Not Found @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@section('content')
 

<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>

<style>     
@media (min-width: 768px)
{ 
    .not_found_image
    {
        width:60%;
        margin-top:-10%;
    }
}
@media (max-width: 768px)
{ 
    .not_found_image
    {
        width:100%;
       
    }
}
 </style>

<div align="center"  style="background-color:#DADADA;padding:10%;" class="mt-2">
<img src="{{asset('Img/4004.png')}}"  class="not_found_image">
  <p>Sorry! Your Requested URL is not on the Server!! <br>If you have any queries Please Feel Free to <a href="{{url('Contact')}}">Contact US</a></p>
</div>

@endsection