<?php 
class WendangModel extends RelationModel{ 
   //操作数据库 
  protected $autoReadRelations = TRUE;
 /* protected $_map = array(
	  'lanmu'   =>'tid', // 把表单中name映射到数据表的username字
	  'des'   =>'description', // 把表单中name映射到数据表的username字
	  'zuozhe'   =>'author', // 把表单中name映射到数据表的username字
	  'cchu'   =>'from', // 把表单中name映射到数据表的username字
	  'status'   =>'flag', // 把表单中name映射到数据表的username字
	  'dianji'   =>'hits', // 把表单中name映射到数据表的username字
	  'content'	=> 'Body',
	  'titile_img'=>'Imageurl'
   );*/
   
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

 
  
}
?>
