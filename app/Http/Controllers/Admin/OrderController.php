<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin\Order as O;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\OrdersStatus as Status;
use App\Models\Admin\OrdersInfo as Info;

class OrderController extends Controller
{
    public function list()
    {  
      
    	$m=new Status();
        $list=$m->list();


    	$model=new O();
        	
    	$data=$model->selects();
    	
    	return  view('admin.order.list', ['data'=>$data, 'list'=>$list]);
    	
    	
    }

    public function search(Request $request)
    {

    	$id=$request->input('id');
    	if ($id==0) {
    		$model=new O();
        	
    		$data=$model->selects();
    		echo json_encode($data);
    	}else{
    		$data=Db::table('orders')->join('orders_status','orders_status.id','=','orders.order_status')->where('order_status',$id)->paginate(5);
            //var_dump($data);die;

    		echo json_encode($data);
    	}
    }


    public function update(Request $request)
    {

    	if ($request->isMethod('post')) {
    		$data=$request->input();
    		$id=$data['id'];
    		unset($data['id']);
    		$model=new O();
    		$res=$model->updates($id,$data);
    		if ($res) {
    			echo "<script>
                    alert('修改成功');
                    location.href='order-list';
                </script>";
    		}
    	}
    	$id=$request->input('id');
    	$m=new Status();
        $list=$m->list();
    	$model=new O();
    	$data=$model->getOne($id);
    	return  view('admin.order.update', ['data'=>$data, 'list'=>$list]);
    }


    public function info(Request $request)
    {

       $id=$request->input('id');
       $model=new Info();
       $data=$model->info($id);
       $list=Db::table('orders_info')->join('goods','goods.id','=','orders_info.goods_id')->where('orders_info.order_number',$id)->get(); 
       
       
       
       return view('admin.order.info', ['data'=>$data, 'list'=>$list ]);
    }


    public function infoUpdate(Request $request)
    {

        $id=$request->input('id');
        $number=$request->input('number');
        $model=new Info();
        $res=$model->updates($id,$number);
        if ($res) {
            echo 1;
        }else{
            echo 2;
        }

    }

    public function searchs(Request $request)
    {

        $search=$request->input('search');
        $model=new O();
        $data=$model->search($search);
        echo json_encode($data);
    }

    
}