<?php
class ArticlesAction extends CommonAction{
	public function index(){
		$map['imgflag'] = array('neq',2);
		$this->_index($map);
	}
 	public function _before_add(){
		$list = $this->node_listtree_func(0,$array,3,"category");
		$this->assign('sct',$list);

		$now = toDate(time(),'Y-m-d');
		$this->assign('now',$now);

		// 合作伙伴logo
		$dao = M('Link');
		$res = $dao->where('status = 1')->select();
		$this->assign('logo',$res);
	}
	public function _before_edit(){
		$list = $this->node_listtree_func(0,$array,3,"category");
		$this->assign('sct',$list);

		$now = toDate(time(),'Y-m-d');
		$this->assign('now',$now);

		// 合作伙伴logo
		$dao = M('Link');
		$res = $dao->where('status = 1')->select();
		// dump($res);
		$this->assign('logo',$res);
	}
	//默认访问上传图片的地方；
	public function add(){
		$type = $_GET['t']?:1;
		$this->assign('type',$type);
		if($type==1){
			$this->display();
		}else{
			$this->display('Photo');
		}
	}
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
		$data["age"]    = $arr["age"];
		$data["height"]    = $arr["height"];
		$data["weight"] =  $arr["weight"];
		$data["address"] =  $arr["address"];
		$data["tid"] =  $arr["tid"];
		$data["tag"] =  $arr["tag"];
		$data["time"] =  $arr["time"];
		$data["order"] =  $arr["order"];
		$data["hot"] =  $arr["hot"];
		$data["hits"] =  $arr["hits"];
		$data["shijian"] =  $arr["shijian"];
		$data["iscommond"] =  $arr["iscommond"];
		$data["linkID"] =  $arr["linkID"]; // 合作伙伴logoid

		if($_POST['type']==2){
			$data['imgflag'] = 2;
			$data["articles_con"]['Imageurl'] = $_POST["tuji"][0];
			$data["articles_con"]['Imagearr'] = serialize($_POST["tuji"]);
		}
		
		$data["articles_con"]['Body'] = $_POST["content"];
		
		
	   //dump($_FILES);
	   if ($_FILES['imgFile']['name']) {
            //如果有文件上传 上传附件到云
			// $upmodel = D('YunUpload');
			$imgurl = $this->_upload();
			if($imgurl){
				$data["imgflag"] =  1;
				$data["articles_con"]['Imageurl'] = $imgurl;
			}
       }
	   


	   //dump($data);
        //保存当前数据对象
       $list = $model->relation(true)->add($data);
		
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
      
	public function tjlist(){
		$map = array();
		$map['imgflag'] =  array('eq',2);
		$name = split('[/.-]',MODULE_NAME);
		$name = $name[0];
        $model = D($name);
		
        if (!empty($model)) {
            $this->_list($model, $map);
        }
		$this->assign('imgflag',2);
		//dump($map);
        $this->display();
	}
	
		//修改信息积累
	//关键 ：一般修改 内容会传入 主键的id数值；
	function edit(){
		$name = split('[/.-]',MODULE_NAME);
		$name = $name[0];
		$model = D($name);
		$id = $_REQUEST[$model->getPK()];
		$map = array();
		$map[$model->getPK()] = array('eq',$id);
		$vo = $model->where($map)->relation(true)->find();

		
		if($vo['imgflag']==2){
			$vo['Imagearr'] = mb_unserialize($vo['Imagearr']);
			// dump($vo);
			$this->assign('vo',$vo);
			$this->display('editPhoto');	
		}else{
			$this->assign('vo',$vo);
			$this->display();	
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
		$data['id']= $arr["id"];
		$data["name"]    = $arr["name"];
		$data["age"]    = $arr["age"];
		$data["height"]    = $arr["height"];
		$data["weight"] =  $arr["weight"];
		$data["address"] =  $arr["address"];
		$data["tid"] =  $arr["tid"];
		$data["tag"] =  $arr["tag"];
		$data["time"] =  $arr["time"];
		$data["order"] =  $arr["order"];
		$data["hot"] =  $arr["hot"];
		$data["hits"] =  $arr["hits"];
		$data["shijian"] =  $arr["shijian"];
		$data["iscommond"] =  $arr["iscommond"];
		$data["linkID"] =  $arr["linkID"]; // 合作伙伴logoid

		if($_POST['type']==2){
			$data['imgflag'] = 2;
			$data["articles_con"]['Imageurl'] = $_POST["tuji"][0];
			$data["articles_con"]['Imagearr'] = serialize($_POST["tuji"]);
		}
		
		$data["articles_con"]['Body'] = $_POST["content"];

			//dump($_FILES);
		if ($_FILES['imgFile']['name']) {
            //如果有文件上传 上传附件到云
			//$upmodel = D('YunUpload');
			$imgurl = $this->_upload();
			if($imgurl){
				$data["imgflag"] =  1;
				$data["articles_con"]['Imageurl'] = $imgurl;
			}
        }
		

	   //$data['tagid'] = $tagids;
		//dump($data);
        // 更新数据
        $list = $model->relation(true)->save($data);

        if(false !== $list) {
	        $this->success('编辑成功!');
        }else{
            $this->error('编辑失败!');
        }
	}
	
	public function successes(){
        $name = split('[/.-]',MODULE_NAME);
		$name = $name[0];
        $model = D($name);
		$map = array();
		$map['flag'] = array('eq',1);
		if($_GET['type']==2){
			$map['imgflag'] = array('eq',2);
		}
        if (!empty($model)) {
            $this->_list($model, $map);
        }
	    $this->display('index');	
	}
	
	public function nosuccesses(){
        $name = split('[/.-]',MODULE_NAME);
		$name = $name[0];
        $model = D($name);
		$map = array();
		$map['flag'] = array('neq',1);
		if($_GET['type']==2){
			$map['imgflag'] = array('eq',2);
		}
        if (!empty($model)) {
            $this->_list($model, $map);
        }
	    $this->display('index');	
	}
	//推荐到首页。更改字段
	public function command2sy(){
		$id = (int)trim($_REQUEST['id']);
		$val = (int)trim($_REQUEST['command']);
		$dao = M('Articles');
		$res = $dao->where('id ='.$id)->setField('sy_command',$val);
		//echo $dao->getlastsql();
		if($res){
			echo 1;	
		}else{
			echo 0;	
		}
	}
	
}