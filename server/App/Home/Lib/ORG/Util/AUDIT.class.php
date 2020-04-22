<?php
//Audit 审计类 
//登录日志错误类型：1 账号错误  2 密码错误  3 验证码错误  4 帐号不存在或已禁用
class AUDIT{
	
	//登录日志 
	static public function setloginlog($flag=''){
	
		// Db方式权限数据
        $db     =   Db::getInstance(C('LOG_DB_DSN'));
		$table = C('LOG_LOGIN_TABLE');
	    $data = array();
		$data['uid'] =  isset($_SESSION[C('USER_AUTH_KEY')]) ? $_SESSION[C('USER_AUTH_KEY')]:'guest';
		$data['time'] = time();
		$data['ip'] = get_client_ip();
		$data['flag'] = isset($flag)?$flag:2; //登录日志错误类型：1 账号错误  2 密码错误  3 验证码错误  4 帐号不存在或已禁  0 登录成功 -1 安全退出
		
		$sql = 'INSERT INTO `'.$table.'` (`ip`, `time`, `flag`, `uid`) VALUES (\''.$data['ip'].'\', '.$data['time'].', '.$data['flag'].', \''.$data['uid'].'\');';
		$rs =   $db->query($sql);
		return $sql;
	}
	//操作日志
	static public function setActionsLog(){
		// Db方式权限数据
        $db     =   Db::getInstance(C('LOG_DB_DSN'));
		$table = C('LOG_ACTION_TABLE');
		$data = array();
		$data['uid'] =  isset($_SESSION[C('USER_AUTH_KEY')]) ? $_SESSION[C('USER_AUTH_KEY')]:'guest';  //用户ID
		$data['type'] = ACTION_NAME;  //操作类型：1，查看，2，默认，3，添加，4，修改，5，删除
		$data['A_APP'] = APP_NAME;   //操作应用
		$data['A_GROUP'] = GROUP_NAME;  //操作 组
		$data['A_MODULE'] = MODULE_NAME;  //操作模型
		$data['A_ACTION'] = ACTION_NAME;  //操作方法
		$data['beizhu'] = __SELF__;	 //备注
		$data['time'] = time();
		$data['ip'] = get_client_ip();
	
		
		
		$sql = "INSERT INTO `$table` (`uid`, `type`,  `IP`, `time`, `A_APP`, `A_GROUP`, `A_MODULE`, `A_ACTION`, `beizhu`) VALUES ( '".$data['uid']."', '".$data['type']."', '".$data['ip']."','".$data['time']."', '".$data['A_APP']."','".$data['A_GROUP']."', '".$data['A_MODULE']."','".$data['A_ACTION']."', '".$data['beizhu']."')";
		
		$rs =  $db->query($sql);
		return $rs;
	}
	
	
}
?>