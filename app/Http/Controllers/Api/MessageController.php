<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function message(Request $request)
    {
        $id=$request->input('id');
        $data=Db::table('agrees')->where('user_id',$id)->join('agrees_reply','agrees.user_id','=','agrees_reply.agrees_id')->get();
        var_dump($data);die;
        if ($data) {
            return code('200');
        }else{
            return code(0);
        }
    }
    
}