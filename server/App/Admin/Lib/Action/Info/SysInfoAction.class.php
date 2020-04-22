<?php
class SysInfoAction extends CommonAction{
	public function edit(){
        $dao = M('SysInfo');
        $res = $dao->find(1);
        // dump($res);
        $this->assign('vo',$res);
        $this->display();
    }

    public function _upload() {
        if (!empty($_FILES)) {
            import("@.ORG.UploadFile");
            $config=array(
                'thumb'=>TRUE,
                'allowExts'=>array('jpg','gif','png'),
                'savePath'=>'./Public/Upload/Article/',
                'saveRule'=>'time',
                'thumbPath'=>'./Public/Upload/Article/thumb/',// 缩略图保存路径
                'thumbFile'=>'',// 缩略图文件名
                'thumbMaxWidth'     =>  '315',// 缩略图最大宽度
                'thumbMaxHeight'    =>  '170',// 缩略图最大高度
            );
            $upload = new UploadFile($config);
            $upload->imageClassPath="@.ORG.Image";

            if (!$upload->upload()) {
                $this->error($upload->getErrorMsg());
            }else {
                $info = $upload->getUploadFileInfo();
                $res =  $config['savePath'].$info[0]['savename'];
                return $res;
            }
        }
    }

    //执行修改基类
    function update(){
        $name = split('[/.-]',MODULE_NAME);
        $name = $name[0];

        $model = D($name);
        $arr = $model->create();
        if (false === $arr) {
            $this->error($model->getError());
        }


        // 创建数据对象
        $data['id'] = $arr["id"];
        // 创建数据对象
        $data["webname"]    = $arr["webname"];
        $data["domain"] =  $arr["domain"];
        $data["beian"] =  $arr["beian"];
        $data["meta"] =  $arr["meta"];
        $data["dianhua"] =  $arr["dianhua"];
        $data["email"] =  $arr["email"];
        $data["dizhi"] =  $arr["dizhi"];
        $data["beian"] =  $arr["beian"];

        // dump($_FILES);
        if ($_FILES['imgFile']['name']) {
            //如果有文件上传 上传附件到云
            // $upmodel = D('YunUpload');
            $imgurl = $this->_upload();
            if($imgurl){
                $data["logo"] = $imgurl;
            }
        }


        //$data['tagid'] = $tagids;

        // 更新数据
        $list = $model->save($data);
        //dump($list);

        if(false !== $list) {
            $this->success('编辑成功!');
        }else{
            $this->error('编辑失败!');
        }
    }
}