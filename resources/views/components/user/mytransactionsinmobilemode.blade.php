<div  id="events" class="container slideanim" >
    <h2 align="center" class="h1-responsive font-weight-bold ">Transaction History</h2> 
    
    <div class="row d-flex justify-content-center"> 
       @php
          $email= Auth::user()->email;
          $Orders=App\Models\Transaction::where('email','=',$email)->get();
       @endphp
                        
     @foreach ($Orders as $item)
       <div class="col-md-4">
       <div class="card-body text-left ">
        <div class="card p-3">
         <strong>Order ID: {{$item->Oder_No}}</strong>
           <strong>TXID: <?php echo $item->TXNID?></strong>
           <p><strong>Amount: </strong><?php echo number_format($item->amount,2 );?> ৳<br>
             <strong>Payment Status: </strong>{{$item->status}} </p>
               </div>
                  </div>
                </div>
             @endforeach
    </div>
                
</div> 