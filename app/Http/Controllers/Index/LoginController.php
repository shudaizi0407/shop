<?php
namespace app\Http\Controllers\Index;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Session;  

class LoginController extends Controller
{
	public function login()
	{
		return view('index.login.login');
	}

	public function register()
	{
		return view('index.login.register');
	}
}