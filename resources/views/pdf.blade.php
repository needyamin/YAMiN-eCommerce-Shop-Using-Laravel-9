<!doctype html>
<html lang="en">
  <head>
    
   <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Order Details</title>
   
  </head>




@if(Auth::user()->id == $pdf->user_id)
<div class="container mt-2 w-200">
  <div class="card">
<div class="card-header">

<strong>Order #{{$pdf->id}}</strong> 
<strong style="float:right">Date: {{$pdf->created_at->format('F-d-Y')}}</strong>

  
</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
<h6 class="mb-3">From:</h6>
<div>

<strong>eCommercestore</strong>
</div>
<div>Address: House # 37 , Road #27,</div> <div>27(old) Dhanmondi, Dhaka -1209, Bangladesh</div>
<div>E-mail: contact@eCommercebd.com</div>
<div>Help Line: 01878578504</div>
</div>

<div class="col-sm-6">
<h6 class="mb-3">To:</h6>
<div>
<strong>{{$pdf->name}}</strong>
</div>
<div>Address: {!! $pdf->Delivery_Address !!}</div>
<div>{{$pdf->city}}</div>
<div>Phone: {{$pdf->Customer_phone_id}} @if(!$pdf->customer_alternative_phone_id) @else , {{$pdf->customer_alternative_phone_id}}@endif</div>
<div>@if(!$pdf->Customer_Emailid) @else Email: {{$pdf->Customer_Emailid}}@endif</div>
</div>



</div>

<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
<th>Item</th>
<th class="right">Unit Cost</th>
<th class="center">Qty</th>
<th class="right">Total</th>
</tr>
</thead>
<tbody>

<?php $sum_tot_Price = 0 ?>
@foreach ($cart_mass as $me)

@foreach ($me->custom_orders as $y)
{!! "<tr><td class='center'>". $y['product_id'].
  "</td><td class='center'>" .$y['price']. 
    " Tk</td><td class='center'>".$y['quantity']. 
    "</td><td class='center'>".$y['quantity'] * $y['price']. 
    " Tk</td></tr>"
  !!}
  <?php $storeDLcharge =$y['del_CHARGE']; ?>
  <?php $sum_tot_Price += $y['quantity'] * $y['price'];?>
<?php $final = $sum_tot_Price + $y['del_CHARGE'];?>
@endforeach


@endforeach

</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody style="float: right; text-align:center; padding-right:5%;">


<tr>
<td>
<strong>Delivery Charge:</strong>
</td>
<td>{{ $storeDLcharge }} Tk</td>
</tr>


<tr>
<td>
<strong>Price total:</strong>
</td>
<td>{{ $final}} Tk</td>
</tr>


</tbody>
</table>

</div>

</div>

</div>
</div>
</div>
@else

<div class="container">
<h1 style="text-align:center; margin-top:10%">You Are not able to see this order. Page will redirect in 5 sec..</h1>
<script>
         setTimeout(function(){
            window.location.href = '/';
         }, 5000);
      </script>

</div>


@endif



 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
