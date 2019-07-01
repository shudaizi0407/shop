<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Index\goods;
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
    	// var_dump($data);die;
    	$brand=DB::table('goods_brand')->get();
    	return view('index.goods.goods',['brand'=>$brand,'data'=>$data]);
    }
    public function brand_list(Request $request){
    	$brand_id = $request->input('id');
    	$data=DB::table('goods')->where('brand_id',$brand_id)->get();
    	$brand=DB::table('goods_brand')->get();
    	return view('index.goods.brandlist',['brand'=>$brand,'data'=>$data]);
    }
    //商品详情
    public function details(Request $request)
    {
    	$id=$request->input('id');
    	
    	$brand=DB::table('goods_brand')->get();
    	$data=DB::table('goods')->where('id', $id)->get();
    	// var_dump($data);die;
    	return view('index.goods.details',['data'=>$data,'brand'=>$brand]);
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
	//
	public function addCart(Request $request)
    {
        $id = $request->input('id');
        $num = $request->input('num');
        if(!isset($num)){
        	$num = '1';
        }
        if(!$request->session()->has('id')){
        	echo "<script>alert('即将跳转到登录页面');window.location.href='index-login';</script>";
        }
        else
        $user_id = $request->session()->get('id');
    	$model = new goods();
    	$res = $model->addCart($id,$user_id,$num);
    	if($res){
    		echo "<script>alert('加入购物车');history.go(-1);</script>";
    	}else{
    		echo "<script>alert('网络错误');history.go(-1);</script>";
    	}
    }

    public function addOrder(Request $request)
    {
    	// $request->session()->put('id',2);
    	if (!$request->session()->has('id')) {
    		echo "<script>alert('即将跳转到登录页面');window.location.href='index-login';</script>";
    	}
    	$num = $request->input('num');
        if(!isset($num)){
        	$num = '1';
        }
    	$user_id = $request->session()->get('id');

    	$id = $request->input('id');
    	// var_dump($num);die;
    	$model = new goods();
    	$res = $model->addOrder($id,$user_id,$num);
    	if($res == 1){
    		echo "<script>window.location.href='cart';</script>";
    	}
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
	//优惠卷
	public function discount(Request $request)
	{
		$goods_id=$request->input('goods');
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
