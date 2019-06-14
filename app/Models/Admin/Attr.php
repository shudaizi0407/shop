<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Attr extends Model
{
    //DB::table('goods_attribude_value')
        // ->join('goods_attribude_key','goods_attribude_value.attribude_id','=','goods_attribude_key.id')->get()
    public function attr()
    {
    	return DB::table('goods_attribude_key')->get();
    }
    public function attrDel($id)
    {
    	$is_del = DB::table("goods_attribude_value")->where('attribude_id',$id)->first();
    	if($is_del){
    		return 0;
    	}else{
    		return DB::table('goods_attribude_key')->where('id',$id)->delete();
    	}
    }
    public function attrisShow($id)
    {
    	$is_show = DB::table("goods_attribude_key")->where('id',$id)->value('is_show');
    	if($is_show){
    		return DB::table('goods_attribude_key')->where('id',$id)->update(['is_show'=>'0']);
    	}else{
    		return DB::table('goods_attribude_key')->where('id',$id)->update(['is_show'=>'1']);
    	}
    }

    public function attrList($id)
    {
    	return DB::table('goods_attribude_value')->where('attribude_id',$id)->get();
    }
    public function valueShow($id)
    {
    	$is_show = DB::table("goods_attribude_value")->where('id',$id)->value('is_show');
    	if($is_show){
    		return DB::table('goods_attribude_value')->where('id',$id)->update(['is_show'=>'0']);
    	}else{
    		return DB::table('goods_attribude_value')->where('id',$id)->update(['is_show'=>'1']);
    	}
    }
}
