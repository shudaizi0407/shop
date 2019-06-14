<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Brand extends Model
{

	public function create($data)
	{
		if(isset($data['brand_name'])){
			$table = "goods_brand";
			$field = "brand_name";
			$value = $data['brand_name'];
			$brand = DB::table('goods_brand')->where('brand_name',$value)->exists();
			if($brand == true){
				return 3;
			}
		}else if(isset($data['type_name'])){
			$table = "goods_type";
			$field = "type_name,pid";
			$value = $data['type_name']."','".$data['pid'];
			$type = DB::table('goods_type')->where('type_name',$value)->first();
			if($type == true){
		   		return 3;
			}
		}else{
			return 0;
		}
		$sql = "insert into ".$table."($field)"." values "."('".$value."')";
		return DB::insert($sql);
	}
	//下拉框的分类
	public function type()
	{
		return DB::table('goods_type')->where('pid','0')->get();
	}

	public function brandList()
	{
		return  DB::table('goods_brand')->paginate(8);
	}
	public function typeList()
	{
		return  DB::table('goods_type')
		->orderByRaw('pid asc')
		->paginate(8);
	}
	public function brandDel($id)
	{
		return DB::table("goods_brand")->where('brand_id',$id)->delete();
	}


	public function typeDel($id)
	{
		return DB::table("goods_type")->where('type_id',$id)->delete();
	}

	public function typeShow($id)
	{
		$show = DB::table("goods_type")->where('type_id',$id)->first();
		$is_show = $show->is_show;

		if($is_show == 1){
			return   DB::table("goods_type")->where('type_id',$id)->update(['is_show'=>0]);
		}else{
			return   DB::table("goods_type")->where('type_id',$id)->update(['is_show'=>1]);
		}
	}
	public function brandShow($id)
	{
		$show = DB::table("goods_brand")->where('brand_id',$id)->first();
		$is_show = $show->is_show;

		if($is_show == 1){
			return   DB::table("goods_brand")->where('brand_id',$id)->update(['is_show'=>0]);
		}else{
			return   DB::table("goods_brand")->where('brand_id',$id)->update(['is_show'=>1]);
		}
	}
}