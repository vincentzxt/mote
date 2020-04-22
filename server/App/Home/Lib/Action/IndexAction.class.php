<?php

// 本类由系统自动生成，仅供测试用途
class IndexAction extends CommonAction {

    public function index(){
        // banner调用
        $dao = M('banner');
        $map['status'] = 1;
        $res = $dao->where($map)->order('`order` desc')->select();
        $this->assign('banlist',$res);

        // 精选案例 选择一个
        $dao = D('Articles');
        $map = array();
        $map['imgflag'] = array('eq',2);
        $map['flag'] = array('eq',1); // 审核通过
        $map['iscommond'] = array('eq',1); // 是否推荐到首页
        $rescommond = $dao->where($map)->relation(true)->order('`order` desc')->limit(1)->select();
        
        $map['iscommond'] = array('eq',0); // 是否推荐到首页
        $resnocommond = $dao->where($map)->relation(true)->order('`order` desc')->limit(3)->select();
        $this->assign('alcom',$rescommond[0]);
        $this->assign('alnocom',$resnocommond);

        // 新闻列表
        $dao = D('Articles');
        $map = array();
        $map['imgflag'] = array('eq',1);
        $map['flag'] = array('eq',1); // 审核通过
        $map['tid'] = array('eq',21); // 新闻动态 21
        $news = $dao->where($map)->relation(true)->order('`order` desc')->limit(6)->select();
        $this->assign('news',$news);
        $map['imgflag'] = array('eq',0);
        $newsnopic = $dao->where($map)->relation(true)->order('`order` desc')->limit(2)->select();
        $this->assign('newsnopic',$newsnopic);
        // dump($news);

        // 最新项目
        $map = array();
        $map['imgflag'] = array('eq',1);
        $map['flag'] = array('eq',1); // 审核通过
        $map['tid'] = array('eq',22); // 新闻动态 21
        $xm = $dao->where($map)->relation(true)->order('`order` desc')->limit(1)->select();
        $this->assign('xm',$xm[0]);
        //dump($xm);

        // 最新招聘信息
        $dao = M('jobs');
        $map = array();
        $map['status'] = 1;
        $jobs = $dao->where($map)->order('`order` desc')->limit(6)->select();
        $this->assign('jobs',$jobs);
        // dump($jobs);
		$this->display();
    }

    public function head(){
        $this->display();
    }
}
