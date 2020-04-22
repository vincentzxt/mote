<?php
class UserBumenAction extends CommonAction{
    public function add(){
	   $this->display();	
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

	// 获取配置类型
    public function _before_add() {
        $model	=	M("user_company");
        $list	=	$model->where('status=1')->select();
        $this->assign('list',$list);
     
    }
	// 获取配置类型
    public function _before_edit() {
        $model	=	M("user_company");
        $list	=	$model->where('status=1')->select();
        $this->assign('list',$list);
     
    }

}