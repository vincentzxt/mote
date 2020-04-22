<?php 
class DataGroupModel extends RelationModel{ 
  	protected $tableName = 'data_group'; 
   
   	protected $_map = array(
		'title'         =>'name', // 把表单中name映射到数据表的username字段
		'beizhu'         =>'des', // 把表单中name映射到数据表的username字段
    );
}
?>
