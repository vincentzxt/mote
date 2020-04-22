<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/layout.css" />
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script language="javascript">
   function ab(){
      var a = $("select option:selected").attr('class');
	  document.getElementById("level").value = parseInt(a) + 1;
	}
</script>
</head>
<body>
<div class="right_wrap">
	<div class="right_top">
    	
        <div class="right_top_mid">
            <P>你当前的位置：<span>系统管理-编辑栏目</span></P>
        </div>    
        <div class="right_top_right"></div>
    </div>
    <div class="right_mid">
    	<div class="right_mid_left"></div>
        <div class="right_mid_mid">
         <form method='post' action="__URL__/update">
        	<table cellspacing="0" cellpadding="0" class="list" >
        	  <input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" />
            <tbody>
            	
            	<tr>
                    <td style="text-align:right;" >分类名称： </td>
                    <td style="text-align:left; padding-left:10px;"><input type="text" name="title" value="<?php echo ($vo["title"]); ?>" /></td>
                </tr>
                <tr>
                    <td style="text-align:right;" >分类别名： </td>
                    <td style="text-align:left; padding-left:10px;"><input type="text" name="etitle" value="<?php echo ($vo["etitle"]); ?>" /></td>
                </tr>
                 <tr>
                	<td style="text-align:right;">上级分类：</td> 
                    <td style="text-align:left; padding-left:10px;">
                   
                    <select name="pid" id="sle" onChange="ab()">
                      <option value="0" class="0">根目录</option>
                       <?php if(is_array($sct)): $i = 0; $__LIST__ = $sct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data[0]); ?>" class="<?php echo ($data[5]); ?>"
                        <?php if(($data[0]) == $vo["pid"]): ?>selected="selected"<?php endif; ?>
                         ><?php echo ($data[3]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <input type="hidden" name="level" value="<?php echo ($vo["level"]); ?>" id="level">
   				 </td>
                </tr>
                <tr>
                	<td style="text-align:right;" >状态：</td> 
                    <td style="text-align:left; padding-left:10px;" > 
                    <select name="status">
                      <option value="1" <?php if($vo['status'] == 1): ?>selected="selected"<?php endif; ?> >开启</option>
                      <option value="0" <?php if($vo['status'] == 0): ?>selected="selected"<?php endif; ?> >关闭</option>
                    </select>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:right;" >url：</td>
                    <td style="text-align:left; padding-left:10px;" ><input name="url" type="text"   value="<?php echo ($vo['url']); ?>" /></td>
                </tr>
                <tr>
                	<td style="text-align:right;" >排序：</td>
                    <td style="text-align:left; padding-left:10px;" ><input name="sort" type="text"   value="<?php echo ($vo['sort']); ?>" /></td>
                </tr>             
                <tr>
                	<td colspan="2">
                    <input type="submit" name="button" id="button" value="提交" style="float:left; margin-left:107px;"   />                   
                    <a href="__ROOT__/Data/Category/index?l=<?php echo ($c); ?>"></a>
                    </td>
                </tr>
             </tbody>
            </table>
             </form>
</div>    
     
    
    </div>
  
</div>
<!--<h1>编辑栏目</h1>
<form method='post' action="__ROOT__/admin.php/Category/Index/Update">
  <input type="hidden" name="Id" value="<?php echo ($vo["Id"]); ?>">
  <input type="hidden" name="c" value="<?php echo ($c); ?>">
  <p>分类名称：<input type="text" name="Name" value="<?php echo ($vo["Name"]); ?>" />
  </p>
  <p>上级分类：
    <label for="ParentId"></label>
    <select name="ParentId" id="sle" onchange="ab()">
      <option value="0" class="0">根目录</option>
       <?php if(is_array($sct)): $i = 0; $__LIST__ = $sct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i; if(($data[4]) != $vo["ParentId"]): ?><option value="<?php echo ($data[0]); ?>" class="<?php echo ($data[3]); ?>"
        <?php if(($data[0]) == $vo["ParentId"]): ?>selected="selected"<?php endif; ?>
         ><?php echo ($data[2]); echo ($data[1]); echo ($data[4]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
    </select>
  </p>
  <input type="hidden" name="Depth" value="1" id="Depth">
  <p>状态：
    <label for="Status"></label>
    <select name="Status">
      <option value="1" selected="selected">开启</option>
      <option value="0">关闭</option>
    </select>
  </p>

  <p>排序：<input name="Priority" type="text"   value="<?php echo ($vo['Priority']); ?>" /></p>
  <p>
    <input type="submit" value="提交" />
  </p>

</form>
<a href="__ROOT__/admin.php/Category/Index?c=<?php echo ($c); ?>">返回列表</a>-->
</body>
</html>