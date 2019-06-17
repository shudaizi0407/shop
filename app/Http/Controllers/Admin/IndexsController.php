<?php
namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  
use Illuminate\Support\Facades\Session; 


class IndexController extends BaseController
{
    public function index()
    {
    	$menus = false;
    	$id = Session::get('id');
    	$admin = DB::table('admin')->where('id',$id)->first();
		// 所属角色
    	$admin_id=$admin->rid;
		$roles = DB::table('role')->where('rid',$admin_id)->first();
		//var_dump($roles);die;
		
		if($roles)
		{
			// 如果角色存在  则将角色中的rights以数组的形式返回  没有则返回空数组
			$roles->rights = (isset($roles->rights) && $roles->rights) ? json_decode($roles->rights,true) : [];
		}

		// 如果为真
		if($roles->rights)
		{
			// 查询菜单
			$menus = DB::table('menu')->whereIn('mid',$roles->rights)->where(['ishidden'=>0,'status'=>0])->get();
			// 无限极分类
			$menus && $menus = $this->getTreeItems($menus);
		}
    	return  view('admin.index.index',['username'=>$admin->username,'menus'=>$menus]);
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

	public function welcome()
	{
		return view('admin.index.welcome');
	}



}