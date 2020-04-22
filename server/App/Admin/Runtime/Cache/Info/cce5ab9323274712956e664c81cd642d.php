<?php if (!defined('THINK_PATH')) exit();?>
<div id="main" class="main" >
	<div class="content">
		<div class="title">添加数据 [<a href="__URL__">返回列表</a>]</div>
		<div id="result" class="result none"></div>
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/layout.css" />
		<script type="text/javascript" src="__PUBLIC__/js/editor/kindeditor.js"></script>
		<script type="text/javascript" src="__PUBLIC__/js/editor/lang/zh_CN.js"></script>
		<script type="text/javascript" src="__PUBLIC__/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
	KindEditor.ready(function(K) {
		var editor = K.editor({
			allowFileManager : true
		});
		K('#J_selectImage').click(function() {
			editor.loadPlugin('multiimage', function() {
				editor.plugin.multiImageDialog({
					clickFn : function(urlList) {
						var div = K('#J_imageView');
						div.html('');
						K.each(urlList, function(i, data) {
							div.append('<img src="' + data.url + '">');
						});
						editor.hideDialog();
					}
				});
			});
		});
	});

    KE.show({
        id : 'content_1' //TEXTAREA输入框的ID
   });
   function checklevel(){
	    id = $('#sctl').val();
		$.ajax({
		   type: "POST",
		   url: "__APP__/Info/Ajax/ajaxfunc",
		   data: "d=category&&b=&&l=&&t=1&&mf=pid&&mt=eq&&mv="+id,
		   success: function(msg){
			 //alert(msg);
			 var obj = jQuery.parseJSON(msg);
			 if(obj!=null){
			     alert('不是根目录，不能添加文章！');
				 $("#sctl").get(0).selectedIndex=0;//index为索引值
				 
			 }
		   }
		});
   }
</script>
<form method='post' id="form1" name="form1" action="__URL__/insert"  enctype="multipart/form-data">
	<table cellpadding=3 cellspacing=3  width="100%" class="list">
<tr>
	<td class="tRight" width="10%">栏目：</td>
	<td class="tLeft" >
    <input type="hidden" name="type" value="2" />
    <select name="lanmu" id="sctl" onchange="checklevel();">
     <option value="0" class="0">请选择</option>
	 <?php if(is_array($sct)): $i = 0; $__LIST__ = $sct;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><option value="<?php echo ($data[0]); ?>" class="<?php echo ($data[5]); ?>"><?php echo ($data[3]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	</select></td>
</tr>
<tr>
	<td class="tRight" width="10%">姓名：</td>
	<td class="tLeft" ><input type="text" class="huge " name="name"></td>
</tr>
		<tr>
			<td class="tRight" width="10%">年龄：</td>
			<td class="tLeft" ><input type="text" class="huge " name="age"></td>
		</tr>
		<tr>
			<td class="tRight" width="10%">身高：</td>
			<td class="tLeft" ><input type="text" class="huge " name="height"></td>
		</tr>
		<tr>
			<td class="tRight" width="10%">体重：</td>
			<td class="tLeft" ><input type="text" class="huge " name="weight"></td>
		</tr>
		<tr>
			<td class="tRight" width="10%">籍贯：</td>
			<td class="tLeft" ><input type="text" class="huge " name="address"></td>
		</tr>
		<tr>
			<td class="tRight">排序：</td>
			<td class="tLeft" ><input type="text" class="huge" name="order">
				&nbsp;&nbsp;默认为1</td>
		</tr>
		<tr>
			<td class="tRight">热度：</td>
			<td class="tLeft" ><input type="text" class="huge" name="hot">
				&nbsp;&nbsp;默认为0</td>
		</tr>
<tr>
	<td class="tRight" width="10%">图集图片：</td>
	<td class="tLeft" ><input type="button" id="J_selectImage" value="批量上传" /></td>
</tr>
<tr>
	<td class="tRight tTop">图集内容：</td>
	<td class="tLeft"><div id="J_imageView"></div></td>
</tr>

<tr>
	<td></td>
	<td class="center"><div style="width:85%;margin:5px">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION[C('USER_AUTH_KEY')] ?>">
	<input type="submit" value="保 存"  class="button small"> <input type="reset" class="button small" onclick="resetEditor()" value="重 置" >
	</div></td>
</tr>
</form>
</table>
</div>
</div>