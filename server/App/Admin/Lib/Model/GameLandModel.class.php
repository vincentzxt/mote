<?php 
class GameLandModel extends RelationModel{ 
  
   
   protected $_auto = array(
      	array('createtime','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳
		array('updatetime','time',3,'function'), // 对create_time字段在更新的时候写入当前时间戳
   );

 
  
}
?>
