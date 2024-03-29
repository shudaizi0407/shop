<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Validator;
use Mail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request)
    {

    	$data=$request->input();
        //var_dump($data);die;
        $data['pwd']=md5($data['pwd']);
        $email=$data['email'];
        $path = $request->file('head_img');
        if (empty($path)) {
            # code...
           return code('1002');  //验证是否为空
        }
        $path = $request->file('head_img')->store('');
        $data['head_img'] = 'uploads/'.$path;
    	$res=Db::table('user')->insert($data);
    	if ($res) {
            $email=$email;
            $id=Db::getPdo()->lastInsertId();
            //echo $id;die;
        //    Mail::raw("点击激活http://www.shop.com/activate?id=".$id,function ($mesage){
            
        //     $mesage->subject("激活");
        //     $mesage->to($email);
        // });
            $flag = Mail::raw("点击激活http://www.shop.com/activate?id=".$id, function ($message) 
                use ($email){
                    $message->to($email)->subject('激活');
            });


    		return json_encode(['code'=>200,'data'=>'注册成功，请到邮箱激活','msg'=>'success']);
    	}else{
    		return json_encode(['code'=>0,'data'=>$data,'msg'=>'fail']);
    	}


        
           
                        
        


    }


    public function activate(Request $request)
    {
        $id=$request->input('id');
        $res=Db::table('user')->where('id',$id)->update(['status'=>1]);
        if ($res) {
            echo "激活成功,请去登录页面登录";
        }
    }
}
