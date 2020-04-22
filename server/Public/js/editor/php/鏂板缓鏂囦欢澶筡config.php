<?php
/* 该配置文件数据只作为参考，如要使用，请新建一个config.php文件，根据提示将数据修改成正确的数据
 */
require_once 'upyun.class.php';
$api_access = array(UpYun::ED_AUTO, UpYun::ED_TELECOM, UpYun::ED_CNC, UpYun::ED_CTT);
$_config = array();
//文件空间信息配置
$_config['file']['bucket'] = 'newcms';      //文件空间名
$_config['file']['user'] = 'tian6411602';           //操作员帐号
$_config['file']['pwd'] = 'nihao123';        //操作员密码
$_config['file']['dir'] = '/kindfiles/';          //存储目录，不能为空，根目录为"/"，结尾必须要加斜杆"/"，如"/kindfile/"
$_config['file']['domain'] = 'http://newcms.b0.upaiyun.com';    //云存储空间的默认域名或者绑定成功的域名，结尾不要加斜杠"/"
//图片空间信息配置
$_config['pic']['bucket'] = 'newcms';    //文件空间名
$_config['pic']['user'] = 'tian6411602';            //操作员帐号
$_config['pic']['pwd'] = 'nihao123';         //操作员密码
$_config['pic']['dir'] = '/kindimages/';            //存储目录，不能为空，根目录为"/"，结尾必须要加斜杆"/"，如"/kindpic/"
$_config['pic']['domain'] = 'http://newcms.b0.upaiyun.com';  //云存储空间的默认域名或者绑定成功的域名，结尾不要加斜杠"/"
//0为自动，1为电信，2为联通网通，3为网通铁通，推荐根据服务器网络状况，手动设置合理的接入点以获取最佳的访问速度
$_config['api_access'] = $api_access[0];