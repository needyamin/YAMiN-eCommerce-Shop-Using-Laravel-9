<?php
namespace App\Http\Controllers\Product_Ordering_Controller;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller; 
    use App\Models\Products;
    use Illuminate\Support\Facades\Cookie;
    use Session;
    use Illuminate\Support\Facades\Validator;

    class add2cart_needyamin extends Controller
    {
        public function index(){
            return view('welcome');
        }
        
        public function add_2_cart_needyamin(Request $request){
              /* Server Side Validation Starts  Here */
              $Validator=Validator::make
              (
                  $request->all(),
                  [
                      'quantity' => ['required', 'integer', 'min:1'],
                  ]
              );

          /* Server Side Validation  completed Here*/
            if($Validator->fails())
            {
                $Response=$Validator->messages();
              //  return response()->json(['alert'=>$Response]);
               return response()->json($Response,200);

            }
            else
            {
                
                $prod_id = $request->input('product_id');
                $quantityx = $request->input('quantity');
                $id=$prod_id;
                 
                ################# PRODUCT QUANTITY IF LIMIT CROSS Start #################
                 $qcheck = Products::find($prod_id);
                 $q_checkN = $qcheck->quantity;
                 if($q_checkN < $quantityx){
                    return response()->json(['status'=>'We have '.$q_checkN.' items in our stock']);
                 }
                 ################# PRODUCT QUANTITY IF LIMIT CROSS END #################
                 
                $prod_id = $request->input('product_id');
                $quantity = $request->input('quantity');
                $id=$prod_id;

                $products = Products::find($prod_id);
                $prod_name = $products->name;
                $prod_url = $products->url;
                $prod_image = $products->image1;
                $delivery_charges=$products->delivery_charges;
                $priceval = $products->price;
                    $discount=$products->discount;
                
                    /* Fixing Price for a Product */
                    $offerprice=$priceval * ($discount)/100;
                    $Final_Price=$priceval- ( $offerprice );
                    $contentforofferprice=$discount." % Discount is Applied ";
              
                    /* Fixing Price for a Product */
                if(!$products) {
                    abort(404);
                }
                else
                {
                    $cart = session()->get('cart');
                    // if cart is empty then this the first product
                    if(!$cart)
                    {
                            $cart = [
                                $id => [
                                    'item_id' => $prod_id,
                                    'item_name' => $prod_name,
                                    'item_url' => $prod_url,
                                    'item_quantity' => $quantity,
                                    'max_quantity' => $q_checkN,
                                    'item_image' => $prod_image,
                                    'item_price' => $priceval,
                                    'offer_price' => $offerprice, 
                                    'delivery_charges'=>$delivery_charges,
                                    'Final_Price'=>$Final_Price,
                                    'contentforofferprice'=>$contentforofferprice,
                                ]
                        ];   
                        session()->put('cart', $cart);
                        return response()->json(['status'=>'Added to Cart']);
                        #return response()->json(['success'=>'Successfully']);
                
                    }

                    // if cart not empty then check if this product exist then increment quantity
                    else if(isset($cart[$id])){
                        $cart[$id]['item_quantity']++; ### Hide
                        session()->put('cart', $cart); ### Hide
                        return response()->json(['status'=>'Product Quantity is Increased']);
                        #return response()->json(['success'=>'Successfully']);
                    }
                    else
                    {
                         // if item not exist in cart then add to cart with quantity = 1
                                $cart[$id] = [
                                    'item_id' => $prod_id,
                                    'item_name' => $prod_name,
                                    'item_url' => $prod_url,
                                    'item_quantity' => $quantity,
                                    'max_quantity' => $q_checkN,
                                    'item_image' => $prod_image,
                                    'item_price' => $priceval,
                                    'offer_price' => $offerprice,
                                    'delivery_charges'=>$delivery_charges,
                                    'Final_Price'=>$Final_Price,
                                    'contentforofferprice'=>$contentforofferprice,
                             
                                ];
                                session()->put('cart', $cart);
                                return response()->json(['status'=>'Added to Cart']);
                    }
                } 
            }
                       
        }
        public function alter_quantity(Request $request){
            /* Server Side Validation Starts  Here */
              $Validator=Validator::make
              (
                  $request->all(),
                  [
                      'quantity' => ['required', 'integer', 'min:1'],
                  ]
              );

          /* Server Side Validation  completed Here*/

        if($Validator->fails()){
                $Response=$Validator->messages();
                return response()->json($Response,200);
            }
            else
            {
                $prod_id = $request->input('product_id');
                $quantity = $request->input('quantity');
                $id=$prod_id;
                $cart = session()->get('cart');
                if(isset($cart[$id])){
                    if($quantity< $cart[$id]['item_quantity']){
                        $cart[$id]['item_quantity']--;
                        session()->put('cart', $cart);
                        return response()->json(['status'=>'Quantity is Drecreased']);
                    }
                    else
                    {
                        $cart[$id]['item_quantity']++;
                        session()->put('cart', $cart);
                        return response()->json(['status'=>'Quantity is Increased']);
                    }
                   
                   
                }
            }

        }
        
        public function remove(Request $request){
            if($request->id) {
                $cart = session()->get('cart');
               if(isset($cart[$request->id])) {
                    unset($cart[$request->id]);
                    session()->put('cart', $cart);
                }
                    
                session()->flash('success', 'Product removed successfully');
                return back()->with('status','Quantity is Increased');
    
            }
        }

        public function clear(Request $request){
                Session::forget('cart');
                session()->flash('success', 'Cart is Cleared');     
                return back()->with('cartclear','Cart is Cleared');
        }
  
    }


 