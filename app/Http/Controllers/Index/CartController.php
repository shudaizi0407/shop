<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
    

    public function index(Request $request)
    {    
         
        if (!$request->session()->has('uid')) {
    		echo "<script>alert('即将跳转到登录页面');window.location.href='index-login';</script>";
    	}


        $id=$request->input('id',1);
         
   
        $data=Db::table('shopcar')->where('user_id',$id)
                                  ->join('goods','shopcar.goods_id','=','goods.id')
                                  ->paginate(2);
        
        return view('index.cart.cart', ["data"=>$data]);
    }

    //修改商品数量
    public function update(Request $request)
    {
        $user_id = $request->session()->get('uid');
        $goods_id = $request->input('goods_id');
        $num = $request->input('num');
       
        $data = Db::table('shopcar')->where("user_id", $user_id)->where("goods_id", $goods_id)->update(['num'=>$num]);

        if ($data) {
            return code('200');
        }else{
            return code(0);
        }
    }

       //删除
   public function del(Request $request)
   {
       $user_id =  $request->session()->get('uid');
    
       $goods_id = $request->input('goods_id');
       $data = Db::table('shopcar')->where("user_id", $user_id)->where("goods_id", $goods_id)->delete();
       return redirect('cart');

   }

    //    确认订单展示
    public function order()
    {

         return view('index.cart.order');
    }

     //展示订单详情
    public function orderAdd(Request $request)
    {
             $data = $request->input();
             $user_id = $request->session()->get('uid');

              if (empty($user_id)) {

                echo "<script>alert('即将跳转到登录页面');window.location.href='index-login';</script>";

              }

             foreach ($data['check'] as $key => $value) {

                   $data1[] = Db::table('shopcar')->where('goods_id', $value)
                                                  ->join('goods', 'goods.id', '=', 'shopcar.goods_id')                 
                                                  ->first();

             }
              // var_dump($data1);die; 
              //计算总价格
              $sumprice = 0;
              foreach ($data1 as $key => $value) {
                  
                        $sumprice +=($value->num)*($value->price);

              }

             //默认的收获地址
             $info = Db::table('addr')->where('user_id', $user_id)->first();
               if (empty($info)) {

                echo "<script>alert('请添加收货地址');window.location.href='index-login';</script>";

              }
             return view('index.cart.order', ['data1'=>$data1, 'info'=>$info, 'sumprice'=>$sumprice]);
    }
      
    //确认结算 
    public function orderAddData(Request $request)
    {

         $data = $request->input();

         $user_id =  $request->session()->get('uid');
      
         $order_number = rand(111111, 999999);
         $order = [
                   "user_id"=>$user_id,
                   "name"=>$data['name'],
                   "address"=>$data['address'],
                   "user_tel"=>$data['user_tel'],
                   "order_number"=>$order_number,
                   "create_time"=>time(),
                   "order_status"=>2

                 ];

         Db::table('orders')->insert($order);
         $order_info = [
                         "order_number"=>$order_number,
                         "goods_id"=>$data['goods_id'],
                         "number"=>$data['number'],
                         "goods_attribute"=>json_encode($data['goods_attribute'])

                        ];
         // 使用事务
  

         Db::table('orders_info')->insert($order_info);
          //结算时同时删除购物车商品
         Db::table("shopcar")->where(['user_id'=>$user_id, 'goods_id'=>$data['goods_id']])->delete();


         return view('index.cart.endorder', ['order_number'=>$order_number]);

    }
}