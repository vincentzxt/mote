<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
 <head>
  <title>后台信息管理</title>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <link href="__PUBLIC__/assets/css/dpl-min.css" rel="stylesheet" type="text/css" />
  <link href="__PUBLIC__/assets/css/bui-min.css" rel="stylesheet" type="text/css" />
   <link href="__PUBLIC__/assets/css/main-min.css" rel="stylesheet" type="text/css" />
 
 </head>
 <body>

  <div class="header">
    
      <div class="dl-title">
       <!-- <a href="http://www.builive.com" title="文档库地址" target="_blank"> 仅仅为了提供文档的快速入口，项目中请删除链接 -->
          <span class="lp-title-port">后台信息管理</span>
        </a>
      </div>

    <div class="dl-log">欢迎您，<span class="dl-log-user"><?php echo ($user["name"]); ?></span>
    你好,<?php echo ($sess["username"]); ?>[<?php echo ($sess["account"]); ?>] !<!--  | 公司：<?php echo (toCompany($sess["fgs_id"])); ?> 部门：<?php echo (tobumen($sess["bm_id"])); ?>  组：<?php echo (togroup($sess["group_id"])); ?>   角色：<?php echo (role_to_name($sess["role_id"])); ?> --><a href="<?php echo U('Login/Index/logout');?>" title="退出系统" class="dl-log-quit">[退出]</a>
   <!-- <a href="" title="文档库" class="dl-log-quit">文档库</a>-->
   
    </div>
  </div>
   <div class="content">
    <div class="dl-main-nav">
      <div class="dl-inform"><div class="dl-inform-title">贴心小秘书<s class="dl-inform-icon dl-up"></s></div></div>
      <ul id="J_Nav"  class="nav-list ks-clear">
      <?php if(is_array($res)): $k = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$res): $mod = ($k % 2 );++$k;?><!--<div  class="style3" onClick="changeleft('<?php echo ($res["id"]); ?>')" ><?php echo ($res["title"]); ?></div>-->
        <li class="nav-item dl-selected">
        <div class="nav-item-inner <?php if($key == 1): ?>nav-home
								   <?php elseif($key == 2): ?>nav-order
								   <?php elseif($key == 3): ?>nav-inventory
								   <?php elseif($key == 4): ?>nav-supplier
								   <?php else: ?> nav-marketing<?php endif; ?>"><?php echo ($res["title"]); ?></div></li><?php endforeach; endif; else: echo "" ;endif; ?>
      <!--  <li class="nav-item dl-selected"><div class="nav-item-inner nav-home">信息管理</div></li>
        <li class="nav-item"><div class="nav-item-inner nav-order">用户管理</div></li>
        <li class="nav-item"><div class="nav-item-inner ">商品建档</div></li>
        <li class="nav-item"><div class="nav-item-inner ">仓库管理</div></li>
        <li class="nav-item"><div class="nav-item-inner ">质检管理</div></li>-->
      </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
   </div>
  <script type="text/javascript" src="__PUBLIC__/assets/js/jquery-1.8.1.min.js"></script>
  <script type="text/javascript" src="__PUBLIC__/assets/js/bui.js"></script>
  <script type="text/javascript" src="__PUBLIC__/assets/js/config.js"></script>

  <script>
    BUI.use('common/main',function(){
	    
        var config = [
	    <?php if(is_array($sct)): $i = 0; $__LIST__ = $sct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>{
            id:'<?php echo ($vo["id"]); ?>', 
            homePage : '',
            menu:
			[
				<?php if(is_array($vo[0])): $i = 0; $__LIST__ = $vo[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?>{
				  text:'<?php echo ($vo1["title"]); ?>',
				  items:[
				    <?php if(is_array($vo1[0])): $i = 0; $__LIST__ = $vo1[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?>{
						id:'<?php echo ($vo2["id"]); ?>',text:'<?php echo ($vo2["title"]); ?>',href:'<?php if($vo2["url"] != ''): ?>__APP__/<?php echo ($vo2["url"]); else: ?>__APP__/Info/Wendang/index/tid/<?php echo ($vo2["id"]); endif; ?>'
						},<?php endforeach; endif; else: echo "" ;endif; ?>
				  ]
				},<?php endforeach; endif; else: echo "" ;endif; ?>
			
			]
        },<?php endforeach; endif; else: echo "" ;endif; ?>
		  ];
      new PageUtil.MainPage({
        modulesConfig : config
      });
    });
  </script>
 </body>
</html>