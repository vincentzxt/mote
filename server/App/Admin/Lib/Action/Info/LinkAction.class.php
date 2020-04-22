<?php
class LinkAction extends CommonAction{
    public function insert(){

        $name = MODULE_NAME;
        $model = D($name);

        $data = array();
        $arr = $model->create();

        //自动验证吧
        if (false === $arr) {
            $this->error($model->getError());
        }

        // 创建数据对象
        $data["name"]    = $arr["name"];
        $data["title"] =  $arr["title"];
        $data["order"] =  $arr["order"];
        $data["url"] =  $arr["url"];
        $data["status"] =  $arr["status"];


        //dump($_FILES);
        if ($_FILES['imgFile']['name']) {
            //如果有文件上传 上传附件到云
            // $upmodel = D('YunUpload');
            $imgurl = $this->_upload();
            if($imgurl){
                $data["pic"] = $imgurl;
            }
        }
        //dump($data);
        //保存当前数据对象
        $list = $model->add($data);

        if ($list !== false) { //保存成功
            // echo 1;
            //echo $model->getlastsql();
            $this->success('新增成功!');
        } else {
            //失败提示
            // echo $model->getlastsql();
            $this->error('新增失败!');

        }

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
        $data["name"]    = $arr["name"];
        $data["title"] =  $arr["title"];
        $data["order"] =  $arr["order"];
        $data["url"] =  $arr["url"];
        $data["status"] =  $arr["status"];

       // dump($_FILES);
        if ($_FILES['imgFile']['name']) {
            //如果有文件上传 上传附件到云
            // $upmodel = D('YunUpload');
            $imgurl = $this->_upload();
            if($imgurl){
                $data["pic"] = $imgurl;
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