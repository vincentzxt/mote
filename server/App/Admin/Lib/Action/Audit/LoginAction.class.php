<?php
class LoginAction extends CommonAction {
    
	//错误日志
	public function errorlog(){
		$name = $this->getActionName();
		$model = D($name);
		$map = array();
		$map['flag'] = array('not in','0,-1');
        if (!empty($name)) {
            $this->_list($model, $map);
        }
		$this->display();
	}
	//日志标记
	public function flag(){
		
	}
}
?>