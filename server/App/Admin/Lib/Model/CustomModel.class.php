<?php 
class CustomModel extends RelationModel{ 
   protected $_map = array(
	 'top'   =>'type', // 把表单中name映射到数据表的username字
	 'paixu'   =>'Priority', // 把表单中name映射到数据表的username字
	 /* 'type'   =>'top', // 把表单中name映射到数据表的username字
	  $data['type'] = $arr['top'];
			$data['Priority'] = $arr['paixu'];
	  */
   );
   protected $_validate = array(
      array('top','/^[0-9]*[1-9][0-9]*$/i','typeid为必填,且为数字'),
	  array('textarea','require','分类名称必须'),
	  array('paixu','require','排序不能为空'),
   );

   protected $_auto = array ( 
      //array('typeName','customgroupid_to_name',1,'function'), // 对create_time字段在更新的时候写入当前时间戳
   );
}
?>
