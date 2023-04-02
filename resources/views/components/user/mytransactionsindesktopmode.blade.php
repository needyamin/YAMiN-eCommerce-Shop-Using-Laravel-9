<!-- datatable core start -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css"> 
<!-- datatable core end -->


<div class="container">
    <h3>My Transactions</h3>
<div class="row">
   <div class="col-md-12">
           <div>
               <div class="card-body">
                   <table id="transations" style="text-align: center;" class="table table-striped table-bordered">
                       <thead>
                        <th style="text-align: center;" >TXID</th>
                           <th style="text-align: center;" >Order_Id</th>
                             <th style="text-align: center;" >Amount</th>
                              <th style="text-align: center;" >Status</th>

                       </thead>
                       @php
                       $email= Auth::user()->email;
                       $Orders=App\Models\Transaction::where('email','=',$email)->get();
                     @endphp
                       <tbody>
                           @foreach ($Orders as $item)
                       <tr>
                           <td>{{$item->TXNID}}</td>
                           <td>{{$item->Oder_No}}</td>
                           <td>{{number_format($item->amount,2)}} ৳</td>
                           <td>{{$item->status}}</td>
                       </tr>
                           @endforeach

                       </tbody>

                   </table>


<script>
$(document).ready(function() {
    $('#transations').DataTable( {
        /*pageLength : 9, */
        /****** show entries off ********/
        "ordering": false,
        "info":     false
        /****** show entries off ********/
    });
} 

);
</script>



               </div>
           </div>
   </div>
</div>
</div><br>