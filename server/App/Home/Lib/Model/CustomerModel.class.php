<?php 
import('@.Model.RelationModel');
class LoginModel extends RelationModel{ 
   //操作数据库 
  protected $autoReadRelations = TRUE;
 protected $_map = array(
	  'username'   =>'username', 
	  'password'   =>'password'
   );
   
   protected $_validate = array(
      array('tid','/^[0-9]*[1-9][0-9]*$/i','请选择栏目'),
	  array('title','require','标题名称必须'),
	 // array('description','require','描述必须'),
	//  array('tag','require','tag必须'),
	  array('author','require','作者必须'),
	//  array('hits','require','点击次数必须'),
	//  array('from','require','来自必须'),
	  array('Body','require','内容必须'),
    );

   protected $_auto = array ( 
	  array('time','time',3,'function'), // 对create_time字段在更新的时候写入当前时间戳
	  array('update_time','time',2,'function'), // 对create_time字段在更新的时候写入当前时间戳
	  array('uid','1'),  // 新增的时候把status字段设置为1
	//  array('tag','setTagval',2,'callback'), 
   );
   
   //操作数据库   关联数据表
   public $_link = array(
	 'articles_con'=>array(
		 'mapping_type' =>HAS_ONE,
		 'class_name'  =>'articles_con',  //要关联的模型类名
		 'mapping_name'=>'articles_con',
		 'foreign_key'=>'Aid',                //关联的外键名称
		 'mapping_fields'=>'Body,Imageurl,Imagearr',
		 'as_fields'=>'Body,Imageurl,Imagearr',
	  )
   ); 
   
  

}
?>
