<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Active;

class ActivityController extends Controller
{
    public function index()
    {
    	$data=Active::paginate(2);

    	return view('admin.activity.index', ['data'=>$data]);
    }	
    public function delete($id)
    {
    	$article = Active::findOrFail($id);
		$res=$article->delete();

		return redirect('active-index');
    }
    public function update(Request $request)
    {
        $data=$request->input();
        unset($data['_token']);
        // var_dump($data);die;
        if ($data['status']=='启用') {
            $data['status']=0;
        }else{
            $data['status']=1;
        }

    	$act=Active::find($data['id']);
        $act->status=$data['status'];
        if($act->save()){
            if ($data['status']==0) {
                return json_encode("不启用");
            }else{
                return json_encode('启用');
            }
        }else{
            return json_encode('n');
        }
    }
    public function create()
    {
    	return view('admin.activity.create');
    }
    public function doCreate(Request $request)
    {
        $data=$request->input();
        unset($data['_token']);
        Active::create($data);
        return redirect('active-index');
    }
}
