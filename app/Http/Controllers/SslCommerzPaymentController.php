<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{


    public function payViaAjax(Request $request)
    {

        #Before  going to initiate the payment order status need to update as Pending.
          DB::table('transactions')->updateOrInsert([
            'TXNID' => $post_data['tran_id'],
            'email' => $post_data['cus_email'],
            'Oder_No'=> $Order->id,
            'amount' => $post_data['total_amount'],
            'status' => 'Pending'
        ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }


    

    public function success(Request $request)
    {
        $successMANN = "Transaction is Successful";
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $mobile_no = $request->input('mno');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('transactions')
            ->where('TXNID', $tran_id)
            ->select('TXNID', 'status', 'amount','Oder_No')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency, $mobile_no );
            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                  $update_product = DB::table('transactions')
                    ->where('TXNID', $tran_id)
                    ->update(['status' => 'Processing']);



       #######################################################################################
      // Start work from here      26-12-2022        
                    // UPDATE ORDER ID
                    $update_product2 = DB::table('orders')
                    ->where('id', $order_detials->Oder_No)
                    ->update([
                        'p_status' => 'Completed',
                        'p_status_Updated_By' => 'Automation',
                ]);   

                echo "<br >Transaction is successfully Completed iiiiiiiiiii";
                return redirect("/Orders")->with('status','You Paid Succesfully'); 

            }
        } 
        else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            return "Transaction is successfully Completed oooooooooooo";

             
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            return "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('transactions')
            ->where('TXNID', $tran_id)
            ->select('TXNID', 'status', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('transactions')
                ->where('TXNID', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('transactions')
            ->where('TXNID', $tran_id)
            ->select('TXNID', 'status','amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('transactions')
                ->where('TXNID', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('transactions')
                ->where('TXNID', $tran_id)
                ->select('TXNID', 'status', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('transactions')
                        ->where('TXNID', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
