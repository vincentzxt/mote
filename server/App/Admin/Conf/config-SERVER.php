<?php
return array(
	//'配置项'=>'配置值'
	'weburl'                   =>'/',// 根目录就为/
	'APP_STATUS' => 'debug', //应用调试模式状态
	//'SHOW_PAGE_TRACE' =>true, // 显示页面Trace信息
	//'URL_MODEL'                 =>  3, // 如果你的环境不支持PATHINFO 请设置为3
    'DB_TYPE'                   =>  'mysql',
    'DB_HOST'                   =>  '127.0.0.1',
    'DB_NAME'                   =>  'wuliu',
    'DB_USER'                   =>  'root',
    'DB_PWD'                    =>  'tian6411602',
    'DB_PORT'                   =>  '3306',
    'DB_PREFIX'                 =>  'think_',
    'APP_AUTOLOAD_PATH'         =>  '@.TagLib',
	'TITLE'                     =>  'BI后台',
    'SESSION_AUTO_START'        =>  true,
   	//权限管理
    'USER_AUTH_ON'              =>  true,
    'USER_AUTH_TYPE'			=>  2,		// 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY'             =>  'authId',	// 用户认证SESSION标记
    'ADMIN_AUTH_KEY'			=>  'administrator',
    'USER_AUTH_MODEL'           =>  'User',	// 默认验证数据表模型
    'AUTH_PWD_ENCODER'          =>  'md5',	// 用户认证密码加密方式
    'USER_AUTH_GATEWAY'         =>  '/Login/',// 默认认证网关



    'NOT_AUTH_MODULE'           =>  'Login,Index,Articles,Onepage,Category,Node,Customgroup,UserGroup,UserRole,User,UAct,BasicData,DataAuthority,Custom,DataGroup,KPI,KHGY,Khgy_kh,Kf_ddqr,CaiWu,XingZheng,YingXiao,ZongHe,Khgy_gys_fw,Khgy_gys_cp,Khgy_gys_bc,Khgy_gys_cys,Kf_fhdj,Yy_thgc_clfydj,Yy_fyjd_ddgl,Yy_fyjd_rk,Yy_fyjd_zc,Yy_fyjd_cyd,Yy_fyjd_dz,Yy_fyjd_pscl,Yy_fyjd_qdfh,Yy_yccl,Yy_Thgc_clfydj,Workflow_type,Workflow_process,Workflow_tpl,UserCompany,UserBumen,Fpgl,Zpgl,Kaihuhang,Wangdian,Yinhangka,Workflow_html,Yhz_lt,Yhz_xg,Yhz_cxkz,Fbbyj,Fgsbyj,Yfk_dkhk,Wzzc_xhpzc,Wzzc_gdzc,Ysk_yuejie,Ysk_lsqk,Ysk_jck,Yfk_yuejie,Yfk_hetongkuan,Articles,Yy_fyjd_ddcx,Yhz,Hz,Ydhz,Fybx,Beiyongjin,Wbxzfk,Xj_lsqk,Ddyfjkb,Fgsyfjkb,Yewu,Peizhi',	
	// 默认无需认证模块
   //  'NOT_AUTH_MODULE'           =>  'Category,Login,Index,CaiWu,Workflow_type,Workflow_process,Workflow_tpl,Fpgl,Zpgl,Workflow_html,Yhz_lt,Yhz_xg,Yhz_cxkz,Fbbyj,Fgsbyj,Yfk_dkhk,Wzzc_xhpzc,Wzzc_gdzc,Ysk_yuejie,Ysk_lsqk,Ysk_jck,Yfk_yuejie,Yfk_hetongkuan,Yhz,Hz,Ydhz,Fybx',


    'REQUIRE_AUTH_MODULE'       =>  '',		// 默认需要认证模块
    'GUEST_AUTH_ON'             =>  true,    // 是否开启游客授权访问
    'GUEST_AUTH_ID'             =>  0,        // 游客的用户ID
	
	'HWXH'  =>'YDHWXH',
	
	'DB_LIKE_FIELDS'            =>  'title|remark',
    'RBAC_ROLE_TABLE'           =>  'think_user_role', 
    'RBAC_USER_TABLE'           =>  'think_user',
    'RBAC_ACCESS_TABLE'         =>  'think_access',
    'RBAC_NODE_TABLE'           =>  'think_node',
	'RBAC_ERROR_PAGE'           =>  '/Index/Index/error',

	
	//审计管理
	'LOG_LOGIN_TABLE'         =>  'think_login_log',
    'LOG_ACTION_TABLE'           =>  'think_actions_log',
	
    //分组
	'APP_GROUP_LIST'=>'Login,Su,Info,Index,Sys,Permission,Audit,Data,Info,Workflow,Caiwu,Ticheng',
	'DEFAULT_GROUP'=>'Login',
	'TOKEN_ON'=>false,  // 是否开启令牌验证
	'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
	'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
	'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true
	
	'LOG_RECORD' => true, // 开启日志记录
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR', // 只记录EMERG ALERT CRIT ERR 错

	'TMPL_PARSE_STRING'  =>array(
       '__PUBLIC__' => 'http://public.shifeinet.com/Public/', // 更改默认的__PUBLIC__ 替换规则
	 )

);
?>