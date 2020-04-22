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
<table id="checkList" class="list" cellpadding=0 cellspacing=0 ><tr><td height="5" colspan="10" class="topTd" ></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('checkList')"></th><th><a href="javascript:sortBy('id','<?php echo ($sort); ?>','tjlist')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "id"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('name','<?php echo ($sort); ?>','tjlist')" title="按照姓名<?php echo ($sortType); ?> ">姓名<?php if(($order) == "name"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('age','<?php echo ($sort); ?>','tjlist')" title="按照年龄<?php echo ($sortType); ?> ">年龄<?php if(($order) == "age"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('height','<?php echo ($sort); ?>','tjlist')" title="按照身高<?php echo ($sortType); ?> ">身高<?php if(($order) == "height"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('weight','<?php echo ($sort); ?>','tjlist')" title="按照体重<?php echo ($sortType); ?> ">体重<?php if(($order) == "weight"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('address','<?php echo ($sort); ?>','tjlist')" title="按照籍贯<?php echo ($sortType); ?> ">籍贯<?php if(($order) == "address"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('tid','<?php echo ($sort); ?>','tjlist')" title="按照父目录<?php echo ($sortType); ?> ">父目录<?php if(($order) == "tid"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('time','<?php echo ($sort); ?>','tjlist')" title="按照发表时间<?php echo ($sortType); ?> ">发表时间<?php if(($order) == "time"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr class="row" onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)" ><td><input type="checkbox" name="key"	value="<?php echo ($list["id"]); ?>"></td><td><?php echo ($list["id"]); ?></td><td><?php echo ($list["name"]); ?></td><td><?php echo ($list["age"]); ?></td><td><?php echo ($list["height"]); ?></td><td><?php echo ($list["weight"]); ?></td><td><?php echo ($list["address"]); ?></td><td><?php echo (getname($list["tid"])); ?></td><td><?php echo (toDate($list["time"],'y-m-d')); ?></td><td>------  <a href="javascript:edit('<?php echo ($list["id"]); ?>')">编辑</a>&nbsp;------  <a href="javascript:del('<?php echo ($list["id"]); ?>')">删除</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="10" class="bottomTd"></td></tr></table>
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