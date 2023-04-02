<?php
namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;

 
use Illuminate\Http\Request;
use Closure;
 

class PhoneverifiedMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    /* "Phoneverified" use as midware on web.php route */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->status == 1)
        {
            return $next($request);
        }

        else
        {
            return redirect('/otp/verify')->with('status','Please Verify Your Phone Number');
        }
        
    }
}
