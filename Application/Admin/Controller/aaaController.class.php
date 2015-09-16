<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
    	$this->initialize(session('admin.name').' 的主页');
    	$this->display();
    }
}