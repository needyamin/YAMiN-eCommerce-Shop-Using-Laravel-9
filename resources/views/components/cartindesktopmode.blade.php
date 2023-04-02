
@if (session('status'))
      <script>
          $(document).ready(function () {
           alertify.set('notifier','position','top-right');
           alertify.alert("Status","Item Removed Succesfully");
          });
     </script>
     
@endif  

@if (session('cartclear'))
      <script>
          $(document).ready(function () {
           alertify.set('notifier','position','top-right');
           alertify.alert("Status","All Items are Removed from the Cart!");
          });
     </script>
     

@endif  


<style>#headerProductsx,#Categoriesx,#SubCategoriesx{display: none;}</style>

<div class="px-5" style="margin-top:-8px;">
    <div class="card p-3 shopping-cart">
        <?php $total = 0 ?>
        @if(session('cart'))
        
            <div class="shopping-cart-table">
                <div class="table-responsive">
                <h5 class="card-title">Your cart items</h5>
                    <div class="col-md-12 text-right mb-3" style="margin-top:15px;">
     <a href="clear-cart" class="font-weight-bold">Clear Cart</a>
                    </div>
 <table class="table my-auto  text-center">
     <thead  class="table-bordered" style="background: white;border-style:solid;">
    
     <tr>
     <th class="cart-image">Image</th>
     <th class="cart-product-name" width="50%">Product Name</th>
     <th class="cart-qty">Quantity</th>
     <th class="cart-total">Price</th>
     <th class="cart-romove">Remove</th>
     </tr>
     </thead>
     
     <tbody class="my-auto">
         @foreach(session('cart') as $id => $details)
         <?php $total += $details['Final_Price'] * $details['item_quantity'] ?>
        
             <tr class="cartpage">
                 
             <td class="cart-image">
                 <a href="{{ url('Shop', $details['item_url'] ) }}">
                 <img src="{{asset('Uploads/Products/'.$details['item_image'].'') }}" width="60px" height="50px" onerror="this.src='{{asset('Img/no_image.jpg')}}';this.onerror='';">
                 </a>
                </td>

                 <td class="cart-product-name-info">
                     <div class='cart-product-description' style="text-align:left;font-size:19px;margin-top:10px;font-weight:bold;">
                     <a href="{{ url('Shop', $details['item_url'] ) }}">{{ $details['item_name'] }}</a>
                     </div>
                     
                 </td>



   <td class="cart-product-quantity">
    <input type="hidden" class="product_id" value="{{ $details['item_id'] }}">
       
    <div >

    <button class="modify_quantity" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="fas fa-minus"></i></button>

 <input type="number" class="quantity" id="packpack{{ $details['item_id'] }}" min="0" max="{{$details['max_quantity'] }}" name="quantity" value="{{ $details['item_quantity'] }}" style="width:50px;margin:0px;" disabled>

<script> 
var post = document.getElementById("packpack{{ $details['item_id'] }}").value;
if (post == 0){document.getElementById("packpack{{ $details['item_id'] }}").value="1";}
if(post == '0'){document.getElementById("packpack{{ $details['item_id'] }}").value="1";}
</script>

<button class="modify_quantity" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="fas fa-plus"></i></button>
</div>

</td>
            


<td class="cart-product-grand-total" width="20%" >
<strong><span class="cart-grand-total-price">

@if ($details['item_price']  * $details['item_quantity'] == $details['Final_Price'] * $details['item_quantity'])
    @else
    <strike class="red-text" style="font-size:20px;">{{ number_format($details['item_price']  * $details['item_quantity'],2)}} TK</strike>  
    @endif

<span class="text" style="font-size:25px;color:#017661;"> {{ number_format($details['Final_Price'] * $details['item_quantity'],2)}} TK</span><br>      
<span>@if ($details['contentforofferprice'] < 0) @else {{$details['contentforofferprice']}} @endif</span>
</strong>         
</td>
       

<td style="font-size: 20px;color:black;">
<form action="delete-from-cart" method="post">
@csrf                    
<input type="hidden"  name="id" value="{{ $id }}">
<button type="submit" class="badge badge-pill btn-danger px-2 py-2" data-id="{{ $id }}" >
    <i class="fas fa-trash" ></i> 
</button>    

     </form>
        </td>
          </tr>
@endforeach
     
</tbody>
         </table></div></div>
    
      
            <div class="row">
                <div class="col-md-8 col-sm-12 estimate-ship-tax">
                    <div>
                    <a href="/" class="btn mx-5" id="continue_shopping_btn">Continue Shopping</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 ">
                    <div class="cart-shopping-total">
                    <hr>
    
    <div class="row">
         <div class="col-md-6">
            <h5 class="cart-grand-name">Total Cost:</h5>
         </div>

        <div class="col-md-6">
             <h5 class="cart-grand-price">
             BDT.
               <span class="cart-grand-price-viewajax">{{number_format($total,2)}} TK</span>
             </h5>
         </div>
     </div>
 <hr>
                    
 
    <div class="row">
       <div class="col-md-12">
           <div class="cart-checkout-btn text-center">
               @if (Auth::user())
                    <a href="{{ url('checkout') }}" class="btn" id="procced_to_checkout">PROCCED TO CHECKOUT</a>
               @else
             <a href="{{ url('login') }}"class="btn" id="procced_to_checkout">PROCCED TO CHECKOUT</a>
             {{-- you add a pop modal for making a login --}}
               @endif
     </div>
 </div>
                    </div>
                </div>
            </div>
                @else
            <div class="row">
                <div class="col-md-12 mycard py-5 text-center">
                    <div class="mycards">
                        <h4>Your cart is currently empty.</h4>
 <a href="{{url('/')}}" class="btn left-xs mt-5" id="currently_empty_cart">Continue Shopping</a>
                    </div>
                </div>
            </div>
        @endif

        


    </div>

</div>