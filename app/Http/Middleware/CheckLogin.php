<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        //echo "CheckLogin";
        //return $next($request);
        if(Auth::check()){
            return $next($request);
        }else{
            return redirect('/login');
        }
    }
}
