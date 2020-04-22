<?php
// 节点模型
class AccessModel extends CommonModel{
	public $_validate = array(
        array('role_id','require','角色必须'),
    );
	//读取用户权限
	function readRoleAccess($id){
		$dao = M('access');
		$map = array();
		$map['role_id'] = array('eq',$id);
		$res = $dao->where($map)->select();
        return $res;
	}
	//删除用户权限
	function delRoleAccess($groupId) {
        $table = $this->tablePrefix.'access';
        $result = $this->db->execute('delete from '.$table.' where role_id='.$groupId);
		//echo $this->db->getlastsql();
        if($result===false) {
            return false;
        }else {
            return true;
        }
    }
	//修改添加权限
	function setRoleAccess($groupId,$appIdList) {
        if(empty($appIdList)) {
            return true;
        }
        $id = implode(',',$appIdList);
		//dump($id);
        $where = 'a.id ='.$groupId.' AND b.id in('.$id.')';
        $result = $this->db->execute('INSERT INTO '.$this->tablePrefix.'access (role_id,node_id,pid,level) SELECT a.id, b.id,b.pid,b.level FROM '.$this->tablePrefix.'user_role a, '.$this->tablePrefix.'node b WHERE '.$where);
		//echo $this->db->getlastsql();
        if($result===false) {
            return false;
        }else {
            return true;
        }
    }
	
	protected function fieldFormat(&$value) {
        if(is_int($value)) {
            $value = intval($value);
        } else if(is_float($value)) {
            $value = floatval($value);
        }else if(is_string($value)) {
            $value = '"'.addslashes($value).'"';
        }
        return $value;
    }

}