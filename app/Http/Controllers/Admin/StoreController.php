<?php

namespace App\Http\Controllers\Admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Store;
use App\Models\Admin\Areas;
use Illuminate\Support\Facades\DB;
class StoreController extends Controller
{
    //
    //仓库列表
	public function storeList(Request $request)
	{
        $store_name = $request->input("ee", '');

        $user = new Store;
     
        $p = 6;
        $sum = $user->count();
        
        $sumye = ceil($sum/$p);
        $page = $request->input("page", '1');
        
        $prev = $page-1 < 1 ? 1 : $page-1;
        $next = $page+1 > $sumye ? $sumye : $page+1;
        $offset = ($page-1) * $p;
        $data = $user->offset("$offset")->where("store_name", 'like', "%$store_name%")->limit($p)->get();

        return view('admin.store.list', ['data'=>$data, 'sumye'=>$sumye, 'prev'=>$prev, 'next'=>$next, 'page'=>$page]);
    	 
  
	}

	public function storeAdd(Request $request)
	{        
		   $Areas = new Areas;        
    	   $data = $request->input();
         
      

            if(empty($data['area'])){
               
              echo "<script type='text/javascript'>
                           alert('仓库所在地不能为空');
                            location.href='http://www.shop.com/store-add-list';
                             </script>";die;
           	 
           }


    	   $str='  ';
           foreach ($data['location'] as $key => $value) {
           	    $str.= $Areas->where(['area_id'=>$value])->value('area_name');

           }
           $location = $str.$data['detail'];
           if(empty($location)){
               
                 echo "<script type='text/javascript'>
                           alert('仓库所在地区不能为空');
                            location.href='http://www.shop.com/store-add-list';
                             </script>";
           	 die;
            }

     		
			$code = rand(11111, 99999);
            $store_number = 'S'.$code;
	    
   

          $arr = [
                'store_name'=>$data['store_name'],
                'store_number'=>$store_number,
                'is_use'=>$data['is_use'],
                'location'=>$location,
                'area'=>$data['area'],

             ];

    
           $user = new Store;
           $res = $user->insert($arr);
           if($res){
           	  return redirect('store-list');
           }

       
	}




	public function storeAddList()
	{
		return view("admin.store.add");
	}

   //地区查看
	public function region()
	{       

        $type = isset($_GET['type'])?$_GET['type']:0;//获取请求信息类型 1省 2市 3区
        
		$province_num = isset($_GET['pnum'])?$_GET['pnum']:'440000';//根据省编号查市信息
		
		$city_num = isset($_GET['cnum'])?$_GET['cnum']:'440100';//根据市编号查区信息
         
		switch ($type) {//根据请求信息类型，组装对应的sql
		    case 1://省

                $province = DB::table('areas')->where(['parent_id'=>0])->get();

                echo json_encode($province);//返回json数据
		        
		        break;
		    case 2://市
                 
		        $province = DB::table('areas')->where(['parent_id'=>$province_num])->get();

                echo json_encode($province);//返回json数据
		       
		        break;
		    case 3://区
		        $province = DB::table('areas')->where(['parent_id'=>$city_num])->get();

                echo json_encode($province);//返回json数据
		        break;
		    default:
		        die('no data');
		        break;
		}

	  }

	  public function storeDel(Request $request)
	  {
	  	   $id = $request->input('id');
	  	   $store = new Store;
	  	   $res = $store->where(['id'=>$id])->delete();
	  	   return redirect('store-list');
	  	   
	  }

	  public function storeUpdateShow(Request $request)
	  {
	  	   $id = $request->input('id');
	  	   $store = new Store;
	  	   $data = $store->find($id);
	  	   return view('admin.store.updateshow', ['data'=>$data]);
	  }

	  public function storeUpdate(Request $request)
	  {
	  	   $data = $request->input();
	  	   // var_dump($data);die;
	  	   $id = $data['id'];
	  	   unset($data['id']);
	  	   unset($data['_token']);
	  	   $store = new Store;
	  	   $data = $store->where(['id'=>$id])->update($data);
	  	   return redirect('store-list');
	  }

	  public function storeStatus(Request $request)
	  {    

		  	 $data = $request->input();
		  	 $id = $data['id'];
		  	 $is_use = $data['is_use'];
		  	 $store = new Store;
		  	 if($is_use == 1){

		  	 	   $data = $store->where(['id'=>$id])->update(['is_use'=>0]);

		  	 }elseif($is_use == 0){

	              $data = $store->where(['id'=>$id])->update(['is_use'=>1]);
		  	 } 
	  }
}
