<?php

class LoginAction extends CommonAction {

    public function index(){
        
				header('Content-type:application/json;charset=utf-8');
        header("Access-Control-Allow-Origin: *");   //全域名
				header("Access-Control-Allow-Credentials: true");   //是否可以携带cookie
				header("Access-Control-Allow-Methods: POST,GET,PUT,OPTIONS,DELETE");   //允许请求方式
				header("Access-Control-Allow-Headers: *");   //允许请求字段，由客户端决定
				$data = file_get_contents("php://input");
				$data =(json_decode($data,true));
				$username = $data['username'];
        $password = md5($data['password']);
        $model = D('Customer');
        $map["username"] =  $username;
        $map["password"] = $password;
        $res = $model->where($map)->find();
        
        if ($res) {
            $arr["data"] = $res;
            $arr["success"] = 1;
						$arr["sql"] = $model->getlastsql();
            echo json_encode($arr);
        } else {
            $arr["data"] = "";
            $arr["success"] = 0;
						$arr["sql"] = $model->getlastsql();
            echo json_encode($arr);
        }
    }

    public function modifyPassword() {
      header('Content-type:application/json;charset=utf-8');
      header("Access-Control-Allow-Origin: *");   //全域名
      header("Access-Control-Allow-Credentials: true");   //是否可以携带cookie
      header("Access-Control-Allow-Methods: POST,GET,PUT,OPTIONS,DELETE");   //允许请求方式
      header("Access-Control-Allow-Headers: *");   //允许请求字段，由客户端决定
      $data = file_get_contents("php://input");
      $data =(json_decode($data,true));
      $username = $data['username'];
      $password = md5($data['password']);
      $model = D('Customer');
      $map["username"] = $username;
      $res = $model->where($map)->setField('password', $password);
      
      if ($res) {
          echo 0;
      } else {
          echo 1;
      }
  }
}
