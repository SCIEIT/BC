<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
    	$this->initialize(session('admin.name').' 的主页');
    	$this->assign('timetotal',10);
    	$this->assign('timeleft',10);
    	$this->assign('stockVal',$this->getStock());
        $this->assign('announcement',D('news')->where(['news_id'=>1])->getField('news_content'));
    	$this->display();
    }
    private function getStock(){
    	$stockarr['stocks']=D('stock')->select();
    	$count=0;
    	foreach ($stockarr['stocks'] as $key=>$stock) {
    		$stockarr['stocks'][$key]['trend']=D('stock_trend')->where(['stock_id'=>$stock['stock_id']])->order('time')->select();
    		if($count<=count($stockarr['stocks'][$key]['trend'])){
    			$count=count($stockarr['stocks'][$key]['trend']);
    		}
    	}
    	$stockarr['count']=$count;
    	return $stockarr;
    }
}