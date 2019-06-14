<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\attr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class AttrController extends Controller
{
    /**
     * 显示给定用户的概要文件.
     *
     * @param  int  $id
     * @return View
     */
    public function __construct()
    {
        
    }
    public function list()
    {
     
        $model = new attr();
        $attr = $model->attr();
        // var_dump($attr);die;
        return view('admin.attr.list',['attr'=>$attr]);
    }
    public function attrAdd(Request $Request)
    {
        $attribute_name = $Request->input('attribute_name');
        $res = DB::table('goods_attribude_key')->insert(['attribude_name'=>$attribute_name]);
        if($res){
            return redirect('goods-attr');
        }
    }
    public function attrDel(Request $Request)
    {
        $id = $Request->input('id');
        $model = new attr();
        $is_del = $model->attrDel($id);
        if($is_del){
            return redirect('goods-attr');
        }else{
        echo "<script>alert('有属性值,不可删除');history.go(-1);</script>"; 
        }
    }
    public function attrUpd(Request $Request)
    {
        $data = $Request->all();
        return DB::table("goods_attribude_key")->where('id',$data['id'])->update(['attribude_name'=>$data['attribude_name']]);
    }
    public function attrisShow(Request $Request)
    {
        $id = $Request->input('id');
        $model = new attr();
        $is_show = $model->attrisShow($id);
        return $is_show;
    }

    public function attrList(Request $Request)
    {
        $id = $Request->input('id');
        $model = new attr();
        $attr = $model->attrList($id);
        // var_dump($attr);die;
        return view('admin.attr.attrList',['attr'=>$attr,'id'=>$id]);
    }
    public function valueAdd(Request $Request)
    {
        $attribute_name = $Request->input('attribute_name');
        $id = $Request->input('id');
        // var_dump($id);die;
        $res = DB::table('goods_attribude_value')->insert(['attribude_value'=>$attribute_name,'attribude_id'=>$id]);
        if($res){
            echo "<script>window.location.href='attr-list?id=$id';</script>";
        }
    }
    public function valueUpd(Request $Request)
    {
        $data = $Request->all();
        return DB::table("goods_attribude_value")->where('id',$data['id'])->update(['attribude_value'=>$data['attribude_value']]);
    }
    public function valueDel(Request $Request)
    {
        $id = $Request->input('id');
        $is_del = DB::table('goods_attribude_value')->where('id',$id)->delete();
        if($is_del){
            echo "<script>alert('删除成功');</script>"; 
        }else{
            echo "<script>alert('删除失败');history.go(-1);</script>"; 
        }
    }
    public function valueShow(Request $Request)
    {
        $id = $Request->input('id');
        $model = new attr();
        $is_show = $model->valueShow($id);
        return $is_show;
    }




}