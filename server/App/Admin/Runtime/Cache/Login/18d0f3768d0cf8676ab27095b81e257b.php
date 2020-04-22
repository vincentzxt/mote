<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" 
"http://www.w3.org/TR/html4/frameset.dtd">
<html lang="en-US"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>管理平台</title>
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/base.css">
  <link rel="stylesheet" type="text/css" href="__PUBLIC__/css/cas.css">
  <link rel="icon" type="image/png" href="">
  <script language="JavaScript">
<!--
var PUBLIC	 =	 '__PUBLIC__';
function keydown(e){
	var e = e || event;
	if (e.keyCode==13)
	{
	ThinkAjax.sendForm('form1','__URL__/checkLogin/',loginHandle,'result');
	}
}

//-->
</script>
</head>
<body onload="if (document.getElementById('userId')) document.getElementById('userId').focus()">
  <div class="panel">
  <div style="min-height:100%;">
    <div class="contentpanel">
      <div class="content_xiao">
      	<div class="login_logo"><img src="__PUBLIC__/images/logo_last.png"></div>
      	<div class="formpanel">
           <form method='post' name="login" id="form1" ACTION="__APP__/Login/Index/checkLogin">
      
      <p>
      <label class="login_list_left">用户名：</label>
      <span class="input-bg-new input-bg-new-lang">
      <input type="text" class="medium bLeftRequire" check="Require" warning="请输入帐号" name="account">
     </span></p>
      <p>
      <label class="login_list_left">密&nbsp;&nbsp;&nbsp;&nbsp;码：</label>
      <span class="input-bg-new input-bg-new-lang"><input type="password" class="medium bLeftRequire" check="Require" warning="请输入密码" name="password"></span></p>
     <!-- <p>
       <label class="login_list_left">验证码：</label>
       <span class="input-bg-new input-bg-new-xiao"><input name='verify' type="text" value=""></span>
       <img src="__ROOT__/Login/Index/verify" id="very" width='127px' height='44px'><a href="javascript:void(0);" onclick="relodev()" class="sx_icon"></a>
      </p>-->
      <p class="btnpanel"><label class="login_list_left"> </label>
       <input type="submit" value="登 录" class="submit">
       <!-- <span>
          <a href="#" class="forget">忘记密码?</a>
        </span> -->
			</p>
    </form>
      </div>
      </div>
    </div>
  </div>
  <!--<div class="footer">
    <p>
      <span>© 2013  ARTH. All Rights Reserved.</span>
      <a href="#" target="_blank">关于我们</a>|<a href="#" target="_blank">微博</a>|<a href="#" target="_blank">Blog</a>|<a href="#" target="_blank">服务条款</a>|<a href="#" target="_blank">隐私政策</a>
      <span>京ICP备13018010号-1</span>
    </p>
  </div>-->
</div>

<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
$().ready(function(){
  $('.input-bg input').focus(function(){
    $(this).parent().addClass('input-bg-active');
  })
  $('.input-bg input').blur(function(){
    $(this).parent().removeClass('input-bg-active');
  })
  $('.input-bg input').keyup(function(){
    if($(this).val().length > 1){
      $('.messagebox').hide("fast");
    }
  })
  $('.submit').click(function(){
    $('.messagebox').hide();
  })
  
})

function relodev(){
	var str = new Date().getTime() + 'a' + Math.random();
	$('#very').attr('src','__ROOT__/Login/Index/verify/'+str);
}
</script>

</body></html>