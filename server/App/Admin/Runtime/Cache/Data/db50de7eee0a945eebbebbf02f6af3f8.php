<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>

<script type="text/javascript" src="__PUBLIC__/Js/common.js"></script>
<script type="text/javascript">
function add(){
    window.location = "__URL__/addmuch";	
	
}
function edit(x){
	window.location = "__URL__/edit/<?php echo ($x); ?>/" + x;
}
function del(x){
	window.location = "__URL__/del/<?php echo ($x); ?>/" + x;
}
</script>
</head>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/layout.css" />
<body>
<div class="main">
<div class="impBtn hMargin fLeft shadow" ><input type="button" id="" name="add" value="新增" onclick="add()" class="add imgButton"></div>

<!-- 列表显示区域  -->

<div class="list" >
<div id="result" class="result none"></div>
<!-- Think 系统列表组件开始 -->
<table id="checkList" class="list" cellpadding=0 cellspacing=0 ><tr><td height="5" colspan="7" class="topTd" ></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('checkList')"></th><th width="5%"><a href="javascript:sortBy('0','<?php echo ($sort); ?>','index')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "0"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('3','<?php echo ($sort); ?>','index')" title="按照栏目名称<?php echo ($sortType); ?> ">栏目名称<?php if(($order) == "3"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('7','<?php echo ($sort); ?>','index')" title="按照链接地址<?php echo ($sortType); ?> ">链接地址<?php if(($order) == "7"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('5','<?php echo ($sort); ?>','index')" title="按照层级<?php echo ($sortType); ?> ">层级<?php if(($order) == "5"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('4','<?php echo ($sort); ?>','index')" title="按照启用/禁用<?php echo ($sortType); ?> ">启用/禁用<?php if(($order) == "4"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><tr class="row" onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)" ><td><input type="checkbox" name="key"	value="<?php echo ($node["id"]); ?>"></td><td><?php echo ($node["0"]); ?></td><td><a href="javascript:child('<?php echo (addslashes($node["id"])); ?>')"><?php echo ($node["3"]); ?></a></td><td><?php echo ($node["7"]); ?></td><td><?php echo ($node["5"]); ?></td><td><?php echo (getStatus($node["4"])); ?></td><td>------  <a href="javascript:edit('<?php echo ($node["0"]); ?>')">编辑</a>&nbsp;------  <a href="javascript:del('<?php echo ($node["0"]); ?>')">删除</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="7" class="bottomTd"></td></tr></table>
<!-- Think 系统列表组件结束 -->

</div>
<!--  分页显示区域 -->
<div class="page"><?php echo ($page); ?></div>
</div>
</body>
</html>