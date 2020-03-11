<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class GosMiddlewarePAuth
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
     $Session = Session::get('usr_session');

        if ($Session!='true') {
         return redirect('/');
        }
        if ($Session!='true') {
         return redirect('/home');
        }
        return $next($request);

    }
}
