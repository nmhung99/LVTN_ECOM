<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles = null)
    {
        $auth = Auth::guard('admin');
        if (!$auth->check()) {
            //role = 'admin';
            return redirect('/admin');
        } else {
            $auth2 = Auth::guard('admin')->user();
            if($auth2->$roles == 1){
                return $next($request);
            } else {
                return redirect('/admin');
            }
        }
        
    }
}
