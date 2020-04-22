/**
�� JQUERY ģ���Ա��ؼ������ʺ�����
* @Author 312854458@qq.com ������
**/
(function($){
// ������ʽ��
$.fn.bankInput = function(options){
var defaults = {
min : 10, // ������������
max : 35, // �����������
deimiter : '  ', // �˺ŷָ���
onlyNumber : true, // ֻ����������
copy : true // ������
};
var opts = $.extend({}, defaults, options);
var obj = $(this);
obj.css({imeMode:'Disabled',borderWidth:'1px',color:'#090',fontFamly:'Times New Roman'}).attr('maxlength', opts.max);
if(obj.val() != '') obj.val( obj.val().replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1"+opts.deimiter) );
obj.bind('keyup',function(event){
if(opts.onlyNumber){
if(!(event.keyCode>=48 && event.keyCode<=57)){
this.value=this.value.replace(/\D/g,'');
}
}
this.value = this.value.replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1"+opts.deimiter);
}).bind('dragenter',function(){
return false;
}).bind('onpaste',function(){
return !clipboardData.getData('text').match(/\D/);
}).bind('blur',function(){
this.value = this.value.replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1"+opts.deimiter);
if(this.value.length < opts.min){
alertMsg.warn('��������'+opts.min+'λ�˺���Ϣ��');
obj.focus();
}
})
}
// �б���ʾ��ʽ��
$.fn.bankList = function(options){
var defaults = {
deimiter : ' ' // �ָ���
};
var opts = $.extend({}, defaults, options);
return this.each(function(){
$(this).text($(this).text().replace(/\s/g,'').replace(/(\d{4})(?=\d)/g,"$1"+opts.deimiter));
})
}
})(jQuery); 