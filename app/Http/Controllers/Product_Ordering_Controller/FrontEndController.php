<?php
namespace App\Http\Controllers\Product_Ordering_Controller;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\delivery_charges;
use App\Models\Products;
use App\Models\MarketingTeamLog;
use App\Models\theme_settings;
use App\Models\category;
use App\Models\subcategory;
use GuzzleHttp\Psr7\Query;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FrontEndController extends Controller
{


    /// THEME SETTING INDEX
    public function themesettings(){
        $theme_settings=theme_settings::first();
        return view('dashboards.admin.themesettings.index', [
            'theme_settings' => $theme_settings, 
        ]);
    }

    ///THEME SETTINGS UPDATE
    public function themesettingspost(Request $request){
             $req9=theme_settings::find('1');  
             $req9->website_title= $request->input('website_name'); 
             $req9->website_description= $request->input('website_description'); 
             $req9->header_meta_code= $request->input('head_meta_tags'); 

             $image2 =$request->file('logo');
             if($request->hasfile('logo')){
                 $destination=public_path('Uploads/Website_Logo').$req9->image2;
                 if(File::exists($destination)){ File::delete($destination);}
                 $s = uniqid(time(), true);
                 $extension=$image2->getClientOriginalExtension();
                 $product_Image_name2=$req9->logo.$s.'-2-.'.$extension;
                 $image2->move(public_path('Uploads/Website_Logo'),$product_Image_name2);
                 $req9->logo=$product_Image_name2;
             }
             

             $req9->theme_color= $request->input('color');
             $req9->save();
        return redirect()->back()->with('status','Update Successfully'); 
    }


    public function delivery_charges_feed (Request $request)
    {
        $charges=delivery_charges::all();
        return view('dashboards.admin.delivery_charges.delivery_charges_feed', [
            'charges' => $charges, 
        ]);
    }

    public function delivery_charges_add (Request $request)
    {
        \LogActivity::addToLog('Delivery Charges Added');
        return view('dashboards.admin.delivery_charges.delivery_charges_add');
    }


    public function delivery_charges_edit (Request $request, $id)
    {
        //////////////////////
        \LogActivity::addToLog('Delivery Charges Edit');
        $delivery_charges_edit = delivery_charges::findOrFail($id);
        return view('dashboards.admin.delivery_charges.delivery_charges_edit',[
            'delivery_charges_edit' => $delivery_charges_edit, 
        ]);
    }

    public function delivery_charges_edit_submit(Request $request){
       
        $request->validate([
            'city'=>'required|unique:delivery_charges',
            'cost'=>'required',
            'postcode'=>'required|unique:delivery_charges'
         ]);
      
            $id=$request->input('id');
             $req4=delivery_charges::find($id);  
             $req4->city= $request->input('city'); 
             $req4->cost= $request->input('cost'); 
             $req4->postcode= $request->input('postcode');
             $req4->save();
             return redirect()->back()->with('status','Update Successfully');  
    }


    public function delivery_charges_delete(Request $request, $id)
    {
        //$id=$request->input('id');
        \LogActivity::addToLog('Delivery Charges Deleted');
         $req4=delivery_charges::find($id); 
        $req4->delete();
        return redirect(url('admin/delivery_charges'))->with('status', 'Cost Deleted');

   
    }


    public function delivery_charges_submit (Request $request)
    {
        ##################################
        $request->validate([
        'city'=>'required|unique:delivery_charges',
        'cost'=>'required',
        'postcode'=>'required|unique:delivery_charges'
     ]);
         #################################
 
         $req4 = new delivery_charges();
         $req4->city= $request->input('city'); 
         $req4->cost= $request->input('cost'); 
         $req4->postcode= $request->input('postcode');
         $req4->save();

         return redirect()->back()->with('status','Successfully');  

    }


    public function updatePrice(Request $request){
        $productID = $request->input('id'); 
        $productPrice = $request->input('price'); 
        $productQuantity = $request->input('quantity'); 
        $product = Products::find($productID);
        $productName = $product->name;
        $productCurrentPrice = $product->price;
        $productCurrentSlug = $product->url;
        $productCurrentPrice = $product->price;

        $product->price = $productPrice;
        $product->quantity = $productQuantity;
        $product->update();
        
         //IP Address GEt    
         if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        //////////////////////////5200/////////////////
        $user_id = Auth::user()->mobile_no;

        ## Update Logs
        $MarketingTeamLog = new MarketingTeamLog();
        $MarketingTeamLog->product_id = $productID;
        $MarketingTeamLog->product_name = $productName;
        $MarketingTeamLog->slug = $productCurrentSlug;
        $MarketingTeamLog->update_price = $productPrice;
        $MarketingTeamLog->old_price = $productCurrentPrice;
        $MarketingTeamLog->username = $user_id;
        $MarketingTeamLog->ip = $ip_address;
        $MarketingTeamLog->save();


        \LogActivity::addToLog('Marketing Team: Price & Quantity Updated');
        return redirect()->back()->with('updatePrice','Price and Quantity has been updated'); 

    }

    public function index(Request $request, $purl)
    {
        
        $Product=Products::where('url','=',$purl)->where('status','=','1')->first();

        if(!$Product) {
            abort(404);
        } else {
            $category_id = $Product->category_id;
            //find category_id and match with products and fetch
            // $additional_info = $Product->name;
            //$description = $Product->description;
            $related_product = Products::where('category_id', '=', $category_id)->inRandomOrder()->paginate(28);
        }
        
        // $YAMiN = subcategory::where('category_id', '=', $category_id)->get();

     

        //$YAMiN = DB::select("SELECT DISTINCT * FROM subcategory INNER JOIN categorymodel ON categorymodel.id JOIN products ON products.category_id;");

        //$related_product = DB::table('products')->where('name','like','%'.$name.'%')->orWhere('additional_info','like',"%".$additional_info."%")->orWhere('description','like',"%".$description."%")->inRandomOrder()->get();

       
        return view('Product-Order-Screens.Product_Page',[
            'Product' => $Product, 
            'related_product' => $related_product,
        ]);
    }



    public function producthomenamecart(Request $request, $id)
    {
        $Product=Products::where('id','=',$id)->first();
        return view('Product-Order-Screens.Product_Page')->with('Product',$Product);
    }
}