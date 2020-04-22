<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title><?php echo ($now["title"]); ?> - <?php echo ($web["webname"]); ?></title>
    <meta name="keywords" content="<?php echo ($now["title"]); ?> - <?php echo ($web["webname"]); ?>" />
    <meta name="description" content="<?php echo ($now["title"]); ?> - <?php echo ($web["webname"]); ?> - <?php echo ($web["meta"]); ?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--[if lt IE 9]>
    <script src="__PUBLIC__/home/js/html5shiv.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="__PUBLIC__/home/css/styles.css"/>
</head>

<body id="abouts" data-components="tab,acorr,linkfollower,colorbox,hashreload:#0">
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

	<section class="banner" style="background-image:url('__PUBLIC__/Data/thumbnail/share/images/default/p18c4ajds1108o1v8791ds2t0k3.jpg_2000x2000.jpg')">
	</section>
<nav class="sub-nav">
		<div class="inner">
		    <?php if(is_array($tophead)): $i = 0; $__LIST__ = $tophead;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tophead): $mod = ($i % 2 );++$i;?><a href="__ROOT__/<?php echo ($tophead["url"]); ?>" ><?php echo ($tophead["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
		</div>
	</nav>

<section class="content content-page center" id="content">
    <h1>
        <?php echo ($now["title"]); ?>
        <small><?php echo ($now["etitle"]); ?></small>
    </h1>
    <div class="toolbar">
        <form method="post">
            <div class="inner">
                <label>关键词</label>
                <input placeholder="职位搜索" name="m_title" type="text">
                <button type="submit" class="more scope-call"><i class="icon-search"></i> 职位搜索</button>
            </div>
        </form>
    </div>
    <h2 class="job-title">招聘信息</h2>
    <style>
        table.zhaopinTable td {
            padding: 10px 5px;
            text-align: center;
        }
        table.zhaopinTable td a{
            display: inline;
            text-align: center;
        }
        </style>
    <ul class="job-list shownone">
        <table style="width:100%;" class="zhaopinTable">
            <tbody>
            <tr>
                <th  width="">职位</th>
                <th class="off" width="20%">招聘人数</th>
                <th class="off" width="20%">地点</th>
                <th class="off" width="130px">招聘日期</th>
            </tr>

            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr  <?php if(($mod) == "1"): else: ?>style="background-color: rgb(240, 240, 240);"<?php endif; ?> >
                <td>
                    <a href="__ROOT__/Jobs/detail/id/<?php echo ($list["id"]); ?>" target="_blank">
                        <span class="name wrap"><?php echo ($list["title"]); ?></span>
                    </a>
                </td>
                <td class="off" width="20%"><?php echo ($list["number"]); ?></td>
                <td class="off" width="20%"><?php echo ($list["place"]); ?></td>
                <td class="off"  width="130px"><?php echo ($list["riqi"]); ?></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>
    </ul>
    <!-- 分页 start -->
    <div class="sabrosus">
        <div class="pager role-pager" data-content="#report2">
            <?php echo ($page); ?>
        </div>
    </div>
    <!-- 分页 end -->
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


	
</body>
</html>