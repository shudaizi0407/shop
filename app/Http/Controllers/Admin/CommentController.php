<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Comment;
use App\Models\Admin\Areas;
use Illuminate\Support\Facades\DB;

class CommentController extends BaseController
{
       public function list(Request $request)
       {
          
            $p = 6;
    		    $sum = DB::table('comment')->count();
    		    
    		    $sumye = ceil($sum/$p);
    		    $page = $request->input("page", '1');
    		    
    		    $prev = $page-1 < 1 ? 1 : $page-1;
    		    $next = $page+1 > $sumye ? $sumye : $page+1;
    		    $offset = ($page-1) * $p;

    		    $data = DB::table('comment')
    		                               ->join('goods','comment.goods_id', '=', 'goods.id')
                                           ->select('comment.*', 'goods.goodsname')
                                           ->offset($offset)
                                           ->limit($p)
    		                               ->get();
            
    		    return view('admin.comment.list', ['data'=>$data, 'sumye'=>$sumye, 'prev'=>$prev, 'next'=>$next, 'page'=>$page]);
    	
       }

       public function content(Request $request)
       {
       	    $id = $request->input('id');
       	    $comment = new Comment;
       	    $data = $comment->find($id);

       	    $list = DB::table('comment_reply')->where(['comment_id'=>$data['id']])->get();
       
       	    // var_dump($list);die;
       	    return view('admin.comment.commentdetail', ['data'=>$data, 'list'=>$list]);
       } 

       public function contentStatus(Request $request)
       {
            $data = $request->input();
            $comment = new Comment;
            if($data['status'] == 1){

                 $comment->where(['id'=>$data['id']])->update(['status'=>1]);
                 echo json_encode(['code'=>1]);die;

            }elseif($data['status'] == 0){

                   $comment->where(['id'=>$data['id']])->update(['status'=>0]);
                    echo json_encode(['code'=>0]);die;
            }
       }

       public function reply(Request $request)
       {
       	   $data = $request->input();
       	  
       	   $data['seller_id'] = 1;
       	   $data['create_time'] = time();
     
       	   DB::table("comment_reply")->insert($data);
       	    echo json_encode(['code'=>1]);die;
       }

       public function delete(Request $request)
       {
           $id = $request->input();
           $comment = new Comment;
           $comment->where(['id'=>$id])->delete();
           return redirect('comment-list');
       }
}