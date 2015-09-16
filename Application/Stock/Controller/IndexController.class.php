<?php
namespace Stock\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
    	$this->initialize('股票首页');
       	// $this->display();
    }
}