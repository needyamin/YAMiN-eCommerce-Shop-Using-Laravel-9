<?php
namespace App\Http\Controllers\Admin;
use Auth;


###EXCEL FILE INSTALLATION PACKAGE
use Rap2hpoutre\FastExcel\FastExcel;



use App\Models\CUSTOM_ORDERS;
use App\Models\oneclick_order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\User;
use App\Models\Products;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\MarketingTeamLog;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\NewsLetter;
use App\Models\Order;
use Illuminate\Support\Facades\DB;


class LinksController extends Controller{
    public function index(){
        
        //orderTotalAmountSum NOT WORKING MAKE COMMENTS
        #$currentMonth = date('m');
        #$ordersamount = DB::table("orders")->where('Shipping_Status','=','Completed')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->sum('Amount');
        #$ordersamount = DB::table("orders")->where('Shipping_Status','=','Completed')->whereDate('created_at', '<=', now()->subDays(30))->sum('Amount');
        
        ## Last Month Order AMOUNT
        $ordersamount= Order::where('Shipping_Status','=','Completed')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->sum('Amount');
        $lastMonthordersamount = Order::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->sum('Amount');

        ## ALL ORDER AMOUNT
        $allamount= Order::where('Shipping_Status','=','Completed')->sum('Amount');


        //order page -current month data
        $currentMonth = date('m');
        $ordersid = DB::table("orders")->where('Shipping_Status','=','Completed')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->count('id');

        $lastMonthR = DB::table("orders")->where('Shipping_Status','=','Completed')->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count('id');

        //order page -todaydata
        $todayDate = DB::table("orders")->whereDate('created_at', Carbon::today())->count('id');
        
         ## Order AMOUNT TODAY
         $ordersamountTODAY= Order::whereDate('created_at', Carbon::today())->sum('Amount');
         $userToday = DB::table("users")->whereDate('created_at', Carbon::today())->count('id');
        

        //new product -> current month
        $products_current_month = date('m');
        $products_current_month = DB::table("products")->where('status','=','1')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->count('id');
        
        $products_TODAY = DB::table("products")->where('status','=','1')->whereDate('created_at', Carbon::today())->count('id');

        $products_LastMonth = DB::table("products")->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count('id');

        //req for stock
        $currentMonth = date('m');
        $req4stock = DB::table("req4stock")->whereRaw('MONTH(created_at) = ?',[$currentMonth])->count('id');
        
        $req4stock_TODAY = DB::table("req4stock")->whereDate('created_at', Carbon::today())->count('id');

        $req4stock_LastMonth = DB::table("req4stock")->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count('id');



        //total Users
        $currentMonth = date('m');
        $user = DB::table("users")->whereRaw('MONTH(created_at) = ?',[$currentMonth])->count('id');
        $LastMOnthuserT= DB::table("users")->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count('id');
        
        //category count
        $category=DB::table("categorymodel")->count('id');

        //Current Search This month
        $currentMonth = date('m');
        $search_feed = DB::table("search_table")->whereRaw('MONTH(created_at) = ?',[$currentMonth])->count('id');

        //Newslatter This month
        $currentMonth = date('m');
        $newsletter = DB::table("newsletter")->whereRaw('MONTH(created_at) = ?',[$currentMonth])->count('sno');

        ################ Total Statistics ################
        $TPost = DB::table("products")->count('id');
        $Tamount= DB::table("orders")->where('Shipping_Status','=','Completed')->sum('Amount');
        $Tuser = DB::table("users")->count('id');


        ############## STOCK OUT AND 0 PRICE ##############
        $stockOUTProductSCount = DB::table("products")->where('quantity', '=', '0')->count('id');
        $zeRoProductSCount = DB::table("products")->where('price', '=', '0')->count('id');

         return view('dashboards.admin.admin.dashboard',[
            'ordersamount' => $ordersamount, 
            'allamount' => $allamount,
            'ordersid' => $ordersid, 
            'products_current_month' => $products_current_month,
            'req4stock' => $req4stock,
            'req4stock_TODAY' => $req4stock_TODAY,
            'req4stock_LastMonth' => $req4stock_LastMonth,
            'user'=> $user,
            'category' => $category,
            'search_feed' => $search_feed,
            'newsletter' => $newsletter,
            'todayDate' => $todayDate,
            'ordersamountTODAY' => $ordersamountTODAY,
            'userToday' =>$userToday,
            'TPost' => $TPost,
            'Tamount' => $Tamount,
            'Tuser' => $Tuser,
            'lastMonthordersamount' => $lastMonthordersamount,
            'lastMonthR' => $lastMonthR,
            'LastMOnthuserT' => $LastMOnthuserT,
            'products_TODAY' => $products_TODAY,
            'products_LastMonth' => $products_LastMonth,
            'stockOUTProductSCount' => $stockOUTProductSCount,
            'zeRoProductSCount' => $zeRoProductSCount,
        ]);
         #return view('dashboards.admin.index');
    }


    public function marketingTeam(Request $request){
        $fetchData = MarketingTeamLog::latest()->get();
        return view('dashboards.admin.admin.MarketingTeamLog',[
            'fetchData' => $fetchData,]);
    }
    public function users(){   
        //Status 0 is Hide user
        //Status 1 is active user
        // Status 2 is the user present in the recycle bin 
        //$users=User::where('status','=','1')->get();
        $users=User::get();
         return view('dashboards.admin.users')->with('users', $users);
    }

    public function show_user_role_edit_view($id){
        $userroles=User::find($id);
        return view('dashboards.admin.edituserrole')->with('userroles', $userroles);
    }

    public function recycleusers(){
        $users=User::where('status','=','2')->latest()->get();
         return view('dashboards.admin.usersrecyclebin')->with('users', $users);
    }

    ## PRODUCT ADMIN TABLE Feed fetching
    public function products(Request $request){
         $email= Auth::user()->email;
         #2-7-2023 start



       ## if click search input then display this result  
        if ($request->filled('q')) {
            $current_input = $request->input('q');
            $Products = Products::Where('name', 'LIKE', "%$current_input%")->orWhere('id', 'LIKE', "%$current_input%")->orWhere('price', 'LIKE', "%$current_input%")->get();
            return view('dashboards.admin.Products.index')->with('Products', $Products);
        }

         ## if click filter then display this with filter date range
         if ($request->has('start_date_products')) {
             $start_date = $request->input('start_date_products');
             $end_date= $request->input('end_date_products');
             $Products=Products::where('status','!=','2')->whereBetween('created_at', [$start_date, $end_date])->latest()->get();
         }

       ### IF CLICK EXPORT CSV start #######
        if ($request->has('start_date_excel')) {
        $start_date = $request->input('start_date_excel');
        $end_date= $request->input('end_date_excel');
        $Products=Products::where('status','!=','2')->whereBetween('created_at', [$start_date, $end_date])->latest()->get();
        return (new FastExcel($Products))->download($start_date.'_to_'.$end_date.'_file.csv');
        }
        ### IF CLICK EXPORT CSV end #######

        ##############################################################################
            ## if click quantity
            if ($request->has('stockoutproduct')) {
                $stockOUTProductSGET = Products::where('quantity', '=', '0')->get();
                return view('dashboards.admin.Products.index')->with('Products', $stockOUTProductSGET);
            }


          ## if click draft
             if ($request->has('draft')) {
                $stockOUTProductSGET = Products::where('status', '!=', '1')->get();
                return view('dashboards.admin.Products.index')->with('Products', $stockOUTProductSGET);
            }
            

            ## if click price  
            if ($request->has('zeropriceproduct')) {
                  $zeRoProductSGET = Products::where('price', '=', '0')->get();
                  return view('dashboards.admin.Products.index')->with('Products', $zeRoProductSGET);
            }

       ########################################################################################################
         #if filter not clicked then display this
         #$start_date = $request->input('start_date_products') ?? Carbon::now()->subDays(30);
         #$end_date= $request->input('end_date_products') ?? Carbon::now();
         #$Products=Products::where('status','!=','2')->whereBetween('created_at', [$start_date, $end_date])->latest()->get();

         $Products=Products::where('status','!=','2')->latest()->paginate(100);

        return view('dashboards.admin.Products.index')->with('Products', $Products);


    }

    public function show_add_product_screen(){
        return view('dashboards.admin.Products.add');

    }

    public function ShowEditingScreen($id){
       $Products = Products::find($id); 
       return view("dashboards.admin.Products.edit")->with('Products',$Products);
    }

    public function recycleproducts(){
        $Products=Products::where('status','=','2')->get();
         return view('dashboards.admin.Products.bin')->with('Products', $Products);
    }

    ##FETCH ALL ORDER ON ADMIN PANEL ('showorders') 
    public function showorders(Request $request){
        $email= Auth::user()->email;
        #$Orders=Order::latest()->get();

        ## if click filter then display this with filter date range
        if ($request->has('start_date')) {
            $start_date = $request->input('start_date');
            $end_date= $request->input('end_date');
            $Orders=DB::table('orders')->whereBetween('created_at', [$start_date, $end_date])->latest()->get();
        }

        ### IF CLICK EXPORT CSV start #######
       if ($request->has('start_date_excel')) {
        $start_date = $request->input('start_date_excel');
        $end_date= $request->input('end_date_excel');
        $Orders=DB::table('orders')->whereBetween('created_at', [$start_date, $end_date])->latest()->get();
        return (new FastExcel($Orders))->download($start_date.'_to_'.$end_date.'_file.csv');
        }
        ### IF CLICK EXPORT CSV end #######

        #if filter not clicked then display this
        $start_date = $request->input('start_date') ?? Carbon::now()->subDays(30);
        $end_date= $request->input('end_date') ?? Carbon::now();
        $Orders=DB::table('orders')->whereBetween('created_at', [$start_date, $end_date])->latest()->get();

        return view('dashboards.admin.orders', [
            'email' => $email,
            'Orders' => $Orders
        ]);
    }





### THis is for online click order
    public function guest_oneclick_orders(Request $request){
        $email= Auth::user()->email;
        ## if click filter then display this with filter date range
        if ($request->has('start_date')) {
            $start_date = $request->input('start_date');
            $end_date= $request->input('end_date');
            $Orders=DB::table('guest_oneclick_orders')->whereBetween('created_at', [$start_date, $end_date])->latest()->get();
        }
        #if filter not clicked then display this
        $start_date = $request->input('start_date') ?? Carbon::now()->subDays(30);
        $end_date= $request->input('end_date') ?? Carbon::now();
        $Orders=DB::table('guest_oneclick_orders')->whereBetween('created_at', [$start_date, $end_date])->latest()->get();
        
        ### IF CLICK EXPORT CSV #######
        // $kk =oneclick_order::all();
         //return (new FastExcel($kk))->download('file.xlsx');
         ### IF CLICK #######

 ### IF CLICK EXPORT CSV start #######
     if ($request->has('start_date_excel')) {
        $start_date = $request->input('start_date_excel');
        $end_date= $request->input('end_date_excel');
        $Orders=DB::table('guest_oneclick_orders')->whereBetween('created_at', [$start_date, $end_date])->latest()->get();
        return (new FastExcel($Orders))->download($start_date.'_to_'.$end_date.'_file.csv');
        }
 ### IF CLICK EXPORT CSV end #######

        return view('components.admin.guest_oneclick_orders', [
            'email' => $email,
            'Orders' => $Orders
        ]);
    }

    public function guest_oneclick_orders_delete(Request $request){
        oneclick_order::where('id','=', $request->id)->delete();
        return redirect('/admin/guest/Orders')->with('status', 'Order Has Been Deleted');
    }



    public function showTransactions(){
        return view('dashboards.admin.Transactions');
    }

    public function showReqForStock(){
        return view('dashboards.admin.req4stock');
    }

    public function admincreateUser(Request $request)
    {
       
        $request->validate([
            'mobile_no' => 'unique:users,mobile_no',
            'email' => 'unique:users,email',
        ]);

        $user = new User();
        $user->username = $request->input('name');
        $user->mobile_no = $request->input('mobile_no');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('usergroup');
        $user->status = 1;
        $user->save();
        $user->id;
        return redirect()->back()->with('status','New User Added successfully!');
        \LogActivity::addToLog('New User'.$user->id.'Created'); 
    }

    public function adminOrdersedit(Request $request, $id){
        $order=Order::findOrFail($id);
        ///// 6-12-2022
        $cart_mass = Order::where('id','=',$id)->with(['custom_orders'])->get();
        $pdf=Order::findOrFail($id);

        return view('dashboards.admin.adminOrdersedit', [
            'order' => $order, 
            'pdf' => $pdf, 
            'cart_mass' => $cart_mass, 
        ]);
    }

 public function updateAddressPrice(Request $request){
    $getID = $request->input('order_id');
    $OrderList = Order::find($getID);
    $OrderList->Delivery_Address = $request->input('address');
    $OrderList->Amount = $request->input('amount');
    $OrderList->update();
    return redirect('/admin-Orders')->with('status', 'Order Information has been updated');

 }

    ##Delete orders FULL 14-1-2023
    public function deleteorderfULL($id){
        Transaction::where('Oder_No','=', $id)->delete();
        Order::where('id','=', $id)->delete();
        CUSTOM_ORDERS::where('order_id','=', $id)->delete();
        return redirect('/admin-Orders')->with('status', 'Transation, Order and Custom Order Has Been Deleted');
    }


    #public function searchboxajax(Request $request)
    
    #{
        #$Products=Products::where('status','=','1')->get();
        #$ProductsX=Products::where('name','LIKE','%'.$searchvalue.'%')->get();
        #return response()->json($Products);

    #}

    public function searchboxajaxPOST(Request $request) {
        $search = $request->input('search');
        $ProductsX=Products::where('name','LIKE','%'.$search.'%')->where('status','=',1)->get();
        return response()->json($ProductsX);

    }
    

    #public function searchboxajax(Request $request){
        #$users = json_decode($request->json()->all());
        #return response()->json($users);
    #}

    /* PDF ADMIN PANEL */
    public function pdf(Request $request, $id){
     ## $orderss = Order::with(['custom_orders'])->get();
       $cart_mass = Order::where('id','=',$id)->with(['custom_orders'])->get();
       $pdf=Order::findOrFail($id);
        return view('dashboards.admin.pdf', [
            'pdf' => $pdf, 
            'cart_mass' => $cart_mass, 
        ]);
    }


    /* PDF FOR USERS*/
    public function pdfUSER(Request $request, $id){
        ## $orderss = Order::with(['custom_orders'])->get();
          $cart_mass = Order::where('id','=',$id)->with(['custom_orders'])->get();
          $pdf=Order::findOrFail($id);
           return view('pdf', [
               'pdf' => $pdf, 
               'cart_mass' => $cart_mass, 
           ]);
       }

     public function showNewsLetter(){
        $NewsLetter=NewsLetter::select('email','name')->distinct('name')->get();
        return view('dashboards.admin.NewsLetter')->with('NewsLetter', $NewsLetter);
    }
    
    
    // ADMIN ORDER UPDATE
    public function adminOrdersUpdate(Request $request){

        $id= $request->input('id');
        $order_id= $request->input('order_id');
        #$user_id = $request->input('user_id');

   ################# UPDATE FIELD RUN #################  
        if (!empty($request->update)) {
            $total=0;$count=0;$order_details='';  //this for user panel update
            foreach ($request->update as $key => $value) {
                $Orders = CUSTOM_ORDERS::find($id);
                $Orders->product_id = $value['product_id'];
                $Orders->quantity = $value['quantity'];
                $Orders->price = $value['price'];
                $Orders->order_id = $order_id;
                $Orders->update();
              
                //this for user panel update start  
                $count=$count +1 ;
                $total += $value['quantity'] * $value['price'];
                $order_details=$order_details.
                        ('Product Name:'.$value["product_id"].', Quantity: '.$value["quantity"].
                        '<br> Price:'.$value["price"]).'</p> <br>';

                $OrdersUpdate=Order::find($order_id);
                $OrdersUpdate->Order_Details= $order_details;
                $OrdersUpdate->Amount = $total;
                $OrdersUpdate->update();
                //this for user panel update end

            }
        }

  ########### MORE FIELD RUN ###############
        if (!empty($request->moreFields)) {
            foreach ($request->moreFields as $key => $value) {
                $Orders = new CUSTOM_ORDERS();
                $Orders->user_id = $value['user_id'];
                $Orders->product_id = $value['product_id'];
                $Orders->quantity = $value['quantity'];
                $Orders->price = $value['price'];
                $Orders->order_id = $value['order_id'];
                $Orders->save();
            }
        } else {
            #return redirect()->back();
            return redirect()->back()->with('status','Edit Order successfully!');
        
        }

    \LogActivity::addToLog('Admin New Order Added');    
    //while function route
    return redirect()->back()->with('status','New Order Added successfully!');
    }
    
    public function adminOrdersDelete($id){
    CUSTOM_ORDERS::find($id)->delete($id);
    \LogActivity::addToLog('Admin Order Delete');
    return redirect()->back()->with('delete','Record deleted successfully!');
    #return response()->json(['success' => 'Record deleted successfully!']);
    }


##add order from admin panel
public function adminAddOrdergetView(){
        $order = CUSTOM_ORDERS::all();
        $cart_mass = Order::all();
        $forloop=User::all();
        $Products=Products::where('status','=','1')->get();
        return view('dashboards.admin.addOrderAdmin',
        [
            'orderfetch' => $order,
            'cart_mass' => $cart_mass, 
            'forloop' => $forloop,
            'Products' => $Products,
    ]);
}


#######################  ADMIN PLACE ORDER FROM HERE 7-12-2022 ################################


public function UpdatePriceAdminAjax(Request $request){
   
    if ($request->has('price')) {
        $id = $request->input('id');
        $Nprice = $request->input('price');
        
        $Orders = Products::find($id);
        $product_name = $Orders->name;
        $Orders->price = $Nprice;
        $Orders->update();
        \LogActivity::addToLog('Ajax Price Updated. Product ID: "'. $id . '" Name: "'. $product_name . '"');
  
      }
    
  return redirect()->back()->with('status','Price Updated Succesfully');

}




public function adminAddOrderpost(Request $request){  
    //IP Address GEt    
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   
    {$ip_address = $_SERVER['HTTP_CLIENT_IP'];}
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
    {$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];}
    else{$ip_address = $_SERVER['REMOTE_ADDR'];}    


    // GET Match Number and get other field from TABLE
    $phone=$request->input('user_phone_no');
    $user_id_get = User::where('mobile_no', '=', $phone)->first();
    $user_id = $user_id_get['id'];
    $user_phone_no=$request->input('user_phone_no') ;
    $customer_name=$request->input('customer_name') ;
    $city=$request->input('city') ;
    $email=$request->input('email') ;
    $phone=$request->input('phone') ;
    $note=$request->input('note') ;
    $delivery_address=$request->input('delivery_address') ;
    $amount=$request->input('amount') ;
    $coupen_code=$request->input('coupen_code') ;
    $payment_mode=$request->input('payment_mode') ;
    $shipping_status=$request->input('shipping_status') ;
    $delivery_status=$request->input('delivery_status') ;
    $payment_status=$request->input('payment_status') ;
      
    
    /// INSERT ORDER BY ADMIN
      if (!empty($request->delivery_address)) {
            $MAKEORDER = new Order();
            $MAKEORDER->Customer_Emailid = $email;
            $MAKEORDER->name = $customer_name;
            $MAKEORDER->user_id = $user_id;
            $MAKEORDER->Customer_phone_id = $user_phone_no;
            $MAKEORDER->Delivery_Address =  $delivery_address;
            $MAKEORDER->city = $city;
            $MAKEORDER->Order_Details = 'Created by Admin';
            $MAKEORDER->Coupen_Code = $coupen_code;
            $MAKEORDER->Amount = $amount;
            $MAKEORDER->paymentmode = $payment_mode;
            $MAKEORDER->Shipping_Status = $shipping_status;
            $MAKEORDER->Delivery_Status = $delivery_status;
            $MAKEORDER->p_status = $payment_status;
            $MAKEORDER->ip = $ip_address; 
            $MAKEORDER->save();
            $MAKEORDER->id;
            #return redirect()->back()->with('status',' Order successfully!');
    }


  ########### MORE FIELD RUN ###############
  if (!empty($request->moreFields)) {
    foreach ($request->moreFields as $key => $value) {
        $Orders = new CUSTOM_ORDERS();
        $Orders->user_id = $user_id;
        $Orders->product_id = $value['product_id'];
        $Orders->quantity = $value['quantity'];
        $Orders->price = $value['price'];
        $Orders->order_id = $MAKEORDER->id;
        $Orders->save();
        #return redirect()->back();
        
    }
} else {
    #return redirect()->back();
    #return redirect()->back()->with('status','Edit Order successfully!');

}

      /*//return $me = uniqid();
        $Order = New Order();
        $User=New User();
        $Transation = new Transaction();*/
        \LogActivity::addToLog('Order Created From Admin Panel.');
        return redirect()->back()->with('status',' Order successfully!');
}
    
}
