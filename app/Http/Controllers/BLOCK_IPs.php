<?php

namespace App\Http\Controllers;
use App\Models\BLOCK_IP;
use Illuminate\Http\Request;

class BLOCK_IPs extends Controller
{
    public function index(Request $request) {
        $ips=BLOCK_IP::all();
        return view('dashboards.admin.BLOCK_IP.index', [
            'ips' => $ips, 
        ]);
        
    }

    public function add(Request $request) {

        $ip = $request->input('ip');
        $note = $request->input('Note');
    
        $add_block_ip = new BLOCK_IP();
        $add_block_ip->ip = $ip;
        $add_block_ip->note = $note;
        $add_block_ip->save();
        return redirect()->back()->with('status', 'BLOCKLIST UPDATED');


    }


    public function delete(Request $request, $id) {
        $findID=BLOCK_IP::find($id);
        $findID->delete();
        return redirect()->back()->with('status', 'ID HAS BEEN DELETED FROM SERVER');
        
    }


}
