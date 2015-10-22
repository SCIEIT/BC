<?php
namespace User\Controller;
use Think\Controller;
class BaseController extends Controller {
	protected function initialize($title){
	    $this->assign('title',$title);
	    $this->display('./head');
	    ob_flush();
	    flush();
	}
	protected function _initialize(){
		if(session('user.id')||(CONTROLLER_NAME=='Login')){
		}else{
			redirect(U('home/login/index'));
		}
	}
	protected function getMoneyLeft($GroupID){
		return D('grouptoasset')->where(['group_id'=>$GroupID,'asset_id'=>1])->getField('amount');
	}
	protected function changeMoney($GroupID,$value){
		$current=D('grouptoasset')->where(['group_id'=>$GroupID,'asset_id'=>1])->getField('amount');
		if(D('grouptoasset')->where(['group_id'=>$GroupID,'asset_id'=>1])->save(['amount'=>($current+$value)])){
			return true;
		}else{
			return false;
		}
	}
	protected function getStockBefore($id,$time){
	    $time=D('stock_trend')->where('stock_id='.$id.' and time <='.$time)->max('time');
	    return D('stock_trend')->where(['stock_id'=>$id,'time'=>$time])->find();
	}
	protected function getGroupStock($id){
		$stocks=D('grouptostock')->where(['group_id'=>$id])->field('stock_id,sum(num_change)')->group('stock_id')->select();
		$sum=0;
		foreach ($stocks as $stock) {
			$sum+=((int)$stock['sum(num_change)'])*(int)($this->getStockBefore($stock['stock_id'],time())['price']);
		}
	    return $sum;
	}
}