<?php
class IndexAction extends Action {
    // 用户登录页面
    public function index() {
		
        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->display();
        }else{
            $this->redirect('Index/Index/index');
        }
    }

 // 检查用户是否登录
    protected function checkUser() {
        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->error('没有登录','__ROOT__/admin.php/Login/Index');
        }
    }
	
    public function login(){
        //如果通过认证跳转到首页
        $this->display();
    }

    // 用户登出
    public function logout(){
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
			import ('@.ORG.Util.AUDIT');
			$aa = AUDIT::setLoginLog(-1);
			if($aa){
				unset($_SESSION[C('USER_AUTH_KEY')]);
				unset($_SESSION);
				session_destroy();
				
				$this->success('登出成功！',__APP__.'/Login/Index');
			}
           
        }else {
		    echo __URL__;
            $this->error('已经登出！',__APP__.'/Login/Index');
        }
    }

    // 登录检测
    public function checkLogin() {
		import ('@.ORG.Util.AUDIT');

        if(empty($_POST['account'])) {
			$aa = AUDIT::setLoginLog(1);
            $this->error('帐号错误！');
			
        }elseif (empty($_POST['password'])){
			$aa = AUDIT::setLoginLog(2);
            $this->error('密码必须！');
        }/*elseif (empty($_POST['verify'])){
            $this->error('验证码必须！');
        }*/
        //生成认证条件
        $map            =   array();
        // 支持使用绑定帐号登录
        $map['account']	= $_POST['account'];
        $map["status"]	=	array('gt',0);
       /* if(session('verify') != md5($_POST['verify'])) {
            $this->error('验证码错误！');
        }*/
        import ( '@.ORG.Util.RBAC' );
        $authInfo = RBAC::authenticate($map);
		
        //使用用户名、密码和状态的方式进行认证
        if(false === $authInfo) {
			$aa = AUDIT::setLoginLog(4);
            $this->error('帐号不存在或已禁用！');
        }else {
            if($authInfo['password'] != md5($_POST['password'])) {
				$aa = AUDIT::setLoginLog(2);
                $this->error('密码错误！');
            }
            $_SESSION[C('USER_AUTH_KEY')]	=	$authInfo['id'];
            $_SESSION['email']	=	$authInfo['email'];
            $_SESSION['loginUserName']	=	$authInfo['account'];
			$_SESSION['loginName']		=	$authInfo['username'];
            $_SESSION['lastLoginTime']	=	$authInfo['last_login_time'];
            $_SESSION['login_count']	=	$authInfo['login_count'];
			$_SESSION['fgs_id']	=	$authInfo['fgs_id'];
			$_SESSION['bm_id']	=	$authInfo['bm_id'];
			$_SESSION['group_id']	=	$authInfo['group_id'];
			$_SESSION['role_id']	=	$authInfo['role_id'];
			$_SESSION['account']	=	$authInfo['account'];
			$_SESSION['username']		=	$authInfo['username'];
			$_SESSION['uid']		=	$authInfo['id'];
			
			$rdao = M('user_role');
			$roleres = $rdao->where('id ='.$_SESSION['role_id'])->find();
			S('qx'.$_SESSION['role_id'],$roleres['qx'],3600);//缓存权限
			
            if($authInfo['account']=='admin') {
                $_SESSION['administrator']		=	false;
            }
            //保存登录信息
            $User	=	M('User');
            $ip		=	get_client_ip();
            $time	=	time();
            $data = array();
            $data['id']	=	$authInfo['id'];
            $data['last_login_time']	=	$time;
            $data['login_count']	=	array('exp','login_count+1');
            $data['last_login_ip']	=	$ip;
            $User->save($data);

            // 缓存访问权限
            RBAC::saveAccessList();
	        $aa = AUDIT::setLoginLog(0);
			//dump($_SESSION);
            $this->success('登录成功！',__APP__.'/Index');

        }
    }
    public function verify() {
        $type	 =	 isset($_GET['type'])?$_GET['type']:'gif';	
        import("@.ORG.Util.Image");
        Image::buildImageVerify(4,1,'gif');
    }
	
	public function sdata(){
		session_write_close();
		if(empty($_POST['time']))exit();      
   		 set_time_limit(0);//无限请求超时时间      
   		 $i=0;      
   		 while (true){      
			//sleep(1);      
			usleep(500000);//0.5秒      
			$i++;      
				  
			//若得到数据则马上返回数据给客服端，并结束本次请求      
			$rand=rand(1,999);      
			if($rand<=15){      
				$arr=array('success'=>"1",'name'=>'xiaocai','text'=>$rand);      
				echo json_encode($arr);      
				exit();      
			}      
				  
			//服务器($_POST['time']*0.5)秒后告诉客服端无数据      
			if($i==$_POST['time']){      
				$arr=array('success'=>"0",'name'=>'xiaocai','text'=>$rand);      
				echo json_encode($arr);      
				exit();      
			}      
   		 }   
	}

}