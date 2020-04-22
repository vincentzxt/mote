<?php
class CategoryAction extends CommonAction{
	public function _before_add(){
		$list = $this->node_listtree_func(0,$array,3,"category");
		$this->assign('sct',$list);
	}
    public function add(){
		$this->display();
	}
	public function index(){
		if($_GET['l']>0){
			$lmid = $_GET['l'];
		}else{
			$lmid = 0;	
		}
		//echo $lmid;
		$list = $this->node_listtree_func($lmid,$array,3,"category");

		$this->assign('list',$list);
	//	dump($list);
	    $this->display();	
	}
	public function addmuch(){
		$list = $this->node_listtree_func(0,$array,3,"category");
		$this->assign('sct',$list);
	    $this->display();
	}
	//批量保存
	public function SaveAddMuch(){
		//dump($_POST);
		$arr = $_REQUEST['Name'];
		$con = str_replace("\r\n",",",$arr);
	
		$array = explode(",",$con);
		//dump($array);return;
		if(count($array)>0){
			$db = $this->getActionName();
			//echo $db;
			$DAO = M($db);
			$data['pid'] = $_POST['ParentId'];
			$data['level'] = $_POST['Depth'];
			$data['status'] = $_POST['Status'];
			$data['sort'] = $_POST['Priority'];
			if(count($array)==1){
				 $data['title'] = $array[0];
				 $m = $DAO->add($data);
					//echo $i; 		
				 if($m){
					echo "第 ".$i." 条数据添加成功"."<br>"."sql语句：".$DAO->getlastsql()."<br>....NETX>>>><br>";	
				 }
			}else{
				for($i=0;$i<=count($array);$i++){
					if(!$array[$i])break;
					$data['title'] = $array[$i];
					$m = $DAO->add($data);
					//echo $i; 		
					if($m){
						echo "第 ".$i." 条数据添加成功"."<br>"."sql语句：".$DAO->getlastsql()."<br>....NETX>>>><br>";	
					}
					//dump($array[0][$i]);
				}
			}
			
			$this->success('数据添加成功！');
			//echo "添加完毕了";
			//$DAO->getlastsql(); 
		}
	}
	//加载修改数据页面
	public function edit() {
        $Cate = M('category');
        $id = $_REQUEST['id'];
        $cate = $Cate->where('id=' . $id)->find();
        //dump($cate);
        if ($cate){
	    	$select = $this->node_listtree_func(0,$array,3,"category");
        //赋值给前台变量
	  	    $this->assign('sct', $select); 
			//dump($select);
	        $this->assign('vo', $cate);
			$this->assign('c', $c); 
            $this->display();
        } else {
             header("Content-Type:text/html; charset=utf-8"); 
             echo ' [ <a href="javascript:history.back()">返 回</a> ]'; 
        }
    }
}