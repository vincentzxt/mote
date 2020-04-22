// Generated by CoffeeScript 1.6.3
(function($) {
  var $image, $lis, $list, currPage, i, sectionSize, _i, _ref;
  currPage = 0;
  $list = $("#caseimage-list");
  $image = $("#caseimage");
  /*$image.parent().data "group", Array::join.call (($list.find "a").map ->
  		($ @).attr "href"
  	), ","
  */

  $list.on("click", "a", function(e) {
    var $a, $li, href;
    $a = $(e.currentTarget);
    $li = $a.parent();
    href = $a.attr("href");
    $image.attr("src", href);
    /*$image.parent().data "index", $li.index() + currPage * sectionSize*/

    ($list.find(".list-item.on")).removeClass("on");
    $li.addClass("on");
    return e.preventDefault();
  });
  $lis = $list.find(".list-item");
    /**
     * hack:移动端显示6个
     */
    if( !/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        sectionSize = 10;
    }else{
        sectionSize = 9;
    }
  for (i = _i = 0, _ref = Math.ceil($lis.length / sectionSize); 0 <= _ref ? _i < _ref : _i > _ref; i = 0 <= _ref ? ++_i : --_i) {
    ($lis.slice(i * sectionSize, (i + 1) * sectionSize)).wrapAll("<div class=''/>");
  }
  ($list.find("a")).first().click();
  ($list.find(".list-section:first")).addClass("section-on");
})($);