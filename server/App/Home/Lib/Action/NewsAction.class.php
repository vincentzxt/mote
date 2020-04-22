<?php
// 本类由系统自动生成，仅供测试用途
class NewsAction extends CommonAction {

    public function index(){
        $this->commonhead(21,7);

        $model = D('Articles');
        // 文章列表1 图片列表2
        $map['imgflag'] = array('eq',2);
        // 这个是栏目id
        $map['tid'] = array('eq',52);
        $data =  $this->_listJson($model,$map,'time',false,true);
        foreach ($data["data"] as $key => $vo) {
            if($vo['imgflag']==2) {
                $data["data"][$key]['Imagearr'] = mb_unserialize($vo['Imagearr']);
            }
        }
        header("Access-Control-Allow-Origin: *");   //全域名
				header("Access-Control-Allow-Credentials: true");   //是否可以携带cookie

				header("Access-Control-Allow-Methods: POST,GET,PUT,OPTIONS,DELETE");   //允许请求方式
				header("Access-Control-Allow-Headers: X-Custom-Header");   //允许请求字段，由客户端决定
				header("Content-Type: text/html; charset=utf-8"); //返回数据类型（ text/html; charset=utf-8、 application/json; charset=utf-8 )
        echo json_encode($data);
//		$this->display();
    }

    public function projects(){
        $this->commonhead(22,7);

        $model = D('Articles');
        // 文章列表
        $map['imgflag'] = array('Neq',2);
        $map['tid'] = array('eq',22);
        $this->_list($model,$map,'time',false,true);
        $this->display();
    }

    public function commonhead($nowid,$pid){
        $this->tophead($pid);
        $dao = M('category');
            // 获取当前分类相关信息
        $now = $dao->where('id = '.$nowid)->find();
        $this->assign('now',$now);
            // 获取子分类信息
        $res = $dao->where('pid = '.$pid)->select();
        $this->assign('category',$res);
    }

    public function detail(){
        $this->commonhead();
				header("Access-Control-Allow-Origin: *");   //全域名
        header("Access-Control-Allow-Credentials: true");   //是否可以携带cookie
  
        header("Access-Control-Allow-Methods: POST,GET,PUT,OPTIONS,DELETE");   //允许请求方式
        header("Access-Control-Allow-Headers: X-Custom-Header");   //允许请求字段，由客户端决定
        header("Content-Type: text/html; charset=utf-8"); //返回数据类型（ text/html; charset=utf-8、 application/json; charset=utf-8 )
        $id = $_GET['id'];
        $dao = D('Articles');
        $res = $dao->relation(true)->where('id = %d ',$id)->find();
        if ($res) {
            $res['Imagearr'] = mb_unserialize($res['Imagearr']);
            $arr["data"] = $res;
            $arr["success"] = 1;
            echo json_encode($arr);
        } else {
            $arr["data"] = "";
            $arr["success"] = 0;
            echo json_encode($arr);
        }

        // dump($res);
//        $this->assign('vo',$res);

        //上一篇 下一篇文章
//        $res_s = $dao->where('tid = '.$res['tid'].' and id < %d ',$id)->order('id desc')->limit('0,1')->find();
//        $res_x = $dao->where('tid = '.$res['tid'].' and id > %d ',$id)->order('id desc')->limit('0,1')->find();
//        $this->assign('vo_s',$res_s);
//        $this->assign('vo_x',$res_x);
//        $this->display();
    }
}
