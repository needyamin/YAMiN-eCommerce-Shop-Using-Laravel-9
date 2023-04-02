<?php
namespace App\Http\Controllers\Admin;

    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller; 
    use App\Models\Products;
    use Illuminate\Support\Facades\Cookie;
    use Session;
    use Illuminate\Support\Facades\Validator;
    use App\Models\Coupen_Code;
    use App\Models\Order;
    use Illuminate\Support\Facades\Auth;
    use Mail;
    use App\Models\User;

    use Xenon\LaravelBDSms\Provider\Ssl;
    use Xenon\LaravelBDSms\Sender;
    use LaravelBDSms, SMS;


class Order_Status_Controller extends Controller{
    public function Order_Status(Request $request, $id){
        $Order_Status= Order::find($id);
        return redirect()->back()->with('Order_Status',$Order_Status)
        ->with('Order_id', $Order_Status->id)
        ->with('Shipping_Status', $Order_Status->Shipping_Status)
        ->with('Delivery_Status', $Order_Status->Delivery_Status)
        ->with('p_status', $Order_Status->p_status)
        ->with('paymentmode', $Order_Status->paymentmode)
        ->with('Order_Cancel_Status', $Order_Status->Order_Cancel_Status);
    }
    
     public function Update_Shipping_Status(Request $request){
        $id=$request->input('Order_id') ;
        $Orders=Order::find($id);
       
        ### UPDATE DATE 4-2-2023
        date_default_timezone_set("Asia/Dhaka");   //BD time (GMT+5:30)
        $Delivery_Status = date('d M, Y h:i:s');
        $Orders->Delivery_Status=$Delivery_Status;


        ## TRY WHEN DELIVERY DONE AUTO DO ANYTHING 4-2-2023

        ##########################################
        $Shipping_Status = $request->input('Shipping_Status');
        $Orders->Shipping_Status=$Shipping_Status;
        $Orders->update();
        \LogActivity::addToLog('Shipping Status Updated, Order ID: #'.$id);
      
        /* Email Alert Starts Here*/
         $email=$Orders->Customer_Emailid;
         $Order_Details=$Orders->Order_Details;
         $Delivery_Address=$Orders->Delivery_Address;
         $p_method=$Orders->paymentmode;
         $Amount=$Orders->Amount;
         $status=$Orders->p_status;
        
         $User=User::where('email','=',$email)->first();
         $loginid=$email;
         $name=$User->name;
                            
         /*$welcomemessage='Hello '.$name.'';
         $emailbody='<p>Your Order has been Shipped. Your estimated delivery date is 3-5 working days. If you would like to view the status of your order or make any changes to it, please visit Your Orders on <a href="https://www.bishuddhotabd.com.com">bishuddhotabd.com</a></p><br><h4>Order Details: </h4><p> Order No:'.$id.$Order_Details.'</p><p><strong>Delivery Address:</strong>'.$Delivery_Address.'</p><p> <strong>Total Amount:</strong>'.$Amount.'</p><p><strong>Payment Method:</strong> '.$p_method.'</p><p><strong>Payment Status:</strong> '.$status.'</p>';
        
         $emailcontent=array('WelcomeMessage'=>$welcomemessage,
        	                    'emailBody'=>$emailbody
        	                    );

         Mail::send(array('html' => 'emails.order_email'), $emailcontent, function($message) use
        	                    ($loginid, $name,$id){
        	                        $message->to($loginid, $name)->subject
        	                        (' Your bishuddhotabd.com order '.$id.' is Shipped');
        	                        $message->from('info@bishuddhotabd.com','bishuddhotabd'); 
        	                    });
                             */
       /* Email Alert Ends Here*/
       return redirect()->back()->with('status','Shipping Status Updated Succesfully');

     }
     
     public function Update_Delivery_Status(Request $request){
        $id=$request->input('Order_id') ;
        $Orders=Order::find($id);
        date_default_timezone_set("Asia/Dhaka");   //BD time (GMT+5:30)
         
        $Delivery_Status =  date('d-m-Y h:i:s');
        $Orders->Delivery_Status=$Delivery_Status;
        
        # $Auth = Auth::user();
        # $Orders->D_Status_Updated_By=$Auth->email;
        $Orders->update();
        
        /* Email Alert Starts Here*/
         $email=$Orders->Customer_Emailid;
         $Order_Details=$Orders->Order_Details;
         $Delivery_Address=$Orders->Delivery_Address;
         $p_method=$Orders->paymentmode;
         $Amount=$Orders->Amount;
         $status=$Orders->p_status;
              $User=User::where('email','=',$email)->first();
              $loginid=$email;
              $name=$User->name;
              
              /*$welcomemessage='Hello '.$name.'';$emailbody='<p>Your Order has been delivered!<br></p><h4>Your Feed Back Matters a Lot! </h4><p> Kindly Share your feed back by using the following link <br><a href="#">Google Form Link</a></p>';
        	    
              $emailcontent=array(
                'WelcomeMessage'=>$welcomemessage,
                'emailBody'=>$emailbody);

        	    Mail::send(array('html' => 'emails.order_email'), $emailcontent, function($message) use
        	      ($loginid, $name,$id){
        	          $message->to($loginid, $name)->subject('Your bishuddhotabd.com order '.$id.' is Delivered');
        	          $message->from('info@bishuddhotabd.com','bishuddhotabd');}); */

       \LogActivity::addToLog('Delivery Status Updated');              
        /* Email Alert Ends Heres*/
        return redirect()->back()->with('status','Delivery Status Updated Succesfully');

     }
      public function Update_Payment_Status(Request $request){

    if ($request->has('Order_id')) {
      $id = $request->input('Order_id');
      $Orders = Order::find($id);
      $p_status = $request->input('p_status');
      $Orders->p_status = $p_status;
      $Auth = Auth::user();

      $Orders->p_status_Updated_By = $Auth->email;
      $Orders->update();
      \LogActivity::addToLog('Payment Status Updated');

    }
      return redirect()->back()->with('status','Payment  Status Updated Succesfully');

     }
       public function Update_paymentmode_Status(Request $request){
         $id=$request->input('Order_id') ;
         $Orders=Order::find($id);
         $paymentmode = $request->input('paymentmode');
         $Orders->paymentmode=$paymentmode;
     
         # $Auth = Auth::user();
         # $Orders->D_Status_Updated_By=$Auth->email;
         $Orders->update();

         \LogActivity::addToLog('Payment  Mode  Updated'); 
       return redirect()->back()->with('status','Payment  Mode  Updated Succesfully');

     }
     public function Order_Cancel(Request $request,$id){ 
        $Orders=Order::find($id);
        date_default_timezone_set("Asia/Dhaka");   //BD time (GMT+5:30)
        $Order_Cancelled_On =  date('d-m-Y h:i:s');
        $Orders->Order_Cancel_Status=1;
        $Orders->Order_Cancelled_On=$Order_Cancelled_On;

      #  $Auth = Auth::user();
      # $Orders->D_Status_Updated_By=$Auth->email;
        $Orders->update();
      
        /* Email Alert Starts Here*/
        $email=$Orders->Customer_Emailid;
        $Order_Details=$Orders->Order_Details;
        $Delivery_Address=$Orders->Delivery_Address;
        $p_method=$Orders->paymentmode;
        $Amount=$Orders->Amount;
        $status=$Orders->p_status;
        
        $User=User::where('email','=',$email)->first();
        $loginid=$email;
        $name=$User->name;
                            
        /*$welcomemessage='Hello '.$name.'';$emailbody='<p>Your Order Was Cancelled Successfully on '.$Order_Cancelled_On.'<br>As per Your Request, we have cancelled your Order. If you paid any payment with us, it will be refunded within 2-3 Working Days...</p><h4>Order Details: </h4><p> Order No:'.$id.$Order_Details.'</p><p><strong>Delivery Address:</strong>'.$Delivery_Address.'</p><p> <strong>Total Amount:</strong>'.$Amount.'</p><p><strong>Payment Method:</strong>'.$p_method.'</p><p><strong>Payment Status:</strong>'.$status.'</p>';
        $emailcontent=array(
        	          'WelcomeMessage'=>$welcomemessage,
        	           'emailBody'=>$emailbody);

        Mail::send(array('html' => 'emails.order_email'), $emailcontent, function($message) use($loginid, $name,$id){
        $message->to($loginid, $name)->subject('Your bishuddhotabd.com order '.$id.' is Cancelled');
        $message->from('info@bishuddhotabd.com','bishuddhotabd');});*/
           
        \LogActivity::addToLog('Order Cancelled by Admin'); 
        /* Email Alert Ends Here*/
        return redirect()->back()->with('status','Order Cancelled Succesfully');

     }

      public function Order_Re_Cancel(Request $request,$id)
     { 
        $Orders=Order::find($id);
        date_default_timezone_set("Asia/Dhaka");   //BD time (GMT+5:30)
        $Order_Cancelled_On =  date('d-m-Y h:i:s');
        $Orders->Order_Cancel_Status=0;
        $Orders->Order_Cancelled_On=NULL;
      
       #  $Auth = Auth::user();
       # $Orders->D_Status_Updated_By=$Auth->email;
        $Orders->update();

        \LogActivity::addToLog('Order Re Cancelled by Admin'); 
        return redirect()->back()->with('status','Order Re Cancelled Succesfully');
     }
     
}