<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserControllerADM extends Controller
{
    ###
    public function updaterole(Request $request,$id){
        $user=User::find($id);
        $user->name = $request->input('name');

        if ($request->has($request->input('password'))) {
            $pass = $request->input('password');
            $user->password = Hash::make($pass);
        }
        
        $role=$request->input('role');
        $status=$request->input('status');
        $user->role = $role;
        $user->status = $status;
        $user->update();
        return redirect()->back()->with('status', 'Role is Updated');
    }


    public function deleteuser(Request $request,$id){
        $user=User::find($id);
        $user->status = 2;
        # status 0 is Hide user
        # status 1 is active user
        # status 2 is the user present in the recycle bin 
        $user->update();
        return redirect()->back()->with('status', 'User Moved to Recycle Bin');

    }
    public function restore(Request $request,$id){
        $user=User::find($id);
        $user->status = 1;
        # status 0 is Hide user
        # status 1 is active user
        # status 2 is the user present in the recycle bin 
        $user->update();
        return redirect()->back()->with('status', 'User Restored Succesfully');

    }
    
    public function confirmdelete(Request $request,$id){
       $delete = User::find($id);
       $delete->delete();
       return redirect()->back()->with('status','User Permanently Deleted  Successfully !!');
    }
    
}