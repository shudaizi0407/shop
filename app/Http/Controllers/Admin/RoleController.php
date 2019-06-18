<?php
namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Session; 

class RoleController extends BaseController
{

	public function index()
	{
		$role = DB::table('role')->get();
		return view('admin.role.index',['role'=>$role]);
	}

	public function add(Request $request)
	{
		$menus = DB::table('menu')->where(['status'=>0])->get();
		// 调用生成children方法
		$menus = $this->getTreeItems($menus);
		$res = [];
		// 将所得菜单数组遍历
		foreach ($menus as $value) {
			$value['children'] = isset($value['children']) ? $this->formatMenus($value['children']) : [];
			$res[] = $value;
		}
		return view('admin.role.add',['menus'=>$res]);
	}

	private function getTreeItems($items)
	{
		$items = json_decode($items,true);
		// 备用的空数组
		$tree = [];
		foreach ($items as $item) {
			$packData[$item['mid']] = $item;
		}
		// 将所得到的菜单数组遍历
		foreach ($packData as $key => $value) {
			// 如果存在pid
			if($value['pid'] != 0)
			{
				// 新建一个空字段数组
				$packData[$value['pid']]['children'][] = &$packData[$key];
			}else{
				$tree[] = &$packData[$key];
			}
		}
		return $tree;
	}

	// 递归
	private function formatMenus($items,&$res=[])
	{
		foreach ($items as $item) {
			if(!isset($item['children']))
			{
				$res[] = $item;
			}else{
				$tem = $item['children'];
				unset($item['children']);
				$res[] = $tem;
				$this->formatMenus($tem,$res);
			}
		}
		return $res;
	}

	public function update(Request $request)
	{
		$rid = $request->input();
		if(!$rid)
		{
			$rid = 0;
			$role = DB::table('role')->where('rid',$rid)->first();
			$role && $role->rights && $role->rights = json_decode($role->rights);
<<<<<<< HEAD
		}else{
			$role = DB::table('role')->where('rid',$rid['rid'])->first();
			$role && $role->rights && $role->rights = json_decode($role->rights);
=======

		}else{
			$role = DB::table('role')->where('rid',$rid['rid'])->first();
			$role && $role->rights && $role->rights = json_decode($role->rights);


>>>>>>> 0ad8c274aa5a151bdb2dd04f986baae4740d4ac0
		}
		$menus = DB::table('menu')->where(['status'=>0])->get();
		// 调用生成children方法
		$menus = $this->getTreeItems($menus);
		$res = [];
		// 将所得菜单数组遍历
		foreach ($menus as $value) {
			$value['children'] = isset($value['children']) ? $this->formatMenus($value['children']) : [];
			$res[] = $value;
		}
		return view('admin.role.update',['role'=>$role,'menus'=>$res]);
	}

	public function save(Request $request)
	{
		$postData = $request->only(['rid','rolename','menus']);
		if(!$postData['rolename'])
		{
			return json_encode(['code'=>1,'msg'=>'角色名称不能为空']);
		}
		$data['rolename'] = $postData['rolename'];
		$data['rights'] = json_encode(array_keys($postData['menus']));
		if(isset($postData['rid']))
		{
			DB::table("role")->where('rid',$postData['rid'])->update($data);
		}else{
			DB::table('role')->insert($data);
		}
		return json_encode(['code'=>0,'msg'=>'保存成功']);
	}

	public function del(Request $request)
	{
		$rid = $request->input();
		$res = DB::table('role')->where('rid',$rid['rid'])->delete();
	    if(!$res)
		{
			return json_encode(['code'=>1,'msg'=>'删除失败']);
		}else{
			return json_encode(['code'=>0,'msg'=>'删除成功']);
		}	
	}
}