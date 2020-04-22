// Generated by CoffeeScript 1.6.3
(function($) {
  return ($(document)).ready(function() {
    var $showDetail, $toolbar, $waterfall, toolbarTop;
    $toolbar = $("#toolbar");
    $waterfall = $("#caseslist");
    $showDetail = $("#scope_show_detail,#scope_hide_detail");
    if ($toolbar.length > 0) {
      toolbarTop = $toolbar.offset().top;
      ($toolbar.find("select")).on("change", function() {
        var $select;
        $select = $(this);
        ($(window)).scrollTop(toolbarTop);
        $waterfall.scrollLoader("url", "?" + $toolbar.serialize());
      });
    }
    if ($showDetail.length > 0) {
      return $showDetail.on("click", function(e) {
        (($(e.currentTarget)).closest(".scope-content")).toggleClass("collapsed");
      });
    }
  });
})($);
$('.toolbar .btn_down').click(function () {
  $(this).parent().toggleClass('active');
});