<?php
// 节点模型
class NodeModel  extends RelationModel{
    protected $_validate	=	array(
        array('name','checkNode','节点已经存在',0,'callback',1),
		array('title','require','显示名必须！'), //默认情况下用正则进行验证
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