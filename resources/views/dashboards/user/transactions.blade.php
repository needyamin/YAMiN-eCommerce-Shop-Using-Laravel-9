@extends('layout')
@section('title') Transactions @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@section('content')
 
<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>
<!-- Payments Section Starts Here-->
<section id="mytransactionsindesktopmode">@include('components.user.mytransactionsindesktopmode')</section>
<section id="mytransactionsinmobilemode">@include('components.user.mytransactionsinmobilemode')</section>
<!-- Payments Section Ends Here-->

@endsection