<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
  
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
  <title><?php echo ($title); ?></title>
  
 <meta http-equiv="Cache-Control" content="max-age=7200" />

  <link href="__PUBLIC__/css/layout.css" media="screen" rel="stylesheet" type="text/css">
<script language="javascript">

function onchg(i){
	 if(i.value==0){
		 $('#appname').html('应用名：');  	
	 }
	 //输入 数据库表名称$d,$b,$l，返回字段类型$t(type)（0：值，1：列表）,返回字段条件(1,字段mf，2，条件mt，3要求mv)
	$.ajax({
	   type: "POST",
	   url: "__APP__/Info/Ajax/ajaxfunc",
	   data: "d=node&&b=&&l=&&t=0&&mf=id&&mt=eq&&mv="+i.value,
	   success: function(msg){
		 var obj= jQuery.parseJSON(msg);
		  $('#level').val(parseInt(obj.level)+1);	 
		  if(obj.level==1){
			   $('#appname').html('模块名：');  
		  }
		  if(obj.level==2){
			    $('#appname').html('操作名：');  
		  }
		
	   }
	});
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
                <li><a href="__URL__/index">节点列表</a></li>
            	<li class="on"><a href="__URL__/add">添加节点</a></li>
                <li><a href="__URL__/addmuch">批量添加节点</a></li>
            </ul>
          	<div class="mod-header radius clearfix"><h2>节点管理</h2></div>
            <div class="mod-body">
            	<div class="content register_content_center">
                	<form method='post'  id="form1" action="__URL__/insert/">
                    <table cellpadding="0" cellspacing="0" width="100%" border="0">
                    <tr>
                        <td class="tRight" ><div id="appname"><?php if(($level) == "1"): ?>应用<?php endif; if(($level) == "2"): ?>模块<?php endif; if(($level) == "3"): ?>操作<?php endif; ?>名：</div></td>
                        <td><input type="text" check='Require' warning="<?php if(($level) == "1"): ?>应用<?php endif; if(($level) == "2"): ?>模块<?php endif; if(($level) == "3"): ?>操作<?php endif; ?>名称不能为空,且不能含有空格" name="name"></td>
                    </tr>
                    <tr>
                        <td class="tRight" >显示名：</td>
                        <td><input type="text" check='Require' warning="显示名称必须"  name="title"></td>
                    </tr>
                    <tr>
                        <td class="tRight" >分 组：</td>
                        <td>
                        <SELECT class="medium bLeft" name="pid" name="node_id" onchange="onchg(this)">
                        <option value="0">未分组</option>
                        <?php if(is_array($flist)): $i = 0; $__LIST__ = $flist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vf): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vf[0]); ?>"><?php echo ($vf[3]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </SELECT>
                        </td>
                    </tr>
                    <tr>
                        <td class="tRight">层级：</td>
                        <td>
                        <input type="text" id="level" name="level" value="1">
                        </td>
                    </tr>
                    <tr>
                        <td class="tRight">状态：</td>
                        <td><SELECT name="status">
                        <option value="1">启用</option>
                        <option value="0">禁用</option>
                        </SELECT></td>
                    </tr>
                    <tr>
                        <td class="tRight tTop">描 述：</td>
                        <td><TEXTAREA class="des" name="remark"  rows="5" cols="57"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="center"><input type="submit" value="保存" class="imgButton"><input type="reset" class="imgButton" value="清空" ></td>
                    </tr>
                    </table>
                    </form>
                </div>
            </div>
		  </div>
        </div>
      </div>
      <div class="hiddenft"></div>
     
    </div>


</body>
</html>