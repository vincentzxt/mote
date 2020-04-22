<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title><?php echo ($web["webname"]); ?></title>
	<meta name="keywords" content="<?php echo ($web["meta"]); ?>" />
	<meta name="description" content="<?php echo ($web["meta"]); ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="baidu-site-verification" content="QCto7nlGwr" />
<!--[if lt IE 9]>
    <script src="__PUBLIC__/home/js/html5shiv.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="__PUBLIC__/home/css/styles.css"/>
</head>

<body  data-components="slider">

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

	
	<section class="slider" id="slider">
	<a class="slider-btn slider-prev"></a>
	<a class="slider-btn slider-next"></a>
	<ul class="slider-flow">
		<?php if(is_array($banlist)): $i = 0; $__LIST__ = $banlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$banlist): $mod = ($i % 2 );++$i;?><li _background="<?php echo ($banlist["pic"]); ?>">
			<div class="slider-area center">
								<a href=" " class="titlebox">
					<h1><?php echo ($banlist["name"]); ?></h1>
					<h2><?php echo ($banlist["title"]); ?></h2>
					<h3><?php echo ($banlist["ftitle"]); ?></h3>
					<p><?php echo ($banlist["con"]); ?></p>
				</a>
			</div>
		</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
	<div class="slider-nav"></div>
</section>

	<section class="content center">
		<div class="news-covers">
			<div class="column">
				<h2 class="news-title">
					<a class="name" href="/Showcases">精选案例 </a>
					<small class="more">SHOWCASES</small>
				</h2>
				<div class="plist">
					<div class="big">
						<a class="imagebox" href="/Showcases/detail/id/<?php echo ($alcom["id"]); ?>"><img src="<?php echo ($alcom["Imageurl"]); ?>"></a>
						<a href="/Showcases/detail/id/<?php echo ($alcom["id"]); ?>">
							<h2>
								<span href="/Showcases/detail/id/<?php echo ($alcom["id"]); ?>" class="wrap title"><?php echo ($alcom["title"]); ?></span>
								<small><?php echo ($alcom["description"]); ?></small>
							</h2>
						</a>
						<p>
							<strong><?php echo ($alcom["hits"]); ?></strong>平方米
							<i class="link-to"></i>
						</p>
					</div>
					<?php if(is_array($alnocom)): $i = 0; $__LIST__ = $alnocom;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$alnocom): $mod = ($i % 2 );++$i;?><a class="list-item" href="/Showcases/detail/id/<?php echo ($alnocom["id"]); ?>">
							<span class="right"><?php echo ($alnocom["hits"]); ?>平方米 <i class="link-to"></i></span>
							<span class="name"><?php echo ($alnocom["title"]); ?></span>
						</a><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
			<div class="column">
				<h2 class="news-title">
					<a class="name" href="/News">公司资讯</a>
					<small class="more">NEWS</small>
				</h2>
				<div class="nlist">
						<?php if(is_array($news)): $k = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$news): $mod = ($k % 2 );++$k;?><div <?php if(($k) > "2"): ?>style="display:none;"<?php endif; ?> class="adBoxs">
								<a href="/News/detail/id/<?php echo ($news["id"]); ?>" class="imagebox"><img src="/<?php echo ($news["Imageurl"]); ?>"></a>
								<div class="sep"></div>
								<a href="/News/detail/id/<?php echo ($news["id"]); ?>" style="margin-bottom:20px;">
									<small class="date"><?php echo (toDate($news["time"])); ?></small>
									<i class="link-to right"></i>
									<span class="name"><?php echo ($news["title"]); ?></span>
								</a>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
							<div class='yyy'>
								<span class="yy y1 current"></span>
								<span class="yy y2"></span>
								<span class="yy y3"></span>
							</div>
							<style>
							.yyy{height:14px;width:55px;margin:0 auto;margin-bottom:20px;}
							.yyy .y1,.yyy .y2,.yyy .y3{ display:block;width:14px;margin:0 2px;height:13px;background-color:#999;float:left;cursor:pointer; }
							.yyy .yy.current{background-color:#34BA88;}
							</style>
						<?php if(is_array($newsnopic)): $i = 0; $__LIST__ = $newsnopic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$newsnopic): $mod = ($i % 2 );++$i;?><div>
								<a href="/News/detail/id/<?php echo ($news["id"]); ?>" style="margin-bottom:16px;">
									<small class="date"><?php echo (toDate($newsnopic["time"])); ?></small>
									<i class="link-to right"></i>
									<span class="name"><?php echo ($newsnopic["title"]); ?></span>
								</a>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>


			     </div>
			</div>
			<div class="column">
				<h2 class="news-title">
					<a class="name" href="/News/projects">最新项目</a>
					<small class="more">NEW PROJECTS</small>
				</h2>
				<div class="nlist pad-bot">
						<a href="/News/detail/id/<?php echo ($xm["id"]); ?>" class="imagebox"><img src="/<?php echo ($xm["Imageurl"]); ?>"></a>
						<div class="sep"></div>
						<a href="/News/detail/id/<?php echo ($xm["id"]); ?>">
							<span class="right"><?php echo ($xm["hits"]); ?>平方米 <i class="link-to"></i></span>
							<span class="name"><?php echo ($xm["title"]); ?></span>
						</a>
				</div>
				<h2 class="news-title">
					<a class="name" href="/research/intro.html">招聘中心</a>
					<small class="more">INSTITUTE NEWS</small>
				</h2>
				<div class="nlist">
					<?php if(is_array($jobs)): $i = 0; $__LIST__ = $jobs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$jobs): $mod = ($i % 2 );++$i;?><a href="/Jobs/detail/id/<?php echo ($jobs["id"]); ?>" style="margin-bottom:34px;">
						<small class="date"></small>
						<i class="link-to right"></i>
						<span class="name"><?php echo ($jobs["title"]); ?></span>
					</a><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>
			</div>
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

	<script>
	$(function(){
		var adCurrent = 2;
		var fadeInTime = 1000;
		var settime = setInterval(runing,3000);
		var stop = false;
		//鼠标点击小图标当前位置
		$('.yyy .yy').click(function(){
			if($(this).hasClass('current'))
				return false;
			$('.yyy .yy').removeClass('current');
			$(this).addClass('current');
			local = $('.yyy .yy.current').index();
			$('.adBoxs').hide();
			$('.adBoxs').eq(adCurrent).fadeIn(fadeInTime);
			adCurrent++;
			$('.adBoxs').eq(adCurrent).fadeIn(fadeInTime);
			adCurrent++;
			if(adCurrent>=6){
				adCurrent=0;
			}
		});
		//mouseMove
		$('.yy,.nlist').hover(function(){
			stop = true
			//clearInterval(settime);
		},function(){
			stop = false;
			//settime = setInterval(runing,3000);
		});
		//runing
		function runing(){
			if(stop==true) return false;
			$('.adBoxs').hide();
			$('.adBoxs').eq(adCurrent).fadeIn(fadeInTime);
			adCurrent++;
			$('.adBoxs').eq(adCurrent).fadeIn(fadeInTime);
			adCurrent++;
			if(adCurrent>=6){
				adCurrent=0;
			}
			//小图标当前位置
			local = $('.yyy .yy.current').index();
			$('.yyy .yy').removeClass('current');
			if(local==2){
				$('.yyy .yy').eq(0).addClass('current');
			}else{
				$('.yyy .yy').eq(local+1).addClass('current');
			}
		}
	});
	</script>
</body>
</html>