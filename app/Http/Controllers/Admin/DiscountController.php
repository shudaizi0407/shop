<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Discount;
use App\Models\Admin\DisUser;
use App\Models\Admin\Goods;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        // $dis=new DisUser();
        // $data=DisUser::get();
        // // $data->good;
        // foreach ($data as $k => $v) {
        //     $v->good;
        // }
        // var_dump($data);die;
    	$serch=$request->input('serch');
    	if (empty($serch)) {
    		$where=[];
    	}else{
    		$where=[['discount_serial','=',$serch]];
    	}
    	
    	$data=Discount::where($where)->paginate(5);

    	return view('admin.discount.index', ['data'=>$data, 'serch'=>$serch]);
    }	
    public function delete($id)
    {
    	$disc = Discount::findOrFail($id);
		$res=$disc->delete();

		return redirect('discount-index');
    }
    public function create()
    {
    	$good=new Goods();
    	$good=$good->alldata();
    	// var_dump($good);die;
    	return view('admin.discount.create', ['good'=>$good]);
    }
    public function doCreate(Request $request)
    {
        $data=$request->input();

        $arr=explode(',', $data['is_all']);
        unset($data['_token']);
        unset($data['is_all']);
        // var_dump($arr);die;
        $res=Discount::create($data);

        $id=$res->id;
        $discount_serial="NK_".str_repeat('0',(6-strlen($id))).$id;

        $flight = Discount::find($id);
		$flight->discount_serial = $discount_serial;
		$flight->save();

		$dis_user=[];
		if (count($arr)==1 && $arr[0]==1) {
			$dis_user[]=['discount_id'=>$arr[0], 'discount_id'=>$id];
		}else{
			foreach ($arr as $k => $v) {
				if ($k==0) {
					continue;
				}

				$dis_user[$v]=['goods_id'=>$v, 'discount_id'=>$id];
			}
		}
		
		DisUser::insert($dis_user);

        return redirect('discount-index');
    }
}
