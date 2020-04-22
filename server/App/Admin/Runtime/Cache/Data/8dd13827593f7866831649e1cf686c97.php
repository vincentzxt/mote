<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<link href="__PUBLIC__/css/layout.css" media="screen" rel="stylesheet" type="text/css">
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/common.js"></script>
<script type="text/javascript">
function addmuch(){
    window.location = "__URL__/addmuch";	
}
function edit(x){
	if($('#typeStr').val()!=''){
		window.location = "__URL__/edit/<?php echo ($x); ?>/" + x + '/' + $('#typeStr').val();
	}else{
		window.location = "__URL__/edit/<?php echo ($x); ?>/" + x ;
	}
}
function del(x){
	window.location =  "__URL__/del/<?php echo ($x); ?>/" + x;
}
function clearcache(){
	window.location =  "__URL__/rmdirs"; 	
}
</script>
</head>
<body>
<div id="doc">
      <!--head开始-->
      
      <!--head结束-->
      <div class="bd clearfix">
        <!--左侧开始-->
        
        <!--左侧结束-->
        <div id="mainContainer">
          <div class="mod mod1">
            <ul class="tab_title">
                <li><a href="__APP__/Data/Customgroup/add">添加分类类型</a></li>
                <li><a href="__APP__/Data/Customgroup/index">分类类型管理</a></li>
                <li><a href="__APP__/Data/Custom/addmuch">添加自定义分类</a></li>
                <li class="on"><a href="__APP__/Data/Custom/index"> 自定义分类管理</a></li>
            </ul>
          	<div class="mod-header radius clearfix"><h2>自定义分类管理</h2></div>
            <div class="mod-body mod-body-ie8">
            	<div class="content register_content_center">
                    <div class="impBtn hMargin fLeft shadow" ><input type="button" id="" name="add" value="新增" onclick="addmuch()" class="add imgButton"></div>
                    <div class="impBtn hMargin fLeft shadow" ><input type="button" id="" name="add" value="清除所有的缓存" onclick="clearcache()" class="add imgButton"></div>
                  
                    <!-- 列表显示区域  --><input type="hidden" id="typeStr" value="<?php echo ($typeStr); ?>">
                    <form action="" method="get" name="form">
                    <select name="type">
                      <?php if(is_array($customgroup)): $i = 0; $__LIST__ = $customgroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$customgroup): $mod = ($i % 2 );++$i;?><option value="<?php echo ($customgroup["typeid"]); ?>"><?php echo ($customgroup["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <input type="submit" value="查询">
                    </form>
                    
                    <div class="list" >
                    <div id="result" class="result none"></div>
                    <!-- Think 系统列表组件开始 -->
<table id="checkList" class="list" cellpadding=0 cellspacing=0 ><tr><td height="5" colspan="8" class="topTd" ></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('checkList')"></th><th><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "id"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('Name','<?php echo ($sort); ?>','index')" title="按照栏目名称<?php echo ($sortType); ?> ">栏目名称<?php if(($order) == "Name"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('type','<?php echo ($sort); ?>','index')" title="按照类型id<?php echo ($sortType); ?> ">类型id<?php if(($order) == "type"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('type','<?php echo ($sort); ?>','index')" title="按照分类名称<?php echo ($sortType); ?> ">分类名称<?php if(($order) == "type"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('status','<?php echo ($sort); ?>','index')" title="按照启用/禁用<?php echo ($sortType); ?> ">启用/禁用<?php if(($order) == "status"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('Priority','<?php echo ($sort); ?>','index')" title="按照排序<?php echo ($sortType); ?> ">排序<?php if(($order) == "Priority"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><tr class="row" onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)" ><td><input type="checkbox" name="key"	value="<?php echo ($node["id"]); ?>"></td><td><?php echo ($node["id"]); ?></td><td><a href="javascript:child('<?php echo (addslashes($node["id"])); ?>')"><?php echo ($node["Name"]); ?></a></td><td><?php echo ($node["type"]); ?></td><td><?php echo (customgroupid_to_name($node["type"])); ?></td><td><?php echo (getStatus($node["status"])); ?></td><td><?php echo ($node["Priority"]); ?></td><td>------  <a href="javascript:edit('<?php echo ($node["Id"]); ?>')">编辑</a>&nbsp;------  <a href="javascript:del('<?php echo ($node["Id"]); ?>')">删除</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="8" class="bottomTd"></td></tr></table>
<!-- Think 系统列表组件结束 -->

                    </div>
                    <!--  分页显示区域 -->
                    <div class="page"><?php echo ($page); ?></div>
                </div>
            </div>
		  </div>
        </div>
      </div>
      <div class="hiddenft"></div>
     
    </div>


</body>
</html>