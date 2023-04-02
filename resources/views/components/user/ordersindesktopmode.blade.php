<!-- datatable core start -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css"> 
<!-- datatable core end -->



<div class="container mt-5"> 

<div align="center">
    <h4>My Orders</h4>
        <p class="col-md-2" style="border-bottom: 2px solid #003399;"></p>
    </div>


   <div class="row">
       <div class="col-12">
               <div class="card">
                   <div class="card-body table-responsive">
                       <table id="orderUSER" class="table table-striped table-bordered" style='text-align:center;'>
                           <thead>
                               <th>Order_Id</th>
                               <th style="text-align:center;"><i class="fa-solid fa-cart-shopping"></i> Order Details</th>
                               <th><i class="fa-sharp fa-solid fa-address-card"></i> Delivery Address</th>
                               <th>Amount ৳</th>
                               <th><i class="fas fa-shipping-fast "></i> Shipping</th>
                               <th><i class="fas fa-truck "></i> Delivery</th>
                               <th><i class="fas fa-money-check "></i> Payment</th>
                               <th> Method</th>

                           </thead>

        
    <tbody>
                         @foreach ($Orders as $item)
          <tr>
                <td><a href="{{url('Order-Status/'.$item->id.'')}}">#{{$item->id}}</a></td>
                
    <!-- display orders with limited text start -->
    <td style="width: 20%;text-align:center;">
  <a href="check/pdf/{{$item->id}}" class="badge badge-success" target="_blank">Order Details Invoice</a>
    </td>
               
             <!-- display orders with limited text end -->
            <td style='text-align:left; width:20%;'><?php echo $item->Delivery_Address ?></td>
            <td>{{number_format($item->Amount,2)}} ৳</td>
            <td>{{$item->Shipping_Status}}</td>
            <td>{{$item->Delivery_Status}} 

    

            </td>

            <td>
                @if($item->p_status =='pending' or $item->p_status =='created')
                @if($item->Shipping_Status=='Canceled') Canceled
                @else
                <a href="/eBKASH/{{$item->id}}" class="badge badge-danger">Pay Now</a>
                @endif
                @else
                {{$item->p_status}}
                @endif
            </td>

           <td>{{$item->paymentmode}}</td>

              </tr>
                @endforeach
   
                </tbody>
   
                      </table>





<script>
$(document).ready(function() {
    $('#orderUSER').DataTable( {
        /*pageLength : 9, */
        /****** show entries off ********/
        "ordering": false,
        "info":     false,
        
        /****** location reload ********/
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
            localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
            return JSON.parse(localStorage.getItem('offersDataTables'));
        }


    });



} 

);
</script>



                   </div>
               </div>
       </div>
   </div>
</div>
<br> 
   
   
