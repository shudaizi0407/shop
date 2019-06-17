<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Model\Admin
 *
 * @property int $id 后台用户id
 * @property string $username 后台用户名
 * @property string $password 后台密码
 * @property int $rid 角色id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereRid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Admin whereUsername($value)
 * @mixin \Eloquent
 */
class Admin extends Model
{
	protected $table = 'admin';//绑定表

	protected $primaryKey = 'id';//绑定主键id

	public $timestamps = false;

	/*public function ticket()
	{
		return $this->hasOne('App\Model\Ticket');
	}*/

}