<?php
namespace App\Http\Controllers\Product_Ordering_Controller;

use DB;
use App\Library\SslCommerz\SslCommerzNotification;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller; 
    use App\Models\Products;
    use App\Models\User;
    use Illuminate\Support\Facades\Cookie;
    use Session;
    use Illuminate\Support\Facades\Validator;
    use App\Models\Coupen_Code;
    use App\Models\Order;
    use App\Models\Transaction;
    use Illuminate\Support\Facades\Auth;
    use Softon\Indipay\Facades\Indipay;
    use Mail;


    class payment extends Controller
    {

        ######### SSL COMMERCE START ####################
    public function proceed_to_Payment(Request $request, $id)
    {
        $Order = Order::where('id', '=', $id)->first();
        $amount = $Order->Amount;
        $name = $Order->name == true ? $Order->name : 'null';
        $email = $Order->Customer_Emailid == true ? $Order->Customer_Emailid : 'null@null.com';
        // $amount=5;
        $id = $Order->id;


        ################### Start from array payment code #####################
        $post_data = array();
        $post_data['total_amount'] = $Order->Amount; # You can't not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['mobile_no'] = $Order->Customer_phone_id;
        $post_data['Oder_No'] = $Order->id;
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $name;
        $post_data['cus_email'] = $email;
        $post_data['cus_add1'] = $Order->Shipping_Status;
        $post_data['cus_add2'] = $Order->Delivery_Status;
        $post_data['cus_city'] = $Order->city;
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $Order->Customer_phone_id;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";


        #Before  going to initiate the payment order status need to insert or update as Pending.
        $transation = new Transaction();
        $transation->TXNID = $post_data['tran_id'];
        $transation->Oder_No = $Order->id;
        $transation->mobile_no = $post_data['mobile_no'];
        $transation->currency = $post_data['currency'];
        $transation->cus_name = $post_data['cus_name'];
        $transation->cus_add1 = $post_data['cus_add1'];
        $transation->cus_add2 = $post_data['cus_add2'];
        $transation->cus_city = $post_data['cus_city'];
        $transation->email = $post_data['cus_email'];
        $transation->amount = $post_data['total_amount'];
        $transation->status = 'Pending';
        $transation->save();


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }



    }

      ################### Proceed to payment end #####################
      ###################### SSL COMMERCE END ########################


    public function proceed_to_Payment_BKASH(Request $request,$id){
        $Order=Order::where('id','=',$id)->first();
        // $amount=5;
        if(!$Order){
            abort(404);
        }

        $id=$Order->id;
        return view('bKash', ['id' => $id,]);
       
    }

    ## eBKASH LOGIN BY ME
    public function eBKASH(Request $request,$id){
        $Order=Order::where('id','=',$id)->first();
        // $amount=5;
        if(!$Order){
            abort(404);
        }

        $id=$Order->id;
        $price=$Order->Amount;
        return view('eBKASH', ['id' => $id, 'price' => $price]);
       
    }




    }