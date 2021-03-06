<?php
namespace App\Models\Index;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Goods extends Model
{
	public function addCart($id,$user_id,$num)
	{
		 $data = [
		 	'user_id'=>$user_id,
		 	'goods_id'=>$id,
		 	'num'=>$num,
		 	'shop_time'=>time()
		 ];
		 $res = DB::table('shopcar')->insert($data);
		 return $res;
	}
public function addOrder($id,$user_id,$num)
	{
		$user = DB::table('user')->where('id',$user_id)->first();
		$address = DB::table('addr')->where('user_id',$user_id)->first('addr');//地址

		$data = [
			'user_id'=>$user_id,
			'name'=>$user->uname,
			'address'=>$address->addr,
			'user_tel'=>$user->tel,
			'order_number'=>time().rand(1000,9999),
			'create_time'=>time(),
			'order_status'=>'1',
		];
		
		$order_number = $data['order_number'];
		$goods = DB::table('goods')->where('id',$id)->first();
		$data2 = [
			'order_number'=>$order_number,
			'goods_id'=>$id,
			'number'=>'1',
			'goods_attribute'=>$goods->attribude,
		];
		$good_num = $goods->stock;
		$goods_num = $good_num-1;
		if($good_num==0){
			echo "<script>alert('已售空');history.go(-1);</script>";
		}else{
		DB::table('orders')->insert($data);
    	DB::table('orders_info')->insert($data2);
    	DB::table('goods')->where('id',$id)->update(['stock'=>$goods_num]);
		}
    	
    	
		return 1;
	}

}