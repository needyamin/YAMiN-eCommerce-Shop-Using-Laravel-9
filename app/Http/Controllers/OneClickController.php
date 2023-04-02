<?php

namespace App\Http\Controllers;

use App\Models\oneclick_order;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class OneClickController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function installADMIN(Request $request)
     {
        $check = User::where('mobile_no','=','01878578504')->first();
        if(!$check){
        User::INSERT([
            "username" => "Md. Yamin Hossain",
            "mobile_no" => "01878578504",
            "email" => "admin@admin.com",
            "password" => Hash::make("admin@123"),
            "status" => "1",
            "role" => "admin",

        ]);

        return "Admin EMAIL: admin@admin.com & PASSWORD: admin@123  has been created successfully";
    } 
    else {
        return "Admin Email & PASSWORD already created.. Please contact site admin";
    }
     }

    public function guest_order_proceed(Request $request)
    {
        $validation = $request->validate([
            'phone' => 'required',
            'address' => 'nullable|max:60',
            'phone' => 'nullable|digits:11',
        ]);
        print_r($validation);

        //IP Address GEt    
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_address = $_SERVER['REMOTE_ADDR'];
        }
        //////////////////////////5200/////////////////
        
        $product = $request->input('product_id'); 
        $qtn = $request->input('quantity');
        $total_price = $product * $qtn;
        /*Order Details Ends Here*/
         $Order = new oneclick_order();
         $Order->name=$request->input('name'); 
         $Order->phone=$request->input('mobile_no'); 
         $Order->address=$request->input('delivery_address');
         $Order->product_id =$request->input('product_id'); 
         $Order->quantity = $request->input('quantity');
         $Order->price = $total_price;
         $Order->ip=$ip_address;
         $Order->save();
         return redirect()->back()->with('status','We received your request. Our Agent will contact you soon.. :) ');

    }

    public function admin_oneclickOrder(){
        return "works";
    }

    
}
