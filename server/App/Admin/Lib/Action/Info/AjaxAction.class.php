<?php
class AjaxAction extends CommonAction{
    //输入 数据库表名称$d,$b,$l，返回字段类型$t(type)（0：值，1：列表）,返回字段条件(1,字段mf，2，条件mt，3要求mv)
	public function ajaxfunc(){
		//判断输入
		$db = $_POST['d'].$_POST['l'].$_POST['b'];
	
		$dao = M($db);
		//查询结果集
		$map = array();
		$map[$_POST['mf']]  = array($_POST['mt'],$_POST['mv']);
		
		//返回 值，还是数组
		if($_POST['t']==0){
			$res = $dao->where($map)->find();
		}else{
		    $res = $dao->where($map)->select();	
		}
		echo sendjson($res);
	} 
	public function changepass(){
	    $id = $_POST['id'];
		//echo $id;
		$pass = $_POST['pass'];
		$dao = M('user');
		$data = array();
		$data['password'] = $pass;
		$res = $dao->where('ids = '.$id)->save($data);
		echo sendjson($res);
	}
}