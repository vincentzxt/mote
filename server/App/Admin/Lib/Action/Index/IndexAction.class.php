<?php
class IndexAction extends CommonAction {
    public function index(){
	//	echo 11;
	    if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->error('没有登录','__ROOT__/admin.php/Login/Index');
        }
		
		 $this->left();
		 $this->top();
		$this->display();
	 // $this->display('main');
    }
	public function left(){
		$id = isset($_GET['id'])?$_GET['id']:292;
		//echo $id;
		$qx = $this->qx();

		$map['id'] = array('in',$qx);
		$list = $this->array_listtree_func(0,"data_authority",$map);
		//dump($list);
		//dump($_SESSION);
        $this->assign('sct',$list);
		$dhtitle = dh_to_name($id);
		$this->assign('dhtitle',$dhtitle);
		//$this->display();
	}
	
	public function top(){
		//dump($_SESSION);
	    $qx = $this->qx();
		
		$dao = M('data_authority');
		$map = array();
		$map['level'] = 1;
		$map['status'] = 1;
		$map['id'] = array('in',$qx);
		//$map['type'] = array('EXP', 'REGEXP \'^'.$_SESSION['qx'].',$\'');
		//dump($map);
		$res = $dao->where($map)->order('sort desc')->select();
		
		//dump($res);
		$this->assign('res',$res);
		//$this->display();
	}
	
	public function qx(){
	   	if(!S('qx'.$_SESSION['role_id'])){
		    $rdao = M('user_role');
			$roleres = $rdao->where('id ='.$_SESSION['role_id'])->find();
			S('qx'.$_SESSION['role_id'],$roleres['qx'],3600,'File');//缓存权限	
		}
		return S('qx'.$_SESSION['role_id']);	
	}
}
?>