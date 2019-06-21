<?php

namespace App\Http\Middleware;

use Closure;

class Token
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
        // echo $request->token;
        // var_dump(session($request->token));
        // var_dump(empty(session($request->token)));
        if (!isset($request->token) || empty(session($request->token))) {
            echo code(101);die;            
        }
        if ((time()-session($request->token))>7200) {
            echo code(102);die;
        }
        
        return $next($request);
    }
}
