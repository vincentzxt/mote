<?php 
class CategoryModel extends CommonModel{ 
   protected $_validate	=	array(
	    array('title','require','栏目名称必须'),
    );
	
	protected $_auto = array ( 
		array('time','time',1,'function'), // 对create_time字段在更新的时候写入当前时间戳
		array('update_time','time',2,'function'), // 对create_time字段在更新的时候写入当前时间戳
    );
}
?>
