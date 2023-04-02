<div id="pnt" class="container mt-2 w-200"><button onclick="print()"><i class='fa fa-print'></i> Print This Invoice</button></div>

<!doctype html>
<html lang="en">
  <head>
  <div id='printableTable'> 

   <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>@page { size: auto;  margin: 0mm; } @media print{#pnt {visibility: hidden;}}</style>

    <title>Order_{{$pdf->id}}_BishuddhotaStore</title>
   
  </head>



<div class="container mt-2" style="font-size:18px; width:980px" >
  <div class="card">
<div class="card-header" style="font-family: 'Calibri Light', sans-serif;">

<strong style="font-wight:18px;">Order #{{$pdf->id}}</strong> 
<strong style="float:right">Date: {{$pdf->created_at->format('F-d-Y')}}</strong>

  
</div>
<div class="card-body" style="font-family: 'Calibri Light', sans-serif;">
<div class="row mb-4">
<div class="col-sm-6">
<h6 class="mb-3">From:</h6>
<div>

<strong>eCommerce</strong>
</div>
<div>Address: Place Your Address Here</div>
<div>E-mail: needyamin@ansnew.com</div>
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
<div>@if(!$pdf->Customer_Emailid) @else Email: {{$pdf->Customer_Emailid}} @endif</div>
</div>



</div>

<div class="table-responsive-sm">
<table class="table table-striped" style="font-size:18px;">
<thead>
<tr>
<th style="width:70%">Item</th>
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
  <?php $sum_tot_Price += $y['quantity'] * $y['price'] ;?>
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


<tr style="font-size:18px;">
<td style="font-family: 'Calibri Light', sans-serif;">
<strong>Delivery Charge:</strong>
</td>
<td>{{ $storeDLcharge }} Tk</td>
</tr>


<tr style="font-size:18px;">
<td>
<strong>Price Total:</strong>
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
</div>





<iframe frameborder='0' height='0' name='print_frame' src='about:blank' style='display: none;' title='print article'></iframe>
<script>
  function printDiv() {
    window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTable").innerHTML;
    window.frames["print_frame"].document.title = "Order_{{$pdf->id}}_(bishuddhotastore)";
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
  }
</script>


 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
