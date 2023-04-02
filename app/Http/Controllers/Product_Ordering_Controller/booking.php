<?php
namespace App\Http\Controllers\Product_Ordering_Controller;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller; 
    use App\Models\Products;
    use Illuminate\Support\Facades\Cookie;
    use Session;
    use Illuminate\Support\Facades\Validator;
    use App\Models\Coupen_Code;
    use App\Models\CUSTOM_ORDERS;
    use App\Models\delivery_charges;
    use App\Models\Order;
    use Illuminate\Support\Facades\Auth;
    use Mail;
    use App\Models\User;

    use Xenon\LaravelBDSms\Provider\Ssl;
    use Xenon\LaravelBDSms\Sender;
    use LaravelBDSms, SMS;


    class booking extends Controller
    {
        public function opencheckoutpage()
        {
            return view('Product-Order-Screens.checkout');
        }
        public function Shipping_Payment_Screen()
        {
            return view('Product-Order-Screens.Shipping_Payment_Screen');
        }
        public function apply_promo_code(Request $request)
        {
                $promo_code = $request->input('promo_code');
                $Coupen_Code=Coupen_Code::find($promo_code);
                if($Coupen=Coupen_Code::where('code',$promo_code)->first())
                {
                    session(['promocode' => $Coupen->code]);
                    session(['discount' =>$Coupen->discount ]);
                    session(['message' =>'% Promo Code Applied Succesfully' ]);
                    session()->reflash();   
                    return back();
                }
                else
                {
                    //die 
                return back()->with('invalid','You Entered Invalid Promo Code');
                }
            
        }
        public function  order_proceed(Request $request)
        {
             //specify your custom message here
        $messages = [
            'required' => 'Please Check :attribute and fill up it..',
          ];
  
              $validation =$request->validate([
                      'Payment_Method'=>'required',
                      'Door_No'=>'required|max:120',
                      'LandMark'=>'nullable|max:120',
                      'city'=>'required|max:60|regex:/^[a-zA-Z\s]*$/',
                      'state'=>'nullable|max:60|regex:/^[a-zA-Z\s]*$/',
                      'pincode'=>'nullable|digits_between:4,10',
                      'mobile_no'=>'nullable|digits:11',
                      'mno'=>'nullable|digits:11',
                      'country'=>'nullable|max:30|regex:/^[a-zA-Z\s]*$/',
                      // 'MobileNumber'=>'required|numeric',
                 
                ], $messages);


                print_r($validation);
            
                //IP Address GEt    
                if (!empty($_SERVER['HTTP_CLIENT_IP']))   
                {$ip_address = $_SERVER['HTTP_CLIENT_IP'];}
                elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
                {$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];}
                else{$ip_address = $_SERVER['REMOTE_ADDR'];}    
                //////////////////////////5200///////////////////
                

                /* Delivery Details*/
                # $Session_TOTAL_AMOUNT=$request->input('Amount')==true ? '120':'60'; 
                $Session_TOTAL_AMOUNT=$request->input('Amount'); ##SESSION DELIVERY CHARGE AMOUNT
                $del_CHARGE = $request->input('del_CHARGE'); ##Delivery Charge

                $address1=$request->input('Door_No');
                $address2=$request->input('LandMark');
                $city=$request->input('city');
                $state=$request->input('state');
                $pincode=$request->input('pincode');
                $mno=$request->input('mno');
                $username=$request->input('username');
                $address1=$request->input('Door_No');
                $alternativemno=$request->input('alternativemno');
                $country=$request->input('country');      

                $Delivery_Address=$address1;
           
                /* Delivery Details*/
                $p_method=$request->input('Payment_Method');
           
                /* Order Details Starts Here*/
                if(session('cart'))
                {
                    $total=0;$count=0;$order_details='';$delivery_charges=0;                    
                    foreach (session('cart') as $id => $details) 
                    {
                        $count=$count +1 ;
                        $total += $details['Final_Price'] * $details['item_quantity'];
                        $order_details=$order_details.'<p>'.
                        ('Product Name:'.$details["item_name"].', Quantity: '.$details["item_quantity"].
                        '<br> Price:'.$details["Final_Price"]).'</p>';
                        $delivery_charges = $delivery_charges + $details['delivery_charges'] ;
                    }
                
                }
                if(session('promocode'))
                {
                    $promocode=session('promocode');
                    $Amount = $total + $delivery_charges - session('discount') * $total / 100;
                }
                else
                {
                    $promocode=null;
                    if(!$Session_TOTAL_AMOUNT){
                        return redirect()->back()->with('errorCity','Please Choose City'); 
                    }
                    $Amount = $Session_TOTAL_AMOUNT; ##DELIVERY CHARGE INPUT HERE
                }

                // Order details YAMIN READ THIS
                $O_Details=$order_details;
                $user=Auth::user()->id;
                $mobile_no=Auth::user()->mobile_no;
                //$name=Auth::user()->name;
                $email=Auth::user()->email;
                
                #$loginid=$Email_Id;
                //$name=Auth::user()->name;
                             

                /*Creating New Order Details*/
                 $Order = new Order();
                 $Order->Customer_phone_id=$request->input('mobile_no')==true ? $request->input('mobile_no'):$mobile_no;
                 $Order->customer_alternative_phone_id=$request->input('alternativemno');
                 $Order->name=$username;
                 $Order->user_id=$user; ##USER ID ADDED
                 $Order->Customer_Emailid=$email;
                 $Order->Delivery_Address=$Delivery_Address;
                 $Order->city = $city;
                 $Order->Order_Details=$O_Details;
                 $Order->Coupen_Code=$promocode;
                 $Order->Amount=$Amount; ### AMOUNT ADDED
                 $Order->paymentmode=$p_method;
                 $Order->p_status="created";
                 $Order->ip = $ip_address; 
                 $Order->save();
                 $Order->id;
                 

        ###################################################################
        if (session('cart')) {
            $total = 0;
            $count = 0;
            $order_details = '';
            $delivery_charges = 0;
            foreach (session('cart') as $id => $details) {
                $count = $count + 1;
                $total += $details['Final_Price'] * $details['item_quantity'];

                
                ### Creating New CUSTOM ORDERS according to ORDERS Table 12-4-2022 NEXT DAY
                $custom_order = new CUSTOM_ORDERS();
                $custom_order->user_id = Auth::user()->id;
                $custom_order->product_id = $details["item_name"];
                $custom_order->order_id= $Order->id;
                $custom_order->quantity = $details["item_quantity"];
                $custom_order->price = $details["Final_Price"];
                $custom_order->del_CHARGE =$del_CHARGE;
                $custom_order->note = $request->input('note');
                $custom_order->ip = $ip_address;
                $custom_order->save();  
            }
        }
      ##########################



                 $id=$Order->id;
                 if($p_method=='Online')
                 {
                    return redirect("proceed_to_Payment/$id");
                 }

                ### MY LOGIC for bKash Payment
                 elseif($p_method=='OnlinebKash'){
                    return redirect("eBKASH/$id");
                 }

                 else
                 {
    	               /* $welcomemessage='Hello '.$name.'<br>';
    	                $emailbody='Your Order Was Placed Successfully<br>
    	                <p>Thank you for your order. We’ll send a confirmation when your order ships. Your estimated delivery date is 3-5 working days. If you would like to view the status of your order or make any changes to it, please visit Your Orders on <a href="https://www.bishuddhotabd.com">bishuddhotabd.com</a></p>
    	                <h4>Order Details: </h4><p> Order No:'.$id.$O_Details.'</p>
    	                 <p><strong>Delivery Address:</strong>
    	               '.$Delivery_Address.'</p>
    	                <p> <strong>Total Amount:</strong>
    	                '.$Amount.'</p>
    	                 <p><strong>Payment Method:</strong>'.$p_method.'</p>';
    	                
                         $emailcontent=array(
    	                    'WelcomeMessage'=>$welcomemessage,
    	                    'emailBody'=>$emailbody
    	                   
    	                    );
    	                  
                          /*  Mail::send(array('html' => 'emails.order_email'), $emailcontent, function($message) use
    	                    ($loginid, $name,$id)
    	                    {
    	                        $message->to($loginid, $name)->subject
    	                        ('Your bishuddhotabd.com order '.$id.' is Confirmed');
    	                        $message->from('info@bishuddhotabd.com','Bishuddhota');
    	                        
    	                    });
                    */
                            Session::forget('cart');
                            Session::forget('discount');
                            Session::forget('promocode');
                            session()->flash('success', 'Session data  is Cleared');
                              
                
                            

                 ///////////////////////////////////////////////   
                       $sender = Sender::getInstance();
                       $sender->setProvider(Ssl::class); 
                       $sender->setMobile($mobile_no);
                       //$sender->setMobile(['017XXYYZZAA','018XXYYZZAA']);
                       $sender->setMessage(
                      'Dear Customer, We have received your order. 
Order ID: '.$id.' 
In-voice value: BDT '.$Amount.' 
For any query: 01810023444 Bishuddhota');
                      $sender->setQueue(false); //if you want to sent sms from queue
                       $sender->setConfig([
                            'api_token' => env('sms_api_token'),
                            'sid' => env('sms_sid'),
                            'csms_id' => 'sms_csms_id']);
                       $status = $sender->send();
                       
                     ///////////////////////////////////////////////

                    return redirect("/Orders")->with('status','Order Placed Succesfully! <br>Order ID: '.$id);                
                 }
                
        }
       
        
        
    }
