<?php
class CustomAction extends CommonAction{
	public function _before_addmuch(){
		$dao = M('customgroup');
		$list = $dao->select();
	
		//dump($list);
		$this->assign('sct',$list);
	}
	public function _before_edit(){
		$dao = M('customgroup');
		$list = $dao->select();
		//dump($list);
		$this->assign('sct',$list);
		
		
		$type = isset($_GET['type'])?$_GET['type']:0; //'<a href="">返回</a>' : '1';
		
		if($type){
			$typeStr = '<a href="__URL__/index/type/'.$type.' style=\'font-size:14px;\'"><<返回</a><br><br>';
		}else{
			$typeStr = '';
		}
		
		$this->assign('fanhui',$typeStr);
	}
    public function addmuch(){
		$this->display();
	}
	
	//批量保存
	public function SaveAddMuch(){
		$db = $this->getActionName();
		$model = D($db);
		$arra = $model->create();
		
		$data['type'] = $arra['type'];
		$data['Priority'] = $arra['Priority'];
		$data['status'] = $arra['status'];
		if (false === $arra) {
			$this->error($model->getError());
		}
	
		$arr = $_REQUEST['textarea'];
		$con = str_replace("\r\n",",",$arr);
		$array[] = explode(",",$con);
		
		//dump($array);
		if(count($array)>=0){
			$data['typeName'] = customgroupid_to_name($data['type']);
			for($i=0;$i<count($array[0]);$i++){
				//echo count($array[0]);
		        $data['Name'] = $array[0][$i];
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
	
	public function liststyle(){
		//列表过滤器，生成查询Map对象
        $map = array();
		$map['type'] = $_REQUEST['type'];
		
		
        if (method_exists($this, '_filter')) {
            $this->_filter($map);
        }
        $name = $this->getActionName();
        $model = D($name);
		
        if (!empty($model)) {
            $this->_list($model,$map);
        }
		$this->display('Sys:Custom:index');

	}
	
	public function _before_index(){
		$type = isset($_GET['type'])?$_GET['type']:0;
		if($type){
			$this->assign('typeStr','type/'.$type);
		}
		
		$dao = M('Customgroup');
		$res = $dao->select();
		$this->assign('customgroup',$res);
	}
	public function rmdirs(){
		$str = $this->rmdirr('App/Admin/Runtime');
		if($str){
			$this->success('清除成功');
		}else{
		    dump($str);	
		}
		
	}
	
    public function child(){
	   $id = $_REQUEST['id'];
	   $dao = M('custom');
	   $res = $dao->where('type = '.$id)->select();
	   $this->assign('vo',$res);
	   $this->display();
   }

}