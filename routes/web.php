<?php

#php artisan serve --host 192.168.89.83 --port 8080

#php artisan migrate:refresh --path=/database/migrations/subcategory_newtable_for_description_and_keywords.php

## Home Routes
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\AuthVerifyOtpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchFeedController;
use App\Http\Controllers\Product_Ordering_Controller;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\BLOCK_IPs;
use App\Http\Controllers\SitemapXmlController;
use App\Http\Controllers\OneClickController;

#use App\Http\Controllers\Order_Status_Controller;
use App\Http\Controllers\Admin\LinksController;
use App\Http\Controllers\Admin\Order_Status_Controller;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserControllerADM;

##Product Order routes
use App\Http\Controllers\Product_Ordering_Controller\booking;
use App\Http\Controllers\Product_Ordering_Controller\CartController;
use App\Http\Controllers\Product_Ordering_Controller\FrontEndController;
use App\Http\Controllers\Product_Ordering_Controller\payment;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\req4stockController;

use App\Http\Controllers\FaceBookController;

#Install ADMIN
Route::GET('install/admin', [OneClickController::class, 'installADMIN'])->middleware('throttle:2,1');


#
#use App\Http\Controllers\Product_Ordering_Controller;
#use App\Http\Controllers\Product_Ordering_Controller;

use App\Http\Controllers\smswirless;
use App\Http\Controllers\Product_Ordering_Controller\add2cart_needyamin;


###### IP BLOCK ROUTER
Route::get('admin/block_ip/', [BLOCK_IPs::class, 'index']);
Route::get('admin/block_ip/add', [BLOCK_IPs::class, 'add']);
Route::post('admin/block_ip/add', [BLOCK_IPs::class, 'add']);
Route::post('admin/block_ip/update', [BLOCK_IPs::class, 'update']);
Route::get('admin/block_ip/delete/{id}', [BLOCK_IPs::class, 'delete']);



## this data will be deleted from here
#Route::get('/testyamin',[ProductController::class,'OLDERdataDELETE']); # 25-1-2023
##search
Route::POST('searchresult',[LinksController::class,'searchboxajaxPOST'])->name('searchboxajaxPOST');

## ONE CLICK ORDER
Route::post('oneclickOrder',[OneClickController::class, 'guest_order_proceed']); //homepage

### ADD ORDER ###
Route::get('/sitemap.xml', [SitemapXmlController::class, 'index']);


###################################################
Route::get('/needyamin_cart', function () {
    return view('Product-Order-Screens.needyamin_cart');
});
###################################################


############################
Route::post('add_2_cart_needyamin',[add2cart_needyamin::class, 'add_2_cart_needyamin']); 
Route::post('request4stock',[req4stockController::class, 'request4stock']); //homepage

Route::get('admin/request4stock',[req4stockController::class,'showRequest4stock'])->name('showRequest4stock')->middleware('auth'); 

Route::get('admin/deletereqforstock/{id}',[req4stockController::class,'deletereqforstockhm'])->middleware('auth'); 

############ LogActivity Created 3-12-2022 ############
use App\Http\Controllers\logActivity;
Route::get('admin/add-to-log', [logActivity::class, 'myTestAddToLog']);
Route::get('admin/logActivity', [logActivity::class,'logActivity']);


## SSL Wirless CHECK PAGE
Route::get('/needyamin',[smswirless::class,'needyamin']);


Route::get('/test', function () {
    return view('category_products');
});

Route::get('/', function () {
    return view('welcome');
});



## SEARCH
#Route::get('/search_feed', function () {return view('search_feed');});

##########################    
Route::get('search_feed',[SearchFeedController::class,'search_feed']);
############################

### UPDATE PRICE ADMIN PANEL AJAX
Route::post('updateprice',[LinksController::class,'UpdatePriceAdminAjax']);


Route::post('subscribe-news-letter',[UserController::class,'subscribe']);
 
Route::post('send-email',[UserController::class,'send_email']);

Route::get('/about', function () {
    return view('about');
});

## Help Page Disabled
#Route::get('/Help', function () {
    #return view('Help');
#});


Route::get('/Frequently-Asked-Questions', function () {
    return view('FAQS');
});
Route::get('/Shipping-and-Returns', function () {
    return view('S_AND_R');
});

Route::get('/Terms-and-Conditions', function () {
    return view('TermsandConditions');
});


Route::get('/privacy-policy', function () {
    return view('privacy_policy');
});

Route::get('/about-us', function () {
    return view('about-us');
});

Route::get('/Contact', function () {
    return view('Contact');
});

### User  Routes Starts Heres
Route::get('/user/dashboard', [UserController::class, 'index'])->middleware('auth');

Route::get('/Shop/{purl}', [FrontEndController::class,'index'])->name('producthomename')->middleware('BLOCK_IP','BLOCK_GEO');
Route::get('/shop/{purl}', [FrontEndController::class,'index'])->name('producthomename')->middleware('BLOCK_IP','BLOCK_GEO');
Route::POST('/shop/frontEnd/updatePrice', [FrontEndController::class,'updatePrice'])->middleware('auth');


##Route::get('/Shop/sub/{purl}', [FrontEndController::class,'product_subcategory']);
##Route::get('/added-cart-product/{id}', [FrontEndController::class,'producthomenamecart'])->name('added-cart-product'); 


## ADMIN THEME SETTINGS 27-12-2022
Route::get('admin/themesettings',[FrontEndController::class,'themesettings'])->middleware('auth');
Route::post('admin/themesettings/post',[FrontEndController::class,'themesettingspost'])->middleware('auth');

## ADMIN SEARCH FEED 7-12-2022
Route::get('admin/search_feed',[SearchFeedController::class,'search_feed_admin'])->middleware('auth');
Route::get('admin/search_feed/{id}',[SearchFeedController::class,'deletesearchfeed'])->middleware('auth'); 


### delivery charges
Route::get('admin/delivery_charges/', [FrontEndController::class,'delivery_charges_feed'])->name('delivery_charges_feed')->middleware('auth');
Route::get('admin/delivery_charges/add', [FrontEndController::class,'delivery_charges_add'])->middleware('auth');
Route::get('admin/delivery_charges/{id}', [FrontEndController::class,'delivery_charges_edit'])->middleware('auth');
Route::post('admin/delivery_charges/submit', [FrontEndController::class,'delivery_charges_submit'])->middleware('auth');
Route::post('admin/delivery_charges/edit_submit', [FrontEndController::class,'delivery_charges_edit_submit'])->middleware('auth'); 
Route::get('admin/delivery_charges/del/{id}', [FrontEndController::class,'delivery_charges_delete'])->middleware('auth'); 

Route::get('/user/dashboard', [UserController::class, 'index'])->middleware('auth');
Route::get('/dashboard', [UserController::class, 'index'])->middleware('NoPhone','Phoneverified','auth','BLOCK_IP','BLOCK_GEO');
Route::get('/profile', [UserController::class, 'open_profile'])->middleware('Phoneverified','auth');
Route::post('/my-profile-update', [UserController::class, 'update'])->middleware('auth');
Route::post('/update-password', [UserController::class, 'updatepassword'])->middleware('auth');   
Route::get('/Orders', [UserController::class, 'open_orders'])->middleware('auth');
Route::get('/Payments', [UserController::class, 'open_transactions'])->middleware('auth');
Route::get('/Order-Status/{id}', [Order_Status_Controller::class,'Order_Status'])->middleware('auth');
///////////
Route::get('/Order-Status/{id}', [Order_Status_Controller::class,'Order_Status'])->middleware('auth');
Route::get('/Order-Cancel/{id}', [Order_Status_Controller::class,'Order_Cancel'])->middleware('auth');
    
## OTP ROUTE for Verify OTP..
Route::controller(AuthVerifyOtpController::class)->group(function(){
    Route::get('/otp/verify', 'login')->name('otp.login')->middleware('auth');
    Route::get('/updatePhoneNumber', 'updatePhoneNumber')->name('otp.updatePhoneNumber')->middleware('auth');
    Route::POST('/updatePhoneNumberPOST', 'updatePhoneNumberPOST')->name('otp.updatePhoneNumberPOST')->middleware('auth');
});

## OTP ROUTE for ALL
Route::controller(AuthOtpController::class)->group(function(){
    Route::get('/otp/login', 'login')->name('otp.login');
    Route::post('/otp/generate', 'generate')->name('otp.generate');
    Route::get('/otp/generate', 'generate')->name('otp.generate'); 
    Route::get('/otp/verification/{user_id}', 'verification')->name('otp.verification');
    Route::post('/otp/login', 'loginWithOtp')->name('otp.getlogin');
});

#User Routes Ends Here 
### Admin MiddleWare  Routes Starts Here
Route::get('category/{name}',[CategoryController::class, 'categoryfetch']); 
Route::get('category/sub/{name}',[CategoryController::class, 'subcategoryfetch']); 

## USER PDF
Route::get('check/pdf/{id}',[LinksController::class, 'pdfUSER']); #homepage

#Marketing Team
Route::get('marketingTeam/dashboard', [LinksController::class, 'marketingTeam'])->middleware('auth');

### MASS GROOUP MIDDLEWARE isADMIN ###
Route::group(['middleware'=>['auth','isAdmin']],function ()
{

    Route::get('admin/dashboard', [LinksController::class, 'index'])->name('admindashboard');
    ##Categories
    Route::get('admin-Category',[CategoryController::class,'showCategory'])->name('ShowCategory'); #admin-CategoryTABLE
    Route::get('admin-AddCategory',[CategoryController::class,'AddCategory']); #viewCategory
    Route::post('/admin/updateCategory/',[CategoryController::class,'updateCategory']); #AddCategory
    Route::get('/admin/deletecategory/{id}',[CategoryController::class,'deletecategory']); #delete Category

    Route::delete('/admin/arraydelete/searches',[SearchFeedController::class,'arraydeletesearches']); #Array delete Searchs
    Route::delete('/admin/arraydelete/logActivityX',[SearchFeedController::class,'arraydeletelogActivity']); #Array delete logs
    Route::delete('/admin/arraydelete/MarketingArrayDel',[SearchFeedController::class,'MarketingArrayDel']); #Array delete logs

    Route::get('admin/category-edit/{id}',[CategoryController::class,'show_category_edit_view'])->name('admin_Category_edit');
    Route::post('admin/category-update/',[CategoryController::class,'editupdatecategory']);
    ######
  
    ##Sub_Categories
     Route::get('admin-SubCategory',[CategoryController::class,'showSubCategory'])->name('showSubCategory'); #V
     Route::get('admin-AddSubCategory',[CategoryController::class,'AddSubCategory']); #C
     Route::post('/admin/updateSubCategory/',[CategoryController::class,'updateSubCategory']); #M
    # Route::get('admin/SubCategory-edit/{id}',[CategoryController::class,'show_SubCategory_edit_view']); #M
    ######

    Route::get('admin/admin-all-users', [LinksController::class,'users']);
    Route::post('admin/admin-all-users/createUser', [LinksController::class,'admincreateUser'])->middleware('auth');
    Route::get('admin/role-edit/{id}',[LinksController::class,'show_user_role_edit_view']);
    Route::post('admin/role-update/{id}',[UserControllerADM::class,'updaterole']);
    Route::get('admin/delete-user/{id}',[UserControllerADM::class,'deleteuser']);
    Route::get('/admin-bin-users', [LinksController::class,'recycleusers']);
    Route::get('admin/restore-user/{id}',[UserControllerADM::class,'restore']);
    Route::get('admin/confirm-delete-user/{id}',[UserControllerADM::class,'confirmdelete']);
    Route::get('admin/products', [LinksController::class,'products'])->middleware('auth');
    Route::get('admin/add-product', [LinksController::class,'show_add_product_screen'])->middleware('auth');      
    Route::post('/admin-store-product',[ProductController::class,'Store']);
    Route::get('admin/product-edit/{id}',[LinksController::class,'ShowEditingScreen'])->middleware('auth');
    Route::put('admin/product-update/{id}',[ProductController::class,'update'])->middleware('auth');    

    
    //seperate image delete
    Route::get('/delete_update_images/del1/{id}/',[ProductController::class,'image1delete'])->middleware('auth'); ##DELETE
    Route::get('/delete_update_images/del2/{id}/',[ProductController::class,'image2delete'])->middleware('auth'); ##DELETE
    Route::get('/delete_update_images/del3/{id}/',[ProductController::class,'image3delete'])->middleware('auth'); ##DELETE
    Route::get('/delete_update_images/del4/{id}/',[ProductController::class,'image4delete'])->middleware('auth'); ##DELETE
    Route::get('/delete_update_images/del5/{id}/',[ProductController::class,'image5delete'])->middleware('auth'); ##DELETE
    Route::get('/delete_update_images/del6/{id}/',[ProductController::class,'image6delete'])->middleware('auth'); ##DELETE


    Route::get('admin-product-delete/{id}',[ProductController::class,'deleteproduct']);
    Route::get('admin-bin-products',[LinksController::class,'recycleproducts']);
    Route::get('admin-product-restore/{id}',[ProductController::class,'restore']);
    Route::get('admin-product-delete-confirm/{id}',[ProductController::class,'confirmdelete']);
    Route::get('admin-Orders',[LinksController::class,'showorders']); ##Links
    Route::get('admin/guest/Orders',[LinksController::class,'guest_oneclick_orders']); ##Links
    Route::get('admin/guest/Orders/delete/{id}',[LinksController::class,'guest_oneclick_orders_delete']); ##Links

    ##PDF INVOICE
    Route::get('admin-Orders/pdf/{id}',[LinksController::class, 'pdf']); #homepage

    ##admin order
    Route::get('admin/admin-Orders-edit/{id}',[LinksController::class,'adminOrdersedit'])->name('child');
    Route::POST('admin/admin-Orders-edit/update',[LinksController::class,'adminOrdersUpdate'])->middleware('auth'); 
    Route::get('admin/admin-Orders-edit/delete/{id}',[LinksController::class,'adminOrdersDelete'])->middleware('auth');
    Route::get('admin/admin-Orders-edit/delete/{id}',[LinksController::class,'adminOrdersDelete'])->middleware('auth'); 

    ## 14-1-2023 UNCOMPLETED YAMIN HOSSAIN SHOHAN
    Route::get('admin/admin-Orders-edit/completeDEL/{id}',[LinksController::class,'deleteorderfULL'])->middleware('auth'); 

    ### ADD ORDER 7-12-2022 ###
    Route::get('admin/admin-Orders-edit/get/view',[LinksController::class,'adminAddOrdergetView']);
    Route::post('admin/admin-Orders-edit/submit/add',[LinksController::class,'adminAddOrderpost']);


    Route::get('admin-Transactions',[LinksController::class,'showTransactions']);
    Route::get('admin-news-letter',[LinksController::class,'showNewsLetter']);
    Route::get('admin-showReqForStock',[LinksController::class,'showReqForStock']);
    
    ######## ADMIN ORDER PAGE ROUTE ########
    Route::get('admin-Order-Status/{id}', [Order_Status_Controller::class,'Order_Status']);
    Route::post('admin-Update-Shipping-Status',[Order_Status_Controller::class,'Update_Shipping_Status']);
    Route::post('admin-Update-Delivery-Status',[Order_Status_Controller::class,'Update_Delivery_Status']);
    Route::post('admin-Update-Payment-Status',[Order_Status_Controller::class,'Update_Payment_Status']);
    Route::post('admin-Update-paymentmode-Status',[Order_Status_Controller::class,'Update_paymentmode_Status']);
    Route::get('admin-Order-Cancel/{id}', [Order_Status_Controller::class,'Order_Cancel']);
    Route::get('admin-Order-Re-Cancel/{id}', [Order_Status_Controller::class,'Order_Re_Cancel']);
    
});


### Cart  Routes Starts Heres
Route::get('cart', [CartController::class,'index']);

Route::post('add-to-cart',[CartController::class, 'addtocart'])->name('addToCart_indexPush'); 
Route::post('modify_quantity',[CartController::class, 'alter_quantity']); 
Route::get('/load-cart-data',[CartController::class, 'cartloadbyajax']);
Route::post('delete-from-cart',[CartController::class,'remove']);
Route::get('clear-cart',[CartController::class,'clear']);

### Book Now Routes
Route::get('checkout',[booking::class,'opencheckoutpage'])->middleware('Phoneverified','auth','BLOCK_IP','BLOCK_GEO');
Route::get('Shipping_Payment_Screen',[booking::class,'Shipping_Payment_Screen'])->middleware('auth');
Route::post('apply-promocode',[booking::class,'apply_promo_code'])->middleware('auth');
Route::post('order-proceed',[booking::class,'order_proceed'])->middleware('auth');

### Payment Routes  Starts Here
Route::get('proceed_to_Payment/{O_Id}',[payment::class,'proceed_to_Payment_BKASH'])->middleware('auth');

### eBkash Payment 
Route::get('eBKASH/{O_Id}',[payment::class,'eBKASH'])->middleware('auth');


### SSLCOMMERZ Startss
Route::post('/pay', [SslCommerzPaymentController::class, 'proceed_to_Payment']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);


// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});


Auth::routes();
#Route::get('/home', [HomeController::class, 'index'])->name('home');
 

