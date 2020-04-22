<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<title><?php echo ($title); ?></title>

<meta http-equiv="Cache-Control" content="max-age=7200" />
<link href="__PUBLIC__/css/layout.css" media="screen" rel="stylesheet" type="text/css">
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script language="javascript">
$('#role_id option').remove();
function onchg(i){
	$('#role_id').val('');
	$('#role_name').val('');
    $('#selt option').remove();
	 //输入 数据库表名称$d,$b,$l，返回字段类型$t(type)（0：值，1：列表）,返回字段条件(1,字段mf，2，条件mt，3要求mv)
	$.ajax({
	   type: "POST",
	   url: "__APP__/Ajax/ajaxfunc",
	   data: "d=user&&b=role&&l=_&&t=1&&mf=pid&&mt=eq&&mv="+i.value,
	   success: function(msg){
		 //alert(msg);
		 var obj = jQuery.parseJSON(msg);
		 for(var i=0;i<obj.length;i++){
		     $('#selt').append('<option value="' + obj[i]['id'] + '">' + obj[i]['name'] + '</option>')	 
		 }
	   }
	});
}
function moval(){
	$('#role_id').val('');
	$('#role_name').val('');
	$('#role_id').val($('#selt').val());
	$('#role_name').val($('#selt :selected').text()); 
}

function checkall(i){
		$("#ss" + i + " :checkbox").attr("checked",'true');//全选  
}
function checknoall(i,n){
		$("#ss" + i + " :checkbox").removeAttr("checked");//取消全选  
}

</script>
<style>
<!--
.chd1 {
	padding-left: 20px;
	clear:both;
	color:#09F;
	font-size:18px;
	padding-top:20px;

}
.chd1 div.c1{ height:30px; line-height:30px; border:1px solid #E8E8E8; background:#F3F3F3; margin-bottom:10px;}
.chd1 span{
	
}
.chd2 span{
	float:left;
}
.chd2 {
	margin-left:30px;
	height:auto;
	display:block;
	clear:both;
	padding-top:10px;
	border:1px solid #E8E8E8;
	color:#C30;
	font-size:14px;
	padding-top:10px;
	background:#F3F3F3
}
.chd3 {
	margin-left:30px;
	display: block;
	line-height: 25px;
	height: 25px;
	padding-top:10px;
	color:#000;
	font-size:12px;
}
.chkinput1{
	float:left
}
.chkinput2{
	float:left
}
.chkinput3{
	float:left
}
.list{
	float:left;
}
.list .chd3{
	float:left;

	display:block
}
input { font-size:12px; line-height:25px; height:25px; margin-left:5px; margin-right:5px;}
-->
</style>
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
    <li <?php if(($objurl) == "User"): ?>class="on"<?php endif; ?> ><a href="__GROUP__/User">用户列表</a></li>
    <li <?php if(($objurl) == "UserCompany"): ?>class="on"<?php endif; ?> ><a href="__GROUP__/UserCompany">分公司管理</a></li>
    <li <?php if(($objurl) == "UserBumen"): ?>class="on"<?php endif; ?> ><a href="__GROUP__/UserBumen">部门管理</a></li>
    <li <?php if(($objurl) == "UserGroup"): ?>class="on"<?php endif; ?> ><a href="__GROUP__/UserGroup">用户组管理</a></li>
    <li <?php if(($objurl) == "UserRole"): ?>class="on"<?php endif; ?> ><a href="__GROUP__/UserRole">系统角色管理</a></li>
</ul>
        <div class="mod-header radius clearfix">
          <h2>角色授权操作</h2>
        </div>
        <div class="mod-body">
          <div class="content register_content_center">
            <form method='post' id="form1" action="__URL__/chmodsave/" >
             
              <p> 操作角色：</p>
                 <b style="color:green;">用户组</b>：<b style="color:#000000"> <?php echo (toUserGroup($userdata['pid'])); ?></b><br>
                    <div style="padding-left:60px; font-size:12px; color:blue">|---<?php echo ($userdata['name']); ?></div>
                    <input size="1" type="hidden" name="role_id" id="role_id" class="small bLeft" value="<?php echo ($userdata['id']); ?>" style="width:100px"  onfocus=this.blur() />
                    
               <p>权限分配：</p>
                  <div>
                      <ul>
                        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt): $mod = ($i % 2 );++$i;?><li id="ss<?php echo ($vt['id']); ?>" class="chd1">
                          <div class="c1"><input 
                              
                            <?php if(is_array($alist)): foreach($alist as $key=>$ao): if($ao['node_id'] == $vt['id']): ?>checked="checked"<?php endif; endforeach; endif; ?>
                            
                            type="checkbox" name="chmod[]" id="sel<?php echo ($vt['id']); ?>" value="<?php echo ($vt['id']); ?>" class="chkinput1" onclick="selectis(<?php echo ($vt['id']); ?>)"><span><!--<?php echo ($vt['name']); ?>--><?php echo ($vt['title']); ?></span>
                            <input type="button" onClick="checkall(<?php echo ($vt['id']); ?>)" value="全选" />
                            <input type="button" onClick="checknoall(<?php echo ($vt['id']); ?>)" value="全不选" />
                         </div>
                            <?php if(is_array($vt[0])): $i = 0; $__LIST__ = $vt[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt1): $mod = ($i % 2 );++$i;?><div id="ss<?php echo ($vt1['id']); ?>" class="chd2"> <input type="checkbox"
                       
                                <?php if(is_array($alist)): foreach($alist as $key=>$ao): if($ao['node_id'] == $vt1['id']): ?>checked="checked"<?php endif; endforeach; endif; ?>
                                name="chmod[]" id="sel<?php echo ($vt1['id']); ?>" value="<?php echo ($vt1['id']); ?>" class="chkinput2" onclick="selectis(<?php echo ($vt1['id']); ?>)"><span><!--<?php echo ($vt1['name']); ?>--><?php echo ($vt1['title']); ?></span>
                                <input type="button" onClick="checkall(<?php echo ($vt1['id']); ?>)" value="全选" />
                                <input type="button" onClick="checknoall(<?php echo ($vt1['id']); ?>)" value="全不选" />
                                  <div class="list">
                                <?php if(is_array($vt1[0])): $i = 0; $__LIST__ = $vt1[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vt2): $mod = ($i % 2 );++$i;?><div id="ss<?php echo ($vt2['id']); ?>" class="chd3"> <input type="checkbox"
                       
                                    <?php if(is_array($alist)): foreach($alist as $key=>$ao): if($ao['node_id'] == $vt2['id']): ?>checked="checked"<?php endif; endforeach; endif; ?>
                                    name="chmod[]" id="sel<?php echo ($vt2['id']); ?>" class="chkinput3" value="<?php echo ($vt2['id']); ?>" onclick="selectis(<?php echo ($vt2['id']); ?>)"><span><!--<?php echo ($vt2['name']); ?>--><?php echo (ab_is_ab($vt2['title'])); ?></span> </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                              </div><?php endforeach; endif; else: echo "" ;endif; ?>
                          </li><?php endforeach; endif; else: echo "" ;endif; ?>
                      </ul>
                    </div>
               
          </div>
        </div>   <input type="submit" value="保存" class="imgButton">
                
            </form>
      </div>
    </div>
  </div>
  <div class="hiddenft"></div>
</div>
</body>
</html>