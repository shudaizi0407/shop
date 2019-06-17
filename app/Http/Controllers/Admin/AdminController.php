<?php
namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Session; 
class AdminController extends BaseController
{
	public function index()
	{
		$data['data'] = DB::table('admin')->get();
		$data['data'] = json_decode($data['data'],true);
		$ids = [];
		foreach ($data['data'] as $key => $value) {
			$ids[] = $value['rid'];
		}
		$data['role'] = DB::table('role')->whereIn('rid',$ids)->get();
		$data['role'] = json_decode($data['role'],true);
		// var_dump($data['role']);die;
		return view('admin.admin.index',['data'=>$data]);
	}

	public function add()
	{
		$role = DB::table("role")->get();
		return view('admin.admin.add',['role'=>$role]);
	}

	public function update(Request $request)
	{
		$id = $request->input();
		$role = DB::table("role")->get();
		$data = DB::table('admin')->where('id',$id['id'])->first();
		return view('admin.admin.update',['role'=>$role,'data'=>$data]);
	}

	public function save(Request $request)
	{
		if($request->isMethod('POST'))
		{
			$postData = $request->post();
			$postData['password'] = md5($postData['password']);
			if(isset($postData['id']))
			{
				$res = DB::table('admin')->where('id',$postData['id'])->update($postData);
			}else{
				$res = DB::table('admin')->insert($postData);
			}
			if(!$res)
			{
				return json_encode(['code'=>1,'msg'=>'操作失败']);
			}else{
				return json_encode(['code'=>0,'msg'=>'操作成功']);
			}
		}else{
			return json_encode(['code'=>1,'msg'=>'无效操作']);
		}
	}


	public function del(Request $request)
	{
		$id = $request->input();
		$res = DB::table('admin')->where('id',$id['id'])->delete();
	    if(!$res)
		{
			return json_encode(['code'=>1,'msg'=>'删除失败']);
		}else{
			return json_encode(['code'=>0,'msg'=>'删除成功']);
		}	
	}
}
