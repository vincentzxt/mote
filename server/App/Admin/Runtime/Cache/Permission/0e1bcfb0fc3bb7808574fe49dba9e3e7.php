<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8">
<title><?php echo ($title); ?></title>

<meta name="csrf-param" content="authenticity_token">

<link href="__PUBLIC__/css/layout.css" media="screen" rel="stylesheet" type="text/css">
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/common.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/Base.js"></script>
<script language="javascript" type="text/javascript" src="__PUBLIC__/js/My97DatePicker/WdatePicker.js"></script>
<script language="javascript">
function add(){
    window.location = "__URL__/add";	
}

function edit(x){
	window.location = "__URL__/edit/<?php echo ($x); ?>/" + x;
}
function del(x){
	window.location =  "__URL__/del/<?php echo ($x); ?>/" + x;
}
function chmod(x){
	window.location =  "__GROUP__/UserRole/chmods/<?php echo ($x); ?>/" + x;
}
function chmoddh(x){
	window.location =  "__GROUP__/UserRole/chmodsdh/<?php echo ($x); ?>/" + x;
}
</script>
<script language="javascript">
 
  function select_bumen(){
	  var id = $('#fgs_id').val();
	  if(id==0)
	  {
		alert('请先选择公司');  
	  }else{
		 var flag = $('#bumenflag').val();
		 $('#groupflag').val(0);
		 $('#group_id').find("option").remove(); 
		 $('#group_id').append("<option value='0'>请选择</option>");
		
		 if(flag==0){
			  $.ajax({
			   type: "POST",
			   url: "__URL__/select_bumen",
			   data: "company="+id,
			   dataType: "json",
			   success: function(msg){
				   
				   if(msg!=null){
					    
						  $.each(msg,function(i,item){
					//遍历json数据
						 //alert(item.id);
						 
						// $('#bm_id').append("<option value='0'>请选择</option>");
						 $('#bm_id').append("<option value='"+item.id+"'>"+item.name+"</option>");
						 $('#bumenflag').val(1);
					   }); 
				   }
				
			   }
			}); 
		 }
		
	  }
	  
	
  }
  
    //选择组
  function select_group(){
	  var cid = $('#fgs_id').val();
	  var bmid =  $('#bm_id').val();

	  if(cid==0&&bmid==0)
	  {
		alert('请先选择分公司或者部门');  
	  }else{
		 var flag = $('#groupflag').val();
		 $('#roleflag').val(0);
		 $('#role_id').find("option").remove(); 
		 $('#role_id').append("<option value='0'>请选择</option>");
		
		 if(flag==0){
			  $.ajax({
			   type: "POST",
			   url: "__APP__/Permission/User/select_group",
			   data: "bumen="+bmid,
			   dataType: "json",
			   success: function(msg){
				   
				   if(msg!=null){
					    
						  $.each(msg,function(i,item){
					//遍历json数据
						 //alert(item.id);
						 
						// $('#bm_id').append("<option value='0'>请选择</option>");
						 $('#group_id').append("<option value='"+item.id+"'>"+item.name+"</option>");
						 $('#groupflag').val(1);
					   }); 
				   }
				
			   }
			}); 
		 }
		
	  }
	  
  }
  
     //选择角色
  function select_role(){
	  var cid = $('#fgs_id').val();
	  var bmid =  $('#bm_id').val();
	  var groupid =  $('#group_id').val();

	  if(cid==0||bmid==0||groupid==0)
	  {
		alert('请先选择分公司/部门/组');  
	  }else{
		 var flag = $('#roleflag').val();
		
		
		 if(flag==0){
			  $.ajax({
			   type: "POST",
			   url: "__APP__/Permission/User/select_role",
			   data: "group="+groupid,
			   dataType: "json",
			   success: function(msg){
				   
				   if(msg!=null){
					    
						  $.each(msg,function(i,item){
					//遍历json数据
						  alert(item.name);
						 
						 $('#role_id').append("<option value='0'>请选择</option>");
						 $('#role_id').append("<option value='"+item.id+"'>"+item.name+"</option>");
						 $('#roleflag').val(1);
					   }); 
				   }
				
			   }
			}); 
		 }
		
	  }
	  
  }
  function setfalg(){
	 $('#bumenflag').val(0);
	 $('#groupflag').val(0);
	 
	 $('#bm_id').find('option').remove();
				  
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
    <li <?php if(($objurl) == "User"): ?>class="on"<?php endif; ?> ><a href="__GROUP__/User">用户列表</a></li>
    <li <?php if(($objurl) == "UserCompany"): ?>class="on"<?php endif; ?> ><a href="__GROUP__/UserCompany">分公司管理</a></li>
    <li <?php if(($objurl) == "UserBumen"): ?>class="on"<?php endif; ?> ><a href="__GROUP__/UserBumen">部门管理</a></li>
    <li <?php if(($objurl) == "UserGroup"): ?>class="on"<?php endif; ?> ><a href="__GROUP__/UserGroup">用户组管理</a></li>
    <li <?php if(($objurl) == "UserRole"): ?>class="on"<?php endif; ?> ><a href="__GROUP__/UserRole">系统角色管理</a></li>
</ul>
        <div class="mod-header radius clearfix">
          <h2>用户列表</h2>
        </div>
        <div class="mod-body mod-body-ie8">
          <div class="content register_content_center">
            <div class="impBtn hMargin fLeft shadow" ><input type="button" id="" name="add" value="添加用户" onclick="add()" class="add imgButton"></div>
            <div class="user marginB15">
              <div class="floatL div_margin"><input type="hidden" name="bumenflag" id="bumenflag" value="0" />
                <form action="" method="post" name="chaxun">
                  分公司：
                  <SELECT name="fgs_id" id="fgs_id" style="width:100px" onChange="setfalg()">
                    <option value="">请选择</option>
                    <?php if(is_array($clist)): $i = 0; $__LIST__ = $clist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo0): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo0["id"]); ?>" <?php if(($req["fgs_id"]) == $vo0["id"]): ?>selected="selected"<?php endif; ?>><?php echo ($vo0["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </SELECT>
                   部门：<input type="hidden" name="bumenflag" id="bumenflag" value="0" />
                  <SELECT name="bm_id" id="bm_id" style="width:100px"  onclick="select_bumen();">
                    <option value="">请选择</option>
                    <?php if(is_array($str1)): $i = 0; $__LIST__ = $str1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo1["Id"]); ?>" <?php if(($req["bm_id"]) == $vo1["id"]): ?>selected="selected"<?php endif; ?>><?php echo ($vo1["Name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </SELECT>
                    组：<input type="hidden" name="groupflag" id="groupflag" value="0" />
                  <SELECT name="group_id" id="group_id" style="width:100px" onclick="select_group()">
                    <option value="">请选择</option>
                    <?php if(is_array($glist)): $i = 0; $__LIST__ = $glist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($req["group_id"]) == $vo["id"]): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </SELECT>
                  最后登陆时间：
                  <input type="text" name="last_login_time" onClick="WdatePicker({dateFmt:'yyyy-MM-dd'})" />
                  <input type="submit" value="检索" class="jiansuo">
                </form>
                <br>
                提示：<font color="#FF0000">授权成功请更新缓存！ </font>权限管理-》数据管理-》缓存清除  即可 （需要超级权限）
              </div>
              <div class="cls"></div>
            </div>
            <!-- 列表显示区域  -->
            
            <div class="list" >
              <div id="result" class="result none"></div>
              <!-- Think 系统列表组件开始 -->
<table id="checkList" class="list" cellpadding=0 cellspacing=0 ><tr><td height="5" colspan="16" class="topTd" ></td></tr><tr class="row" ><th width="8"><input type="checkbox" id="check" onclick="CheckAll('checkList')"></th><th><a href="javascript:sortBy('id','<?php echo ($sort); ?>','index')" title="按照序号<?php echo ($sortType); ?> ">序号<?php if(($order) == "id"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('account','<?php echo ($sort); ?>','index')" title="按照登录名<?php echo ($sortType); ?> ">登录名<?php if(($order) == "account"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th width="10%"><a href="javascript:sortBy('username','<?php echo ($sort); ?>','index')" title="按照姓名<?php echo ($sortType); ?> ">姓名<?php if(($order) == "username"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('fgs_id','<?php echo ($sort); ?>','index')" title="按照分公司<?php echo ($sortType); ?> ">分公司<?php if(($order) == "fgs_id"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('bm_id','<?php echo ($sort); ?>','index')" title="按照部门名称<?php echo ($sortType); ?> ">部门名称<?php if(($order) == "bm_id"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th width="15%"><a href="javascript:sortBy('role_id','<?php echo ($sort); ?>','index')" title="按照组/职位<?php echo ($sortType); ?> ">组/职位<?php if(($order) == "role_id"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th width="10%"><a href="javascript:sortBy('email','<?php echo ($sort); ?>','index')" title="按照邮箱<?php echo ($sortType); ?> ">邮箱<?php if(($order) == "email"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('create_time','<?php echo ($sort); ?>','index')" title="按照创建时间<?php echo ($sortType); ?> ">创建时间<?php if(($order) == "create_time"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('last_login_time','<?php echo ($sort); ?>','index')" title="按照最后登录时间<?php echo ($sortType); ?> ">最后登录时间<?php if(($order) == "last_login_time"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('last_login_ip','<?php echo ($sort); ?>','index')" title="按照最后登录IP<?php echo ($sortType); ?> ">最后登录IP<?php if(($order) == "last_login_ip"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('login_count','<?php echo ($sort); ?>','index')" title="按照登录次数<?php echo ($sortType); ?> ">登录次数<?php if(($order) == "login_count"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('status','<?php echo ($sort); ?>','index')" title="按照启用/禁用<?php echo ($sortType); ?> ">启用/禁用<?php if(($order) == "status"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('remark','<?php echo ($sort); ?>','index')" title="按照备注<?php echo ($sortType); ?> ">备注<?php if(($order) == "remark"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th><a href="javascript:sortBy('qx','<?php echo ($sort); ?>','index')" title="按照权限<?php echo ($sortType); ?> ">权限<?php if(($order) == "qx"): ?><img src="__PUBLIC__/images/<?php echo ($sortImg); ?>.gif" width="12" height="17" border="0" align="absmiddle"><?php endif; ?></a></th><th >操作</th></tr><?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$node): $mod = ($i % 2 );++$i;?><tr class="row" onmouseover="over(event)" onmouseout="out(event)" onclick="change(event)" ><td><input type="checkbox" name="key"	value="<?php echo ($node["id"]); ?>"></td><td><?php echo ($node["id"]); ?></td><td><?php echo ($node["account"]); ?></td><td><?php echo ($node["username"]); ?></td><td><?php echo (tocompany($node["fgs_id"])); ?></td><td><?php echo (tobumen($node["bm_id"])); ?></td><td><?php echo (uroleishave($node["role_id"])); ?></td><td><?php echo ($node["email"]); ?></td><td><?php echo (toDate($node["create_time"])); ?></td><td><?php echo (toDate($node["last_login_time"])); ?></td><td><?php echo (($node["last_login_ip"])?($node["last_login_ip"]):从未登录); ?></td><td><?php echo ($node["login_count"]); ?></td><td><?php echo (getStatus($node["status"])); ?></td><td><?php echo ($node["remark"]); ?></td><td><?php echo (toDataGroup($node["qx"])); ?></td><td>------  <a href="javascript:chmoddh('<?php echo ($node["role_id"]); ?>')">导航授权</a>&nbsp;------  <a href="javascript:chmod('<?php echo ($node["role_id"]); ?>')">功能授权</a>&nbsp;------  <a href="javascript:edit('<?php echo ($node["id"]); ?>')">编辑</a>&nbsp;------  <a href="javascript:del('<?php echo ($node["id"]); ?>')">禁用</a>&nbsp;</td></tr><?php endforeach; endif; else: echo "" ;endif; ?><tr><td height="5" colspan="16" class="bottomTd"></td></tr></table>
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