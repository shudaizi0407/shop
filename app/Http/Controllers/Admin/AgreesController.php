<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Agrees;
use Illuminate\Support\Facades\DB;
class AgreesController extends BaseController
{
    //
    public function list(Request $request)
    {
          $agrees = new Agrees;
          $p = 6;
          $sum = $agrees->count();
          
          $sumye = ceil($sum/$p);
          $page = $request->input("page", '1');
          
          $prev = $page-1 < 1 ? 1 : $page-1;
          $next = $page+1 > $sumye ? $sumye : $page+1;
          $offset = ($page-1) * $p;
          $data = $agrees->offset("$offset")->limit($p)->get();
         
          return view('admin.agrees.list', ['data'=>$data, 'sumye'=>$sumye, 'prev'=>$prev, 'next'=>$next, 'page'=>$page]);
      	 


    }

    public function reply(Request $request)
    {
    	   $data = $request->input();

    	   $data['admin_id'] = 1;
       	 $data['create_time'] = time();
     
       	 DB::table("agrees_reply")->insert($data);
       	 echo json_encode(['code'=>1]);die;   
    }

    public function content(Request $request)
    {
   	    $id = $request->input('id');

   	    $agrees = new Agrees;
   	    $data = $agrees->find($id);
   
   	    $list = DB::table('agrees_reply')->where(['agrees_id'=>$data['id']])->get();
   
   	    return view('admin.agrees.agreesdetail', ['data'=>$data, 'list'=>$list]);
    }
    
    public function delete(Request $request)
    {
        $id = $request->input('id');   
        $agrees = new Agrees;
        $agrees->where('id',$id)->delete();
        return redirect("agrees-list");  
    } 
}
