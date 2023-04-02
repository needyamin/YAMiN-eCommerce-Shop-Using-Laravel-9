@extends('layout')
@section('title') Orders @endsection
@section('keywords') Bishuddhota, Store, Product, onlineshop,bdshop @endsection
@section('description') Introducing world famous exclusive imported products. @endsection
@section('content')
 

<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>

<!-- Orders Section Starts Here-->
<div id="ordersindesktopmode">@include('components.user.ordersindesktopmode')</div>
<section id="ordersinmobilemode">@include('components.user.ordersinmobilemode')</section>

<!-- Orders Section Ends Here-->
@if (session('status'))
        <script>
        $(document).ready(function () {
        $('#centralModalSuccess').modal('show');
        });
        </script>
@endif

 
 <!-- Central Modal Medium Success -->
 <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header ss-->
       <div class="modal-header" id="base_color_background">
         <p class="heading lead">Success</p>

         <button type="button" class="close" id="base_color_background" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
           <p> <?php echo session('status') ?></p>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a href="{{url('/')}}" class="btn" id="base_color_background" style="color:white">SHOP MORE</a>
         <a type="button" class="btn btn-outline-grey waves-effect" data-dismiss="modal">No, thanks</a>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Success-->
 
 
 @if (session('Order_Status'))
    @include('components.user.orderstatus')
    <script>
        $(document).ready(function ()
        {
            $('#show_Order_Status_Modal').modal('show');
        });
    </script>
 @endif
@endsection