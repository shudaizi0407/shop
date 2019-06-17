<?php
namespace app\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Session;  

class LoginController extends Controller
{
	// 登录
	public function login(Request $request)
	{
		if($request->isMethod('POST'))
		{
			$postData = $request->only(['username','password']);

			$Validator = $this->validate($request,[
				'username' => 'required|min:2|max:20',
				'password' => 'required|min:6|max:32',
			]);
			$admin = DB::table('admin')->where('username',$postData['username'])->first();
			//var_dump($admin);die;
			if(!$admin)
			{
				return json_encode(['code'=>1,'msg'=>'该用户不存在']);
			}
			//var_dump(md5($postData['password']));die;
			if(md5($postData['password']) != $admin->password)
			{
				return json_encode(['code'=>1,'msg'=>'密码错误']);
			}
			Session::put('id',$admin->id);
			return json_encode(['code'=>0,'msg'=>'欢迎登录']);
		}else{
			return view('admin.login.login');
		}
	}

	// 退出
	public function logout(Request $request)
	{
		$request->session()->forget('id');
		return redirect('admin-login');
	}
}
