@extends('order_page_layout.new_layout')
@section('title') Product Cart @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@section('content')

<style>
    @media (min-width: 768px){#cartindesktopmode{display: block;}#cartinmobilemode{display:none;}}  
    @media (max-width: 768px)
    {#cartindesktopmode{display: none;}#cartinmobilemode{display:block;}}
</style>
    

    <!-- Cart Section Starts Here-->
     <section id="cartindesktopmode">
            @include('components.cartindesktopmode')
    </section>
     
      <section id="cartinmobilemode">
          @include('components.cartinmobilemode')
         </section>
      <!-- Cart Section Ends Here-->
@endsection