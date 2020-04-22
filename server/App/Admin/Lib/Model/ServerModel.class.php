<?php 
class ServerModel extends RelationModel{   
   
   protected $_auto = array(
      	array('time','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳
		array('aid','setaid',3,'callback'), // 对create_time字段在更新的时候写入当前时间戳
		array('pid','setpid',3,'callback'), // 对create_time字段在更新的时候写入当前时间戳
   );
   
   public function setaid(){
	    $id = $_POST['gid'];
	    $dao = M('ServerGroup');
		$res = $dao->where('gid ='.$id)->find();
		
	    return $res['aid'];
   } 
   
    public function setpid(){
		$id = $_POST['gid'];
	    $dao = M('ServerGroup');
		$res = $dao->where('gid ='.$id)->find();
	    return $res['pid'];
   } 
   
}
?>
