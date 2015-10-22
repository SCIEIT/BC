<?php
namespace Admin\Controller;
use Think\Controller;
class ResultController extends BaseController {
    public function index(){
    	$this->initialize('结果展示');
    	$resultArr['cash']=$this->getCash();
    	$resultArr['stock']=$this->getStock();
    	$this->assign('groupresult',$resultArr);
    	$this->display();
    }
    private function getCash(){
    	return D('groups')->join('grouptoasset on groups.group_id=grouptoasset.group_id')->where(['grouptoasset.asset_id'=>1])->select();
    }
    private function getStock(){
    	$groups=D('groups')->select();
    	foreach ($groups as $key => $group) {
    		$groups[$key]['stock']=D('grouptostock')->field('stock_id,sum(num_change)')->where(['group_id'=>$group['group_id']])->group('stock_id')->select();
    	}
    	var_dump($groups);
    }
}