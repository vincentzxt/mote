<?php 
class OnepageModel extends RelationModel{ 
   protected $_map = array(
	  'lanmu'   =>'id', // 把表单中name映射到数据表的username字
	  'lanmuname'   =>'tname', // 把表单中name映射到数据表的username字
	  'content'=>'Body'
   );
   
   protected $_validate = array(
      array('tid','/^[0-9]*[1-9][0-9]*$/i','请选择栏目'),
	  array('tname','require','栏目名称不能为空'),
	  array('meta','require','网页关键字不能为空'),
	  array('des','require','描述不能为空'),
	  array('Body','require','内容不能为空'),
    );

   protected $_auto = array ( 
	  
   );
   
  
}
?>
