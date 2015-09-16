<?php
namespace Admin\Controller;
use Think\Controller;
class TestController extends BaseController {
    public function index(){
    	$this->initialize('题目列表');
    	$this->display();
    }
}