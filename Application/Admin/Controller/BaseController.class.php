<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
	protected function initialize($title){
	    $this->assign('title',$title);
	    $this->display('./head');
	    ob_flush();
	    flush();
	}
	protected function _initialize(){
		if(session('admin.id')||(CONTROLLER_NAME=='Login')){
		}else{
			redirect(U('login/index'));
		}
	}
}