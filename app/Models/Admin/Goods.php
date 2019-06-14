<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Goods extends Model
{
	protected $table = 'goods';
    public function alldata(){
    	$list = DB::table('goods')->select('id','goodsname')->get();
    	return $list;
    }
}
