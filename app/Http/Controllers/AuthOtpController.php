<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Auth;
use Mail;

//for sms
use Xenon\LaravelBDSms\Provider\Ssl;
use Xenon\LaravelBDSms\Sender;
use LaravelBDSms, SMS;


class AuthOtpController extends Controller
{
    // Return View of OTP Login Page
    public function login(){
        return view('auth.otp-login');
    }

    // Generate OTP
    public function generate(Request $request){
        $request->validate([
            'mobile_no' => 'required|exists:users,mobile_no'
        ]);



        ########## CONDITIONAL DROP CODE FOR CHOOSE METHOD START ##########
        if($request->has('chooseOPtion')){
            if(Auth::user()->mobile_no == $request->input('chooseOPtion')){

                $mobile_number = $request->input('mobile_no');
                $verificationCode = $this->generateOtp($mobile_number);

                ######## SEND OTP SMS START ########
                ////////////////////////////////////////////////   
                 $sender = Sender::getInstance();
                 $sender->setProvider(Ssl::class); 
                 $sender->setMobile($mobile_number);
                //$sender->setMobile(['017XXYYZZAA','018XXYYZZAA']);
                 $sender->setMessage('Dear Customer, 
                 Your OTP is: '.$verificationCode->otp.'
                 For any query: 01810023444 BishuddhotaStore.Com');
                 $sender->setQueue(false); //if you want to sent sms from queue
                 $sender->setConfig([
                     'api_token' => env('sms_api_token'),
                     'sid' => env('sms_sid'),
                     'csms_id' => 'sms_csms_id']);
                 $status = $sender->send();
                //dd($status);                
                ///////////////////////////////////////////////
                ######## SEND OTP SMS END ########
                $message = "Your OTP Code Sent To Your Phone No: ".$mobile_number;
                return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message); 
            }
              
            
        if(Auth::user()->email == $request->input('chooseOPtion')){
        $mobile_number = $request->input('mobile_no');
        $verificationCode = $this->generateOtp($mobile_number);

        ################ EMAIL CODE START ###################
        $loginid=Auth::user()->email;
        $mobile = $request->input('mobile_no');
        $name=Auth::user()->name;

            /////////////////// email /////////////////////////
            if ($name) {$welcomemessage = 'Hello '.$name.'<br>';}
            else{$welcomemessage = 'Hello <br>';}
            $emailbody = 'Dear Customer, Your OTP is: <span style="font-size:20px; font-weight:bold;"> '.$verificationCode->otp.' </span> <br> For any query: 01810023444 Bishuddhotastore.Com';
            $emailcontent = array(
            'WelcomeMessage'=>$welcomemessage,
            'emailBody' => $emailbody);
            
             Mail::send(array('html' => 'emails.OTP'), $emailcontent, function ($message) use ($loginid, $mobile) {
             $message->to($loginid, $mobile)->subject('Your Bishuddhotastore OTP Code');
             $message->from('bishuddhotastore@btl.net.bd', 'BishuddhotaStore');
            });
        
    ################ EMAIL CODE END ###################

    $message = "Your OTP Code Sent To Your Email: " .$loginid;
    return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message); 

        }
        }
    ########## CONDITIONAL DROP CODE FOR CHOOSE METHOD END ##########



        $mobile_number = $request->input('mobile_no');
        $verificationCode = $this->generateOtp($mobile_number);

        ////////////////////////////////////////////////   
        $sender = Sender::getInstance();
        $sender->setProvider(Ssl::class); 
        $sender->setMobile($mobile_number);
       //$sender->setMobile(['017XXYYZZAA','018XXYYZZAA']);
        $sender->setMessage('Dear Customer, 
        Your OTP is: '.$verificationCode->otp.'
        For any query: 01810023444 BishuddhotaStore.Com');
        $sender->setQueue(false); //if you want to sent sms from queue
        $sender->setConfig([
            'api_token' => env('sms_api_token'),
            'sid' => env('sms_sid'),
            'csms_id' => 'sms_csms_id']);
        $status = $sender->send();
        //dd($status);                
        ///////////////////////////////////////////////

        $message = "Your OTP Code Sent To Your Phone number: ". $mobile_number;
        # Return With OTP 
        return redirect()->route('otp.verification', ['user_id' => $verificationCode->user_id])->with('success',  $message); 
    }


    public function generateOtp($mobile_no){
        $user = User::where('mobile_no', $mobile_no)->first();
        # User Does not Have Any Existing OTP
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();
        $now = Carbon::now();
        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }

        // Create a New OTP
        return VerificationCode::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);
    }

    public function verification($user_id){
        return view('auth.otp-verification')->with([
            'user_id' => $user_id
        ]);
    }

    public function loginWithOtp(Request $request){
        #Validation
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'otp' => 'required'
        ]);

        #Validation Logic
        $verificationCode   = VerificationCode::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

        $now = Carbon::now();
        if (!$verificationCode) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
            return redirect()->route('otp.login')->with('error', 'Your OTP has been expired');
        }

        $user = User::whereId($request->user_id)->first();

        if($user){
            // Expire The OTP
            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);

            Auth::login($user);

            // Update users status role 1-8-2023
            $user=User::find($request->user_id);
            $user->status = 1;
            $user->update();

            
            return redirect('/user/dashboard');
        }

        return redirect()->route('otp.login')->with('error', 'Your Otp is not correct');
    }
}
