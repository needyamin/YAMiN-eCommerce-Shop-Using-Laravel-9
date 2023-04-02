<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\NewsLetter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Mail;


class UserController extends Controller
{
    public function subscribe(Request $request){
           $NewsLetter = new NewsLetter();
           $NewsLetter->name= $request->input('name'); 
           $NewsLetter->email= $request->input('email');
           $NewsLetter->save();
           return redirect()->back()->with('status','Thanks for Subscribing! We Will mail You Our Latest Updates');
    }

    public function index(){
         return view('dashboards.user.index');
    }
    
    public function open_profile(){
         return view('dashboards.user.profile');
    }

    public function update(Request $request){
                 $validation =$request->validate([
                      'name'=>'nullable|max:60',
                      'image'=> 'mimes:jpeg,png,jpg,gif,svg|max:10000|dimensions:max_width=300,max_height=200',
                      'address1'=>'',
                      'address2'=>'',
                      'LandMark'=>'nullable|max:60',
                      'city'=>'nullable|max:60|regex:/^[a-zA-Z\s]*$/',
                      'state'=>'nullable|max:60|regex:/^[a-zA-Z\s]*$/',
                      'pincode'=>'nullable|digits_between:4,10',
                      'mobile_no' => ['string', 'max:11','unique:users'],
                      'email' => ['string','unique:users'],
                      'alternativemno'=>'nullable|digits:11',
                      'country'=>'nullable|max:30|regex:/^[a-zA-Z\s]*$/',
                // 'MobileNumber'=>'required|numeric',
                 
                ]);
                print_r($validation);
                $name=$request->input('name');
                $email=$request->input('email');
                $address1=$request->input('address1');
                $address2=$request->input('address2');
                $city=$request->input('city');
                $state=$request->input('state');
                $pincode=$request->input('pincode');
                $mno=$request->input('mobile_no');
                $mnumber=$request->input('mno');
                $alternativemno=$request->input('alternativemno');
                
                $country=$request->input('country');
                
                $user_id=Auth::user()->id;
                $user=User::findOrFail($user_id);
                $user->name=$name;
                $user->address1=$address1;
                $user->address2=$address2;
                $user->city=$city;
                $user->mnumber = $mnumber;
                $user->state=$state;
                $user->pincode=$pincode;

                if($request->has('mobile_no')){
                $user->mobile_no = $mno; //store data
                }
                if($request->has('email')){
                    $user->email=$email; //store data
                }

                $user->alternativemno=$alternativemno;
                $user->country=$country;
                
        
                if($request->hasfile('image')){
                    $destination='Uploads/profiles/'.$user->image;
                    if(File::exists($destination)){
                        File::delete($destination);
                    }
                    
                    $file=$request->file('image');
                    $extension=$file->getClientOriginalExtension();
                    $filename=time() .'.'.$extension;
                    $file->move('Uploads/profiles/',$filename);
                    $user->image=$filename;
        
                }
        
                   $user->update();
                   return redirect()->back()->with('successstatus', 'Your Profile Data is Updated Succesfully');

    }
    
    public function open_orders(){
        $email= Auth::user()->id;
        $Orders=Order::where('user_id','=',$email)->latest()->get();
        return view('dashboards.user.orders', [
            'email' => $email,
            'Orders' => $Orders
        ]);
    }

    public function open_transactions(){
            return view('dashboards.user.transactions');
        }
         
        public function updatepassword(Request $request){
             $validation =$request->validate([
                       'newpass'=>'required', 
                        'confirm_new_Pass'=>'required', 
                ]);
                print_r($validation);
                $newpass=$request->input('newpass');
                $confirm_new_Pass=$request->input('confirm_new_Pass');
                
                if($confirm_new_Pass==$newpass){
                    $user_id=Auth::user()->id;
                    $user_id=Auth::user()->id;
                    $user=User::findOrFail($user_id);
                    $user->password=Hash::make($newpass);
                    $user->update();
                    return redirect()->back()->with('successstatus', 'Password is Updated Succesfully');   
                }
                
                else
                { 
                    return redirect()->back()->with('passwordwontmatch', 'Password Wont Match! Please Try Again!!');  
                }
                   
         }
         
         public function send_email(Request $request){
             $validation =$request->validate([
                        'name'=>'required|max:30|regex:/^[a-zA-Z\s]*$/', 
                        'email'=>'required|email', 
                        'subject'=>'required|max:80', 
                        'message'=>'required|max:300', 
                 
                ]);
                  print_r($validation);
             
                $name=$request->input('name');
                $email=$request->input('email');
                $subject=$request->input('subject');
                $message=$request->input('message');
                $emailto="needyamin@gmail.com";
                $recievername="Admin";
                /* Mail Starts Here */
                   $welcomemessage='Hello Admin';
        	                $emailbody='I am '.$name.'<br>
        	             <p><strong>My Query/Message: </strong> :'.$message.'</p> <br>
        	             <strong>My Email: </strong>'.$email.'<br>';
        	                $emailcontent=array(
        	                    'WelcomeMessage'=>$welcomemessage,
        	                    'emailBody'=>$emailbody
        	                   
        	                    );
        	                    Mail::send(array('html' => 'emails.order_email'), $emailcontent, function($message) use
        	                    ($emailto, $subject,$recievername)
        	                    {
        	                        $message->to($emailto, $recievername)->subject
        	                        ('Hello Admin New Mail From your Client/Customer:'.$subject);
        	                        $message->from('info@bishuddhotabd','bishuddhotabd');
        	                        
        	                    });
                
    /* Mail Ends Here */
    return redirect()->back()->with('status', 'Thank you for contacting us, we will reach you as soon as possible');    
         }
        
}
