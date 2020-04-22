<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
  <title><?php echo ($title); ?></title>
  
 <meta http-equiv="Cache-Control" content="max-age=7200" />

  <link href="__PUBLIC__/css/layout.css" media="screen" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="__PUBLIC__/Js/common.js"></script>
<script type="text/javascript">
function edit(x){
	window.location = "__URL__/edit/<?php echo ($x); ?>/" + x;
}
function del(x){
	window.location =  "__URL__/del/<?php echo ($x); ?>/" + x;
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
                <li class="on"><a href="__URL__/index">操作日志</a></li>
            	
            </ul>
          	<div class="mod-header radius clearfix"><h2>日志列表</h2></div>
            <div class="mod-body">
            	<div class="content">
                    <div class="user marginB15">
                    	<div class="floatL div_margin">
                            用户组:
                            <select name="">
                              <option value="2">1</option>
                              <option value="4">3</option>
                            </select>
                            权限角色:
                            <select name="">
                              <option value="2">1</option>
                              <option value="4">3</option>
                            </select>
                            用户邮箱：
                            <input type="text" value="sou" />
                            昵称：
                            <input type="text" value="sou" />
                         </div>
                         <div class="floatL">
                            最后登陆IP：
                            <input type="text" value="sou" />
                            登陆时间：
                            <input type="text" value="sou" />
                            <input type="button" value="检索" class="jiansuo"></div>
                    	<div class="cls"></div>
                    </div>
                	<!-- 列表显示区域  -->
                    
                    <div class="" >
                    <div id="result" class="result none"></div>
                    <!-- Think 系统列表组件开始 -->
<table id="checkList" class="list" cellpadding=0 cellspacing=0 ><tr><td height="5" colspan="12" class="topTd" ></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('checkList')"></th><th><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index')" title="按照编号<?php echo ($sortType); ?> ">编号<?php if(($order) == "id"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th width="20%"><a href="javascript:sortBy('uid','<?php echo ($sort); ?>','index')" title="按照用户<?php echo ($sortType); ?> ">用户<?php if(($order) == "uid"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('type','<?php echo ($sort); ?>','index')" title="按照操作类型<?php echo ($sortType); ?> ">操作类型<?php if(($order) == "type"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('IP','<?php echo ($sort); ?>','index')" title="按照ip地址<?php echo ($sortType); ?> ">ip地址<?php if(($order) == "IP"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('time','<?php echo ($sort); ?>','index')" title="按照时间<?php echo ($sortType); ?> ">时间<?php if(($order) == "time"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('A_APP','<?php echo ($sort); ?>','index')" title="按照应用<?php echo ($sortType); ?> ">应用<?php if(($order) == "A_APP"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('A_GROUP','<?php echo ($sort); ?>','index')" title="按照组<?php echo ($sortType); ?> ">组<?php if(($order) == "A_GROUP"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('A_MODULE','<?php echo ($sort); ?>','index')" title="按照模型<?php echo ($sortType); ?> ">模型<?php if(($order) == "A_MODULE"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('A_ACTION','<?php echo ($sort); ?>','index')" title="按照行为<?php echo ($sortType); ?> ">行为<?php if(($order) == "A_ACTION"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('beizhu','<?php echo ($sort); ?>','index')" title="按照具体操作地址<?php echo ($sortType); ?> ">具体操作地址<?php if(($order) == "beizhu"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><tr class="row" onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)" ><td><input type="checkbox" name="key"	value="<?php echo ($node["id"]); ?>"></td><td><?php echo ($node["id"]); ?></td><td><?php echo (toUser($node["uid"])); ?></td><td><?php echo ($node["type"]); ?></td><td><?php echo ($node["IP"]); ?></td><td><?php echo (toDate($node["time"])); ?></td><td><?php echo ($node["A_APP"]); ?></td><td><?php echo ($node["A_GROUP"]); ?></td><td><?php echo ($node["A_MODULE"]); ?></td><td><?php echo ($node["A_ACTION"]); ?></td><td><?php echo ($node["beizhu"]); ?></td><td> <?php echo ($node["标记"]); ?>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="12" class="bottomTd"></td></tr></table>
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