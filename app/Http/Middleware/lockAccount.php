<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class lockAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $max = 10*60;
        if(!session()->has('last_request') || $max > (time() - session('last_request') )){
            session()->put('last_request',time());
        }

        if($max < (time() - session('last_request'))){
            session()->put('locked',1);
            return redirect('/locked');
        }
        return $next($request);
    }
}
