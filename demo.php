
         {{ csrf_field() }}
模型
artisan命令行

php artisan make:model  Models/Admin/Agrees
php artisan make:controller Admin/AgreesController
    make:model(模型或控制器)  Admin(模块名,前后台)  User(模型名  最好跟表明一致) UserController(控制器)

// 指定表名  (默认是模型名加个s) 
protected $table = ‘member’;

// 指定主键的名称  如果你创建的表字段中主键ID的名称不为id，则需要通过 $primaryKey 来指定一下。
protected $primaryKey = ‘mid’;

// 批量赋值
# 白名单
protected $fillable = [‘允许添加的字段名’];
# 黑名单
protected $guarded = [‘拒绝添加的字段名’];

// 时间戳 这里一定要注意它是用的public     false 不开启   ture  开启 表字段为  create_at   update_at delete_at(应该可改  没研究)
public $timestamps = false;

UserInfo 模型名
save添加(在控制器写)
$user=new UserInfo;
// //设定数据
// $user->user_name='xiaoming';
// $user->work_years=23;
// $user->job='232';
// $bool=$user->save($name);  //保存
		
create添加
protected $fillable=['user_name','work_years','job'];   //允许批量赋值的字段

查询 
$user=new UserInfo;
$data=$user->get();
或者
UserInfo::all();
单查
UserInfo::findOrFail($id);

删除
$article = UserInfo::findOrFail($id);
$article->delete();


git 命令 
1.git add .提交
2.git status 查看状态
3.git commit -m"描述" 提交
4.git push 上传
5.git pull 下载
6.git push origin "分支名" 上传到指定的分支