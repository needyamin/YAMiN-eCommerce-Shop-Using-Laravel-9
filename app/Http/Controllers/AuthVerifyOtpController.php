<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Auth;

//for sms
use Xenon\LaravelBDSms\Provider\Ssl;
use Xenon\LaravelBDSms\Sender;
use LaravelBDSms, SMS;

class AuthVerifyOtpController extends Controller
{
    // Return View of OTP Login Page
    public function login(){

/// Code Expire Check start
$now = Carbon::now();
$verificationCode = VerificationCode::where('user_id', Auth::user()->id)->latest()->first();
        if ($verificationCode) {
            $check = $now->isAfter($verificationCode->expire_at);


            if ($check) {
                $EXstatus = "404";
            } else {
                $EXstatus = "200";
            }
            /// Code Expire Check End
        } else{
            $EXstatus = '';
        }

    return view('auth.otp-verify', ['timeOut' => $EXstatus]);
   }

    public function updatePhoneNumber(Request $request){
        return view('auth.updatePhoneNumber');
    }

    public function updatePhoneNumberPOST(Request $request)
    {
        $request->validate([
            'mobile_no' => ['required', 'string', 'max:11','unique:users'],
        ]);

        $UpDate = User::where('email', Auth::user()->email)->first();
        $UpDate->mobile_no = $request->input('mobile_no');
        $UpDate->save();
        return redirect('/dashboard');
    }

    // Generate OTP
    public function generate(Request $request){
        $request->validate([
            'mobile_no' => 'required|exists:users,mobile_no'
        ]);

        # Generate An OTP
        $verificationCode = $this->generateOtp($request->mobile_no);

        ///////////////////////////////////////////////   
        $sender = Sender::getInstance();
        $sender->setProvider(Ssl::class); 
        $sender->setMobile($request->mobile_no);
       //$sender->setMobile(['017XXYYZZAA','018XXYYZZAA']);
        $sender->setMessage('Dear Customer, 
        Your OTP is: '.$verificationCode->otp.'
        For any query: 01878578504 needyamin.github.io');
        $sender->setQueue(false); //if you want to sent sms from queue
        $sender->setConfig(['api_token' => env('SSLWirless_api_token'),
        'sid' => 'BISHUDDHOTA','csms_id' => env('SSLWirless_csms_id')]);
        $status = $sender->send();                
        ///////////////////////////////////////////////


        $message = "Your OTP To Login Code Sent '.$verificationCode->otp.'";
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
        $verificationCode = VerificationCode::where('user_id', $request->user_id)->where('otp', $request->otp)->first();

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
