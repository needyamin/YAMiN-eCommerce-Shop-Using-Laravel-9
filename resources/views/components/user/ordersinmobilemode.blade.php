<div  id="events" class="container slideanim" >
    <h2 align="center" class="h1-responsive font-weight-bold " style="color:#330033;margin-top:-30px;">My Previous Orders</h2> 
    <div class="row d-flex justify-content-center" style=""> 
    @php
    $email= Auth::user()->email;
    $Orders=App\Models\Order::where('Customer_Emailid','=',$email)->paginate(5);
    @endphp

    @foreach ($Orders as $item)
    <div class="col-md-4 p-4">
     <div class="card-body p-3">
        <div class="card p-4">
     <strong style="font-size: 20px;">Order ID: {{$item->id}}</strong>
    <h6 class="mt-2" align="left">
    <strong>Order Details: </strong><?php echo $item->Order_Details?>  
</h6>
            
       
        <p align="left"><strong>Amount: </strong> {{number_format($item->Amount,2)}} ৳<br>
        <strong>Delivery Address: </strong> <br><?php echo $item->Delivery_Address ?></p>
        <a href="{{url('Order-Status/'.$item->id.'')}}" class="btn px-2 py-2" style="background:#017661; color:white;">Check Status</a>
     
              @if($item->p_status =='pending')
                <a href="/eBKASH/{{$item->id}}" class="btn px-2 py-2" style="background:#f42862; color:white;">Pay Now</a>
                @else
                <span  class="btn px-2 py-2">{{$item->p_status}}</span>
                @endif



    </div>
   </div>
    </div>
    @endforeach
    </div>
    
  
</div>

<style>[aria-current] .page-link {background-color: #017661 !important; }</style>
<div class="me d-flex justify-content-center mt-2">
    <p>{{ $Orders->fragment('Orders')->links("pagination::bootstrap-4")}}</p>
    </div>