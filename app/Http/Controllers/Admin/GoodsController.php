<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\goods;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function list()
    {
    	$model = new goods();
    	$list = $model->list();
    	return view('admin.goods.list');
    }








}