<?php
class DataAuthorityAction extends CommonAction{
	public function _before_add(){
		$list = $this->node_listtree_func(0,$array,3,"data_authority");
		$this->assign('sct',$list);
	}
	public function _before_edit(){
		$dao = M('data_group');
		$list = $dao->select();
		$this->assign('datagroup',$list);
	}
    public function add(){
		$this->display();
	}
	public function index(){
		$list = $this->node_listtree_func(0,$array,3,"data_authority");
		$this->assign('list',$list);
	
	    $this->display();
	}
	public function addmuch(){
		$list = $this->node_listtree_func(0,$array,3,"data_authority");
		$this->assign('sct',$list);
	    $this->display();
	}
	//批量保存
	public function SaveAddMuch(){
		$arr = $_REQUEST['Name'];
		$con = str_replace("\r\n",",",$arr);
	
		$array[] = explode(",",$con);
	
		if(count($array)>=0){
			$db = $this->getActionName();
			echo $db;
			$DAO = M($db);
			$data['pid'] = $_POST['ParentId'];
			$data['level'] = $_POST['Depth'];
			$data['status'] = $_POST['Status'];
			$data['sort'] = $_POST['Priority'];
			
			
			
			if(count($array[0])==1){
				 $data['title'] = $array[0][0];
				 $m = $DAO->add($data);
				 if($m){
					echo "第 ".$i." 条数据添加成功"."<br>"."sql语句：".$DAO->getlastsql()."<br>....NETX>>>><br>";	
				 }
			}else{
				echo 1;
				for($i=0;$i<count($array[0]);$i++){
					$data['title'] = $array[0][$i];
					$m = $DAO->add($data);
					//echo $i; 		
					if($m){
						echo "第 ".$i." 条数据添加成功"."<br>"."sql语句：".$DAO->getlastsql()."<br>....NETX>>>><br>";	
					}
					//dump($array[0][$i]);
				}
			}
			
			$this->success('数据添加成功！');
		
		}
	}
	//加载修改数据页面
	public function edit() {
        $Cate = M('data_authority');
        $id = $_REQUEST['id'];
        $cate = $Cate->where('id=' . $id)->find();
        //dump($cate);
        if ($cate){
	    	$select = $this->node_listtree_func(0,$array,3,"data_authority");
            //赋值给前台变量
	  	    $this->assign('sct', $select); 
			//dump($select);
	        $this->assign('vo', $cate);
			$this->assign('c', $c); 
            $this->display();
        }else {
             header("Content-Type:text/html; charset=utf-8"); 
             echo ' [ <a href="javascript:history.back()">返 回</a> ]'; 
        }
    }
	
	//权限管理
	public function selectqx(){
		$valname = $_GET['valname'];
		$this->assign('valname',$valname);	
		
		$dao = M('data_group');
		$map = array();
		//$map['status'] = 1;
		$res = $dao->where($map)->select();
		//dump($res);
		$this->assign('list',$res);
		$this->display();	
	}
}