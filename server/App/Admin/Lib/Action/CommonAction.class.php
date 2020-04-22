<?php
class CommonAction extends Action{
	//获取当前操作的对应数据权限：接口为  模块操作；
	public $ResArray = array();
	
    //前置函数
    function _initialize() {
		

		//输出当前objurl的值 module name 的值
		$this->assign('objurl',MODULE_NAME);
		$this->assign('acturl',ACTION_NAME);
		//echo ACTION_NAME;
		$this->actJiedian(__SELF__);
		
		$this->assign('sess',$_SESSION);
		//rbac权限验证
		import ('@.ORG.Util.AUDIT');
		//AUDIT::setActionsLog();
	    import('@.ORG.Util.Cookie');
			//赋值标题
		$title = C('TITLE');
		$this->assign('title',$title);
		
		
        // 用户权限检查  是否开启认证，判断当前操作是否需要认证
        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
           import('@.ORG.Util.RBAC');
		   
           if (!RBAC::AccessDecision(GROUP_NAME)) {
               
                //检查认证识别号
                if (!$_SESSION [C('USER_AUTH_KEY')]) {
                    //跳转到认证网关
                    redirect(PHP_FILE . C('USER_AUTH_GATEWAY'));
                }
                // 没有权限 抛出错误
				//echo C('RBAC_ERROR_PAGE');
                if (C('RBAC_ERROR_PAGE')) {
					// 定义权限错误页面
                    redirect(PHP_FILE . C('RBAC_ERROR_PAGE'));
					
                }else {
                    if (C('GUEST_AUTH_ON')) {
                        $this->assign('jumpUrl', PHP_FILE . C('USER_AUTH_GATEWAY'));
						$this->assign('uname', $_SESSION['loginUserName']);
                    }
                    // 提示错误信息
                    $this->error(L('_VALID_ACCESS_'));
					
                }
				
            }
			
        }		
	
		
    }
	//自动处理节点
	public function actJiedian($url){
		
		$url = str_replace(__APP__,'',$url);
		$arr = explode("/",$url);
		//dump($arr);
		$c_arr = count($arr);
		
		if($c_arr<4)return;
		$dao = M('node');
		//判断第一级有没有，没有自动添加
		$map['level'] = 1;
		$map['name'] = $arr[1];
		$map['pid'] = 0;
		
		$res1 = $dao->where($map)->find();
		
		//如果没有找到第一级分类 就添加
		if(!$res1){
		     $dao->add($map);	
			 echo $dao->getlastsql();
		}else{//查看第二级分类
			$map['level'] =2;
			$map['pid'] = $res1['id'];
			$map['name'] = $arr[2];
			$res2 = $dao->where($map)->find();
			//如果第二级不存在就添加
			if(!$res2){
				$map['title'] = dh_to_title($arr[2]);
			    $dao->add($map);
				echo $dao->getlastsql();	
			}else{
				//echo 111;
			    $map['level'] =3;
				$map['pid'] = $res2['id'];
				
				$map['name'] = ACTION_NAME;
				
				$res2 = $dao->where($map)->find();	
				if(!$res2){
					$map['title'] = $this->Jiedian2Name(ACTION_NAME);
					$dao->add($map);
					echo $dao->getlastsql();
				}
			}
		}
	}
	
	public function Jiedian2Name($actname){
		
		switch($actname){
			case 'index':
			  $val = '列表查看';
			  break;  
			case 'add':
			  $val = '添加';
			  break; 
			case 'insert':
			case 'saveAddfun':
			  $val = '执行添加';
			  break;  
			case 'update':
			case 'Saveupdatefun':
			  $val = '执行修改';
			  break;    
			case 'edit':
			  $val = '修改';
			  break;   
			case 'del':
			case 'delD':
			case 'delete':
			  $val = '删除';
			  break;
			case 'showInfo':
			case 'show':
			  $val = '查看';
			  break;    
			default:$val = '待修改';
		}
		return $val;
	}
	
	public function add(){
		$this->display();
	}
	
	protected function _search($name = '',$map=array()) {
		//dump($_REQUEST);
		$this->assign('req',$_REQUEST);
        //生成查询条件
        if (empty($name)) {
            $name = $this->getActionName();
        }

        $model = D($name);
      
		foreach ($model->getDbFields() as $key => $val) {
		    $farr[] = $val;
		}
		foreach ($_REQUEST as $key => $val) {
		    
			 $zhengzeflag = $this->match_m($key);//判断是否是模糊查询
			 
			 if($zhengzeflag){
				  $key = preg_replace("/^m_/",'',$key); //去掉 模糊查询的 m_
			      $iflag = in_array($key,$farr); //是否在数据库里存在这个字段，是 就是模糊查询
				  //dump($iflag);
				  if($iflag){
					   if($val != '') {
					      $map[$key] = array('EXP', 'REGEXP \''.$val.'\''); 
					   }
				  }
			 }else{
				// echo $key;
			      $iflag = 	in_array($key,$farr); //是否在数据库里存在这个字段，是 就是模糊查询	 
				 // dump($iflag);
				  if($iflag){
					   if($key=='time'){
						   if($val){
							     $fromtime = strtotime($val) -1;
								 $endtime = $fromtime + 3600*24 + 1;
								 $map [$key] = array(array('gt',$fromtime),array('lt',$endtime));
						   }
						   
					   }else{
						    
						    if($val != '') {
								 $isdate = $this->is_Date($val);
								 if($isdate){
									 $fromtime = strtotime($val) -1;
									 $endtime = $fromtime + 3600*24 + 1;
									 $map [$key] = array(array('gt',$fromtime),array('lt',$endtime));
								 }else{
									 $map [$key] = array('eq',$val);
								 }
								
					  		}
							  
					   }
					  
				  }else{//不存在就是 自定义查询 格式：   字段_标记   peisongriqi_start   peisongriqi_stop
					  $key = explode('_',$key);
					  $qflag = 	in_array($key[0],$farr);
					  if($qflag){
						    if($key[1]=='start'){
								if($val){
									 $fromtime = strtotime($val) -1;
								     $map[$key[0]] = array('gt',$fromtime);
								}
								
							}
							if($key[1]=='stop'){
								if($val){
								 $endtime = strtotime($val) +1;
								 $map[$key[0]] = array('lt',$endtime);
								}
							}
							if($fromtime&&$endtime){
								  $map [$key[0]] = array(array('gt',$fromtime),array('lt',$endtime));
							}
							
					  }
				  }
			 }
			 
			 //$zhengzeflag = $this->match_m($_REQUEST[]);
		}
		
	
		/*$farr = array();
        foreach ($model->getDbFields() as $key => $val) {
			array_push($farr,$val);
			echo $val.'<br>';
			$zhengzeflag = $this->match_m($val);
			dump($zhengzeflag);
            if(isset($_REQUEST[$val]) && $_REQUEST[$val] != '') {
				echo 1;
				
				dump($zhengzeflag);
				if($val=='time'){
					 $fromtime = strtotime($_REQUEST[$val]) -1;
					 $endtime = $fromtime + 3600*24 + 1;
					 $map [$val] = array(array('gt',$fromtime),array('lt',$endtime));
				}elseif($zhengzeflag){
					 $val = preg_replace("/m_/i",'',$val); 
					 $map[$val] = array('EXP', 'REGEXP \''.$_REQUEST [$val].'\''); 
				}else{
				     $map [$val] = array('eq', $_REQUEST[$val]);
				}
                
            }
        }
		dump($farr);*/
		//dump($map);
        return $map;
    }
	
	function is_Date($str,$format="Y-m-d"){
		$unixTime_1 = strtotime($str);
		if ( !is_numeric($unixTime_1) ) return 0;
			$checkDate = date($format,$unixTime_1);
			$unixTime_2 = strtotime($checkDate);;
		if($unixTime_1 == $unixTime_2){
			return 1;
		}else{
			return 0;
		}
	} 
	
	public function index() {
        //列表过滤器，生成查询Map对象
        $map = $this->_search();
	 
        if (method_exists($this, '_filter')) {
            $this->_filter($map);
        }
	  
        $name = $this->getActionName();
		//echo $name;
        $model = D($name);
	    
        if (!empty($model)) {
            $this->_list($model, $map );
        }
		
        $this->display();
        return;
    }
	//公共查询index
	public function _index($arr=array(),$html='index',$name='',$pk=0,$excel=false) {
        //列表过滤器，生成查询Map对象
		$map = $arr;
        $map = $this->_search($name,$map);
	    /*$isarr = count($arr);
		if($isarr){
		    for($i=0;$i<$isarr;$i++){
				$map[$arr[$i][0]] = $arr[$i][1];
			}	
		}*/
		
		
        if (method_exists($this, '_filter')) {
            $this->_filter($map);
        }
		//dump($map);
	    if($name==''){
			$name = $this->getActionName();
		}
       

        $model = D($name);
		//echo 11;
	    // dump($map);
        if (!empty($model)) {
            $volist = $this->_list($model, $map,'',false,$pk);
        }
	    if($excel)return $volist;
        $this->display($html);
    }
	
	public function match_m($arr){
		/**
			匹配手机号码
			规则：
				手机号码基本格式：
				前面三位为：
				移动：134-139 147 150-152 157-159 182 187 188
				联通：130-132 155-156 185 186
				电信：133 153 180 189
				后面八位为：
				0-9位的数字
		*/
		
		$rule  = "/^m_/";
		preg_match($rule,$arr,$result);
		return $result;
	}
	
	 /**
      +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param Model $model 数据对象
     * @param HashMap $map 过滤条件
     * @param string $sortBy 排序
     * @param boolean $asc 是否正序
      +----------------------------------------------------------
     * @return void
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    protected function _list($model, $map, $sortBy = '', $asc = false,$pk=0) {
		//dump($model);
        //排序字段 默认为主键名
        if (isset($_REQUEST ['_order'])) {
            $order = $_REQUEST ['_order'];
        } else {
			if($sortBy){
				$order = $sortBy;
			}else{
				$order = $pk!=0 ? $pk : $model->getPk();
			}
            
        }
		
        //排序方式默认按照倒序排列
        //接受 sost参数 0 表示倒序 非0都 表示正序
        if (isset($_REQUEST ['_sort'])) {
            $sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
        } else {
            $sort = $asc ? 'asc' : 'desc';
        }
		
        //取得满足条件的记录数
		if($pk){
			 $count = $model->where($map)->count($pk);
		}else{
			$resa = $model->where($map)->select();
			$count = count($resa);
		}
     	
		//	echo $model->getlastsql();
        if ($count > 0) {
			//echo 1;
            import("@.ORG.Util.Page");
            //创建分页对象
            if (!empty($_REQUEST ['listRows'])) {
                $listRows = $_REQUEST ['listRows'];
            }else {
                $listRows = '';
            }
            $p = new Page($count, $listRows);
            //分页查询数据
            //dump($model);
			//dump($model->modeltype);
			if($model->modeltype=="viewmodel" || empty($model->_link)){
				$voList = $model->where($map)->order("`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select();



			}else{
				$voList = $model->where($map)->relation(true)->order("`" . $order . "` " . $sort)->limit($p->firstRow . ',' . $p->listRows)->select();
				
			}
            
         //  echo $model->getlastsql();
            //分页跳转的时候保证查询条件
            foreach ($map as $key => $val) {
                if (!is_array($val)) {
					if($key!='_string')
                    $p->parameter .= "$key=" . urlencode($val) . "&";
                }
            }
            //分页显示
            $page = $p->show();
			//dump($page);
            //列表排序显示
            $sortImg = $sort; //排序图标
            $sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
            $sort = $sort == 'desc' ? 1 : 0; //排序方式
			//dump($voList);
            //模板赋值显示
            $this->assign('list', $voList);
		
			
            $this->assign('sort', $sort);
            $this->assign('order', $order);
			//dump($sortImg);
            $this->assign('sortImg', $sortImg);
            $this->assign('sortType', $sortAlt);
            $this->assign("page", $page);
			//输出主键的名称
			$this->assign('x',$model->getPK());
        }else{
		   // echo '未找到记录';	
		}
        cookie('_currentUrl_', __SELF__);
		
        return $voList;
    }
	
	//制作model验证函数
	function PutArrayCheck(){
		
	}
	
	
	//ajax 处理2维数组 切换数组方向 便于插入数据库
	//字段不能包含 item 字符
	public function ArrToArr($arr,$fiewds=''){
		$namearray = array_keys($arr);
		
		
		//处理函数包含 dt_前缀的数组。替换掉保持到 newarr 然后 赋值返回给 arr
		$newarr = array();
		$regex = "/^dt_/";
		foreach($arr as $k => $v)
		{			
				$k = preg_replace("/dt_/i",'',$k); 
				$newarr[$k] = $v;
		}
        $arr = $newarr;
		//echo 11;
		//dump($arr);
		if($fiewds!=''){
			$number = count($arr[$fiewds]);
		}else{
			//echo 2;
			$number = count($arr[$namearray[count($namearray)-1]]);
		}
		//echo 'number is:'.$number;
		for($i=0;$i<$number;$i++){
			//echo $i;
			foreach($arr as $k => $v)
			{
				//如果不是数组就过滤掉吧
				if(is_array($v)){
					$res[$i][$k] = $v[$i];
				}
			}
		}
		return $res;
    }
    //插入函数基础类
    function insert() {
		//dump($_POST);return;
       /*   输出自动model验证
		$array = array_keys($_POST);
		for($i=0;$i<count($array);$i++){
			if($_POST[$array[$i]]!=''){
				echo " array('".$array[$i]."','require','".$_POST[$array[$i]]."不能为空'),<br>";
			}
		}
		return;
		*/
		
		//dump($_POST);return;

		//处理post数据
		$_POST = $this->act_post($_POST);
        //dump($_POST);
        $name = $this->getActionName();

        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        //保存当前数据对象
        $list = $model->add();
	//	$this->savezhida($list);
	//	$this->savezhuanda($list);
        if ($list !== false) { //保存成功
           $this->success('新增成功!');
			// echo $model->getlastsql();
        } else {
            //失败提示
            echo $model->getlastsql();
			$this->error('新增失败!');
			
        }
    }
	
	//插入函数基础类
    function insertfun() {
       /*$array = array_keys($_POST);
		for($i=0;$i<count($array);$i++){
			if($_POST[$array[$i]]!=''){
				echo " array('".$array[$i]."','require','".$_POST[$array[$i]]."不能为空'),<br>";
			}
		}
		return; */
	 
		//处理post数据
		//$p = $_POST;
		$_POST = $this->act_post($_POST);
        $name = $this->getActionName();
        // echo $name;
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
		
		
    
        $list = $model->add();
	   
        if ($list !== false) { //保存成功
            //$this->success('新增成功!');
			echo $model->getlastsql();
			return $list;
        } else {
            //失败提示
            echo $model->getlastsql();
			//$this->error('新增失败!');
			return 0;
        }
    }
	
	//修改信息积累
	//关键 ：一般修改 内容会传入 主键的id数值；
	function edit(){
        
		$name = $this->getActionName();
		$model = D($name);
		//dump($model);
		//echo $model->getPK();
		$id = $_REQUEST[$model->getPK()];
		$map = array();
		$map[$model->getPK()] = array('eq',$id);
		//dump($map);
		if(empty($model->_link)){
			//echo 111;
			$vo = $model->where($map)->find();
	    }else{
			$vo = $model->relation(true)->where($map)->find();
		}
		
	   // dump($vo);
		//echo $model->getlastsql();
	    $this->assign('vo',$vo);
		$this->assign('action_name',$name);
		$this->display();
	}
	
	//展示信息
	function showInfo(){
		$name = $this->getActionName();
		//echo $name;
		$model = D($name);
		//echo $model->getPK();
		$id = $_REQUEST[$model->getPK()];
		
		$map = array();
		$map[$model->getPK()] = array('eq',$id);
		//dump($map);
		$vo = $model->relation(true)->where($map)->find();
	    //dump($vo);
		//echo $model->getlastsql();
	    $this->assign('vo',$vo);
		$this->assign('action_name',$name);
		$this->display('show');
	}
	//执行修改基类
	function update(){
	  
		//处理post数据
		$_POST = $this->act_post($_POST);
		
		$name = $this->getActionName();
	
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        // 更新数据
        $list = $model->save();
		
        if (false !== $list) {
            //成功提示
            $this->success('编辑成功!');
			//echo $model->getlastsql();
        } else {
            //错误提示
            $this->error('编辑失败!');
			//echo $model->getlastsql();
        }
	}
	
	//处理post数据，合并复选按钮，但是过滤dt——前缀的数组字段 不被合并；
	function act_post($p){
		//接收post函数
		$post_str = $p;
		//定义newpost函数数组
		$post_new = array();
	    if($post_str){
		    $array = array_keys($post_str); //存储为array 循环判断有没有数组，如果有数组存储为 '1,2,3' 等格式
		   	for($i=0;$i<count($array);$i++){
			//	echo $array[$i];
			//	dump(is_array($data[$array[$i]]));
			$regex = "/^dt_/";
			$x1 = preg_match($regex,$array[$i]);
			if(preg_match($regex,$array[$i])){
					$rename = preg_replace("/dt_/i",'',$array[$i]); 
					$post_new[$rename] = $post_str[$array[$i]];
				}else{
					if(is_array($post_str[$array[$i]])){
						 $str = '';
						 //如果是数组处理为 字段
						 for($j=0;$j<count($post_str[$array[$i]]);$j++){
							 $str .= $post_str[$array[$i]][$j].',';
							 //echo $str;
						 }
						 $post_new[$array[$i]] = $str;
					}else{
					     $post_new[$array[$i]] = $post_str[$array[$i]];	
					}
				}
			}
		}
		return $post_new;	
	}
	//执行修改基类
	function updatefun(){
		//处理post数据
		$_POST = $this->act_post($_POST);
	
		$name = $this->getActionName();
	    
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
		
        // 更新数据
        $list = $model->save();
        if (false !== $list) {
			return 1;
        } else {
			return 0;
        }
	}
	
	function ajaxdeldt(){
	
		$name = $_POST['name'];
		$id = $_POST['id'];

		$model = M($name);

		$map = array();
		$map['id'] = array('eq',$id);
		$vo = $model->where($map)->delete();
		//echo 
		if (false !== $vo) {
           //成功提示
		 //  echo $model->getlastsql();
           //$this->success('删除成功!');\
		   echo 1;
        }else {
            //错误提示
           //$this->error('编辑失败!');
		//	 echo $model->getlastsql();
			 echo 0;
        }
	}
	
	function del($name=''){
		$name = empty($name)?$this->getActionName():$name;
		$model = D($name);
		$id = $_REQUEST[$model->getPK()];
		//dump($id);
		$map = array();
	  	if($model->_extModel==''){
			$vo = $model->where($map)->delete($id);
	    }else{
			$vo = $model->relation(true)->where($map)->delete($id);
		}
		
		//echo 
		if (false !== $vo) {
        //成功提示
		   //echo $model->getlastsql();
           $this->success('删除成功!');
        } else {
            //错误提示
           $this->error('编辑失败!');
		   // echo $model->getlastsql();
        }
	}
	
	function delD($name=''){
	    $this->del($name);
	}
	
	
	  /**
      +----------------------------------------------------------
     * 取得操作成功后要返回的URL地址
     * 默认返回当前模块的默认操作
     * 可以在action控制器中重载
      +----------------------------------------------------------
     */
    function getReturnUrl() {
        return __URL__ . '?' . C('VAR_MODULE') . '=' . MODULE_NAME . '&' . C('VAR_ACTION') . '=' . C('DEFAULT_ACTION');
    }
	
	//节点管理无限极分类函数
	function node_listtree_func($id=0,$array,$level=3,$db){
		
		if($db){
		    $name = $db;
		}else{
			$name = $this->getActionName();
		}
		$model = M($name); 
		if(S('rows'.$name.$id)){
			$this->assign('x',$model->getPK());
		    //return 	S('rows'.$name.$id);
		}
	    $rows = $array;
		
		
		$map = array();
		$map['pid'] = array('eq',$id);
		//$map['id'] = array('neq',226);
		if($db=='data_authority'){

			$list = $model->where($map)->order('sort desc')->select();
		}else{
			$list = $model->where($map)->order($model->getPK())->select();
		}
		
	    foreach($list as $val){
			
			if($val['level']<=$level){
				
				if($val['level']){
				
				for($j=1;$j<$val['level'];$j++){
					$str = '----';
					$val['title'] = $str.$val['title'];
				}
			}
			//创建集合给前台调用
			$rows[] = array($val['id'],$val['name'],$val['pid'],$val['title'],$val['status'],$val['level'],$val['type'],$val['url'],$val['rename'],$val['sqlname'],$val['type_name']);
			if($db){
				$rows = $this->node_listtree_func($val['id'],$rows,$level,$db);
			}else{
				$rows = $this->node_listtree_func($val['id'],$rows,$level);
			}
			}
		}
		$this->assign('x',$model->getPK());
		S('rows'.$name.$id,$rows);
		return $rows;
	}
    //多维数组查询无限极分类
	function array_listtree_func($id=0,$db,$map=array()){
		if(S('list'.$db.$id)){
		    //echo 1;
			if(empty($map)){
			    //echo 2;
				return 	S('list'.$db.$id);
			}
		}
		
		$model = M($db); 

		$map['pid'] = array('eq',$id);
		$map['status'] = array('eq',1);
		if($db=='data_authority'){
			$list = $model->where($map)->order('sort desc')->select();
		}else{
			$list = $model->where($map)->order($model->getPK())->select();
		}
		
		if(count($list)){
			for($i=0;$i<count($list);$i++){
				$list[$i][] = $this->array_listtree_func($list[$i]['id'],$db,$map);
			}
		}
		if(empty($map)){
			S('list'.$db.$id,$list);
		}
		return $list;
	}
	
	//数据权限检查
	function data_checkchmod($id){
		//获取权限列表
		$dao = M('data_authority');
		$map = array();
		$map['id'] = array('eq', $id);
		$map['level'] = array('in','2,3');
		$list = $dao->where($map)->select();
	
		return $list;		
	}
	//格式化统计数据
	function resdatafunc($id){  //$str 为 数据管理的id的值。
	 
		 $this->ResArray = $this->data_checkchmod($id);  //赋值 公共变量。
		
	     if($this->ResArray){
			 $sqlname = strtolower($this->ResArray[0]['sqlname']);
			 $rename = strtolower($this->ResArray[0]['rename']);
		 }else{
		 	 return;
		 }
	
		 
		 $dao = M($sqlname);
		 $res = $dao->order('time')->select();
	  
		 
		 $data = array();
	
		  //处理参数合并数组；
		 for($i=0;$i<count($res);$i++){
				$data['time'][] = DataToDate($res[$i]['time'],$format = 'Y-m-d');
				$data['data'][] = intval($res[$i]['number']);
				
		 }
		 $data['time'] = json_encode($data['time']);
		 $data['data'] = json_encode($data['data']);
		 $data['rename'] = $rename;
		 $data['array'] = $res;
		 return $data;	
	}
	//查询一组 （N个子目录的统计 ： 横向分栏表）
	function one_array_s($id){
	
		$dao = M('data_authority');
		$map = array();
		$map['pid'] = array('eq', $id);
		$map['level'] = array('eq',3);
		
		$list = $dao->where($map)->field('id,sqlname')->select();
	 
		$resdata = array();
		for($i=0;$i<count($list);$i++){
			$resdata[$list[$i]['sqlname']] = $this->resdatafunc($list[$i]['id']);
		}
		return $resdata;
	}
	
	//菜单列表筛选数组  $array 为自定义字段id的数据  ，Str 为输出到页面里面的 动态标签的前缀 如： Str1,Str2 等
	function ArrayCtllistmenu($array,$str){
		for($i=0;$i<count($array);$i++){
			 $str1 = $str.$i;  
			 $strdata = ctllistmenu($array[$i]);
			
			 $this->assign($str1,$strdata);
		}
	}
	
	//操作控制函数 序列化函数  
	function sendjson($arr){
		return json_encode($arr);
	}
	
	
	public function delete() {
        //删除指定记录
        $name = $this->getActionName();
        $model = D($name);
        if (!empty($model)) {
            $pk = $model->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                if (false !== $model->where($condition)->delete()) {
                    $this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }
	//上传文件
    public function _upload(){
			import('@.ORG.UploadFile');
			$upload = new UploadFile();// 实例化上传类
			$upload->maxSize  = 3145728 ;// 设置附件上传大小
			//$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->savePath =  './Public/Uploads/'.date("Y/m/d").'/';// 设置附件上传目录
			

			create_folders($upload->savePath);
			
			if(!$upload->upload()) {
				// 上传错误提示错误信息
				//$this->error($upload->getErrorMsg());
				$info = '';
			}else{// 上传成功 获取上传文件信息
				$info =  $upload->getUploadFileInfo();
			}
			
			return $info;
    }
	
	//保存附件
	public function _savefile($id,$db,$Field,$arr){
		$fileinfo = $arr;
		$dao = M($db);
		$data[$Field] = $fileinfo["savepath"].$fileinfo["savename"];	
		$res = $dao->where('id = '.$id)->save($data);
		echo $dao->getlastsql();
	}
	
	
	    /**
         +----------------------------------------------------------
         * Export Excel | 2013.08.23
         * Author:HongPing <hongping626@qq.com>
         +----------------------------------------------------------
         * @param $expTitle     string File name
         +----------------------------------------------------------
         * @param $expCellName  array  Column name
         +----------------------------------------------------------
         * @param $expTableData array  Table data
         +----------------------------------------------------------
         */
        public function exportExcel($expTitle,$expCellName,$expTableData){
            $xlsTitle = iconv('utf-8', 'utf-8', $expTitle);//文件名称
            $fileName = $expTitle.date('-Y-m');//or $xlsTitle 文件名称可根据自己情况设定
            $cellNum = count($expCellName);
            $dataNum = count($expTableData);
            vendor("PHPExcel.PHPExcel");
            $objPHPExcel = new PHPExcel();
            $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');
            
            $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.' 导出时间:'.date('Y-m-d H:i:s'));  
			
            for($i=0;$i<$cellNum;$i++){
					 $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]); 
            } 
			
			$hang = 0;//增量
			//echo $dataNum.'<br>';
              // Miscellaneous glyphs, UTF-8   
            for($i=0;$i<$dataNum;$i++){
			 // echo '第几排数据 $i:'.$i.'<br>';
              for($j=0;$j<$cellNum;$j++){
				
				$explodeArray = explode('.',$expCellName[$j][0]);
				//dump($explodeArray);
				$explodeArrNum = count($explodeArray);
				//echo $explodeArrNum.':当前变量 count <br>';
				
			    if($explodeArrNum==1){
					$zeng = 0;
					if($expCellName[$j][2]){
					     $funstr = $expCellName[$j][2];	
						 $lsval =  $funstr($expTableData[$i][$expCellName[$j][0]]);
					}else{
						 $lsval =  $expTableData[$i][$expCellName[$j][0]];
					}
					
					$objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3+$hang), $lsval);
					
				}elseif($explodeArrNum==2){
					$zeng = 0;
					// dump($expTableData[$i]['hw']);
					// echo '第2当前值：'.$expTableData[$i][$explodeArray[0]][$explodeArray[1]].'<br>';
				     $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3+$hang), $expTableData[$i][$explodeArray[0]][$explodeArray[1]]); 	
				}elseif($explodeArrNum==3){
					
					 
					 $ls_arr = $expTableData[$i][$explodeArray[0]];
					 $zeng = count($ls_arr)-1;
					 for($k=0;$k<count($ls_arr);$k++){
						
						 if($expCellName[$j][2]){
					     	$funstr = $expCellName[$j][2];	
						 	$lsval =  $funstr($expTableData[$i][$explodeArray[0]][$k][$explodeArray[2]]);
						 }else{
						 	$lsval =  $expTableData[$i][$explodeArray[0]][$k][$explodeArray[2]];
					     }
						 // dump($expTableData[$i][$explodeArray[0]][$k]);
						 // echo '第3当前值：'.$expTableData[$i][$explodeArray[0]][$k][$explodeArray[2]].'<br>';
					      $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3+$k+$hang),$lsval); 	 
					 }
					 
					 
				}
				
              }   
			  $hang +=  $zeng;         
            }  
            
            header('pragma:public');
            header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
            header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  
            $objWriter->save('php://output'); 
            exit;   
        }
         
        /**
         +----------------------------------------------------------
         * Import Excel | 2013.08.23
         * Author:HongPing <hongping626@qq.com>
         +----------------------------------------------------------
         * @param  $file   upload file $_FILES
         +----------------------------------------------------------
         * @return array   array("error","message")
         +----------------------------------------------------------     
         */   
        public function importExecl($file){ 
            if(!file_exists($file)){ 
                return array("error"=>0,'message'=>'file not found!');
            } 
            Vendor("PHPExcel.PHPExcel.IOFactory"); 
            $objReader = PHPExcel_IOFactory::createReader('Excel5'); 
            try{
                $PHPReader = $objReader->load($file);
            }catch(Exception $e){}
            if(!isset($PHPReader)) return array("error"=>0,'message'=>'read error!');
            $allWorksheets = $PHPReader->getAllSheets();
            $i = 0;
            foreach($allWorksheets as $objWorksheet){
                $sheetname=$objWorksheet->getTitle();
                $allRow = $objWorksheet->getHighestRow();//how many rows
                $highestColumn = $objWorksheet->getHighestColumn();//how many columns
                $allColumn = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $array[$i]["Title"] = $sheetname; 
                $array[$i]["Cols"] = $allColumn; 
                $array[$i]["Rows"] = $allRow; 
                $arr = array();
                $isMergeCell = array();
                foreach ($objWorksheet->getMergeCells() as $cells) {//merge cells
                    foreach (PHPExcel_Cell::extractAllCellReferencesInRange($cells) as $cellReference) {
                        $isMergeCell[$cellReference] = true;
                    }
                }
                for($currentRow = 1 ;$currentRow<=$allRow;$currentRow++){ 
                    $row = array(); 
                    for($currentColumn=0;$currentColumn<$allColumn;$currentColumn++){;                
                        $cell =$objWorksheet->getCellByColumnAndRow($currentColumn, $currentRow);
                        $afCol = PHPExcel_Cell::stringFromColumnIndex($currentColumn+1);
                        $bfCol = PHPExcel_Cell::stringFromColumnIndex($currentColumn-1);
                        $col = PHPExcel_Cell::stringFromColumnIndex($currentColumn);
                        $address = $col.$currentRow;
                        $value = $objWorksheet->getCell($address)->getValue();
                        if(substr($value,0,1)=='='){
                            return array("error"=>0,'message'=>'can not use the formula!');
                            exit;
                        }
                        if($cell->getDataType()==PHPExcel_Cell_DataType::TYPE_NUMERIC){
                            $cellstyleformat=$cell->getParent()->getStyle( $cell->getCoordinate() )->getNumberFormat();
                            $formatcode=$cellstyleformat->getFormatCode();
                            if (preg_match('/^([$[A-Z]*-[0-9A-F]*])*[hmsdy]/i', $formatcode)) {
                                $value=gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value));
                            }else{
                                $value=PHPExcel_Style_NumberFormat::toFormattedString($value,$formatcode);
                            }                
                        }
                        if($isMergeCell[$col.$currentRow]&&$isMergeCell[$afCol.$currentRow]&&!empty($value)){
                            $temp = $value;
                        }elseif($isMergeCell[$col.$currentRow]&&$isMergeCell[$col.($currentRow-1)]&&empty($value)){
                            $value=$arr[$currentRow-1][$currentColumn];
                        }elseif($isMergeCell[$col.$currentRow]&&$isMergeCell[$bfCol.$currentRow]&&empty($value)){
                            $value=$temp;
                        }
                        $row[$currentColumn] = $value; 
                    } 
                    $arr[$currentRow] = $row; 
                } 
                $array[$i]["Content"] = $arr; 
                $i++;
            } 
            spl_autoload_register(array('Think','autoload'));//must, resolve ThinkPHP and PHPExcel conflicts
            unset($objWorksheet); 
            unset($PHPReader); 
            unset($PHPExcel); 
            unlink($file); 
            return array("error"=>1,"data"=>$array); 
        }
	
	public  function impUser(){
         if(isset($_FILES["import"]) && ($_FILES["import"]["error"] == 0)){
            $result = $this->importExecl($_FILES["import"]["tmp_name"]);
            if($result["error"] == 1){          
              $execl_data = $result["data"][0]["Content"];
                      foreach($execl_data as $k=>$v){
                         // ..这里写你的业务代码..
                      }
             }
          }
    }
		
	public function expExcel($name,$xlsfields,$xlsData){//导出Excel
            $xlsName  = $name;
			$xlsCell = $xlsfields;
          /*  $xlsCell  = array(
                array('id','账号序列'),
                array('account','登录账户'),
                array('nickname','账户昵称')
            );*/
           // $xlsModel = M('Post');
           // $xlsData  = $xlsModel->Field('id,account,nickname')->select();
            $this->exportExcel($xlsName,$xlsCell,$xlsData);
    }
	
	//初始化流程表
	public function _auto_liucheng($dbid,$dd_id,$yundanhao,$hwheji,$huohao,$danhao,$time,$zerenren,$jieduan,$flag='是',$peisongren=0){
		$dao = M('hwliucheng');
		$data = array();
		$data['dabaohw_id'] = $dbid;
		$data['dd_id'] = $dd_id;
		$data['yundanhao'] = $yundanhao;
		$data['chengyunjianshu'] = $hwheji;
		$data['xuhao'] = $huohao;
		$data['danhao'] = $danhao;
		$data['shijian'] = $time;
		$data['zerenren'] = $zerenren;
		$data['jieduan'] = $jieduan;
		$data['flag'] = $flag;
		$data['peisongren'] = $peisongren;
		//插入流程数据
		$dao->add($data);
		//echo $dao->getlastsql();
		
	}
	
	//查询当前状态的运单号数组 ， 收获  入库   装车    承运  入库  配送
	//$jd 阶段
	public function select_hwliucheng($jd){
	    $dao = M('hwliucheng');	
		$map = array();
		$map['jieduan'] = $jd;
		
		$res = $dao->where($map)->field('yundanhao')->group('yundanhao')->select();
	
		$yundanhaoarr = array();
		if($res){
		    for($i=0;$i<count($res);$i++){
				$f1 = count($this->select_hwlc($res[$i]['yundanhao'],0,$jd));
				$f2 = $this->select_dabaohw($res[$i]['yundanhao']);
		
			    if($f1==$f2){
					array_push($yundanhaoarr,$res[$i]['yundanhao']);	
				}
			    
			}	
		}
		return $yundanhaoarr;
	}
	//获取运单的货物总数
	public function select_dabaohw($yundanhao){
		$dao = M('dabaohw');
		$res = $dao->where('yundanhao = "'.$yundanhao.'"')->getField('chengyunjianshu');
		return $res;
	}
	//获取运单的货物总数
	public function select_dabaohw_ddid($yundanhao){
		$dao = M('dabaohw');
		$res = $dao->where('yundanhao = "'.$yundanhao.'"')->getField('dd_id');
		return $res;
	}
	//获取流程阶段的货物数量
	public function select_hwlc($yundanhao=0,$dd_id=0,$jd){
		$dao = M('hwliucheng');	
		$map = array();
		$map['jieduan'] = $jd;
		if($yundanhao){
			$map['yundanhao'] = $yundanhao;
		}
		if($dd_id){
			$map['dd_id'] = $dd_id;
		}
		//dump($map);
		
		$res = $dao->where($map)->field('dabaohw_id')->select();
		//echo $dao->getlastsql();
		$arr = array();
		for($i=0;$i<count($res);$i++){
		   	array_push($arr,$res[$i]['dabaohw_id']);
		}
		//dump($arr);
		return $arr;
	}
	//流程包格式化 输入流程包数组  输出流程包列表格式
	public function liucB_XLH($res){
		//dump($res);
		$arr = array();
		$jianzhi = array_keys($res);//获取键值
		for($i=0;$i<count($res);$i++){
			$arr[$i]['id'] = $res[$i]['id'];	
			$arr[$i]['yundanhao'] = $res[$i]['yundanhao'];	
		
		}
		
		$arr = assoc_unique($arr,'yundanhao');
		//dump($arr);
	    $lsarray = array();
		for($i=0;$i<count($arr);$i++){
			$lsarray[$i]['id'] = $i;
			$lsarray[$i]['yundanhao'] = $arr[$i];
			$lsarray[$i]['chengyunjianshu'] = $this->select_dabaohw($arr[$i]);
			$lsarray[$i]['dd_id'] = $this->select_dabaohw_ddid($arr[$i]);
			$s_arr = array();
		    for($j=0;$j<count($res);$j++){
				$ss = array();
				if($res[$j]['yundanhao'] == $arr[$i]){
					
					//array_push($lsarray[$i]['yundanhao']['hwb'][$j]['xuhao'],$res[$j]['xuhao']);	
					$ss['id'] = $res[$j]['dabaohw_id'];	
					$ss['xuhao'] = $res[$j]['xuhao'];	
					$ss['flag'] = $res[$j]['flag'];
				}
				if(count($ss)>1){
					$s_arr[] = $ss;
				}
				
			}
			
			$lsarray[$i]['hwb'] = $s_arr;
	
		}

		return $lsarray;
		
	}
	
	public function deletehwb(){
		$dd_id = $_REQUEST['dd_id'];
		$jieduan = $_REQUEST['jieduan'];
		$dao = M('hwliucheng');
		$map = array();
		$map['dd_id'] = $dd_id;
		$map['jieduan'] = $jieduan;
		
		$res = $dao->where($map)->delete();
		if($res){
		   echo 1;	
		}else{
		   echo $dao->getlastsql();	
		}
		
	}
	
		//AJAX 自动完成
	public function autoCompleteInputVar(){
		$db = $_REQUEST['db'];
		//条件名称
		$tj = $_REQUEST['tj'];
		$tjval = trim(isset($_REQUEST['tjval']))?$_REQUEST['tjval']:trim($_REQUEST['term']);
		$th = $_REQUEST['th'];
		
		
		$map = array();
		if($tjval){
			$map[$tj] = array('like','%'.$tjval.'%');
		}
		
		
		$dao = M($db);
		$res = $dao->where($map)->order('id desc')->limit(15)->select();
		
	    for($i=0;$i<count($res);$i++){
			$res[$i]['label'] = $res[$i][$th];	
		}
		
		echo json_encode($res);
		
		
	}
	
	public function auto_khid(){
	    $dao = M('khgy_kh');
		$id = $dao->max('id');
		$str = 'KH'.date('ymd').'-'.$id;
		$this->assign('autokhid',$str);
		return $str;
	}
	
			//后台页面
	public function clearAdminCache(){
		header("Content-type: text/html; charset=utf-8");
		//清文件缓存
		$dirs = array('Admin/Runtime/');
		@mkdir('Runtime',0777,true);
		//清理缓存
		foreach($dirs as $value) {
			$this->rmdirr($value);
		}
		echo '<div style="color:red;">系统缓存清除成功！</div>';
	}
	//处理方法
	public function rmdirr($dirname) {
		if (!file_exists($dirname)) {
			return false;
		}
		if (is_file($dirname) || is_link($dirname)) {
			return unlink($dirname);
		}
		$dir = dir($dirname);
		if($dir){
			while (false !== $entry = $dir->read()) {
			if ($entry == '.' || $entry == '..') {
				continue;
			}
			//递归
			$this->rmdirr($dirname . DIRECTORY_SEPARATOR . $entry);
			}
		}
		$dir->close();
		return rmdir($dirname);
	}
	
	

}