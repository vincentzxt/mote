<?php
class AjaxAction extends CommonAction{
    //���� ���ݿ������$d,$b,$l�������ֶ�����$t(type)��0��ֵ��1���б�,�����ֶ�����(1,�ֶ�mf��2������mt��3Ҫ��mv)
	public function ajaxfunc(){
		//�ж�����
		$db = $_POST['d'].$_POST['l'].$_POST['b'];
	
		$dao = M($db);
		//��ѯ�����
		$map = array();
		$map[$_POST['mf']]  = array($_POST['mt'],$_POST['mv']);
		
		//���� ֵ����������
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