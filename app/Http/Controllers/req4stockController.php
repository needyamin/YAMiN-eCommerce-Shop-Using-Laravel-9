<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\req4stock;


class req4stockController extends Controller
{
    public function request4stock(Request $request){
        
       $req4= $request->validate([
       'mobile_nox' => 'required|digits:11',
    ]);

    if($request->validate){
        return redirect()->back()->with('status_request4','invlide phone number..'); 
    }

     //////////// IP Address Start //////////// 
       if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip_address = $_SERVER['HTTP_CLIENT_IP'];
       } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
       } else {
          $ip_address = $_SERVER['REMOTE_ADDR'];
       }
    //////////// IP Address End  ////////////

        $req4 = new req4stock();
        $req4->name= $request->input('name'); 
        $req4->email= $request->input('email');
        $req4->mobile_no= $request->input('mobile_nox');
        $req4->message= $request->input('message');
        $req4->product_id= $request->input('product_id');
        $req4->quantity= $request->input('quantity');
        $req4->ip = $ip_address;
        $req4->save();
        return redirect()->back()->with('status','Request Sent Successfully');  
    }

  
    public function showRequest4stock(Request $request){
        $reqforstock=req4stock::all();
        return view('dashboards.admin.req4stock',[
            'reqforstock' => $reqforstock, 
        ]);
   
    }

    ##Delete Request for stock
   public function deletereqforstockhm(Request $request, $id){
           $reqforstock=req4stock::find($id);
           $reqforstock->delete();
           return redirect()->back()->with('status', 'Record Deleted');
       }

}
