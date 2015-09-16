<?php
namespace Admin\Controller;
use Think\Controller;
class StockController extends BaseController {
    public function index(){
    	$this->initialize('股票首页');
    }
}