@section('title') All Orders @endsection
@section('keywords') adminorder,orders,admin panel,root @endsection
@section('description') All Order Display Here @endsection
@include('dashboards.admin.admin.header-footer.header')
@include('dashboards.admin.admin.sidebar')
@include('dashboards.admin.admin.header-footer.datatablecore')
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script src="https://cdn.datatables.net/fixedheader/3.3.2/js/dataTables.fixedHeader.min.js">  </script>


<main class="container-fluid">
@if (session('status'))<div class="alert alert-danger" role="alert">{{ session('status') }}</div>@endif

<div class="container">
<p><a href="{{ url('admin/admin-Orders-edit/get/view') }}" class="btn btn-primary mt-2">Add Order </a></p>

<p><div class="card p-2"> <span class="text-muted"> <a href="{{ url('admin/dashboard')}}" style="font-size: 0.9rem;"> <span class="bi bi-border-all"></span> Dashboard</a> / All Orders </span></div></p>


<button type="button" class="btn-sm btn-primary float-right mb-1 ml-1" data-toggle="modal" data-target="#exampleModalExcelCenter">
<i class="bi bi-download"></i> Download Excel
</button>

<button type="button" class="btn-sm btn-primary float-right mb-1 ml-1" data-toggle="modal" data-target="#exampleModalCenter">
<i class="bi bi-filter"></i> Filter
</button>
<br>
<!-- Modal Start-->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      
<div class="modal-body">
<form action="{{ url('admin-Orders')}}" method="GET">
  <div class="form-group">
        <label>Start Date</label>
        <input type="date" name="start_date" value="{{Carbon\Carbon::now()->subDays(60)->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
   

   
    <div class="form-group">
      <label>End Date</label>
       <input type="date" name="end_date" value="{{Carbon\Carbon::now()->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
  

      <div class="form-group">
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </div>

  </div>

</form>

      </div>
    </div>
  </div>
<!-- Modal END-->

<!-- Modal Start excel-->
<div class="modal fade" id="exampleModalExcelCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalExcelCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalExcelCenterLongTitle">Excel Export</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
<form action="{{ url('admin-Orders')}}" method="GET">

  <div class="form-group">
        <label>Start Date</label>
        <input type="date" name="start_date_excel" value="{{Carbon\Carbon::now()->subDays(60)->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
   

    <div class="form-group">
      <label>End Date</label>
       <input type="date" name="end_date_excel" value="{{Carbon\Carbon::now()->isoFormat('YYYY-MM-DD')}}" class="form-control" required>
      </div>
  

      <div class="form-group">
      <button type="submit" class="btn btn-primary mb-2">Submit</button>
    </div>

  </div>
</form>
      </div>
    </div>

</div>
<!-- Modal excel END-->



<div class="table-responsive-sm">
<style>
td{word-break: break-all !important;}select{width:110px;} table,td,tr{font-size: 0.9rem;}.badge{margin-top: 5px;}
</style>

<table id="orderProduct" class="table-striped table-bordered">
<thead style="background:white;">
  <tr>
     <th>Order_Id</th>
       <th>Customer Name</th>
        <th>Telephone</th>
          <th>Delivery Address</th>
            <th>City</th>
              <th>Total Price</th>
                <th>Payment Status</th>
                 <th>Delivery Status</th>
                   <th>Action</th> 
                    <th>Created</th>
                     <th>Invoice</th>
                      </tr>    
                         </thead>
  
                 <tbody>
          
                   @foreach ($Orders as $item)
                        <tr>
                             <td style='text-align:center;'>
                               <a href="{{ url('admin/admin-Orders-edit') }}/{{$item->id}}">{{$item->id}}</a></td>
                               <td id="tdID" style="width:120px">{{ $item->name }} </td>
                               <td style="text-align:left;width:140px;"><?php echo $item->Customer_phone_id ?> 
                              @if(!$item->customer_alternative_phone_id) @else <p class='text-muted'> {{$item->customer_alternative_phone_id}}@endif</p></td>
                               <td style="text-align:left;width:170px;text-align: justify;font-size:small"><?php echo $item->Delivery_Address ?></td>
                               <td style="width:90px;text-align:left;font-size:small">{{$item->city}}</td>
                               <td style="text-align:center;width:150px;">{{number_format($item->Amount,2)}} <span style="font-size: 20px;">৳</span> <p class="text-muted">{{ $item->paymentmode }}</p>  </td>
                               
            <td id="load{{$item->id}}">
       <!-- payment status starts -->
      <form action="admin-Update-Payment-Status" id="paymentUpdate{{$item->id}}" method="POST">
                     
            <input type="hidden" value="{{$item->id}}" name="Order_id" id="Order_idajax{{$item->id}}">            
                             <select name="p_status" id="p_status{{$item->id}}" style="width:80px;">
                                <option value="{{$item->p_status}}" hidden>{{$item->p_status}}</option> 
                                 <option value="pending">pending</option>
                                  <option value="completed">completed</option>
                                    <option value="Refunded">Refunded</option>
                                      </select><br>
                                    <button type="submit"><i class="bi bi-cart-check-fill" title="Save Changes"></i></button>
                                    <a onclick="window.location.reload();"><i class="bi bi-arrow-clockwise" title="Reload This Page"></i></a>
                                    </form>
                          <!-- payment status end -->
 
<script type="text/javascript">
$('#paymentUpdate{{$item->id}}').on('submit',function(e){
    e.preventDefault();
    let Order_id = $('#Order_idajax{{$item->id}}').val();
    let p_status = $('#p_status{{$item->id}}').val();
    var div;
    
    $.ajax({
      url: "admin-Update-Payment-Status",
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        Order_id:Order_id,
        p_status:p_status,
      },
      success:function(response){
        $('#load{{$item->id}}').html(div);
        //$('#notice{{$item->id}}').html("<span class='alert alert-success'>Updated</span>").delay(2000).fadeOut(100);
        alertify.success('Payment Status Updated for Order ID: {{$item->id}}'); 
      },
      error: function(response) {
        //$('#notice{{$item->id}}').html("<span class='alert alert-success'>Something Wrong</span>").delay(2000).fadeOut(100);
        alertify.error('Error, payment status not updates for Order ID: {{$item->id}}'); 
      },
      });
    });
  </script>

           </td>

 
          <td id="loadx{{$item->id}}">
              @if($item->Order_Cancel_Status==1)
              @else 
                              
              @endif

              <meta name="csrf-token" content="{{ csrf_token() }}">

                <form action="{{ url('admin-Update-Shipping-Status') }}" id="shipping{{$item->id}}" method="POST">
              
                <input type="hidden" value="{{$item->id}}" name="Order_id" id="Order_idxx{{$item->id}}">   
                 <input type="hidden" name="p_status" id="p_status{{$item->id}}"> 
                     <select name="Shipping_Status" id="Shipping_Statusxx{{$item->id}}" style="width:80px;">
                     <option value="{{$item->Shipping_Status}}" hidden>{{$item->Shipping_Status}}</option> 
                     <option value="Created">Created</option>
                     <option value="Processing">Processing</option>
                     <option value="Shipped">Shipped</option>
                     <option value="Ready for pickup">Ready for pickup</option>
                     <option value="Completed">Completed</option>
                     <option value="Canceled">Canceled</option>
                     <option value="On Hold">On Hold</option>
                     <button type="submit">Update</button>
                     </select>
                     <button type="submit"><i class="bi bi-cart-check-fill" title="Save Changes"></i></button>
                     <a onclick="window.location.reload();"><i class="bi bi-arrow-clockwise" title="Reload This Page"></i></a>
                </form>


<script type="text/javascript">
$('#shipping{{$item->id}}').on('submit',function(e){
    e.preventDefault();
   
    let Order_id = $('#Order_idxx{{$item->id}}').val();
    let Shipping_Status = $('#Shipping_Statusxx{{$item->id}}').val();
    let p_status = $('#p_status{{$item->id}}').val();
    var div;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
      url: "admin-Update-Shipping-Status",
      type:"POST",
      data:{
        Order_id:Order_id,
        p_status:p_status,
        Shipping_Status:Shipping_Status,
      },
      success:function(response){
        $('#loadx{{$item->id}}').html(div);
        //$('#noticexx{{$item->id}}').html("<span class='alert alert-success'>Updated</span>").delay(2000).fadeOut(100);
        alertify.success('Shipping Status Updated for Order ID: {{$item->id}}');
      },
      error: function(response) {
        //$('#noticexx{{$item->id}}').html("Not updated").delay(2000).fadeOut(100);
        alertify.error('ERROR! Shipping Status Not Updated for Order ID: {{$item->id}}');
      },
      });
    });
  </script>


  </td>



                  
     <td> 
      <a href="{{url('admin-Order-Status/'.$item->id.'')}}" class="badge btn btn-primary pd-2">Check Status</a>
           @if($item->Delivery_Status!='pending' || $item->Order_Cancel_Status==1)
           <a href="{{url('admin-Order-Status/'.$item->id.'')}}"  class="badge btn btn-danger pd-2 disabled">Cancel Order</a>
             @else
           <a href="{{url('admin-Order-Cancel/'.$item->id.'')}}" class="badge btn btn-danger pd-2 ">Cancel Order</a>
               @endif
                 </td>
 
 <td width="text-align:center;" style="text-align:left;width:140px;">{{Carbon\Carbon::parse($item->created_at)->format('jS M y  g:i A')}}</td>  
     <td> <a href="{{ url('admin-Orders/pdf/'.$item->id.'')}}" target="_blank"><i class="bi bi-file-pdf"></i> PDF</a> </td>
     </td>
        </tr>
             @endforeach      
                   </tbody>
    
                    </table>
                       </div></div>







<script>
$(document).ready(function() {
 var table = $('#orderProduct').DataTable({

  "ordering": false,
  "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        }
});

 new $.fn.dataTable.FixedHeader( table );

} );
</script>


<!-- datatables keep order and page selection page refresh
  $('#offersTable').dataTable({
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        }
    });
  -->





</main>
@include('dashboards.admin.admin.header-footer.footer')