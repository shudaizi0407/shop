<?php
namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Session; 

class MenuController extends BaseController
{

	public function index(Request $request)
	{
		$pid = $request->input();
		// var_dump($pid);die;
		if(!$pid)
		{
			$pid = 0;
			$data = DB::table('menu')->where(['pid'=>$pid,'ishidden'=>0,'status'=>0])->orderBy('sort','asc')->get();
		}else{
			$data = DB::table('menu')->where(['pid'=>$pid,'ishidden'=>0,'status'=>0])->orderBy('sort','asc')->get();
		}
		$data = json_decode($data,true);
		return view('admin.menu.index',['data'=>$data,'pid'=>$pid]);
	}

	public function save(Request $request)
	{
		$postData = $request->input();
		foreach ($postData['menunames'] as $key => $value) {
			$data['pid'] = (int)$postData['pid'];
			$data['menuname'] = $value;
			$data['controller'] = $postData['controllers'][$key];
			$data['method'] = $postData['methods'][$key];
			$data['ishidden'] = isset($postData['ishiddens'][$key]) ? 1 : 0;
			$data['status'] = isset($postData['status'][$key]) ? 1 : 0;
			$data['sort'] = (int)$postData['sorts'][$key];
			if($key == null && $data['menuname'])
			{
				DB::table('menu')->insert($data);
			}

			if($key > 0)
			{
				if($data['menuname'] == '' && $data['method'] == '' && $data['controller'] == '')
				{
					$res = DB::table('menu')->where('pid',$key)->first();
					if(!$res){
						DB::table("menu")->where('mid',$key)->delete();
					}else{
						return json_encode(['code'=>1,'msg'=>'存在子菜单不可删除']);
					}
				}else{
					DB::table('menu')->where('mid',$key)->update($data);
				}
			}
		}
		return json_encode(['code'=>0,'msg'=>'保存成功']);
	}
}