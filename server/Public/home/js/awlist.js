// Generated by CoffeeScript 1.6.3
(function($) {
  ($(document)).ready(function() {
    var $list, divHtml, expandFirst;
    $list = $("#awardlist");
    divHtml = "<div class='aw-section hidden'/>";
    $list.on("click", ".role-handle", function(e) {
      var $content, $dds, $inner, $sections, h, sep, top, w;
      $content = (($(this)).closest("li")).find(".acorr-content");
      $inner = $content.find(".aw-inner");
      if (($content.find(".aw-section")).length === 0) {
        if ($inner.length > 0) {
          $dds = $inner.children();
          w = $dds.width();
          h = $inner.height();
          top = $inner.offset().top;
          sep = 0;
          $dds.each(function(i) {
            var $dd;
            $dd = $(this);
            if ($dd.offset().top + $dd.height() >= top + h) {
              ($dds.slice(sep, i)).wrapAll(divHtml);
              sep = i;
            }
          });
          ($dds.slice(sep)).wrapAll(divHtml);
          $sections = $dds.parent().removeClass("hidden");
          $sections.width(w);
          $sections.parent().width(w * $sections.length);
          if ($sections.length <= 2) {
            ($content.find(".role-prev,.role-next")).remove();
          }
        }
      }
    });
    expandFirst = function() {
      ($list.find(".role-handle")).first().trigger("click");
    };
    if ($list.height()) {
      expandFirst();
    } else {
      ($("#awardtab")).one("click", function(e) {
        setTimeout(expandFirst);
      });
    }
    $list.on("loaded", function(e) {
      expandFirst();
    });
  });
})($);
