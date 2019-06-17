<?php

namespace App\Http\Controllers\Admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends BaseController
{
   public function list()
   {
   	$data=Db::table('user')->paginate(3);
   	return view('admin.user.list', ['data'=>$data]);
   }

   public function status(Request $request)
   {

   		$id=$request->input('id');
   		$status=$request->input('status');
   		if ($status==1) {
   			Db::table('user')->where('id',$id)->update(['status'=>0]);
   			echo 1;
   		}elseif($status==0){
   			Db::table('user')->where('id',$id)->update(['status'=>1]);
   			echo 1;
   		}
   }

}
