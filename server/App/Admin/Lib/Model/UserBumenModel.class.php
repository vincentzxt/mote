<?php
// 节点模型
class UserBumenModel extends RelationModel{
	protected $tableName = 'user_bumen'; 
   
    protected $_validate	=	array(
        //array('name','checkNode','节点已经存在',0,'callback'),
    );
	
	protected $_auto = array ( 
		//array('create_time','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳
		//array('update_time','time',2,'function'), // 对create_time字段在更新的时候写入当前时间戳
    );


    public function checkNode() {
        $map['name']	 =	 $_POST['name'];
        $map['pid']	=	isset($_POST['pid'])?$_POST['pid']:0;
        $map['status'] = 1;
        if(!empty($_POST['id'])) {
            $map['id']	=	array('neq',$_POST['id']);
        }
        $result	=	$this->where($map)->field('id')->find();
        if($result) {
            return false;
        }else{
            return true;
        }
    }
}