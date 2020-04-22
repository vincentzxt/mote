<?php
return array(
	//'配置项'=>'配置值'
	'weburl'                   =>'/newcms/',// 根目录就为/
	'APP_STATUS' => 'debug', //应用调试模式状态
	'SHOW_PAGE_TRACE' =>false, // 显示页面Trace信息
	'URL_MODEL'                 =>  3, // 如果你的环境不支持PATHINFO 请设置为3
    'DB_TYPE'                   =>  'mysql',
    'DB_HOST'                   =>  'localhost',
    'DB_NAME'                   =>  'mote',
    'DB_USER'                   =>  'root',
    'DB_PWD'                    =>  'nihao123',
    'DB_PORT'                   =>  '3306',
    'DB_PREFIX'                 =>  'think_',
    'APP_AUTOLOAD_PATH'         =>  '@.TagLib',
	'TITLE'                     =>  '内容发布管理后台',
    'SESSION_AUTO_START'        =>  true,
   	//权限管理
    'USER_AUTH_ON'              =>  true,
    'USER_AUTH_TYPE'			=>  1,		// 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'             =>  'authId',	// 用户认证SESSION标记
    'ADMIN_AUTH_KEY'			=>  'administrator',
    'USER_AUTH_MODEL'           =>  'User',	// 默认验证数据表模型
    'AUTH_PWD_ENCODER'          =>  'md5',	// 用户认证密码加密方式
    'USER_AUTH_GATEWAY'         =>  '/Login/',// 默认认证网关

  //  'NOT_AUTH_MODULE'           =>  'Login,Index,Articles,Onepage,Category,Node,UserCompany,UserBumen,Customgroup,UserGroup,UserRole,User,UAct,BasicData,DataAuthority,Custom,DataGroup,Ajax,Experts,Banner,Link,Command,Wendang,Agame,GameLand,Server,ServerGroup,Cmd,Pet,Shop,ShopCategory,MailRelease,ResourceRelease,Gift,Select,Notice,Activity,ActivityConfig,CustomPage,SysInfo,DiaoyongType,Diaoyong,Zhuanjia,Faq,JobType,Jobs',
    'NOT_AUTH_MODULE'           =>  'Login,Index',


    'REQUIRE_AUTH_MODULE'       =>  '',		// 默认需要认证模块
    'GUEST_AUTH_ON'             =>  true,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'             =>  0,        // 游客的用户ID
	
	'HWXH'  =>'YDHWXH',
	
	'DB_LIKE_FIELDS'            =>  'title|remark',
    'RBAC_ROLE_TABLE'           =>  'think_user_role', 
    'RBAC_USER_TABLE'           =>  'think_user',
    'RBAC_ACCESS_TABLE'         =>  'think_access',
    'RBAC_NODE_TABLE'           =>  'think_node',
	//'RBAC_ERROR_PAGE'           =>  '/Index/Index/error',

	
	//审计管理
	'LOG_LOGIN_TABLE'         =>  'think_login_log',
    'LOG_ACTION_TABLE'           =>  'think_actions_log',
	
    //分组
	'APP_GROUP_LIST'=>'Login,Su,Info,Index,Sys,Permission,Audit,Data,Info,Game',
	'DEFAULT_GROUP'=>'Login',
	'TOKEN_ON'=>false,  // 是否开启令牌验证
	'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
	'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
	'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true
	
	'LOG_RECORD' => true, // 开启日志记录
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错



);
?>
