
<!--<div class="d-lg-none">-->
<div class="d-lg-none">
<div class="container"> 
    <h3>Payments</h3>

    @php
    $email= Auth::user()->email;
    $Orders=App\Models\Transaction::paginate(20);
    @endphp
                        
     @foreach ($Orders as $item)
    <br>
    <div class="card">
    <div class="py-3">
         <ul style="list-style:none;width:100%;">
            <li> <strong>Order Id: </strong>  {{$item->Oder_No}}</li>
                 <li><strong>TXID: </strong><?php echo $item->TXNID?></li>
                                        
                <li><strong>Amount: </strong><?php echo number_format($item->amount,2);?> <span style="font-size: 20px;">৳</span></li>
                                    
                <li><strong>Payment Status: </strong>{{$item->Status}}</li>
         </ul>
                                    
       @endforeach
   
    </div></div></div></div>
    <br>  {{ $Orders->links()}}