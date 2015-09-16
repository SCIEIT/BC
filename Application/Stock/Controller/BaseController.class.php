<?php
namespace Stock\Controller;
use Think\Controller;
class BaseController extends Controller {
	protected function initialize($title){
	    $this->assign('title',$title);
	    $this->display('./head');
	    ob_flush();
	    flush();
	}
	protected function _initialize(){
		$this->checkLoginAndRedirect();
	}
	protected function checkLoginAndRedirect(){
		if(session('user.id')&&session('group.id')){
			return true;
		}else{
			redirect(U('Home/login/index',array(
				'Action'=>ACTION_NAME,
				'Controller'=>CONTROLLER_NAME,
				'Module'=>MODULE_NAME
				)));
			return false;
		}
	}
}