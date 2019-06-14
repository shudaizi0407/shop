<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class DisUser extends Model
{
    protected $table = 'dis_user';
    public $timestamps = false;
    //允许批量赋值的字段
    protected $guarded = [];
    public function good(){
	    return $this->hasOne('App\Models\Admin\Goods','id','goods_id');
	}
}
