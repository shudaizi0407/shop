<?php
namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session; 

class BaseController extends Controller
{
	
	public function __construct()
	{
		$this->middleware(function ($request, $next) {
	        $data = $request->session()->all();
	        if(!isset($data['id']))
	        {
	        	return redirect('admin-login');
	        }
	        return $next($request);
   		 });
	}
}