<?php
class DiaoyongAction extends CommonAction{
	public function _before_add(){
        $daotype = M('DiaoyongType');
        $res = $daotype->where('status = 1')->select();
        // dump($res);
        $this->assign('str0',$res);
    }

    public function _before_edit(){
        $daotype = M('DiaoyongType');
        $res = $daotype->where('status = 1')->select();
        // dump($res);
        $this->assign('str0',$res);
    }
}