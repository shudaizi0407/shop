<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin\Store;
class CheckAge
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

         if ($request->input("store_name") == '') {

        
            return redirect('store-add-list');
        }
        
        $user = Store::where('store_name',$request->input('store_name'))->first();

        if($user){
             
            return redirect('store-add-list');
        }
    
        return $next($request);
       
    }
}
