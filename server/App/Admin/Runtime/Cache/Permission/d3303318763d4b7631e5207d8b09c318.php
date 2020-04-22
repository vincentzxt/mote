<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<link href="__PUBLIC__/css/layout.css" media="screen" rel="stylesheet" type="text/css">
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script language="javascript">
$('#role_id option').remove();
function onchg(i){
    $('#selt option').remove();
	if(i.value==0)return false;
	//输入 数据库表名称$d,$b,$l，返回字段类型$t(type)（0：值，1：列表）,返回字段条件(1,字段mf，2，条件mt，3要求mv)
	$.ajax({
	   type: "POST",
	   url: "__APP__/Permission/User/getuser",
	   data: "user="+i.value,
	   success: function(msg){
		 //alert(msg);
		 if(msg==-1){
		     alert('对不起没有职位！');	 
			  $('#selt').append('<option value="0">请选择</option>');
		 }else{
			 var obj = jQuery.parseJSON(msg);
			 $('#selt').append('<option value="0">请选择</option>');
			 for(var i=0;i<obj.length;i++){
				 $('#selt').append('<option value="' + obj[i]['id'] + '">' + obj[i]['name'] + '</option>');
			 }
		 }
	   }
	});
}
function checkName(i){
	var acc = $('#account').val();
	$.ajax({
	   type: "POST",
	   url: "__APP__/Permission/User/checkAccount",
	   data: "account="+acc,
	   success: function(msg){
		   //alert(msg);
		   if(msg==-1){
			   alert('登陆名称已经存在');   
		   }
		   if(msg==-2){
			   alert('登陆名称错误');   
		   }
		    if(msg==1){
			   alert('可以注册');   
		   }
		   
	   }
	});
}


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
          <h2>添加用户</h2>
        </div>
        <div class="mod-body">
          <div class="content register_content_center">
            <form method='post' id="form1" action="__URL__/update" >
            <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>">
              <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                  <td class="tRight" >角色选择：</td>
                  <td> 分公司：
                    <SELECT name="fgs_id" id="fgs_id" style="width:100px"  onChange="setfalg()">
                      <option value="0">请选择</option>
                      <?php if(is_array($clist)): $i = 0; $__LIST__ = $clist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo0): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo0["id"]); ?>"   <?php if(($vo0["id"]) == $vo["fgs_id"]): ?>selected<?php endif; ?>><?php echo ($vo0["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </SELECT>
                    部门：<input type="hidden" name="bumenflag" id="bumenflag" value="0" />
                    <SELECT name="bm_id" id="bm_id" style="width:100px" onclick="select_bumen();">
                       
                        <option value="<?php echo ($vo["bm_id"]); ?>" ><?php echo (tobumen($vo["bm_id"])); ?></option>
                    </SELECT>
                   组：<input type="hidden" name="groupflag" id="groupflag" value="0" />
                    <SELECT name="group_id" id="group_id" style="width:100px"  onclick="select_group()">
                        <option value="<?php echo ($vo["group_id"]); ?>" ><?php echo (togroup($vo["group_id"])); ?></option>
                    </SELECT>
                    角色： <input type="hidden" name="roleflag" id="roleflag" value="0" />
                    <select name="role_id" id="role_id" style="width:100px"  onclick="select_role()">
                      <option value="<?php echo ($vo["role_id"]); ?>"><?php echo (role_to_name($vo["role_id"])); ?></option>
                  </select></td>
                </tr>
               
                <tr>
                  <td class="tRight" >姓&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
                  <td><input type="text" name="username" value="<?php echo ($vo["username"]); ?>" id="username"></td>
                </tr>
                <tr>
                  <td class="tRight" >用户名：</td>
                  <td><input type="text" check='Require' warning="用户名不能为空" id="account" name="account" value="<?php echo ($vo["account"]); ?>">
                    <input type="button" value="检测帐号" onClick="checkName()" class="submit hMargin"></td>
                </tr>
                <tr>
                  <td class="tRight" >密码：</td>
                  <td><input type="password" name="password" autocomplete="off"></td>
                </tr>
                <tr>
                  <td class="tRight" >确认密码：</td>
                  <td><input type="password" name="repassword" autocomplete="off"></td>
                </tr>
              
                <tr>
                  <td class="tRight">状态：</td>
                  <td><SELECT name="status">
                      <option value="1" <?php if(($vo["status"]) == "1"): ?>selected="selected"<?php endif; ?>>启用</option>
                      <option value="0" <?php if(($vo["status"]) == "0"): ?>selected="selected"<?php endif; ?>>禁用</option>
                    </SELECT></td>
                </tr>
                <tr>
                  <td class="tRight tTop">备  注：</td>
                  <td class="tLeft"><TEXTAREA class="large bLeft"  name="remark" rows="5" cols="57"><?php echo ($vo["remark"]); ?></textarea></td>
                </tr>
                <tr>
                  <td class="tRight tTop">邮箱：</td>
                  <td class="tLeft"><input type="text" class="medium bLeft" name="email" value="<?php echo ($vo["email"]); ?>"></td>
                </tr>
                <!-- <tr>
                  <td>工资：</td>
                  <td><span class="tLeft">
                    <input name="gongzi" type="text" class="medium bLeft" id="gongzi" value="<?php echo ($vo["gongzi"]); ?>">
                  </span></td>
                </tr>-->
                <tr>
                  <td></td>
                  <td><input type="submit" value="保 存" class="imgButton">
                    <input type="reset"value="清 空" class="imgButton"></td>
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