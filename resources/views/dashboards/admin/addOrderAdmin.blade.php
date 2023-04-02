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

<form action="{{ url('admin/admin-Orders-edit/submit/add')}}" method="POST">
@csrf
<div class="container">

<div class="form-group">
<label>Select Users</label> <br>
<select name="user_phone_no" class="form-control">
    @foreach ($forloop as $data)
    <option value="{{ $data->mobile_no }}">{{ $data->mobile_no }} </option>
    @endforeach    
</select>
</div>



<div class="card p-2"> Create Order </div> </br>



  <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="company">Customer Name</label>
          <input type="text" class="form-control" name="customer_name" placeholder="Customer Name" required>
        </div>
      </div>
 

      <div class="col-md-6">
        <div class="form-group">
          <label for="phone">City</label>
          <input type="text" class="form-control" name="city" placeholder="City">
        </div>
      </div>
   
    </div>


    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="company">Email</label>
          <input type="email" class="form-control" name="email" placeholder="Email" id="company">
        </div>
      </div>
 

      <div class="col-md-6">
        <div class="form-group">
          <label for="phone">Phone Number</label>
          <input type="tel" class="form-control" name="phone" placeholder="phone">
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="first">Order Note</label>
          <textarea placeholder="Order Details" name="note" class="form-control"></textarea>
        </div>
      </div>


      <div class="col-md-6">
        <div class="form-group">
          <label for="last">Delivery Address</label>
          <textarea name="delivery_address" placeholder="Delivery Address" class="form-control"></textarea>
        </div>
      </div>

    </div>


    <!--  row   -->
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="email">Amount</label>
          <input type="number" name="amount" class="form-control"  placeholder="Amount">
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="url">Coupen Code</label>
          <input type="text" class="form-control" name="coupen_code" placeholder="Coupen Code">
        </div>
      </div>

    </div>
    <!-- row -->


    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="email">Payment Mode</label>
          <select class="form-control" name="payment_mode">
          <option value="completed" hidden="">completed</option> 
           <option value="pending">pending</option>
             <option value="completed">completed</option>
               <option value="Refunded">Refunded</option>
          </select>
        </div>
      </div>

      
      <div class="col-md-3">
        <div class="form-group">
          <label for="email">Shipping Status</label>
          <input type="text" name="shipping_status" class="form-control" placeholder="Shipping Status">
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label for="url">Delivery Status</label>
          <select class="form-control" name="delivery_status">
          <option value="completed" hidden="">completed</option> 
           <option value="pending">pending</option>
             <option value="completed">completed</option>
               <option value="Refunded">Refunded</option>
          </select>
        </div>
      </div>

      <div class="col-md-3">
        <div class="form-group">
          <label for="email">Payment Status</label>
          <select class="form-control" name="payment_status">
          <option value="completed" hidden="">completed</option> 
           <option value="pending">pending</option>
             <option value="completed">completed</option>
               <option value="Refunded">Refunded</option>
          </select>
        </div>
      </div>
    </div>






</div>



<div class="container">
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
</tr>  
</table> 

<button type="button" name="add" id="add-btn" class="btn btn-warning">Add More</button>
<br><br>
<input type="submit" class="btn btn-primary" name="Submit" value="Submit">

</div>



<script type="text/javascript">
var i = 0;
$("#add-btn").click(function(){
++i;
$("#dynamicAddRemove").append('<tr><td><select name="moreFields['+i+'][product_id]" class="form-control">@foreach ($Products as $item)<option>{{$item->name}}</option>@endforeach</select></td><td><input type="hidden" name="moreFields['+i+'][order_id]" class="form-control"><input type="hidden" name="moreFields['+i+'][user_id]" class="form-control"><input type="number" placeholder="Quantity" name="moreFields['+i+'][quantity]" VALUE="1" class="form-control"></td><td><input type="number" placeholder="Amount" VALUE="0" name="moreFields['+i+'][price]" class="form-control"></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
});
$(document).on('click', '.remove-tr', function(){  
$(this).parents('tr').remove();
});  
</script>

</form>
  </main>
@include('dashboards.admin.admin.header-footer.footer')