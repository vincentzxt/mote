//nav href to xp
$(document).ready(function(){
	$('#xp').hover(
		function(){
			$(this).after('<div id="title" class="goto-xp"><div class="small-corner"></div>应用联盟</div>');
		},
		function(){
			$(this).next('#title').remove();
		}
	)
});
/*
 * column
 */
;$(document).ready(function(){
  //fix sidebar style
  $('#siderNav .nav-items>li:last').addClass('item-bottom');
  
  window.fixColumn = function(){
    if($('.fix-column')){
      var $this = $('.fix-column'),len,panelWidth,m;
      var scrollbar = 0;
      if (document.documentElement.clientHeight < document.documentElement.offsetHeight){
        scrollbar = 1;
      }
      $this.each(function(){
        len = $(this).children('.col').length;
        m = $(this).attr("m");
        if(len>1){
          panelWidth = $(this).width()-m*(len-1) -len;
          $(this).children('.col').width(parseInt(panelWidth/len),10).css("margin-right",m+"px");
          $(this).children('.col:last').css("margin-right","0px");
        }
      })
    }
  }
	 fixColumn();
	 $(window).resize(function(){
		 fixColumn();
	 });
 });
 /*
 menu
 */
;(function($){
	$('#siderNav .nav-item').bind('click',function(e){
		var $this = $(this);
		var ul = $this.find('.sub-list');
		if(!$this.hasClass('on')){
			if(ul.length > 0){
				ul.slideDown('fast',function(){
					$this.addClass('on');
				});
			}else{
				$this.addClass('on');
			}
			if($this.siblings('.on').find('.sub-list').length > 0){
				$this.siblings('.on').find('.sub-list').slideUp('fast',function(){
					$this.siblings('.on').removeClass('on');
				});
			}else{
				$this.siblings('.on').removeClass('on');
			}
		}
		e.stopPropagation();
	})
})(jQuery);

$('.expandCollapse').bind('click',function(){
	var id = $(this).attr('expand-id');
	var obj =$('#'+id);
	if(obj.is(":visible")){
		obj.addClass('hidden');
		$(this).parent().css('border-top','0px');
		$(this).text('展开明细数据');
	}else{
		obj.removeClass('hidden');
		if(obj.find('.pagination').html() !=''){
			$(this).parent().css('border-top','1px solid #B4B4B4');
			obj.find('.pagination').removeClass('hidden');
		}else{
			obj.find('.pagination').addClass('hidden');
			$(this).parent().css('border-top','0px');
		};
		$(this).text('收起明细数据');
	}
	return false;
});

$('.exportCsv').bind('click',function(e){
  $(this)._export(e);
})

function confirm_msg(title,str,callback){
	$('<div>'+str+'</div>').dialog({title:title, buttons: [
		{
			text: "确认",
			click: function() { $(this).dialog("close"); callback(); }
		},		
		{
			text: "取消",
			click: function() { $(this).dialog("close");}
		}

	]});
};
/**
 *it can be used to replace the windows.alert
 */
window.alert = $.alert = function(msg,time){

	if(arguments.length<=0 || msg == undefined){
		msg = "";
	}
	var randomnum = parseInt(Math.random()*1000000000);
	if(time>0){
		$('<div id="temp_alert_box'+randomnum+'">'+msg+'</div>').Tips({title:"提示",width:300});
		setTimeout(function(){
			$('#temp_alert_box'+randomnum).Tips("close");
			$('#temp_alert_box'+randomnum).parent(".ui-dialog").remove();
			$('#temp_alert_box'+randomnum).remove();
		},time);
	}else{
		$('<div id="temp_alert_box">'+msg+'</div>').dialog({title:"提示",width:397,modal:true, buttons: [
		{
			text: "确认",
			click: function() { $(this).dialog("close");}
		}]});		
	}
};


