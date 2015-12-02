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
	protected function Checkexpire(){
		$deadline=D('settings')->where(['key'=>'Deadline'])->getField('value');
		if(time()>$deadline){
            $this->error('以超过比赛时间:'.date("Y年m月d日  h:ia",$deadline),U('index/index'),3);
        }
        if(D('grouptodistrict')->where(['group_id'=>session('group.id')])->getField('district_id')=='0'){
        	$this->error('以超过比赛时间!!!',U('index/index'),3);
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