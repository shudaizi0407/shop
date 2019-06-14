<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    protected $table = 'active';
    public $timestamps = false;
    //允许批量赋值的字段
    protected $fillable=['active_name','start_time','end_time','active_desc','status','full','subtract']; 

 //    public function type(){
	//     return $this->hasOne('App\Models\Admin\Goods','id','goods_id');
	// }

	public function getStatusAttribute($value)
    {
    	$arr=['不启用','启用'];
        return $arr[$value];
    }
}
