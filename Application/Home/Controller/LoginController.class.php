<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends BaseController {
    public function index(){
    	$this->initialize('Login');
    	$this->display();
    }
}