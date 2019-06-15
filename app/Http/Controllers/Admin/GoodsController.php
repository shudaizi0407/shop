<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\goods;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class GoodsController extends Controller
{
	//分页展示商品数据
    public function list()
    {
    	$model = new goods();
        $brand = DB::table('goods_brand')->select('brand_id','brand_name')->get();
        $type = DB::table('goods_type')->select('type_id','type_name')->get();
    	$list = $model->list();

    	return view('admin.goods.list',['list' => $list,'brand' => $brand,'type'=>$type]);
    }

    //添加商品
    public function create()
    {
          //展示品牌 类型
        $brand = DB::table('goods_brand')->select('brand_id','brand_name')->get();
        $type = DB::table('goods_type')->select('type_id','type_name')->get();
        $model = new goods();
        $color = $model->color();
        $size = $model->size();
        $norms = $model->norms();
    	return view('admin.goods.create',['brand' => $brand,'type'=>$type])->with(['colors'=>$color,'sizes'=>$size,'normss'=>$norms]);
    }
    
    public function createDo(Request $request)
    {
        $data = $request->all();
 
        $path = $request->file('file');
        if (empty($path)) {
            # code...
            echo "图片为空";die;  //验证是否为空
        }
        $path = $request->file('file')->store('');
        $data['img'] = $path;

        $model = new goods();
        $res = $model->create($data);
        if($res){
            return redirect('goods-list');
        }else{
            echo "<script>alert('网络错误');history.go(-1);</script>";
        }
    }

    public function details(Request $request)
    {
        $id = $request->input('id');
        $model = new goods();
        $data = $model->details($id);
        $brand = DB::table('goods_brand')->select('brand_id','brand_name')->get();
        $type = DB::table('goods_type')->select('type_id','type_name')->get();
       return view('admin.goods.details',['details'=>$data,'brand' => $brand,'type'=>$type]);

    }
    public function upDetails(Request $request)
    {
        $data = $request->all();
        $path = $request->file('file');
        if (empty($path)) {
            # code...
            echo "图片为空";die;  //验证是否为空
        }
        $path = $request->file('file')->store('');
        $data['img'] = $path;

        $model = new goods();
        $res = $model->up_details($data);
        if($res){
            return redirect('goods-list');
        }else{
            echo "<script>alert('网络错误');history.go(-1);</script>";
        }
    }

    public function delete(Request $request)
    {
        
        $id = $request->input('id');
        $res = DB::table('goods')->where('id',$id)->delete();
        if($res){
            return redirect('goods-list');
        }else{
            echo "<script>alert('网络错误');history.go(-1);</script>";
        }
    }

    public function find(Request $request)
    {
        $data = $request->all();
        $model = new goods();
        $list = $model->find($data);
        $brand = DB::table('goods_brand')->select('brand_id','brand_name')->get();
        $type = DB::table('goods_type')->select('type_id','type_name')->get();
        return view('admin.goods.find',['list' => $list,'brand' => $brand,'type'=>$type]);
    }


}