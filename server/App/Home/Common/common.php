<?php
function toCmd($id){
    $dao = M('Cmd');
    $res = $dao->where('id ='.$id)->find();
    return $res['name'].' '.$res['command'];
}

function type_to_name($id){
    $dao = M('DiaoyongType');
    $res = $dao->where('id = '.$id)->find();
    // echo $dao->getlastsql();
    // dump($res);
    return $res['title'];
}

function tologo($logoid){
    if (!$logoid)
        return './Public/images/default_logo.png';
    if(!S('Link'.$logoid)){
        $dao = M('Link');
        $res = $dao->where('id ='.$logoid)->find();
        S('Link'.$logoid,$res['pic']);
    }
    return S('Link'.$logoid);
}

function toServer($id){
    $dao = M('Server');
    $res = $dao->where('id ='.$id)->find();
    return $res['name'];
}

function toServerGroup($gid){
    $dao = M('ServerGroup');
    $res = $dao->where('gid ='.$gid)->find();
    return toagame($res['aid']).'>>'.togameland($res['pid']).'>>'.$res['gname'];
}

//定义函数，显示格式改变，可以自定义id的值等
function sleepfun($j=3){
    for($i=1;$i<=$j;$i++){
        // echo $i;
        sleep(1);
    }
}

function toagame($id){
    $dao = M('agame');
    $res = $dao->where('id ='.$id)->find();
    //echo $dao->getlastsql();
    //dump($res);
    if($res){
        return $res['chname'].'('.$res['enname'].')';
    }else{
        return '游戏不存在';
    }
}

function togameland($id){
    $dao = M('GameLand');
    $res = $dao->where('pid ='.$id)->find();
    //echo $dao->getlastsql();
    //dump($res);
    if($res){
        return $res['chname'].'('.$res['enname'].')';
    }else{
        return '游戏平台不存在';
    }
}
function toUserAccess(){

}
function topdf($url){
    return '<a href="__ROOT__/Public/Uploads/'.$url.'" target="_blank" title="点击在线查看">[查看]'.$url.'</a>';
}
//公共函数
function toDefaultDate($time, $format = 'Y-m-d h:m:s'){
    if (empty ( $time )) {
        return '暂无';
    }
    $format = str_replace ( '#', ':', $format );
    return date ($format, $time );
}
function toDate($time, $format = 'Ymd'){
    if (empty( $time )) {
        $time = time();
    }
    $format = str_replace ( '#', ':', $format );
    return date ($format, $time );
}
function dateStr($date,$no) {
    $date = explode('-',$date);
    return $date[$no];
}
function toTimeHS($time, $format = 'h:s'){
    if (empty ( $time )) {
        return '暂无';
    }
    $format = str_replace ( '#', ':', $format );
    return date ($format, $time );
}
function tomoney($mon,$red='#F60'){
    if($mon){
        return '<span style="color: '.$red.';">￥</span>'.$mon;
    }else{
        return '-';
    }

}

//获取微吧名称
function getCategoryName($id){
    $cate = R("Info/Command/wbcategorylist",array(1));
    foreach($cate as $key => $val){
        if($val['weiba_id']==$id){
            echo $val['weiba_name'];
        }
    }
}

//获取辣妈名称
function getmaName($id){
    $cate = R("Info/Command/malist",array($id));
    //dump($cate);
    return $cate;
}

function tocategory($tid){
    if(!S('tocategory'.$tid)){
        $dao = M('category');
        $res = $dao->where('id ='.$tid)->find();
        S('tocategory'.$tid,$res['title']);
    }
    return S('tocategory'.$tid);
}

function arr_custom_to_name($arr){
    $str ='';
    $arr1 = explode(',',$arr);
    for($i=0;$i<count($arr1);$i++){
        $str .= custom_to_name($arr1[$i]).',';
    }
    return $str;
}



function tocount($arr){
    return count($arr)+1;
}

function toend($i){
    switch($i){
        case  0:
            return '否';
        case  1:
            return '是';
    }
}


function toCompany($u){
    if(!S('toCompany'.$u)){
        $dao = M('user_company');
        $res = $dao->where('status = 1 and id ='.$u)->find();
        if($res){
            $str = $res['name'];
        }else{
            $str =  '未分配';
        }
        S('toCompany'.$u,$str);
    }
    $val = S('toCompany'.$u);
    return $val;
}
function tobumen($u){
    if(!S('tobumen'.$u)){
        $dao = M('user_bumen');
        $res = $dao->where('status = 1 and id ='.$u)->find();
        if($res){
            $str = $res['name'];
        }else{
            $str = '未分配';
        }
        S('tobumen'.$u,$str);
    }
    $val = S('tobumen'.$u);
    return $val;
}
function togroup($u){
    if(!S('togroup'.$u)){
        $dao = M('user_group');
        $res = $dao->where('status = 1 and id ='.$u)->find();

        if($res){
            $str = $res['name'];
        }else{
            $str = '未分配';
        }
        S('togroup'.$u,$str);
    }
    return  S('togroup'.$u);
}

function toshow($name){
    return '<a onClick="toshow(this);">'.$name.'</a>';
}



function DataToDate($time) {
    return substr($time, 0, 10);
}
function toimage($s){
    return '<img src="/'.$s.'" width="100" height="50">';
}
function toUser($u){
    if(!S('toUser'.$u)){
        $dao = M('user');
        $res = $dao->where('status = 1 and id ='.$u)->find();
        if($res){
            $str = $res['account'];
        }else{
            $str = '游客';
        }
        S('toUser'.$u,$str);
    }
    return  S('toUser'.$u);
}



//获取签单日期
function getqdriqi(){
    //$dao = M('');
    return '暂无';
}




function getusername($u){
    $dao = M('user');
    $fl = strpos($u,',');
    if($fl){
        $arr = explode(',',$u);
        $resarr = '';
        for($i=0;$i<count($arr);$i++){
            $res = $dao->where('id = '.$arr[$i])->find();
            if($i>0){
                $resarr .= ','.$res['username'];
            }else{
                $resarr .= $res['username'];
            }
        }
        return $resarr;
    }else{
        $res = $dao->where('id = '.$u)->find();
        if($res){
            return $res['username'];
        }else{
            return '无-'.$u;
        }
    }
}



function toDataGroup($u){
    $dao = M('data_group');
    $res = $dao->where('id = '.$u)->find();
    if($res){
        return $res['name'];
    }else{
        return '未知权限';
    }
}
function toflag($a){
    //登录日志错误类型：1 账号错误  2 密码错误  3 验证码错误  4 帐号不存在或已禁  0 登录成功 -1 安全退出
    if($a==1){
        return '<font color="red">账号错误</font>';
    }
    if($a==2){
        return '<font color="red">密码错误</font>';
    }
    if($a==3){
        return '<font color="red">验证码错误</font>';
    }
    if($a==4){
        return '<font color="red">帐号不存在或已禁</font>';
    }
    if($a==0){
        return '<font color="green">登录成功</font>';
    }
    if($a==-1){
        return '安全退出';
    }
}

//返回为数组
function strToArray($str){
    $arr = split(',',$str);
    if(count($arr)==1){
        $array[0] = $arr[0];
    }else{
        for($i=0;$i<count($arr)-1;$i++){
            $array[$i]=$arr[$i];
        }
    }
    return $array;
}

//获取文章tid 对应的name
function getname($id){
    if(!S('getname'.$id)){
        $dao = M('category');
        $res = $dao->where('id = '.$id)->find();
        S('getname'.$id,$res['title']);
    }
    return S('getname'.$id);
}
function getGameStatus($status, $imageShow = false) {
    switch ($status) {
        case 0 :
            $showText = '<font color="#FF0000">停服</font>';
            $showImg = '<IMG SRC="__PUBLIC__/images/locked.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="禁用">';
            break;
        case 2 :
            $showText = '<font color="#FFFF00">维护</font>';
            $showImg = '<IMG SRC="__PUBLIC__/images/prected.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="待审">';
            break;
        case - 1 :
            $showText = '删除';
            $showImg = '<IMG SRC="__PUBLIC__/images/del.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="删除">';
            break;
        case 1 :
        default :
            $showText = '<font color="green">正常开服</font>';
            $showImg = '<IMG SRC="__PUBLIC__/images/ok.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="正常">';

    }
    return ($imageShow === true) ?  $showImg  : $showText;
}


function getStatus($status, $imageShow = true) {
    switch ($status) {
        case 0 :
            $showText = '禁用';
            $showImg = '<IMG SRC="__PUBLIC__/images/locked.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="禁用">';
            break;
        case 2 :
            $showText = '待审';
            $showImg = '<IMG SRC="__PUBLIC__/images/prected.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="待审">';
            break;
        case - 1 :
            $showText = '删除';
            $showImg = '<IMG SRC="__PUBLIC__/images/del.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="删除">';
            break;
        case 1 :
        default :
            $showText = '正常';
            $showImg = '<IMG SRC="__PUBLIC__/images/ok.gif" WIDTH="20" HEIGHT="20" BORDER="0" ALT="正常">';

    }
    return ($imageShow === true) ?  $showImg  : $showText;
}
function ugroupishave($i){
    if($i==0){
        return '未分类';
    }else{
        $dao = M('user_group');
        $res = $dao->where('status = 1 and id ='.$i)->find();
        if($res){
            return $res['name'];
        }else{
            return '已删除';
        }
    }
}

//根据类型id获取类型名字
function role_to_name($id){
    if(!S('role_to_name'.$id)){
        $dao = M('user_role');
        $res = $dao->where('id = '.$id)->find();
        S('role_to_name'.$id,$res['name']);
    }
    return	S('role_to_name'.$id);
}

//根据类型id获取类型名字
function customgroupid_to_name($id){
    if(!S('customgroupid_to_name'.$id)){
        $dao = M('customgroup');
        $res = $dao->where('typeid = '.$id)->find();
        S('customgroupid_to_name'.$id,$res['name']);
    }
    return	S('customgroupid_to_name'.$id);
}
//根据id获取类型名字
function custom_to_name($id){
    if(!S('custom_to_name'.$id)){
        $dao = M('custom');
        $res = $dao->where('Id = '.$id)->find();
        S('custom_to_name'.$id,$res['Name']);
    }
    return	S('custom_to_name'.$id);
}
//根据类型id获取类型名字
function dh_to_name($id){
    if(!S('dh_to_name'.$id)){
        $dao = M('data_authority');
        $res = $dao->where('id = '.$id)->find();
        S('dh_to_name'.$id,$res['title']);
    }
    return	S('dh_to_name'.$id);
}

function toShopCategory($id){
    $dao = M('ShopCategory');
    $map = array();
    $map['id'] = array('eq',$id);
    $rs = $dao->where($map)->find();
    //echo $dao->getlastsql();
    return $rs['title'];
}

function dh_to_title($url){
    $dao = M('data_authority');
    $map = array();
    $map['url'] = array('EXP', 'REGEXP \''.$url.'\'');
    $rs = $dao->where($map)->find();
    //echo $dao->getlastsql();
    return $rs['title'];
}

//加载列表显示菜单选项
function listcustom($id){
    if($id){
        if(S('listcustom'.$id)){
            $res = S('listcustom'.$id);
        }else{
            $dao = M("custom");
            $res = $dao->where("type = ".$id)->order('Priority desc')->select();
            echo $dao->getLastSql();
            S('listcustom'.$id,$res);
        }
    }else{
        if(S('listcustom')){
            $res = S('listcustom');
        }else{
            $dao = M("custom");
            $res = $dao->order('Priority desc')->select();
            S('listcustom',$res);
        }
    }
    return $res;
}


//菜单列表筛选
function ctllistmenu($id){
    if(S('listcustom')){
        $array = S('listcustom');
        for($i=0;$i<count($array);$i++){
            if($array[$i]['type']==$id){
                $arr[]=$array[$i];
            }
        }
        if($arr==NULL){
            $arr=listcustom($id);
        }
        return $arr;
    }else{
        listcustom();
    }
}


function uroleishave($i){
    if($i==0){
        return '未支配权限';
    }else{
        $dao = M('user_role');
        $res = $dao->where('status = 1 and id ='.$i)->find();
        if($res){
            //调用出权限用户组
            $gdao = M('user_group');
            $gres = $gdao->where('id ='.$res['pid'])->find();
            return '<b style="color:green;">组</b>：<b style="color:#000000">'.$gres['name'].'</b>&nbsp;&nbsp;/&nbsp;&nbsp;<b style="color:green;">职位</b>：<b style="color:blue">'.$res['name'].'</b>';
        }else{
            return '已删除';
        }
    }
}

function toUserGroup($r){
    if(!S('gres'.$r)){
        $gdao = M('user_group');
        $gres = $gdao->where('id ='.$r)->find();
        S('gres'.$r,$gres['name']);
    }
    $val =  S('gres'.$r);
    return $val;
}

function nodename($i){
    if($i==0){
        return '未分类';
    }else{
        if(!S('nodename'.$i)){
            $dao = M('node');
            $res = $dao->where('status = 1 and id ='.$i)->find();
            if($res){
                $val = $res['title'];
            }else{
                $val = '已删除';
            }
            S('nodename'.$i,$val);
        }
        $val = S('nodename'.$i);
        return $val;
    }
}
//知识库和专家团推荐
function showStatus($id,$name){
    $dao = M($name);
    $res = $dao->where('id ='.$id)->find();
    if($res['sy_command']==1){//1
        return '<a href="javascript:command('.$id.',0)">取消首页推荐</A>';
    }else if($res['sy_command']==0){//0
        return '<a href="javascript:command('.$id.',1)">推荐到首页</A>';
    }else{
        return '';
    }

}
//推荐首页大图
function apicommand_big($id,$val){
    //dump($id);
    //dump($val);
    if($val==0){
        return '<a href="javascript:command('.$id.',1)">推荐到首页大图</A>';
    }else{
        return '<a href="javascript:command('.$id.',0)">取消首页大图推荐</A>';
    }
}
//推荐首页列表图
function apicommand_list($id,$val){
    //dump($id);
    //dump($val);
    if($val==0){
        return '<a href="javascript:lcommand('.$id.',1)">推荐首页列表</A>';
    }else{
        return '<a href="javascript:lcommand('.$id.',0)">取消首页列表推荐</A>';
    }
}

//推荐首页聪妈
function apicommand_ma($id,$val){
    //dump($id);
    //dump($val);
    if($val==0){
        return '<a href="javascript:command('.$id.',1)">推荐聪妈</A>';
    }else{
        return '<a href="javascript:command('.$id.',0)">取消推荐聪妈</A>';
    }
}
//推荐贴吧到首页


function apicommand_wb($id,$val){
    //dump($val);
    if($val==0){
        return '<a href="javascript:command('.$id.',1)">首页推荐</A>';
    }else{
        return '<a href="javascript:command('.$id.',0)">取消首页推荐</A>';
    }
}




function mb_unserialize($serial_str) {
    $out = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $serial_str );
    return unserialize($out);
}


//操作控制函数 序列化函数
function sendjson($arr){
    return json_encode($arr);
}

/**
 * 系统邮件发送函数
 * @param string $to    接收邮件者邮箱
 * @param string $name  接收邮件者名称
 * @param string $subject 邮件主题
 * @param string $body    邮件内容
 * @param string $attachment 附件列表
 * @return boolean
 */
function think_send_mail($to, $name, $subject = '', $body = '', $attachment = null){
    $config = C('THINK_EMAIL');
    vendor('PHPMailer.class#phpmailer'); //从PHPMailer目录导class.phpmailer.php类文件
    $mail             = new PHPMailer(); //PHPMailer对象
    $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP();  // 设定使用SMTP服务
    $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
    $mail->SMTPSecure = 'ssl';                 // 使用安全协议
    $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
    $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
    $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
    $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
    $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
    $replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
    $replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
    $mail->AddReplyTo($replyEmail, $replyName);
    $mail->Subject    = $subject;
    $mail->MsgHTML($body);
    $mail->AddAddress($to, $name);
    if(is_array($attachment)){ // 添加附件
        foreach ($attachment as $file){
            is_file($file) && $mail->AddAttachment($file);
        }
    }
    return $mail->Send() ? true : $mail->ErrorInfo;
}
//权限管理显示函数
function ab_is_ab($atr){
    $ab = preg_replace("/-*/i",'', $atr);

    switch($ab){
        case'add': return preg_replace('/'.$ab.'/','添加', $atr);
        case'del': return preg_replace('/'.$ab.'/','删除', $atr);
        case'edit': return preg_replace('/'.$ab.'/','修改', $atr);
        case'index':return preg_replace('/'.$ab.'/','默认index', $atr);
        case'insert': return preg_replace('/'.$ab.'/','执行添加', $atr);
        case'update': return preg_replace('/'.$ab.'/','执行修改', $atr);
        case'addmuch':return preg_replace('/'.$ab.'/','批量添加', $atr);
        default: return $atr;
    }
}
//定义函数，显示格式改变，可以自定义id的值等
function chg_role_input($i,$id){
    return $i."<input type='hidden' name='".$id."' value='".$i."'/>";
}
function chg_role_input_date($i,$id){
    return toDate($i)."<input type='hidden' name='".$id."' value='".toDate($i)."'/>";
}
function chg_role_input_fz($i,$id){
    $j = custom_to_name($i);
    return $j."<input type='hidden' name='".$id."' value='".$j."'/>";
}

function create_folders($dir){
    return is_dir($dir) or (create_folders(dirname($dir)) and mkdir($dir, 0777));
}

//判断是数组层级
function arrayLevel($arr){
    $al = array(0);
    function aL($arr,&$al,$level=0){
        if(is_array($arr)){
            $level++;
            $al[] = $level;
            foreach($arr as $v){
                aL($v,$al,$level);
            }
        }
    }
    aL($arr,$al);
    return max($al);
}

//订单序列
function DingdanXulie($g){
    return date('Ymd').$g;
}

//二维数组去掉重复值
function assoc_unique($arr, $key)
{
    $rAr=array();
    for($i=0;$i<count($arr);$i++)
    {

        if(!isset($rAr[$arr[$i][$key]]))
        {
            $rAr[]=$arr[$i][$key];
        }
    }

    $arr=array_unique($rAr);
    array_multisort($arr);
    return $arr;
}

function deletehtml($str){
    $str = trim($str);
    $str=strip_tags($str,"");
    $str=preg_replace("{\t}","",$str);
    $str=preg_replace("{\r\n}","",$str);
    $str=preg_replace("{\r}","",$str);
    $str=preg_replace("{\n}","",$str);
    $str=preg_replace("{ }","",$str);
    $str=str_replace( "&nbsp;","",$str);

    return cut_str($str,50);
}

//去除样式  html 代码 转为 文本
function noHTML($content)
{
    $content = preg_replace("/<font[^>]*>/i",'', $content);
    $content = preg_replace("/<\/font>/i",'', $content);
    $content = preg_replace("/<span[^>]*>/i",'', $content);
    $content = preg_replace("/<\/span>/i",'', $content);
    $content = preg_replace("/<a[^>]*>/i",'', $content);
    $content = preg_replace("/<\/a>/i",'', $content);
    $content = preg_replace("/<img[^>]*>/i",'', $content);
    $content = preg_replace("/<p[^>]*>/i",'', $content);
    $content = preg_replace("/<\/p>/i",'', $content);
    $content = preg_replace("/style=.+?['|\"]/i",'',$content);//去除样式
    $content = preg_replace("/class=.+?['|\"]/i",'',$content);//去除样式
    $content=str_replace("&nbsp;","",$content);
    $content=str_replace(" ","",$content);
    $content = preg_replace("/<br[^>]*>/i",'', $content);
    $content= preg_replace("/\s(?=\s)/","\\1",$content);
    $content=preg_replace("{\t}","",$content);
    $content=preg_replace("{\r\n}","",$content);
    $content=preg_replace("{\r}","",$content);
    $content=preg_replace("{\n}","",$content);
    $content=preg_replace("{ }","",$content);
    $content = strip_tags($content);
    $content= preg_match_all('/[\x{4e00}-\x{9fff}]+/u', $content, $matches);
    $content = join('', $matches[0]);
    return $content;
}

//数组转换

function ArrayToList($array){
    $newarray = array();
    foreach($array as $key=>$value){
        for($j=0;$j<count($value);$j++){
            $newarray[$j][$key] = $array[$key][$j];
        }
    }
    return $newarray;
}

//判断多维数组是否存在某个值
function deep_in_array($value, $array) {
    foreach($array as $item) {
        if(!is_array($item)) {
            if ($item == $value) {
                return $item;
            } else {
                continue;
            }
        }

        if(in_array($value, $item)) {
            return $item;
        } else if(deep_in_array($value, $item)) {
            return $item;
        }
    }
    return false;
}

function recursive_keys($foo, $arr, $a = -1, $temp = array()){
    global $bar;
    $a++;
    foreach($arr as $k => $v){
        $temp[$a] = $k;
        if(is_array($v)){
            recursive_keys($foo, $v, $a, $temp);
        }elseif($v === $foo){
            $bar[] = $temp;
        }
    }
    return $bar;
}


//获取参数的前多少位 $arr 字符串 注意：只能使用字符串
function cut_str($string,$sublen,$start = 0,$code = 'UTF-8')
{
    //$string = noHTML($string);
    if($code == 'UTF-8')
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);
        $num=0;
        $yu='';
        for($i=0;$i<count($t_string[0]);$i++,$subend=$i){
            if($num<=$start){
                $substart = $num;
            }
            if(eregi("^([\x80-\xff])+$",$t_string[0][$i])){
                $num += 2;
            }else{
                $num += 1;
            }
            if($num >$sublen){
                $subend = $i;
                if((count($t_string[0])) > $i){
                    $yu = '..';
                    //$yu = '';
                }
                break;
            }
        }
        return join('',array_slice($t_string[0],$substart,$subend)) . $yu ;
    }else{
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';
        for($i=0; $i< $strlen; $i++)
        {
            if($i>=$start && $i< ($start+$sublen)){
                if(ord(substr($string, $i, 1))>129){
                    $tmpstr.= substr($string, $i, 2);
                }else{
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        // if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";


        return $tmpstr;
    }
}


?>