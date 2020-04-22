<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title><?php echo ($now["title"]); ?> - <?php echo ($web["webname"]); ?></title>
    <meta name="keywords" content="<?php echo ($now["meta"]); ?> - <?php echo ($web["webname"]); ?>" />
    <meta name="description" content="<?php echo ($now["des"]); ?> - <?php echo ($web["webname"]); ?> - <?php echo ($web["meta"]); ?>" />
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

<section class="content content-page center" id="content">
    <form class="toolbar autofix" id="toolbar">
    <a href="javascript:" class="btn_down right">筛选</a>
    <div class="inner">
        <a class="more scope-call right" href="http://www.pblandscape.com/contacts.html"><i class="icon-call"></i> 业务联系</a>
        <label>类型</label>
        <select name="type">
            <option value="" selected="selected">不限...</option>
            <option value="住宅及商业地产项目">住宅及商业地产项目</option>
            <option value="别墅项目">别墅项目</option>
            <option value="酒店及旅游度假区项目">酒店及旅游度假区项目</option>
            <option value="市政项目">市政项目</option>
        </select>
        <label>城市</label>
        <select name="city">
            <option value="" selected="selected">不限...</option>
            <option value="北京">北京</option>
            <option value="上海">上海</option>
            <option value="天津">天津</option>
            <option value="重庆">重庆</option>
            <option value="广东广州">广东广州</option>
            <option value="广东东莞">广东东莞</option>
            <option value="广东梅州">广东梅州</option>
            <option value="广东惠州">广东惠州</option>
            <option value="广东佛山">广东佛山</option>
            <option value="广东珠海">广东珠海</option>
            <option value="广东深圳">广东深圳</option>
            <option value="广东肇庆">广东肇庆</option>
            <option value="广东阳江">广东阳江</option>
            <option value="广东云浮">广东云浮</option>
            <option value="广东清远">广东清远</option>
            <option value="广东江门">广东江门</option>
            <option value="四川成都">四川成都</option>
            <option value="海南海口">海南海口</option>
            <option value="海南澄迈">海南澄迈</option>
            <option value="海南琼海">海南琼海</option>
            <option value="海南陵水">海南陵水</option>
            <option value="海南万宁">海南万宁</option>
            <option value="安徽黄山">安徽黄山</option>
            <option value="安徽滁州">安徽滁州</option>
            <option value="福建福州">福建福州</option>
            <option value="福建泉州">福建泉州</option>
            <option value="福建厦门">福建厦门</option>
            <option value="浙江杭州">浙江杭州</option>
            <option value="江苏淮安">江苏淮安</option>
            <option value="江苏南京">江苏南京</option>
            <option value="江苏扬州">江苏扬州</option>
            <option value="江苏无锡">江苏无锡</option>
            <option value="江苏南通">江苏南通</option>
            <option value="江苏泰州">江苏泰州</option>
            <option value="江苏昆山">江苏昆山</option>
            <option value="山东济南">山东济南</option>
            <option value="山东威海">山东威海</option>
            <option value="山东烟台">山东烟台</option>
            <option value="山东青岛">山东青岛</option>
            <option value="广西南宁">广西南宁</option>
            <option value="广西柳州">广西柳州</option>
            <option value="湖北武汉">湖北武汉</option>
            <option value="陕西西安">陕西西安</option>
            <option value="河北邢台">河北邢台</option>
            <option value="河北廊坊">河北廊坊</option>
            <option value="黑龙江哈尔滨">黑龙江哈尔滨</option>
            <option value="内蒙古包头">内蒙古包头</option>
            <option value="辽宁沈阳">辽宁沈阳</option>
            <option value="江西南昌">江西南昌</option>
            <option value="河南郑州">河南郑州</option>
        </select>
        <label>风格</label>
        <select name="style">
            <option value="" selected="selected">不限...</option>
            <option value="ART DECO">ART DECO</option>
            <option value="自然生态">自然生态</option>
            <option value="东南亚">东南亚</option>
            <option value="新中式">新中式</option>
            <option value="新古典">新古典</option>
            <option value="欧式">欧式</option>
            <option value="现代">现代</option>
            <option value="日式">日式</option>
        </select>
        <label>发展商</label>
        <select name="business">
            <option value="" selected="selected">不限...</option>
            <option value="实地地产">实地地产</option>
            <option value="珠江实业集团">珠江实业集团</option>
            <option value="越秀集团">越秀集团</option>
            <option value="泰禾集团">泰禾集团</option>
            <option value="保利集团">保利集团</option>
            <option value="建华置地">建华置地</option>
            <option value="盛天集团">盛天集团</option>
            <option value="融汇集团">融汇集团</option>
            <option value="新福港集团">新福港集团</option>
            <option value="中信集团">中信集团</option>
            <option value="鲁商集团">鲁商集团</option>
            <option value="万科集团">万科集团</option>
            <option value="富力地产">富力地产</option>
            <option value="市政">市政</option>
            <option value="其他">其他</option>
            <option value="合景泰富">合景泰富</option>
            <option value="长隆集团">长隆集团</option>
            <option value="融侨地产">融侨地产</option>
            <option value="苏宁置业">苏宁置业</option>
            <option value="方圆集团">方圆集团</option>
            <option value="泰达控股">泰达控股</option>
            <option value="融晟集团">融晟集团</option>
            <option value="中建地产">中建地产</option>
            <option value="美的地产">美的地产</option>
            <option value="中信泰富">中信泰富</option>
            <option value="新长江地产">新长江地产</option>
            <option value="三正集团">三正集团</option>
            <option value="武汉天时">武汉天时</option>
            <option value="昆仑置业">昆仑置业</option>
            <option value="荣和集团">荣和集团</option>
            <option value="雅居乐集团">雅居乐集团</option>
            <option value="嘉和置业">嘉和置业</option>
            <option value="嘉业地产">嘉业地产</option>
            <option value="华策地产">华策地产</option>
            <option value="百汇地产">百汇地产</option>
            <option value="中德世纪">中德世纪</option>
            <option value="中骏置业">中骏置业</option>
            <option value="时代地产">时代地产</option>
            <option value="远洋地产">远洋地产</option>
            <option value="香格里拉酒店集团">香格里拉酒店集团</option>
            <option value="侨鑫集团">侨鑫集团</option>
            <option value="扬州天俊">扬州天俊</option>
            <option value="北京意华">北京意华</option>
            <option value="北京慧诚">北京慧诚</option>
            <option value="兆辉地产">兆辉地产</option>
            <option value="汇银地产">汇银地产</option>
            <option value="新基房产">新基房产</option>
            <option value="新鸿基地产">新鸿基地产</option>
            <option value="德盈集团">德盈集团</option>
            <option value="发能地产">发能地产</option>
            <option value="嘉裕集团">嘉裕集团</option>
            <option value="鼎峰集团">鼎峰集团</option>
            <option value="京东集团">京东集团</option>
            <option value="正荣集团">正荣集团</option>
            <option value="金通集团">金通集团</option>
            <option value="中南集团">中南集团</option>
            <option value="融信集团">融信集团</option>
            <option value="东胜集团">东胜集团</option>
            <option value="华夏幸福">华夏幸福</option>
            <option value="海南白马">海南白马</option>
        </select>
    </div>
</form>
    <ul class="caseslist role-waterfall" id="caseslist">
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><li class="column">
                <a title="<?php echo ($list["title"]); ?>" href="__ROOT__/Showcases/detail/id/<?php echo ($list["id"]); ?>" _id="<?php echo ($list["id"]); ?>">
                    <img src="<?php echo ($list["Imageurl"]); ?>" class="bg">
                    <div class="cover">
                        <div class="desc">
                            <div class="cell">
                                <img src="/<?php echo (tologo($list["linkID"])); ?>" class="logo">
                                <p class="name"><?php echo ($list["from"]); ?>-<?php echo ($list["title"]); ?></p>
                                <p>
                                    <strong><?php echo ($list["hits"]); ?></strong>平方米
                                </p>
                            </div><div class="after"></div>
                        </div>
                        <div class="title">
                            <span class="right case-to"></span>
                            <p class="name">
                                <?php echo ($list["from"]); ?>
                                <span class="unit"><?php echo ($list["hits"]); ?></span>
                            </p>
                            <p><?php echo ($list["title"]); ?></p>
                        </div>
                    </div>
                </a>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>

    <!-- 分页 start -->
    <div class="sabrosus">
        <div class="pager"><?php echo ($page); ?></div>
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