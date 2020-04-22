<?php
class JobsAction extends CommonAction{
  /*
	*	招聘人数 number
	*	有效期  validity
	*	招聘对象 target
	*	专业要求 professional
	*	工作经验 background
	*	工作地点 place
	*	学历要求 education
	*	外语经验  language
	*	薪酬待遇 treatment
	*	年龄要求 age
	*	是否提供食宿 board
	*
	**/
	public function _before_add(){
		// 招聘类型
        $dao = M('JobType');
		$map['status'] = array('eq',1);
		$res = $dao->where($map)->select();
		$this->assign('type',$res);
	}

	public function _before_edit(){
		// 招聘类型
		$dao = M('JobType');
		$map['status'] = array('eq',1);
		$res = $dao->where($map)->select();
		$this->assign('type',$res);
	}


}