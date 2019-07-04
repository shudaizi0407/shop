<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
 
class GoodsController extends Controller
{
	//查询
    public function index(Request $request)
    {
    	$size=$request->input('size');
    	$page=$request->input('page');

    	$size=isset($size)?$size:5;
    	$page=isset($page)?$page:1;

    	$offset=($page-1)*$size;

    	$where[]=['status', 1];
    	
    	$data=DB::table('goods')->where($where)->skip($offset)->take($size)->get();
    	return code('200', $data);
    }
    //商品详情
    public function details(Request $request)
    {
    	$id=$request->input('id');
    	if (isset($id)) {
    		return code(2001);
    	}
    	$data=DB::table('goods')->where('id', $id)->get();
    	return code(200, $data);
    }
    //品牌
    public function brand()
    {
    	$data=DB::table('goods_brand')->get();
    	return code(200, $data);
    }
    //分类
    public function type(Request $request)
    {
    	$status=$request->input('status');

    	$status=isset($status)?$status:0;

    	$data=DB::table('goods_type')->get();
    	if ($status==0) {
    		return code(200, $data);
    	}else{
    		$data=$this->list_level($data);
    		return code(200, $data);
    	}
    }
    public function list_level($data, $pid=0, $level=1)
	{
		static $array = array();

		foreach ($data as $k => $v) {

			if($pid == $v->pid){
				$v->level = $level;

				$array[] = $v;

				$this->list_level($data,$v->type_id,$level+1);
			}
		}
		return $array;
	}
	//评论
	public function comment(Request $request)
	{
		$goods_id=$request->input('goods');
		$goods_id=isset($goods_id)?$goods_id:0;

		if ($goods_id==0) {
			$data=DB::table('comment')
			->leftJoin('comment_reply', 'comment.id', '=', 'comment_reply.comment_id')
			->select('comment.content as comment', 'comment_reply.content as reply', 'user_id', 'goods_id', 'seller_id', 'comment.create_time as comment_create_time', 'comment_reply.create_time as reply_create_time')
			->get();

			return code(200, $data);
		}

		$data=DB::table('comment')
		->leftJoin('comment_reply', 'comment.id', '=', 'comment_reply.comment_id')
		->where('goods_id', $goods_id)
		->select('comment.content as comment', 'comment_reply.content as reply', 'user_id', 'goods_id', 'seller_id', 'comment.create_time as comment_create_time', 'comment_reply.create_time as reply_create_time')
		->get();

		return code(200, $data);
	}
	//首页轮播图
	public function carousel(Request $request)
	{
		$status=$request->input('order');
		$status=isset($status)?$status:0;
		if ($status==0) {
			$data=DB::table('goods')->orderBy('grade', 'desc')->select('id', 'img')->take(5)->get();
		}else{
			$data=DB::table('goods')->orderBy('grade', 'asc')->select('id', 'img')->take(5)->get();
		}
		
		return code(200, $data);
	}
	//推荐商品
	public function recommend(Request $request)
	{
		$status=$request->input('order');
		$status=isset($status)?$status:0;
		$num=$request->input('num');
		$num=isset($num)?$num:10;

		if ($status==0) {
			$data=DB::table('goods')->orderBy('sale', 'desc')->take($num)->get();
		}else{
			$data=DB::table('goods')->orderBy('sale', 'asc')->take($num)->get();
		}
		
		return code(200, $data);
	}
	//活动
	public function activity(Request $request)
	{
		$data=DB::table('active')->where('status', 1)->get();
		return code(200, $data);
	}

	public function showDiscount()
	{
		$user_id = session('uid');
		$data=DB::table('dis_user')
			->leftJoin('discount', 'dis_user.discount_id', '=', 'discount.id')
			->where('user_id',$user_id)
			->get();
		return code(200, $data);
	}
	//优惠卷
	public function discount(Request $request)
	{
		$goods_id=$request->input('goods_id');
		$goods_id=isset($goods_id)?$goods_id:0;
		$where=[];
		if ($goods_id==0) {
			$where[]=['is_all', 1];
		}else{
			$where[]=['goods_id', $goods_id];
		}
		$data=DB::table('dis_user')
			->leftJoin('discount', 'dis_user.discount_id', '=', 'discount.id')
			->where($where)
			->get();
		return code(200, $data);
	}
	//redis 底层实现  list  laravel 用到的设计模式 比家属  覆盖索引
}
