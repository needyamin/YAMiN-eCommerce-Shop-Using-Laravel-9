@extends('layout')
@section('title') Bishuddhotabd - 401 Page @endsection
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
<div align="center"  style=" background-color:#DADADA;padding:10%;">
   
 
              <img src="{{asset('Img/401.png')}}"  class="not_found_image"   >
 
                <p>You are not allowd to access this webpage</p>
        
   
</div>
@endsection