<?php
class NodeAction extends CommonAction{
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
	
	public function add(){
	  $this->display();
    }
	
	public function addmuch(){
	  $this->display();
    }
	
	// 获取配置类型
    public function _before_addmuch() {
      $arr = $this->node_listtree_func(0,$array,2);	
	  $this->assign('flist',$arr);
	  $node	=	M("Node");
      $node->getById($_SESSION['currentNodeId']);
      $this->assign('pid',$node->id);
      $this->assign('level',$node->level+1);
    }
	//批量保存
	public function SaveaddMuch(){
		
		$db = $this->getActionName();
		$model = D($db);
		$arra = $model->create();
		
		$data['pid'] = $arra['pid'];
		$data['status'] = $arra['status'];
		$data['level'] = $arra['level'];
		$data['remark'] = $arra['remark'];
		
		if (false === $arra) {
			$this->error($model->getError());
		}
	
		$arr = $_REQUEST['name'];
		$con = str_replace("\r\n",",",$arr);
		$array[] = explode(",",$con);
		
		//dump($array);
		if(count($array)>=0){
			for($i=0;$i<count($array[0]);$i++){
				//echo count($array[0]);
		        $data['name'] = $array[0][$i];
				$data['title'] = $array[0][$i];
				//$m = $model->add($data);
				//echo $i; 	
				$m = $model->add($data);	
				if($m){
				    echo "第 ".$i." 条数据添加成功"."<br>"."sql语句：".$model->getlastsql()."<br>....NETX>>>><br>";	
				}
				//dump($array[0][$i]);
			}
			
			$this->success('数据添加成功！');
			//echo "添加完毕了";
			//echo $model->getlastsql(); 
		}
	}
	
	// 获取配置类型
    public function _before_add() {
      $arr = $this->node_listtree_func(0,$array,2);	
	  $this->assign('flist',$arr);
	  $node	=	M("Node");
      $node->getById($_SESSION['currentNodeId']);
      $this->assign('pid',$node->id);
      $this->assign('level',$node->level+1);
    }
	// 获取配置类型
    public function _before_edit() {
        $arr = $this->node_listtree_func(0,$array,2);	
	  $this->assign('flist',$arr);
	  $node	=	M("Node");
      $node->getById($_SESSION['currentNodeId']);
      $this->assign('pid',$node->id);
      $this->assign('level',$node->level+1);
    }
	//public 
	public function index(){
	    $arr = $this->node_listtree_func();	
		$this->assign('list',$arr);
		//输出主键的名称
		
		$this->display();
	}
}