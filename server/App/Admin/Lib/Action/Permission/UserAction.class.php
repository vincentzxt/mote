<?php
class UserAction extends CommonAction{
	public function _initialize(){
		parent::_initialize();
        $model	=	M("user_group");//组
        $list	=	$model->where('status=1')->select();
        $this->assign('glist',$list);
		
		$model	=	M("user_company");
        $list1	=	$model->where('status=1')->select();
        $this->assign('clist',$list1);
		
		$model	=	M("data_group");
        $list2	=	$model->select();
        $this->assign('dlist',$list2);
		
	}
	
	public function index() {
        //列表过滤器，生成查询Map对象
        $map = $this->_search();
	 
        if (method_exists($this, '_filter')) {
            $this->_filter($map);
        }
	   // dump($map);
        $name = $this->getActionName();

        $model = D($name);
	   
        if (!empty($model)) {
            $this->_list($model, $map ,'status');
        }
	
        $this->display();
        return;
    }
    public function add(){
	   $this->display();	
	}
	
	public function getuserid(){
		$dao = M('user');
		$map = array();
		$map['role_id'] = array('eq',$_POST['user']);
		$res = $dao->where($map)->select();
	    //echo $dao->getlastsql();
		//dump($res);
		if($res){
			$resjson = sendjson($res);
		    echo $resjson;
		}else{
			echo -1;
		}
	}
	
	public function getuser(){
		$dao = M('user_role');
		$map = array();
		$map['pid'] = array('eq',$_POST['user']);
		$res = $dao->where($map)->select();
	    //echo $dao->getlastsql();
		//dump($res);
		if($res){
			$resjson = sendjson($res);
		    echo $resjson;
		}else{
			echo -1;
		}
	
	}
	
	// 检查帐号
    public function checkAccount() {
        if(!preg_match('/^[a-z]\w{4,}$/i',$_POST['account'])) {
            //$this->error( '用户名必须是字母，且5位以上！');
			echo -2;
			return;
        }
        $User = M("User");
        // 检测用户名是否冲突
        $map['account']  =  $_REQUEST['account'];
        $result  =  $User->where($map)->find();
        if($result) {
           // $this->error('该用户名已经存在！');
		   echo -1;
        }else {
           //  $this->success('该用户名可以使用！');
		   echo 1;
        }
    }
	
    public function _filter(&$map){
      /*  if(!empty($_GET['group_id'])) {
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
	
	public function select_user(){
	    $id = $_GET['id'];
		$this->assign('fid',$id);	
		$this->display();
	}
	
	public function select_oneuser(){
		
		$valname = $_GET['valname'];
		$this->assign('valname',$valname);	
		
		if(!S('select_oneuser')){
			$dao = M('user');
			$map = array();
			$map['status'] = 1;
			$res = $dao->where($map)->select();
			S('select_oneuser',$res);
		}
		$res = S('select_oneuser');
		
		$this->assign('list',$res);
		$this->display();
	}
	
	public function select_bumen(){
	    $company_id = $_POST['company'];
		$dao = M('user_bumen');
		$res = $dao->where('status=1 and fgs_id = '.$company_id)->select();
		
		$resjson = sendjson($res);
        echo $resjson;
	} 
	
	public function select_group(){
	    $bm_id = $_POST['bumen'];
		$dao = M('user_group'); 
		$res = $dao->where('status=1 and bm_id = '.$bm_id)->select();
		//dump($res);
		$resjson = sendjson($res);
        echo $resjson;
	} 
	
	public function select_role(){
	    $group_id = $_POST['group'];
		$dao = M('user_role'); 
		$res = $dao->where('status=1 and pid = '.$group_id)->select();
		//dump($res);
		$resjson = sendjson($res);
        echo $resjson;
	} 
	
	public function ajax_select_user(){
		/*
		  var cid = $('#fgs_id').val();//分公司id
	   var bmid =  $('#bm_id').val();//部门id
	   var groupid =  $('#group_id').val(); //组id
	   var roleid = $('$role_id').val();//角色id
		*/
		$cid = $_POST['cid'];
		$bmid = $_POST['bmid'];
		$groupid = $_POST['groupid'];
		$roleid = $_POST['roleid'];
		
		$map = array();
		if($cid){
			$map['fgs_id'] = array('eq',$cid);
		}
		if($bmid){
			$map['bm_id'] = array('eq',$bmid);
		}
		if($groupid){
			$map['group_id'] = array('eq',$groupid);
		}
		if($roleid){
			$map['role_id'] = array('eq',$roleid);
		}
		$map['status'] = array('eq',1);
		
		$dao = M('user');
		$res = $dao->where($map)->select();
		
	    $resjson = sendjson($res);
        echo $resjson;
		
	}
	
	public function select_user_of_role(){
		/*
		  var cid = $('#fgs_id').val();//分公司id
	   var bmid =  $('#bm_id').val();//部门id
	   var groupid =  $('#group_id').val(); //组id
	   var roleid = $('$role_id').val();//角色id
		*/
		
		$roleid = $_POST['roleid'];
		
		$map = array();
		if($roleid){
			$map['role_id'] = array('eq',$roleid);
		}
		
		$dao = M('user');
		$res = $dao->where($map)->select();
		
	    $resjson = sendjson($res);
        echo $resjson;
		
	}
	
	//重写del方法
	public function del(){
		$id = (int)trim($_REQUEST['id']);
		$dao = M('user');
		$data['status'] = 0;
		$res = $dao->where('id = '.$id)->save($data);
		if($res){
			$this->success('操作成功！');	
		}else{
			$this->error('操作失败！');	
		}
	}
	

	
}