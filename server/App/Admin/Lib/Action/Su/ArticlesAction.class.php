<?php
class ArticlesAction extends CommonAction{
	//获取总部通知
	public function lindex(){
		  //列表过滤器，生成查询Map对象
        $map = $this->_search();
	
		$map['fgs_id'] = array('eq',1);
        if (method_exists($this, '_filter')) {
            $this->_filter($map);
        }
        $name = $this->getActionName();
        $model = D($name);
		
        if (!empty($model)) {
            $this->_list($model, $map);
        }
		//dump($map);
        $this->display();
	}
	
	//获取总部通知
	public function findex(){
		  //列表过滤器，生成查询Map对象
        $map = $this->_search();
	
		//$map['fgs_id'] = $_SESSION['fgs_id'];
	    $map['fgs_id'] = array('neq',1);
        if (method_exists($this, '_filter')) {
            $this->_filter($map);
        }
        $name = $this->getActionName();
        $model = D($name);
		
        if (!empty($model)) {
            $this->_list($model, $map);
        }
		
        $this->display();
	}
	
	public function index(){
		  //列表过滤器，生成查询Map对象
        $map = $this->_search();
	
        if (method_exists($this, '_filter')) {
            $this->_filter($map);
        }
        $name = $this->getActionName();
        $model = D($name);
		
        if (!empty($model)) {
            $this->_list($model, $map);
        }
		//dump($map);
        $this->display();
	}
 	public function _before_add(){
		$list = $this->node_listtree_func(0,$array,3,"category");
		$this->assign('sct',$list);
		$model	=	M("user_company");
        $list1	=	$model->where('status=1')->select();
        $this->assign('clist',$list1);
	}
	public function _before_edit(){
		$list = $this->node_listtree_func(0,$array,3,"category");
		$this->assign('sct',$list);
		$model	=	M("user_company");
        $list1	=	$model->where('status=1')->select();
        $this->assign('clist',$list1);
	}
	
	public function insert(){
		
	  //  dump($_POST);
		
		$name = $this->getActionName();
		
        $model = D($name);
		$data = array();
		$arr = $model->create();
        //自动验证吧
        if (false === $arr) {
            $this->error($model->getError());
        }
		
        // 创建数据对象
		$data["title"]    = $arr["title"];
		$data["author"] =  $arr["author"];
		$data["from"] =  $arr["from"];
		$data["description"] =  $arr["description"];
		$data["tid"] =  $arr["tid"];
		$data["tag"] =  $arr["tag"];
		$data["flag"] =  $arr["flag"];
		$data["time"] =  $arr["time"];
		$data["fgs_id"] =  $arr["fgs_id"];

		if($_POST['type']==2){
			$data['imgflag'] = 2;
			$data["articles_con"]['Imageurl'] = $_POST["tuji"][0];
			$data["articles_con"]['Imagearr'] = serialize($_POST["tuji"]);
		}
		$data["articles_con"]['Body'] = $_POST["content"];
		
		if ($_FILES['image']['name']) {
            //如果有文件上传 上传附件
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
		    echo 1;
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
                'savePath'=>'./Public/Images/Upload/Article/',
                'saveRule'=>'time',
				'thumbPath'=>'./Public/Images/Upload/Article/thumb/',// 缩略图保存路径
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
		$name = $this->getActionName();
        $model = D($name);
		
        if (!empty($model)) {
            $this->_list($model, $map);
        }
		//dump($map);
        $this->display('index');
	}
	
		//修改信息积累
	//关键 ：一般修改 内容会传入 主键的id数值；
	function edit(){
		$name = $this->getActionName();
		$model = D($name);
		$id = $_REQUEST[$model->getPK()];
		
		$map = array();
		$map[$model->getPK()] = array('eq',$id);
		$vo = $model->where($map)->relation(true)->find();
		
		if($vo['imgflag']==2){
			$vo['Imagearr'] = mb_unserialize($vo['Imagearr']);
		//	dump($vo);
			$this->assign('vo',$vo);
			$this->display('editPhoto');	
		}else{
			$this->assign('vo',$vo);
			$this->display();	
		}
	}
	
  
	
	//执行修改基类
	function update(){
	//	dump($_POST);
		$name = $this->getActionName();
        $model = D($name);
		$arr = $model->create();
        if (false === $arr) {
            $this->error($model->getError());
        }
		
		
        // 创建数据对象
		$data['id']= $arr["id"];
		$data["title"]    = $arr["title"];
		$data["author"] =  $arr["author"];
		$data["from"] =  $arr["from"];
		$data["description"] =  $arr["description"];
		$data["tid"] =  $arr["tid"];
		$data["tag"] =  $arr["tag"];
		$data["flag"] =  $arr["flag"];
		$data["time"] =  $arr["time"];
		$data["fgs_id"] =  $arr["fgs_id"];
		
		if($_POST['type']==2){
			$data['imgflag'] = 2;
			$data["articles_con"]['Imageurl'] = $_POST["tuji"][0];
			$data["articles_con"]['Imagearr'] = serialize($_POST["tuji"]);
		}
		
		$data["articles_con"]['Body'] = $_POST["content"];

		if ($_FILES['image']['name']) {
            //如果有文件上传 上传附件
            $imgurl = $this->_upload();
			if($imgurl){
				$data["imgflag"] =  1;
				$data["articles_con"]['Imageurl'] = $imgurl;
			}
        }
	//	dump($data);
        // 更新数据
        $list = $model->relation(true)->save($data);
		echo $model->relation(true)->getlastsql();
        if(false !== $list) {
	        $this->success('编辑成功!');
        }else{
           // $this->error('编辑失败!');
        }
	}
	
	public function successes(){
        $name = $this->getActionName();
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
        $name = $this->getActionName();
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
	
	public function detail(){
	    $id = $_GET['id'];
		$tid = $_GET['tid'];
		$dao = D('Articles');
		$res = $dao->relation(true)->where('id ='.$id)->find();
		//echo $dao->getlastsql();
		
		if(!$res){
		  	$this->redirect('/404.html');
		}

		
		//上一篇 下一篇文章
		$res_s = $dao->where('tid = '.$tid.' and id < %d ',$id)->order('id desc')->limit('0,1')->find();
		$res_x = $dao->where('tid = '.$tid.'and id > %d ',$id)->order('id desc')->limit('0,1')->find();
		$this->assign('vo_s',$res_s);
		$this->assign('vo_x',$res_x);
		
		$this->assign('vo',$res);
		$this->display('news_detail');	
	}
	
}