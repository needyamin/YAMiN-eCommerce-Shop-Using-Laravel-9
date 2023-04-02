<?php
  
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
  
class GeoBlocking
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $a = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
        $countrycode= $a['geoplugin_countryCode'];

        if ($countrycode=='GB')
           abort(403, "Your region restricted access this site. For any technical support send email at contact@bishuddhotabd.com ");

        //else if ($countrycode=='CA')
           //abort(403, "Your region restricted access this site. For any technical support send email at contact@bishuddhotabd.com ");

        else
          return $next($request);
    
    }
}