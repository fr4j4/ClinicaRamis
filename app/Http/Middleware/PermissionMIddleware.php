<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class PermissionMIddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        echo "permission middleware";
        if (Auth::guest()) {
            abort(403);
        }
        $permissions = is_array($permission)?$permission:explode('|', $permission);
        foreach ($permissions as $permission) {
            if (Auth::user()->can($permission)) {
                return $next($request);
            }
        }
        abort(403);
    }
}
