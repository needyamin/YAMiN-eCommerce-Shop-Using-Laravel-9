<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\search;
use App\Models\LogActivity;
use App\Models\MarketingTeamLog;

$crud = new search();
class SearchFeedController extends Controller
{
   

   public function search_feed_admin(Request $request){
    $fetch = search::latest()->get();
    return view('dashboards.admin.search_activity_admin',['fetch' => $fetch]);
   }

    public function search_feed(Request $request)
    {

       
            //IP Address GEt   ############################# 
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip_address = $_SERVER['REMOTE_ADDR'];
            }
              ############################# 
             
            // if auth has loggin then print user ID or print guest  
            if (Auth::check()){$user_id = Auth::user()->id;} else {
            $user_id = "guest";}

            //if auth has loggin print mobile no or print guest
            if (Auth::check()){$mobile_no = Auth::user()->mobile_no;} else {
                $mobile_no = "guest";}


        if ($request->filled('q')) {
            $coupen_code = $request->input('q');
            $crud = new search();
            $crud->search_q = $coupen_code;
            $crud->user_id = $user_id;
            $crud->user_mobile_no = $mobile_no;
            $crud->ip = $ip_address;
            $crud->product_name = "0";
            $crud->save();
            return view('search_feed');
        }

        else{
            return view('search_feed');
        }


    }


##Delete Search Feed
public function deletesearchfeed(Request $request, $id){
    $searchfeedx=search::find($id);
    $searchfeedx->delete();
    return redirect()->back()->with('status', 'Record has been deleted');
}


##MASS DELETE ADMIN SEARCH PANEL
public function arraydeletesearches(Request $request)
{
    $ids = $request->input('ids');
    search::whereIn('id', $ids)->delete();
    return redirect()->back()->with('status', 'Record has been deleted');
}

##MASS DELETE arraydeletelogActivity
public function arraydeletelogActivity(Request $request)
{
    $ids = $request->input('ids');
    LogActivity::whereIn('id', $ids)->delete();
    return redirect()->back()->with('status', 'Record has been deleted');
}

##MASS DELETE arraydeleteMarketing Team Activity
public function MarketingArrayDel(Request $request)
{
    $ids = $request->input('ids');
    MarketingTeamLog::whereIn('id', $ids)->delete();
    return redirect()->back()->with('status', 'Record has been deleted');
}
    
}
