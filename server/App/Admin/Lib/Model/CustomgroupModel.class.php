<?php 
class CustomgroupModel extends RelationModel{ 
   protected $_map = array(
	  'tid'   =>'typeid', // 把表单中name映射到数据表的username字
	
   );

   protected $_validate = array(
      array('top','/^[0-9]*[1-9][0-9]*$/i','typeid为必填,且为数字'),
	  array('textarea','require','分类名称必须填写'),
    );
}
?>
