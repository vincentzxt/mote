<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="__PUBLIC__/css/layout.css" />
<script type="text/javascript" src="__PUBLIC__/Admin/Js/Base.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/prototype.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/mootools.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/Form/CheckForm.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/Think/ThinkAjax.js"></script>
<script type="text/javascript" src="__PUBLIC__/Admin/Js/common.js"></script>
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>

<script type="text/javascript">
var URL='__URL__';

function add(){
	window.location = "__URL__/add/t/<?php echo ($imgflag); ?>";
}
function edit(x){
	window.location = "__URL__/edit/<?php echo ($x); ?>/" + x;
}
function del(x){
	window.location =  "__URL__/delD/<?php echo ($x); ?>/" + x;
}
function command(x,y){
	//alert(x);
	//command2sy  
	//$id = int(trim($_REQUEST['id']));
	//$val = int(trim($_REQUEST['command']));
	$.ajax({
	   type: "POST",
	   url: "command2sy",
	   data: "id="+x+"&command="+y,
	   success: function(msg){
		// alert( "Data Saved: " + msg );
		   if(msg==1){
			   alert('操作成功');
				 window.location.reload();   
		   }else{
			   alert('操作失败');   
		   }
	   }
	});
	
	
	
	
}
</script>
<div class="main">
<div class="content" >
<div class="title">数据列表</div>
<!--  功能操作区域  -->
<div class="operate" >
<div class="impBtn hMargin fLeft shadow" ><input type="button" id="" name="add" value="新增" onclick="add()" class="add imgButton"></div>
<div class="impBtn hMargin fLeft shadow" ><input type="button" id="" name="delete" value="删除" onclick="foreverdel()" class="delete imgButton"></div>
<!-- 查询区域 -->

<div class="fRig">
<form method='post' action="">
<input type="text" name="m_title" title="组名" class="medium" value="<?php echo ($req["m_title"]); ?>" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;推荐类型：

<select name="sy_command" id="sy_command">
  <option>请选择</option>
  <option value="0"  <?php if(($req["sy_command"]) == "0"): ?>selected<?php endif; ?> >普通</option>
   <option value="1" <?php if(($req["sy_command"]) == "1"): ?>selected<?php endif; ?> >首页推荐</option>
</select>
<input type="submit" name="sub" value="查询" />

<!-- 高级查询区域 -->
<div  id="searchM" class=" none search cBoth" >
</div>
</form>
</div>
<!-- 功能操作区域结束 -->
<!-- 列表显示区域  -->
<div id="ThinkAjaxResult" style="display:none;">11</div>
<div class="list" >
<!-- Think 系统列表组件开始 -->
<table id="checkList" class="list" cellpadding=0 cellspacing=0 ><tr><td height="5" colspan="14" class="topTd" ></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('checkList')"></th><th><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "id"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th width="8%"><a href="javascript:sortBy('title','<?php echo ($sort); ?>','index')" title="按照标题<?php echo ($sortType); ?> ">标题<?php if(($order) == "title"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('description','<?php echo ($sort); ?>','index')" title="按照描述<?php echo ($sortType); ?> ">描述<?php if(($order) == "description"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('tag','<?php echo ($sort); ?>','index')" title="按照关键词<?php echo ($sortType); ?> ">关键词<?php if(($order) == "tag"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('hits','<?php echo ($sort); ?>','index')" title="按照点击数<?php echo ($sortType); ?> ">点击数<?php if(($order) == "hits"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('tid','<?php echo ($sort); ?>','index')" title="按照父目录<?php echo ($sortType); ?> ">父目录<?php if(($order) == "tid"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('from','<?php echo ($sort); ?>','index')" title="按照出处<?php echo ($sortType); ?> ">出处<?php if(($order) == "from"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('author','<?php echo ($sort); ?>','index')" title="按照作者<?php echo ($sortType); ?> ">作者<?php if(($order) == "author"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('time','<?php echo ($sort); ?>','index')" title="按照发表时间<?php echo ($sortType); ?> ">发表时间<?php if(($order) == "time"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('shijian','<?php echo ($sort); ?>','index')" title="按照自定义时间<?php echo ($sortType); ?> ">自定义时间<?php if(($order) == "shijian"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('flag','<?php echo ($sort); ?>','index')" title="按照状态<?php echo ($sortType); ?> ">状态<?php if(($order) == "flag"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('uid','<?php echo ($sort); ?>','index')" title="按照发布人<?php echo ($sortType); ?> ">发布人<?php if(($order) == "uid"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr class="row" onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)" ><td><input type="checkbox" name="key"	value="<?php echo ($list["id"]); ?>"></td><td><?php echo ($list["id"]); ?></td><td><a href="javascript:edit('<?php echo (addslashes($list["id"])); ?>')"><?php echo ($list["title"]); ?></a></td><td><?php echo ($list["description"]); ?></td><td><?php echo ($list["tag"]); ?></td><td><?php echo ($list["hits"]); ?></td><td><?php echo (getname($list["tid"])); ?></td><td><?php echo ($list["from"]); ?></td><td><?php echo ($list["author"]); ?></td><td><?php echo (toDate($list["time"],'y-m-d')); ?></td><td><?php echo ($list["shijian"]); ?></td><td><?php echo (getStatus($list["flag"])); ?></td><td><?php echo (toUser($list["uid"])); ?></td><td>------  <a href="javascript:edit('<?php echo ($list["id"]); ?>')">编辑</a>&nbsp;------  <a href="javascript:del('<?php echo ($list["id"]); ?>')">删除</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="14" class="bottomTd"></td></tr></table>
<!-- Think 系统列表组件结束 -->

</div>
<!--  分页显示区域 -->
<div class="page"><?php echo ($page); ?></div>
<!-- 列表显示区域结束 -->
</div>
<!-- 主体内容结束 -->
</div>
<!-- 主页面结束 -->
</div>