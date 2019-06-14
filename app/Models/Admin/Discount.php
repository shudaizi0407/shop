<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discount';
    public $timestamps = false;
    //允许批量赋值的字段
    protected  $guarded = [];
}
