// Generated by CoffeeScript 1.6.3
(function($) {
  var $arrow, $panel, $panelDl, $partners, lastLi, lastLink;
  $partners = $("#partners");
  $panel = $("#partnerAwards");
  $panelDl = $panel.find("dl");
  $arrow = $panel.find(".arrow");
  lastLink = null;
  lastLi = null;
  return $partners.on("click", "a", function(e) {
    var $a, $li, $next, h, isHidden;
    $a = $(this);
    isHidden = $panel.hasClass("noarrow");
    if (isHidden || lastLink !== this) {
      lastLink = this;
      $panelDl.html(($a.find("dl")).html());
      h = $panelDl.outerHeight();
      $li = $a.closest("li");
      $arrow.css("left", $li.offset().left);
      while (($next = $li.next()).length > 0 && $li.offset().top === $next.offset().top) {
        $li = $next;
      }
      if (lastLi !== $li[0]) {
        lastLi = $li[0];
        $panel.detach().height(0);
        $li.after($panel);
      }
      return ($panel.removeClass("noarrow")).height(h);
    } else {
      return ($panel.addClass("noarrow")).css("height", 0);
    }
  });
})($);