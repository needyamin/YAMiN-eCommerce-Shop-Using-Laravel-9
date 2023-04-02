<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;


class logActivity extends Controller
{
   
    public function myTestAddToLog()
    {
        \LogActivity::addToLog('My Testing Add To Log.');
        dd('log insert successfully.');
    }


    public function logActivity()
    {
        $logs = \LogActivity::logActivityLists();
        return view('dashboards.admin.admin.logActivity',compact('logs'));
    }
}