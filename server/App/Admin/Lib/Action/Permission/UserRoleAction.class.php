<?php
class UserRoleAction extends CommonAction{
	public function _initialize(){
		parent::_initialize();
	    $model	=	M("user_group");
        $list	=	$model->where('status=1')->select();
        $this->assign('glist',$list);
	}
    public function add(){
	   $this->display();	
	}
	
	public function getuserrole(){
	
		$dao = M('user_role');
		$map = array();
		$map['pid'] = array('eq',$_POST['gid']);
		$res = $dao->where($map)->select();
	
		//$resn = array('-3','');
		$resjson = sendjson($res);
		echo $resjson;
	}
	
    public function _filter(&$map){
/*        if(!empty($_GET['group_id'])) {
            $map['group_id'] =  $_GET['group_id'];
            $this->assign('nodeName','分组');
        }elseif(empty($_POST['search']) && !isset($map['pid']) ) {
            $map['pid']	=	0;
        }
        if($_GET['pid']!=''){
            $map['pid']=$_GET['pid'];
        }
        $_SESSION['currentNodeId']	=	$map['pid'];
        //获取上级节点
        $node  = M("Node");
        if(isset($map['pid'])) {
            if($node->getById($map['pid'])) {
                $this->assign('level',$node->level+1);
                $this->assign('nodeName',$node->name);
            }else {
                $this->assign('level',1);
            }
        }*/
    }


	public function del(){
	    $id =  $_GET['id'];
		//判断是否有用户属于用户角色，如果有则删除失败；如果没有则删除成功；
		$dao = M('user');
		$con = $dao->where('gid ='.$id)->count();
		if($con){
			$this->error('删除失败！请清理相关用户权限！');
		}else{
			$daou = M('user_role');
			$res = $daou->where('id ='.$id)->delete();
			if (false !== $res) {
				//成功提示
				$this->success('删除成功!');
			}else {
				//错误提示
			    $this->error('删除失败!');
				//echo $model->getlastsql();
			}
		}
	}
	// 获取配置类型
    public function _before_chmods(){
       // $model	=	M("user_group");
//        $list	=	$model->where('status=1')->select();
//        $this->assign('glist',$list);
          //获取某个用户的权限
		  $id   = $_GET['id'];
		  $role   = D("Access");
		  $list = $role->readRoleAccess($id);
		  $this->assign('alist',$list);
		  
		  $user = M('user_role');
		  $userdata = $user->where('id = '.$id)->find();
		   if(!$userdata){
			  $this->error('当前角色已经不存在，请重新编辑用户角色');
		  }
		  $this->assign('userdata',$userdata);
    }
	
	// 获取配置类型
    public function _before_chmodsdh(){
          $id = $_GET['id'];
          //获取某个用户的权限
		  $id   = $_GET['id'];
		  
		  $user = M('user_role');
		  $userdata = $user->where('id = '.$id)->find();
		  if(!$userdata){
			  $this->error('当前角色已经不存在，请重新编辑用户角色');
		  }
		  //echo $user->getlastsql();
		  //dump($userdata);
		  $this->assign('userdata',$userdata);
    }
	
	//修改某个用户权限
	public function chmods(){
		$arr = $this->array_listtree_func(0,'node');
		$this->assign('list',$arr);
	    
		//输出主键的名称
		$this->display();
	}
	
	public function chmodsdh(){
		$id = $_GET['id'];
		$this->_before_chmods();
		$dao = M('user_role');
		$res = $dao->where('id='.$id)->find();
		$this->assign('qx',$res['qx']);
		
		$list = $this->node_listtree_func(0,$array,3,"data_authority");
		//dump($list);
		$this->assign('list',$list);
	    $this->display();
	}
	
	public function chmodsave(){
		
		$id     = $_POST['role_id'];
        $roleid	= $_POST['chmod'];
        $role   = D("Access");
		//删除某个用户角色的权限
        $role->delRoleAccess($id);
		//重新赋予权限
        $result = $role->setRoleAccess($id,$roleid);
		if($result){
		    $this->success('授权成功');	
		}else{
			$this->error('授权失败');	
		}
     
		
	}
	public function chmoddhsave(){
		//dump($_POST);
		$id     = $_POST['role_id'];
		$roles	= $_POST['ids'];
        $dao = M('user_role');
		
		$dao->where('id ='.$id)->setField('qx',0);
		//重新赋予权限
        $result = $dao->where('id ='.$id)->setField('qx',$roles);
		
		if($result){
		    echo 1;
		}else{
			echo 0;
		}
     
		
	}
	
	
	
	
}