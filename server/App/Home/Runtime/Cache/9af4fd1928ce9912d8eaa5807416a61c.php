<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
    <title><?php echo ($vo["title"]); ?> - <?php echo ($web["webname"]); ?></title>
    <meta name="keywords" content="<?php echo ($vo["tag"]); ?> - <?php echo ($web["webname"]); ?>" />
    <meta name="description" content="<?php echo ($vo["description"]); ?> - <?php echo ($web["webname"]); ?> - <?php echo ($web["meta"]); ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if lt IE 9]>
    <script src="/Public/home/js/html5shiv.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="__PUBLIC__/home/css/styles.css">
    <script src="__PUBLIC__/home/js/share.js"></script>
    <link rel="stylesheet" href="__PUBLIC__/home/css/share_style0_16.css"></head>

<body data-components="colorbox,scroller">
<header>
    <div class="header-top">
        <a href="#" ><img src="/<?php echo ($web["logo"]); ?>" class="logo" /></a>
        <div class="share right">
            <div class="wechat_qr hidden">
                <img src="__PUBLIC__/Data/thumbnail/share/images/default/p18lpou0t9lgdqk617m418fn2ur5.jpg_2000x2000.jpg" width="100" height="100" />
            </div>
            <a id="share_wechat">
                <i class="share-wechat"></i>
            </a>
        </div>
        <div class="right tel" style="display: none">
            <a href="#">购销平台</a>
            |
            <a href="#">员工登录</a>
            |
            <label>#</label>
        </div>
    </div>
    <div class="navbar navbar-inverse">
        <nav class="nav-collapse collapse navbar-inner">
            <div class="container">

                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="menuName">菜单</span>

                <div class="nav-collapse collapse">
                    <ul class="nav navmenu" id="navmenu">
                        <li>
                            <a href="__ROOT__/<?php echo ($dh["url"]); ?>" <?php if(($objurl) == "Index"): ?>class="on"<?php endif; ?> >首页</a>
                        </li>
                        <?php if(is_array($dhlist)): $i = 0; $__LIST__ = $dhlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dhlist): $mod = ($i % 2 );++$i;?><li class="dropdown">
                                <a class="<?php if(($objurl) == $dhlist["url"]): ?>on<?php endif; ?> dropdown dropdown-toggle" href="__ROOT__/<?php echo ($dhlist["url"]); ?>" data-toggle="dropdown"><?php echo ($dhlist["title"]); ?></a>
                                <div class="dropdown-menu" >
                                    <?php if(is_array($dhlist[0])): $i = 0; $__LIST__ = $dhlist[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$dh): $mod = ($i % 2 );++$i;?><a href="__ROOT__/<?php echo ($dh["url"]); ?>"><?php echo ($dh["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

<nav class="sub-nav">
		<div class="inner">
		    <?php if(is_array($tophead)): $i = 0; $__LIST__ = $tophead;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tophead): $mod = ($i % 2 );++$i;?><a href="__ROOT__/<?php echo ($tophead["url"]); ?>" ><?php echo ($tophead["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</nav>
<section class="content center content-page" id="content">
    <div class="case-padding">
        <?php if(empty($vo_s)): else: ?>
            <a href="__ROOT__/Showcases/detail/id/<?php echo ($vo_s["id"]); ?>" class="news-btn news-prev"></a><?php endif; ?>
        <?php if(empty($vo_x)): else: ?>
            <a href="__ROOT__/Showcases/detail/id/<?php echo ($vo_x["id"]); ?>" class="news-btn news-next"></a><?php endif; ?>
     </div>
    <h1>
        <?php echo ($vo["title"]); ?>
        <small><?php echo ($vo["etitle"]); ?></small>
    </h1>
    <div class="case-cover">
        <div class="column-left">
				<span class="imagebox">
					<img src="<?php echo ($vo["Imageurl"]); ?>" id="caseimage">
				</span>
        </div>
        <div class="column-right">
            <a class="case-cover-prev left role-prev"><i></i></a>
            <a class="case-cover-next right role-next"><i></i></a>
            <div class="caseimage-list role-list" id="caseimage-list">
                <div class="list-inner">
                    <div class="list-section section-on">
                        <?php if(is_array($vo["Imagearr"])): $k = 0; $__LIST__ = $vo["Imagearr"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$img): $mod = ($k % 2 );++$k;?><div class="list-item <?php if(($k) == "1"): ?>on<?php endif; ?>">
                                <a class="imagebox" href="<?php echo ($img); ?>">
                                    <img src="<?php echo ($img); ?>">
                                </a>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="case-desc case-padding">
        <div class="column-left">
            <ul class="profile-list floating">
                <li class="list-item">
                    <span class="name">地点（城市）</span>
                    <p class="big"><?php echo ($vo["from"]); ?></p>
                </li>
                <li class="list-item linewrap">
                    <span class="name">发展商</span>
                    <p style="margin-top: 19px;"><?php echo ($vo["author"]); ?></p>
                </li>
                <li class="list-item">
                    <span class="name">建设规模（平方米）</span>
                    <strong><?php echo ($vo["hits"]); ?></strong>
                </li>

                <li class="list-item last empty">
                </li>
            </ul>
        </div>
        <div class="column-right">
            <ul class="desc-list">

                <li>
                    <span class="before"></span>
                    <span class="name">本项目为<?php echo ($now["title"]); ?>项目</span>
                </li>

            </ul>
        </div>
    </div>
    <div class="case-detail pre case-padding">
        <div class="row toleft">
            <div class="column-left">
                <div class="imagebox">
                    <img src="<?php echo ($pics[0]); ?>" />
                </div>
            </div>
            <div class="column-right">
                <h2 class="case-subtitle">项目简介</h2>
                <p><?php echo ($vo["description"]); ?></p>
            </div>
        </div>
        <div class="row toright">
            <div class="column-left">
                <h2 class="case-subtitle">项目定位</h2>
                <p><?php echo ($vo["dingwei"]); ?></p>
            </div>
            <div class="column-right">
                <div class="imagebox">
                    <img src="<?php echo ($pics[1]); ?>" />
                </div>
            </div>
        </div>
        <div class="row toleft">
            <div class="column-left">
                <div class="imagebox">
                    <img src="<?php echo ($pics[2]); ?>" />
                </div>
            </div>
            <div class="column-right">
                <h2 class="case-subtitle">项目特色</h2>
                <p><?php echo ($vo["tag"]); ?></p>
            </div>
        </div>
    </div>
    <div class="news-share">
        <p class="right">
            <?php if(empty($vo_s)): else: ?>
                <a href="__ROOT__/Showcases/detail/id/<?php echo ($vo_s["id"]); ?>">上一个：<?php echo ($vo_s["title"]); ?></a><?php endif; ?>
            <?php if(empty($vo_x)): else: ?>
                <a href="__ROOT__/Showcases/detail/id/<?php echo ($vo_x["id"]); ?>" class="news-btn news-next"></a>
                <a href="__ROOT__/Showcases/detail/id/<?php echo ($vo_x["id"]); ?>">下一个：<?php echo ($vo_x["title"]); ?></a><?php endif; ?>

          			<a href=""__ROOT__/Showcases" class="back">返回</a>
        </p>
        <!-- Baidu Button BEGIN -->
        <div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1484112801425"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a></div>
        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
        <!-- Baidu Button END -->
    </div>
</section>

<div style="clear:both;"></div>
<footer>
    <nav>
        <div class="inner">
            <?php if(is_array($mapres)): $i = 0; $__LIST__ = $mapres;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mapres): $mod = ($i % 2 );++$i;?><dl>
                <dt>
                    <a href="__ROOT__/<?php echo ($mapres["url"]); ?>"><?php echo ($mapres["title"]); ?></a>
                </dt>
                    <?php if(is_array($mapres[0])): $i = 0; $__LIST__ = $mapres[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mapc1): $mod = ($i % 2 );++$i;?><dd>
                           <a href="__ROOT__/<?php echo ($mapc1["url"]); ?>"><?php echo ($mapc1["title"]); ?></a>
                        </dd><?php endforeach; endif; else: echo "" ;endif; ?>

            </dl><?php endforeach; endif; else: echo "" ;endif; ?>
            <div class="qr">
                <img src="__PUBLIC__/Data/thumbnail/share/images/default/p18nproo0g1k2nibu91s2199rc5.jpg_2000x2000.jpg" />
            </div>
            <p class="link-out">
                <span class="bold">合作伙伴：</span>
                <?php if(is_array($hz)): $i = 0; $__LIST__ = $hz;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hz): $mod = ($i % 2 );++$i;?><a href="<?php echo ($hz["url"]); ?>" target="_blank"><?php echo ($hz["title"]); ?><i class="link-to"></i></a><?php endforeach; endif; else: echo "" ;endif; ?>

            </p>
        </div>
    </nav>
    <div class="contacts">
        <div class="inner">
            <p class="bold">联系</p>
            <div class="left">
                <p><?php echo ($web["webname"]); ?></p>
                <p><a target="_blank" href="#">地址：<?php echo ($web["dizhi"]); ?></a></p>
            </div>
            <div class="left">
                <p>电话：<?php echo ($web["dianhua"]); ?></p>
                <p>网站：<a href="http://<?php echo ($web["domain"]); ?>"><?php echo ($web["domain"]); ?></a></p>
                <p>Email：<a href="mailto:<?php echo ($web["email"]); ?>"><?php echo ($web["email"]); ?></a></p>
            </div>

            <div class="left last">
                <p><span>工程：</span>
                    <a target="_blank" href="#">北京</a>
                    <a target="_blank" href="#">石家庄</a>
                    <a target="_blank" href="#">武汉</a>
                    <a target="_blank" href="#">南宁</a>
                    <a target="_blank" href="#">海南</a>
                </p>
                <p><span>设计：</span>
                    <a target="_blank" href="#">广州</a>
                    <a target="_blank" href="#">北京</a>
                    <a target="_blank" href="#">上海</a>
                    <a target="_blank" href="#">武汉</a>
                    <a target="_blank" href="#">海南</a>
                    <a target="_blank" href="#">成都</a>
                </p>
                <p><span>苗木：</span>
                    <a target="_blank" href="#">北京</a>
                    <a target="_blank" href="#">石家庄</a>
                    <a target="_blank" href="#">武汉</a>
                    <a target="_blank" href="#">南宁</a>
                    <a target="_blank" href="#">海南</a>
                </p>
            </div>

        </div>
    </div>
    <div style="background-color:#282828;text-align:center;padding:0 10px 10px 10px;">
        <a target="_blank" href="/www.miitbeian.gov.cn/publish/query/indexFirst.action"><?php echo ($web["beian"]); ?></a> 2005-2020 Quan Yuan Garden Co., Ltd.
<script type="text/javascript" src="https://js.users.51.la/20727325.js"></script>
</div>
</footer>

<div id="btn_top" class="btn_top"><div class="btn_top_wrap"></div></div>


<!--[if lte IE 6]>
<script src="__PUBLIC__/home/js/DD_belatedPNG_0.0.8a-min.js"></script>
<script>DD_belatedPNG.fix('img');</script>
<script type="text/javascript" src="__PUBLIC__/share/js/minmax.js"></script>
<![endif]-->
<script src="__PUBLIC__/home/js/jquery-1.10.2.min.js"></script>

<script type="text/javascript">
    $(function(){
        $(window).scroll(function() {
            if($(window).scrollTop() >= 100){
                $('#btn_top').fadeIn(300);
            }else{
                $('#btn_top').fadeOut(300);
            }
        });
        $('#btn_top').click(function(){$('html,body').animate({scrollTop: '0px'}, 0);});
    });
</script>

<script type="text/javascript">

    /**
     * 手机版的menu的data-toggle
     */
    (function($){
        if( !/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            var $a =  $('#navmenu .dropdown > a'),
                    firstValid = false;
            $a.each(function(){
                var $item = $(this);
                if(firstValid){
                    $item.removeAttr('data-toggle');
                }else{
                    firstValid = true;
                }

            });
        }else{
            //地址a标签替换
            var pathname = location.pathname;
            pathname = pathname.replace(".html",'');
            var $link = $('#navmenu .dropdown a');
            $link.each(function(){
                var $a = $(this),
                        href = $a.attr('href');
                href = href.replace('.html','');
                if(pathname.indexOf(href) >=0){
                    $a.addClass('on');
                }
            });
        }
    })($);
</script>

<script src="__PUBLIC__/home/js/plugins.js"></script>
<script src="__PUBLIC__/home/js/bootstrap.min.js"></script>
<script src="__PUBLIC__/home/js/jquery.colorbox-min.js"></script>

<script src="__PUBLIC__/home/js/iscroll.js"></script>

<script type="text/javascript">
    // 菜单scroll，当菜单栏宽度过短时隐藏两边按钮

    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        var $scrollNav = $('nav.sub-nav');
        if($scrollNav.length){
            $children = $scrollNav.find('.inner a');
            var scrollWidth = 0,
                    scrollLeft = 0;
            $children.each(function(){
                //console.log($(this).outerWidth(true));
                var ele = $(this);
                if(ele.hasClass('on')){
                    scrollLeft = scrollWidth;
                }
                scrollWidth += ele.outerWidth(true);
            });
            //隐藏两边按钮
            if($scrollNav.width() - 40 >= scrollWidth){
                $scrollNav.addClass('hideDir');

            }else{
                scrollWidth +=40;
                $scrollNav.find('.inner').width(scrollWidth);
                var myScroll = new iScroll($scrollNav[0],{
                    vScroll : false,
                    hScroll : true,
                    hScrollbar: false,
                    onBeforeScrollStart : function(e){
                        $('.sub-nav').addClass('start');
                        e.preventDefault();
                    },
                    onTouchEnd : function(){
                        $('.sub-nav').removeClass('start');
                    }
                });
                myScroll.scrollTo(-scrollLeft);
            }



        }
    }



</script>

<script src="__PUBLIC__/home/js/jquery.colorbox-min.js"></script>
<script src="__PUBLIC__/home/js/casedetail.js"></script>
</body>
</html>