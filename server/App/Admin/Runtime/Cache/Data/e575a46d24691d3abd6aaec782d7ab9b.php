<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>
<link href="__PUBLIC__/css/layout.css" media="screen" rel="stylesheet" type="text/css">
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/lhgdialog/lhgdialog.min.js"></script>
<script language="javascript">
   function ab(){
      var a = $("select option:selected").attr('class');
	  document.getElementById("level").value = parseInt(a) + 1;
	}
	
	function selectqx(valname){
		  $.dialog({ 
			   title: "单用户选择",
			   width: 530,
			   height: 400,
			   content: 'url:__APP__/Data/DataAuthority/selectqx/valname/'+valname,
			   lock:true
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
                <li><a href="__APP__/Data/DataAuthority">数据栏目管理</a></li>
            	<li  class="on"><a href="#">编辑栏目</a></li>
            </ul>
          	<div class="mod-header radius clearfix"><h2>编辑栏目:<?php echo ($vo["title"]); ?></h2></div>
            <div class="mod-body">
            	<div class="content register_content_center">
                     <form method='post' action="__URL__/update">
                        <table width="100%" cellspacing="0" cellpadding="0" class="data" >
                        <thead>
                            <tr>
                                <td width="13%">&nbsp;</td>
                                <td width="38%" style="text-align:left; padding-left:10px;"><input type="hidden" name="id" value="<?php echo ($vo["id"]); ?>" /></td> 
                                <td width="49%">&nbsp;</td>                   
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr>
                                <td style="text-align:right;" >数据栏目名称： </td> 
                                <td style="text-align:left; padding-left:10px;"><input type="text" name="title" value="<?php echo ($vo["title"]); ?>" /></td>
                                <td style="text-align:left; padding-left:10px;"></td>
                            </tr>
                            <tr>
                            	<td style="text-align:right;">数据栏目说明： </td>
                                <td style="text-align:left; padding-left:10px;"><input type="text" name="rename" value="<?php echo ($vo["rename"]); ?>" /></td>
                                <td></td>
                            </tr>
                             <tr>
                                <td style="text-align:right;">上级分类：</td> 
                                <td style="text-align:left; padding-left:10px;">
                               
                                <select name="pid" id="sle" onchange="ab()">
                                  <option value="0" class="0">根目录</option>
                                   <?php if(is_array($sct)): $i = 0; $__LIST__ = $sct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data[0]); ?>" class="<?php echo ($data[5]); ?>"
                                    <?php if(($data[0]) == $vo["pid"]): ?>selected="selected"<?php endif; ?>
                                     ><?php echo ($data[3]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                                <input type="hidden" name="level" value="<?php echo ($vo["level"]); ?>" id="level">
                             </td>
                                <td style="text-align:left; padding-left:10px;"></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;" >状态：</td> 
                                <td style="text-align:left; padding-left:10px;" > 
                                <select name="status">
                                  <option value="1" <?php if($vo['status'] == 1): ?>selected="selected"<?php endif; ?> >开启</option>
                                  <option value="0" <?php if($vo['status'] == 0): ?>selected="selected"<?php endif; ?> >关闭</option>
                                </select>
                                </td>
                                <td style="text-align:left; padding-left:10px;" ></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;" >关联数据库名称：</td>
                                <td style="text-align:left; padding-left:10px;" ><input name="sqlname" type="text"   value="<?php echo ($vo['sqlname']); ?>" /></td>
                                <td style="text-align:left; padding-left:10px;" ></td>
                            </tr>  
                             <tr>
                                <td style="text-align:right;" >数据权限：</td>
                                <td style="text-align:left; padding-left:10px;" >
                                 <input name="type" id="type" type="hidden" value="<?php echo ($vo["type"]); ?>" />
                                 <input name="type_name" id="type_name" type="text" value="<?php echo ($vo["type_name"]); ?>" />
                                 <input type="button" value="选择" onclick="selectqx('type')">
                                </td>
                                <td style="text-align:left; padding-left:10px;" ></td>
                            </tr>  
                             <tr>
                            	<td class="tRight">操作地址： </td>
                                 <td style="text-align:left; padding-left:10px;" ><input name="url" type="text"  value="<?php echo ($vo['url']); ?>" />（相对于BI路径） 比如  KPI/AU</td>
                            </tr> 
                               <tr>
                                <td style="text-align:right;" >排序：</td>
                                <td style="text-align:left; padding-left:10px;" ><input name="sort" type="text"   value="<?php echo ($vo['sort']); ?>" /></td>
                                <td style="text-align:left; padding-left:10px;" ></td>
                            </tr>              
                            <tr>
                            	<td style="text-align:right;" ></td>
                                <td colspan="2" style="text-align:left; padding-left:10px;">
                                <input type="submit" name="button" id="button" value="提交" class="imgButton" />                   
                                <a href="__ROOT__/admin.php/Category/Index?c=<?php echo ($c); ?>">返回列表</a>
                                </td>
                            </tr>
                         </tbody>
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