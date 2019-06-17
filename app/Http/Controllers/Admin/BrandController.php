<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class BrandController extends Controller
{
	public function brandList()
	{
		$model = new brand();
		$res = $model->brandList();
		$count = DB::table('goods_brand')->count();
		return view('admin.brand.brand',['info'=>$res,'count'=>$count]);
	}
	public function typeList()
	{
		$model = new brand();
		$res = $model->typeList();
		$type = $model->type();
		$count = DB::table('goods_type')->count();
		return view('admin.brand.type',['info'=>$res,'count'=>$count,'type'=>$type]);
	}
	public function create(Request $request)
	{
		$data = $request->all();
		$model = new brand();
		$res = $model->create($data);
		// var_dump($res);die;
		if($res==1){
			echo "<script>history.go(-1);</script>";
		}else if($res == 0){
			echo "<script>alert('添加失败');history.go(-1);</script>";
		}else if($res == 3){
			echo "<script>alert('已存在');history.go(-1);</script>";
		}else{
			 echo "<script>alert('网络错误');history.go(-1);</script>";
		}

	}

	public function brandDel(Request $request)
	{
		$id = $request->input('id');
		$model = new brand();
		$res = $model->brandDel($id);
		if($res){
			return 1;
		}else{
			return 0;
		}
	}
	public function typeDel(Request $request)
	{
		$id = $request->input('id');
		$model = new brand();
		$res = $model->typeDel($id);
		if($res){
			return 1;
		}else{
			return 0;
		}
	}
	public function typeUpd(Request $request)
	{
		$id = $request->input('id');
		$model = new brand();
		return $model->typeShow($id);
	}
	public function brandUpd(Request $request)
	{
		$id = $request->input('id');
		$model = new brand();
		return $model->brandShow($id);
	}
	public function inputType(Request $request)
	{
		$id = $request->input('id');
		$type_name = $request->input('type_name');
		return DB::table('goods_type')->where('type_id',$id)->update(['type_name'=>$type_name]);
	}
	public function inputBrand(Request $request)
	{
		$id = $request->input('id');
		$brand_name = $request->input('brand_name');
		//var_dump($brand_name);die;
		DB::table('goods_brand')->where('brand_id',$id)->update(['brand_name'=>$brand_name]);
		
	}
}