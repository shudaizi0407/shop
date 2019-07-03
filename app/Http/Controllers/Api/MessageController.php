<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function message(Request $request)
    {
        $id=$request->session()->get('uid');
        $data=Db::table('agrees')->where('user_id',$id)->join('agrees_reply','agrees.user_id','=','agrees_reply.agrees_id')->get();
        if ($data) {
            return code('200',$data);
        }else{
            return code(0);
        }
    }


    
}