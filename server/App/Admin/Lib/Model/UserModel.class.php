<?php
// 节点模型

class UserModel extends RelationModel{
	protected $tableName = 'user'; 
   
   	protected $_map = array(
		//'username'         =>'username', // 把表单中name映射到数据表的username字段
		//'role_id'         =>'gid', // 把表单中name映射到数据表的username字段
    );
    protected $_validate	=	array(
	    array('gid','require','角色必须'),
	    array('account','/^[a-z]\w{3,}$/i','帐号格式错误'),
		array('account','','登陆用户名不能重复哦！',0,'unique',1), 
		array('username','require','昵称必须'),
		
		array('password','require','密码必须',2),
		array('repassword','require','确认密码必须',2),
		array('repassword','password','确认密码不正确',3,'confirm'), // 验证确认密码是否和密码一致
		array('email','email','邮箱不正确'), // 验证确认密码是否和密码一致
    );
	

	
	protected $_auto = array( 
		array('create_time','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳
		array('update_time','time',2,'function'), // 对create_time字段在更新的时候写入当前时间戳
		array('password','checkpass',3,'callback'), // 对create_time字段在更新的时候写入当前时间戳
//		array('last_login_ip','get_client_ip',3,'function'), // 对create_time字段在更新的时候写入当前时间戳
//		array('login_count',1,'1'), // 对create_time字段在更新的时候写入当前时间戳
//		array('email',1,''), // 对create_time字段在更新的时候写入当前时间戳
    );
	
	public function checkpass(){
	    if($_POST['password']==''){
		     return false;	
		}else{
		     return md5($_POST['password']);	
		}
	}

    public function checkNode() {
        $map['account']	 =	 $_POST['account'];
        //$map['pid']	=	isset($_POST['pid'])?$_POST['pid']:0;
        $map['status'] = 1;
        if(!empty($_POST['ids'])) {
            $map['ids']	=	array('neq',$_POST['ids']);
        }
        $result	=	$this->where($map)->field('ids')->find();
        if($result) {
            return false;
        }else{
            return true;
        }
    }
}