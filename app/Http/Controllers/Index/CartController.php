<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
    

    public function index(Request $request)
    {    
         
        if (!$request->session()->has('id')) {
    		echo "<script>alert('即将跳转到登录页面');window.location.href='index-login';</script>";
    	}

        $id=$request->input('id',1);
         
   
        $data=Db::table('shopcar')->where('user_id',$id)
                                  ->join('goods','shopcar.goods_id','=','goods.id')
                                  
                                  ->paginate(2);
        // var_dump($data);die;
        return view('index.cart.cart',["data"=>$data]);
    }
    public function update(Request $request)
    {
        $user_id=$request->input('user_id',1);
        $goods_id=$request->input('goods_id');
        $num=$request->input('num');
       
        $data=Db::table('shopcar')->where("user_id",$user_id)->where("goods_id",$goods_id)->update(['num'=>$num]);

        if ($data) {
            return code('200');
        }else{
            return code(0);
        }
    }

       //删除
       public function del(Request $request)
       {
           $user_id=$request->input('user_id',1);
        
           $goods_id=$request->input('goods_id');
           $data=Db::table('shopcar')->where("user_id",$user_id)->where("goods_id",$goods_id)->delete();
           return redirect('cart');
   
       }

    //    确认订单
    public function order()
    {

         return view('index.cart.order');
    }

     //展示订单详情
    public function orderAdd(Request $request)
    {
             $data=$request->input();
             $user_id=$request->input('id',1);
             $goods_id=$data['goods_id'];

             $data=Db::table('shopcar')->where('goods_id',$goods_id)
                            ->join('goods','goods.id','=','shopcar.goods_id')                 
                       ->get();
             $info=Db::table('addr')->where('id',$user_id)->first();
            //  var_dump($info);die;
            
             return view('index.cart.order',['data'=>$data,'info'=>$info]);
    }

    public function orderAddData(Request $request)
    {

         $data=$request->input();
         $user_id=1;
         
        

         $order_number=rand(111111,999999);
         $order=[
               "user_id"=>$user_id,
               "name"=>$data['name'],
               "address"=>$data['address'],
               "user_tel"=>$data['user_tel'],
               "order_number"=>$order_number,
               "create_time"=>time(),
               "order_status"=>1

         ];
         Db::table('orders')->insert($order);
         $order_info=[
             "order_number"=>$order_number,
             "goods_id"=>$data['goods_id'],
             "number"=>$data['number'],
             "goods_attribute"=>json_encode($data['goods_attribute'])

         ];
         Db::table('orders_info')->insert($order_info);
          
        //  Db::table("shopcar")->where(['user_id'=>$user_id,'goods_id'=>$data['goods_id']])->delete();
//  var_dump($order_number);die;
         return view('index.cart.endorder', ['order_number'=>$order_number]);

    }

    
//    public function endorder()
//    {
//     return view('index.cart.endorder');
//    }

   

}