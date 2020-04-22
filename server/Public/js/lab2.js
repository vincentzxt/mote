$(function(){
	
	$('#b1').click(function(){
		$obj = $('#s1 option:selected').clone(true);
		if($obj.size() == 0){
			alert("请至少选择一条!");
		}
		$('#s2').append($obj);
		$('#s1 option:selected').remove();
	});
	
/*	$('#b2').click(function(){
		$('#s2').append($('#s1 option'));
	});*/
	
	$('#b3').click(function(){
		$obj = $('#s2 option:selected').clone(true);
		if($obj.size() == 0){
			alert("请至少选择一条!");
		}
		$('#s1').append($obj);
		$('#s2 option:selected').remove();
	});
	
/*	$('#b4').click(function(){
		$('#s1').append($('#s2 option'));
	});*/
	//双击操作
	$('option').dblclick(function(){
		var flag = $(this).parent().attr('id');
		alert(flag);
		if(flag == "s1"){
			var $obj = $(this).clone(true);//克隆元素
			$('#s2').append($obj);
			$(this).remove();
		}else{
			var $obj = $(this).clone(true);//克隆元素
			$('#s1').append($obj);
			$(this).remove();
		}
	});
	
});