<?php
  
namespace App\Http\Middleware;
use App\Models\BLOCK_IP;
use Closure;
use Illuminate\Http\Request;
  
class BlockIpMiddleware
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
        $memus=BLOCK_IP::pluck('ip')->toArray();
        if (in_array($request->ip(), $memus)) {
            abort(403, "You are restricted to access the site.");
        }
  
        return $next($request);
    }
}