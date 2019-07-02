<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class ContentController extends Controller
{

    public function index(Request $request)
    {
    if (!$request->session()->has('uid')) {
        echo "<script>alert('即将跳转到登录页面');window.location.href='index-login';</script>";
    }

        $id =  $request->session()->get('uid');
        
        $data = Db::table('orders')->join('orders_status', 'orders.order_status', '=', 'orders_status.id')
                                   ->join('orders_info', 'orders.order_number', '=', 'orders_info.order_number')
                                   ->join('goods', 'goods.id', '=', 'orders_info.goods_id')
                                   ->select('orders.*', 'orders_status.*', 'orders_info.*', 'goods.goodsname', 'goods.img', 'goods.price')
                                   ->where('user_id', $id)
                                   ->get();
    //    var_dump($data);die;
        return view('index.content.content', ['data'=>$data]);
    }


    public function order(Request $request)
    {

        $id =  $request->session()->get('uid');
        
        $data = Db::table('orders')->join('orders_status', 'orders.order_status', '=', 'orders_status.id')
                                   ->join('orders_info', 'orders.order_number', '=', 'orders_info.order_number')
                                   ->join('goods', 'goods.id','=', 'orders_info.goods_id')
                                   ->select('orders.*', 'orders_status.*', 'orders_info.*','goods.goodsname', 'goods.img', 'goods.price')
                                   ->where('user_id', $id)
                                   ->get();

       echo json_encode(['data'=>$data]);
    }

      //待收货
      public function wait(Request $request)
      {
          $id =  $request->session()->get('uid');
          $data = Db::table('orders')->where('orders.user_id', $id)
                                     ->join('orders_status', 'orders.order_status', '=', 'orders_status.id')
                                     ->join('orders_info', 'orders.order_number', '=', 'orders_info.order_number')
                                     ->join('goods', 'goods.id', '=', 'orders_info.goods_id')
                                     ->select('orders.*', 'orders_status.*', 'orders_info.*', 'goods.goodsname', 'goods.img', 'goods.price')
                                     ->where("order_status", '=', 2)
                                     ->get();
       
          if ($data) {
              return code('200',$data);
          }else{
              return code('1001');
          }
      }
      // 待评论
      public function comment(Request $request)
      {
          $id =  $request->session()->get('uid');
          $data = Db::table('orders')->where('orders.user_id', $id)
                                      ->join('orders_status', 'orders.order_status', '=', 'orders_status.id')->join('orders_info', 'orders.order_number', '=', 'orders_info.order_number')
                                      ->join('goods', 'goods.id', '=', 'orders_info.goods_id')
                                      ->select('orders.*', 'orders_status.*', 'orders_info.*', 'goods.goodsname', 'goods.img', 'goods.price')
                                      ->where("order_status", '=', 3)
                                      ->get();
          if ($data) {
              return code('200', $data);
          }else{
              return code('1001');
          }
  
      }
      //未付款
      public function unpaid(Request $request)
      {
          $id =  $request->session()->get('uid');
          $data = Db::table('orders')->where('orders.user_id', $id)
                                      ->join('orders_status', 'orders.order_status', '=', 'orders_status.id')->join('orders_info', 'orders.order_number', '=', 'orders_info.order_number')
                                      ->join('goods', 'goods.id', '=', 'orders_info.goods_id')
                                      ->select('orders.*', 'orders_status.*', 'orders_info.*', 'goods.goodsname', 'goods.img', 'goods.price')
                                      ->where("order_status", '=', 1)
                                      ->get();
          if ($data) {
              return code('200', $data);
          }else{
              return code('1001');
          }
  
      }
     //为您推荐
      public function goodsNew()
      {
          $data = Db::table('goods')->limit(5)->get();
        return view('index.content.goodsnew', ['data'=>$data]);
      }

      //订单详情
      public function orderDetail(Request $request)
      {
              $number =  $request->input('number');
              $data = Db::table("orders")->where(['order_number'=>$number])->first();
              return view("index.content.orderdetail", ['data'=>$data]);
      }

}