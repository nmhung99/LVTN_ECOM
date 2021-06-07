<?php

namespace App\Http\Middleware;
use Auth;

use Closure;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $auth = Auth::guard('admin');
        if (!$auth->check()) {
            //role = 'admin';
            return redirect('/admin');
        }
        return $next($request);
    }
}
