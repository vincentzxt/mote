<?php
class OnepageAction extends CommonAction{
	public function _before_add(){
		$list = $this->node_listtree_func(0,$array,3,"category");
		
		$this->assign('sct',$list);
	}
	
    public function add(){
	    $this->display();	
	}
	
     //插入函数基础类
    function insert() {
        $name = $this->getActionName();
		//echo $name;
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        //保存当前数据对象
        $list = $model->add();
		
        if ($list !== false) { //保存成功
		    $this->update_category($list,$_POST['lanmu']);
            $this->success('新增成功!');
			//echo $model->getlastsql();
        } else {
            //失败提示
            //echo $model->getlastsql();
			$this->error('新增失败!');
        }
    }
	
	function update_category($id,$tid){
	  
	  $dao = M('category');
	  $map = array();
	  $map['id'] = array('eq',$tid);
	  $data['type'] = 2;
	  // $data['url'] = $id;
	  $res = $dao->where($map)->save($data);

   }
   
   public function _before_edit(){
	  $list = $this->node_listtree_func(0,$array,3,"category");
	 
      $this->assign('sct',$list);
   }
   
   public function delonepage(){
	  $id = $_GET['id'];
	  if($id){
		  $dao = M('category');
		  
	  }
	  $this->del();
   }
}