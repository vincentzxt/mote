<?php
return array(
	//'配置项'=>'配置值'

    'APP_STATUS' => 'debug', //应用调试模式状态
    'SHOW_PAGE_TRACE' =>false, // 显示页面Trace信息
    'URL_MODEL'                 =>  2, // 如果你的环境不支持PATHINFO 请设置为3
    'DB_TYPE'                   =>  'mysql',
    'DB_HOST'                   =>  'localhost',
    'DB_NAME'                   =>  'mote',
    'DB_USER'                   =>  'root',
    'DB_PWD'                    =>  'nihao123',
    'DB_PORT'                   =>  '3306',
    'DB_PREFIX'                 =>  'think_',
    'HTML_CACHE_ON'=>false, // 开启静态缓存
    'HTML_FILE_SUFFIX'  =>  '.html', // 设置静态缓存后缀为.shtml
    'HTML_CACHE_RULES'=> array(
        '*'=>array('{$_SERVER.REQUEST_URI|md5}'),
    ),


);
?>
