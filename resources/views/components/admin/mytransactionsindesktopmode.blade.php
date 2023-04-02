@section('title') Search Activity @endsection
<!-- datatable core start -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css"> 
<!-- datatable core end -->


<div class="d-none d-lg-block" align="center">
<div class="container">
    <h3>All Transactions</h3>

                   <table id="transations" style="text-align:center; margin:0 auto;" class="table table-striped table-bordered" cellspacing="0">
                       <thead>
                           <th>TXID</th>
                           <th>Order_Id</th>
                           <th>Amount</th>
                           <th>Status</th>
                       </thead>
                @php
                $email= Auth::user()->email;
                $Orders=App\Models\Transaction::paginate(10);
                @endphp
        
            <tbody>
                @foreach ($Orders as $item)
                       <tr>
                           <td>{{$item->TXNID}}</td>
                           <td>{{$item->Oder_No}}</td>
                           <td>{{number_format($item->amount,2)}} <span style="font-size: 20px;">৳</span></td>
                           <td>{{$item->status}}</td>
                       </tr>
                 @endforeach
                        </tbody>

                   </table>

<script>
$(document).ready(function() {
    $('#transations').DataTable();
} 
);
</script>


        </div>
    </div>

