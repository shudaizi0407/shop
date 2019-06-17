<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Goods extends Model
{

	protected $table = 'goods';
    public function alldata()
    {
    	$list = DB::table('goods')->select('id','goodsname')->get();
        return $list;
    }
    // 返回分页展示商品数据
    public function list()
    {
    	$list = DB::table('goods')
        ->join('goods_brand','goods.brand_id','=','goods_brand.brand_id')
        ->join('goods_type','goods.type_id','=','goods_type.type_id')
        ->paginate(10);

    	return $list;
    }
    public function color()
    {
        return DB::table('goods_attribude_value')->where('attribude_id','1')
        ->join('goods_attribude_key','goods_attribude_value.attribude_id','=','goods_attribude_key.id')->get();
    }
    public function size()
    {
        return DB::table('goods_attribude_value')->where('attribude_id','2')
        ->join('goods_attribude_key','goods_attribude_value.attribude_id','=','goods_attribude_key.id')->get();
    }
    public function norms()
    {
        return DB::table('goods_attribude_value')->where('attribude_id','3')
        ->join('goods_attribude_key','goods_attribude_value.attribude_id','=','goods_attribude_key.id')->get();
    }
    //添加商品
    public function create($data)
    {
        $color = '颜色:'.$data['color'];
        $size = '尺码:'.$data['size'];
        $norms = '规格:'.$data['norms'];
        $arribude = $color.','.$size.','.$norms;
        $arribude = json_encode($arribude);
        $data = [
            'goodsname'=>$data['goodsname'],
            'goods_code'=> 'asd-'.time(),
            'create_time'=>time(),
            'up_time'=>time(),
            'img'=>'uploads/'.$data['img'],
            'goods_desc'=>$data['goods_desc'],
            'price'=>$data['price'],
            'brand_id'=>$data['brand_id'],
            'type_id'=>$data['type_id'],
            //卖家id
            'seller_id'=>'0',
            'is_delivery_fee'=>$data['is_delivery_fee'],
            'stock'=>$data['stock'],
            'attribude'=>$arribude,
        ];
        return DB::table('goods')->insert($data);
    }

    public function details($id)
    {
        $data = DB::table('goods')
        ->join('goods_brand','goods.brand_id','=','goods_brand.brand_id')
        ->join('goods_type','goods.type_id','=','goods_type.type_id')
        ->where('id',$id)
        ->first();
        return $data;
    }

    public function up_details($data)
    {
        $id = $data['id'];
        $data = [
            'goodsname'=>$data['goodsname'],
            'up_time'=>time(),
            'img'=>'uploads/'.$data['img'],
            'goods_desc'=>$data['goods_desc'],
            'price'=>$data['price'],
            'brand_id'=>$data['brand_id'],
            'type_id'=>$data['type_id'],
            'is_delivery_fee'=>$data['is_delivery_fee'],
            'stock'=>$data['stock'],
        ];
        // var_dump($data);die;
        return DB::table('goods')->where('id',$id)->update($data);
    }
    public function find($data)
    {
        $brand = $data['brand'];
        $type = $data['type'];
        $name = $data['world'];
        if (isset($brand)) {
            $whereOne = "and brand_name='$brand' ";
        }else{
            $whereOne = "";
        }
        if (isset($type)) {
            $whereTwo = "and type_name='$type' ";
        }else{
            $whereTwo = "";
        }
        if (isset($name)) {
            $whereThree = "and goodsname='$name'";
        }else{
            $whereThree ="";
        }
        $sql = "SELECT `id`,`goods_code`,`goodsname`,`img`,`price`,`create_time`,`stock`,`sale`,`brand_name`,`type_name` FROM goods LEFT JOIN goods_brand ON goods.brand_id = goods_brand.brand_id LEFT JOIN goods_type ON goods.type_id = goods_type.type_id where 1=1 ".$whereOne.$whereTwo.$whereThree;
        return DB::select($sql);
    }
}
