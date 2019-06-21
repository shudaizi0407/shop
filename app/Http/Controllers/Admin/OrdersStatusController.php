<?php
namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Admin\OrdersStatus as Status;

class OrdersStatusController extends BaseController
{
    public function list()
    {   

    	$model=new Status();
    	$data=$model->selects();
    	
    	return  view('admin.ordersstatus.list', ['data'=>$data]);
    }

    public function add(Request $request)
    {
    	if ($request->isMethod('post')) {
    	
    		$data=$request->input();
    		if (empty($data)) {
    			
    		}
    		$model=new Status();
    		$data=$model->adds($data);
    		if ($data) {
    			echo "<script>
						alert('添加成功');
						location.href='ordersstatus-list';	
    				</script>";
    		}
    	}
    	return view('admin.ordersstatus.add');
    }


    public function delete(Request $request)
    {

    	$id=$request->input('id');
    	$model=new Status();
    	$res=$model->deltes($id);
    	if ($res) {
    		echo "<script>
						alert('删除成功');
						location.href='ordersstatus-list';	
    			</script>";
    	}
    }

    public function update(Request $request)
    {

    	if ($request->isMethod('post')) {
    		$id=$request->input('id');
    		$state=$request->input('state');
    		$model=new Status();
    		$res=$model->updates($id,$state);
    		if ($res) {
    			echo "<script>
						alert('修改成功');
						location.href='ordersstatus-list';	
    			</script>";
    		}
    	}

    	$id=$request->input('id');
    	$model=new Status();
    	$data=$model->getOne($id);

    	return view('admin.ordersstatus.update', ['data'=>$data]);
    }

    

}