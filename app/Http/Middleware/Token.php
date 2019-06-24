<?php

namespace App\Http\Middleware;

use Closure;
use DB;
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
        $token=$request->input('token')?$request->input('token'):'';
        $time=DB::table('user')->where('as_token', $token)->select('create_time')->get();

        if (empty($time[0]->create_time)) {
            echo code(101);die;            
        }
        if ((time()-$time[0]->create_time)>7200) {
            echo code(102);die;
        }
        
        return $next($request);
    }
}
