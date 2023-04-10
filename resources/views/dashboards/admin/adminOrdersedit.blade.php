@section('title') Category @endsection
@section('keywords') Home,About,Contact,Car @endsection
@section('description') Write some descripton about the webpage @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.sidebar')
<!-- main content -->
<main class="container-fluid">

@if (session('status'))
  <div class="alert alert-success" role="alert">
      {{ session('status') }}
  </div>
  @endif

  @if (session('delete'))
  <div class="alert alert-danger" role="alert">
      {{ session('delete') }}
  </div>
  @endif
  
<!-- code start from here 1-12-2022 -->
<!-- code end 1-12-2022 -->


<script>
  $("#myid").val(jsonvalue[1]).prop('selected', true);
  console.log(jsonvalue[1]);
</script>

<div class="container">

@php
$mnu = $order->Customer_phone_id;
$users=App\Models\User::where('mobile_no','=',$mnu)->get();
$forloop=App\Models\User::all();
@endphp


<div class="form-group">
<label>Select Users</label><br>
<select value="{{ $order->Customer_phone_id }}" disabled>
    <option value="{{ $order->Customer_phone_id }}"> {{ $order->Customer_phone_id }} </option>
    @foreach ($forloop as $data)
    <option> {{ $data->mobile_no }} </option>
@endforeach    
</select>
</div>

<div class="form-group">
<a href="{{ url('admin/admin-Orders-edit/completeDEL', $order->id) }}" class="btn btn-danger"> DELETE </a>
</div>

<div class="card p-2"> Order ID: {{ $order->id }} </div> </br>

<form action="{{ url('admin/admin-Orders-edit/updateAddressPrice') }}" method="POST">
@csrf
<input type="hidden" name="order_id" value="{{ $order->id }}">

  <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="company">Email</label>
          <input type="email" class="form-control" value="{{ $order->Customer_Emailid }}" placeholder="Email" id="company">
        </div>
      </div>
 

      <div class="col-md-6">
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" class="form-control" value="{{ $order->Customer_phone_id }}" placeholder="phone">
        </div>
      </div>
   
    </div>


    <div class="row">
      <div class="col-md-6">
        <div class="card p-2">
      <p>Order IP: <span class="text-muted">{{ $order->ip }}</span></p>
      <p>Date/Time: <span class="text-muted">{{Carbon\Carbon::parse($order->created_at)->format('jS M y || g:i A')}}</span></p>
      </div>
      </div>


      <div class="col-md-6">
        <div class="form-group">
          <label for="last">Delivery Address</label><br>
          <textarea name="address" rows="3" cols="50">{{ $order->Delivery_Address }}</textarea>
        </div>
      </div>

    </div>


    <!--  row   -->
    <div class="row">
      <div class="col-md-6">

        <div class="form-group">
          <label for="email">Amount</label>
          <input type="number" name="amount" class="form-control" value="{{ $order->Amount }}" placeholder="Amount">
        </div>
      </div>

    </div>
    <!-- row -->

<input type="submit" name="submit" class="btn btn-primary" value="Update Address & AMOUNT"></input>
</form>

</div>



<div class="container">
<form action="{{ url('admin/admin-Orders-edit/update')}}" method="POST">
@csrf


<table class="table table-bordered" id="dynamicAddRemove">  
<tr>
<th>Product Name</th>
<th>Quantity</th>
<th>Amount </th> 
<th> </th>
</tr>
<tr> 

<!--<td><input type="text" name="moreFields[0][title]" value="Enter Product Title" class="form-control" /></td>-->  
<?php $sum_tot_Price = 0; ?>

@foreach ($cart_mass as $me)
@foreach ($me->custom_orders as $y)
{!! "<tr><td class='center'>
  <input type='hidden' name='id' value='{$y["id"]}'>
    <input type='hidden' name='order_id' value='{$y["order_id"]}'>
    <input type='text' name='update[{$y["id"]}][product_id]' value='{$y["product_id"]}' class='form-control'>"."</td>".

    "<td class='center'> 
      <input type='number' name='update[{$y["id"]}][quantity]' value='{$y["quantity"]}' class='form-control'> ". " </td>"
   .
   "<td class='center'>
    <input type='number' name='update[{$y["id"]}][price]' value='{$y["price"]}' class='form-control'>". "</td>
    <td> <a href='delete/{$y["id"]}' class='btn btn-danger'>Remove</a> </td>
    </tr>"
  !!}


@endforeach
@endforeach
</tr>  
</table> 

<button type="button" name="add" id="add-btn" class="btn btn-warning">Add More</button>
<br><br>
<input type="submit" class="btn btn-primary" name="Submit" value="Update Product Lists">

</div>

@php
$paginaId = request()->page;
$Products=App\Models\Products::where('status','=','1')->get();
@endphp


<script type="text/javascript">
var i = 0;
$("#add-btn").click(function(){
++i;
$("#dynamicAddRemove").append('<tr><td><select name="moreFields['+i+'][product_id]" class="form-control">@foreach ($Products as $item)<option>{{$item->name}}</option>@endforeach</select></td><td><input type="hidden" name="moreFields['+i+'][order_id]" VALUE="{{ $order->id }}" class="form-control"><input type="hidden" name="moreFields['+i+'][user_id]" VALUE="{{ $order->user_id }}" class="form-control"><input type="number" placeholder="Quantity" name="moreFields['+i+'][quantity]" VALUE="1" class="form-control"> </td><td><input type="number" placeholder="Amount" VALUE="0" name="moreFields['+i+'][price]" class="form-control"></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){  
$(this).parents('tr').remove();
});  
</script>
</form>




  </main>
@include('dashboards.admin.admin.header-footer.footer')
