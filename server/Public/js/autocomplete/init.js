//autocomplete插件
jQuery().ready(function() {
	if (!$.curCSS) $.curCSS = $.css; 
	
	//查询客户表信息
	$("#fa_gongsimingcheng").autocomplete({
		source: URL +"/autoCompleteInputVar?db=khgy_kh&&th=khname&&tj=khname",
		//minLength: 1,
		autoFocus: true,
		open : function(){
		   var position = $(this).position();
           $(".ui-autocomplete:visible").css({top:position.top+20,left:position.left});
		},
		position: {  collision: "flip"  },
		max: 12,    //列表里的条目数
        minChars: 1,    //自动完成激活之前填入的最小字符
        width: 400,     //提示的宽度，溢出隐藏
        scrollHeight: 300,   //提示的高度，溢出显示滚动条
		select: function(event, ui) {
			
			$('#fa_kehudaima').val(ui.item.kehudaima);
			$('#khid').val(ui.item.id);
		    $('#fa_lianxidizhi').val(ui.item.gongsidizhi);
       }
	
	}).autocomplete( "instance" )._renderItem = function( ul, item ) {
		return $( "<li>" ).append( "<a>" + item.label + "<br>" + item.kehudaima + "<br>" + item.gongsidizhi + "</a>" ).appendTo( ul )
	};;
	
	$( "#fa_kehudaima" ).autocomplete({
		source: URL +"/autoCompleteInputVar?db=khgy_kh&&th=kehudaima&&tj=kehudaima",
		//minLength: 1,
		autoFocus: true,
		open : function(){
		   var position = $(this).position();
           $(".ui-autocomplete:visible").css({top:position.top+20,left:position.left});
		},
		max: 12,    //列表里的条目数
        minChars: 1,    //自动完成激活之前填入的最小字符
        //width: 400,     //提示的宽度，溢出隐藏
       // scrollHeight: 300,   //提示的高度，溢出显示滚动条
		select: function(event, ui) {
			$('#fa_gongsimingcheng').val(ui.item.khname);
			$('#khid').val(ui.item.id);
		    $('#fa_lianxidizhi').val(ui.item.gongsidizhi);
       }
	
	}).autocomplete( "instance" )._renderItem = function( ul, item ) {
		return $( "<li>" ).append( "<a>" + item.label + "<br>" + item.khname + "</a>" ).appendTo( ul )
	};;
	
	
	//收方信息查询
	$( "#shou_gongsimingcheng" ).autocomplete({
		source: URL +"/autoCompleteInputVar?db=yy_fyjd_ddgl&&th=shou_gongsimingcheng&&tj=shou_gongsimingcheng",
		//minLength: 1,
		autoFocus: true,
		open : function(){
		   var position = $(this).position();
           $(".ui-autocomplete:visible").css({top:position.top+20,left:position.left});
		},
		max: 12,    //列表里的条目数
        minChars: 1,    //自动完成激活之前填入的最小字符
        width: 800,     //提示的宽度，溢出隐藏
        scrollHeight: 300,   //提示的高度，溢出显示滚动条
		select: function(event, ui) {
			$('#shou_gongsimingcheng').val(ui.item.shou_gongsimingcheng);
			$('#shou_kehudaima').val(ui.item.shou_kehudaima);
			$('#shou_lianxidianhua').val(ui.item.shou_lianxidianhua);
		    $('#shou_lianxiren').val(ui.item.shou_lianxiren);
			$('#shou_shouji').val(ui.item.shou_shouji);
			$('#shou_lianxidizhi').val(ui.item.shou_lianxidizhi);
			
			return false;
       }
	}).autocomplete( "instance" )._renderItem = function( ul, item ) {
		return $( "<li>" ).append( "<a>" + item.label + "<br>" + item.shou_lianxiren + "</a>" ).appendTo( ul )
	};
	
	
	//收方信息查询
	$( "#shou_kehudaima" ).autocomplete({
		source: URL +"/autoCompleteInputVar?db=yy_fyjd_ddgl&&th=shou_kehudaima&&tj=shou_kehudaima",
		//minLength: 1,
		autoFocus: true,
		open : function(){
		   var position = $(this).position();
           $(".ui-autocomplete:visible").css({top:position.top+20,left:position.left});
		},
		max: 12,    //列表里的条目数
        minChars: 0,    //自动完成激活之前填入的最小字符
        width: 400,     //提示的宽度，溢出隐藏
        scrollHeight: 300,   //提示的高度，溢出显示滚动条
		select: function(event, ui) {
			$('#shou_gongsimingcheng').val(ui.item.shou_gongsimingcheng);
			$('#shou_lianxidianhua').val(ui.item.shou_lianxidianhua);
		    $('#shou_lianxiren').val(ui.item.shou_lianxiren);
			
			$('#shou_shouji').val(ui.item.shou_shouji);
			$('#shou_lianxidizhi').val(ui.item.shou_lianxidizhi);
		
       }
	
	})
	
	//查询联系人信息
	$( "#fa_lianxiren" ).autocomplete({
		//source: "autoCompleteInputVar?db=khgy_kh_hz&&th=lianxiren&&tj=khid&&tjval="+khid,
		source: function( request, response ) {
		var khid = $("#khid").val();
		if(!khid){return;}
		$.ajax({
		type: "POST",
		url: URL +"/autoCompleteInputVar?db=khgy_kh_hz&&th=lianxiren&&tj=khid&&tjval=" + encodeURI(encodeURI(khid)),
		dataType: "json",
		data: {
			maxRows: 12
		},
		success: function( data ) {
			
			if(data.length > 0){
				response( $.map( data, function( item ) {
					return {
						dianhua:item.dianhua,
						shouji:item.shouji,
						value: item.lianxiren
					}
					}));
					}
				}
			});
		},
		autoSelectFirst:true,
		autoFocus: true,
		open : function(){
		   var position = $(this).position();
           $(".ui-autocomplete:visible").css({top:position.top+20,left:position.left});
		},
		max: 12,    //列表里的条目数
        minChars: 0,    //自动完成激活之前填入的最小字符
        width: 400,     //提示的宽度，溢出隐藏
        scrollHeight: 300,   //提示的高度，溢出显示滚动条
		select: function(event, ui) {
			
			$('#fa_lianxidianhua').val(ui.item.dianhua);
			$('#fa_shouji').val(ui.item.shouji);
			
     }

	
	}).autocomplete( "instance" )._renderItem = function( ul, item ) {
		return $( "<li>" ).append( "<a>" + item.label + "<br>电话：" + item.dianhua  + "手机： "  + item.shouji +"</a>" ).appendTo( ul )
	};
	
}); 