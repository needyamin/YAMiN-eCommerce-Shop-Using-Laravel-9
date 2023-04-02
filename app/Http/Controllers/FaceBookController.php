<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class FaceBookController extends Controller
{
   use AuthenticatesUsers;
/**
 * Login Using Facebook
 */
 public function loginUsingFacebook()
 {
    return Socialite::driver('facebook')->redirect();
 }

 public function callbackFromFacebook()
 {
       $user = Socialite::driver('facebook')->stateless()->user();
       $find = User::where('email', $user->getEmail())->first();

       if(is_null($find)) {
         $u = new User([
             'name' => $user->getName(),
             'email' => $user->getEmail(),
             'facebook_id' => $user->getId(),
             'password' => Hash::make($user->getName().'@'.$user->getId()),
             'status' =>1,

         ]);
         $u ->save();
         Auth::loginUsingId($u->id);
         return redirect('/dashboard');

     } else {
      $UpDate=User::where('email', $user->getEmail())->first();
      $UpDate->username= $user->getName();
      $UpDate->facebook_id = $user->getId();
      $UpDate->save();
      Auth::login($find);
      return redirect('/dashboard');

     }
       } 
 
      }