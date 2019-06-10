<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Goods extends Model
{
    //
    public function list()
    {
    	$list = DB::table('goods')->get();
    	return $list;
    }
}
