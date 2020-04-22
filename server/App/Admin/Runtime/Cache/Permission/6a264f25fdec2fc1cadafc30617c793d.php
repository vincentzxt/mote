<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<title><?php echo ($title); ?></title>

<meta http-equiv="Cache-Control" content="max-age=7200" />
<link href="__PUBLIC__/css/layout.css" media="screen" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__PUBLIC__/Admin/Js/Base.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/prototype.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/mootools.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/Form/CheckForm.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/Think/ThinkAjax.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/common.js"></script>
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script type="text/javascript">
function edit(x){
	window.location = "__URL__/edit/<?php echo ($x); ?>/" + x;
}
function del(x){
	window.location =  "__URL__/delD/<?php echo ($x); ?>/" + x;
}
</script>
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
          <li class="on"><a href="__URL__/index">节点列表</a></li>
          <li ><a href="__URL__/add">添加节点</a></li>
          <li ><a href="__URL__/addmuch">批量添加节点</a></li>
        </ul>
        <div class="mod-header radius clearfix">
          <h2>节点列表</h2>
        </div>
        <div class="mod-body">
          <div class="content">
            <div class="impBtn hMargin fLeft shadow" ><input type="button" id="" name="delete" value="删除" onclick="foreverdel()" class="delete imgButton"></div>
            <!-- 列表显示区域  -->
            
            <div class="" >
              <div id="result" class="result none"></div>
              <!-- Think 系统列表组件开始 -->
<table id="checkList" class="list" cellpadding=0 cellspacing=0 ><tr><td height="5" colspan="6" class="topTd" ></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('checkList')"></th><th width="10%"><a href="javascript:sortBy('0','<?php echo ($sort); ?>','index')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "0"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th width="20%"><a href="javascript:sortBy('1','<?php echo ($sort); ?>','index')" title="按照名称<?php echo ($sortType); ?> ">名称<?php if(($order) == "1"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('3','<?php echo ($sort); ?>','index')" title="按照说明<?php echo ($sortType); ?> ">说明<?php if(($order) == "3"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('4','<?php echo ($sort); ?>','index')" title="按照状态<?php echo ($sortType); ?> ">状态<?php if(($order) == "4"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><tr class="row" onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)" ><td><input type="checkbox" name="key"	value="<?php echo ($node["id"]); ?>"></td><td><?php echo ($node["0"]); ?></td><td><a href="javascript:child('<?php echo (addslashes($node["id"])); ?>')"><?php echo ($node["1"]); ?></a></td><td><?php echo (ab_is_ab($node["3"])); ?></td><td><?php echo (getStatus($node["4"])); ?></td><td>------  <a href="javascript:edit('<?php echo ($node["0"]); ?>')">编辑</a>&nbsp;------  <a href="javascript:del('<?php echo ($node["0"]); ?>')">删除</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="6" class="bottomTd"></td></tr></table>
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