<?php
namespace User\Controller;
use Think\Controller;
class StockController extends BaseController {
    public function index(){
        $this->Checkexpire();
    	$this->initialize(session('group.name').'的股票');
        $this->assign('money',$this->getMoneyLeft(session('group.id')));
        $this->assign('stocks',$this->getStock());
        $this->display();
    }
    private function getStock(){
        $stockarr['stocks']=D('stock')->select();
        $count=0;
        foreach ($stockarr['stocks'] as $key=>$stock) {
            $stockarr['stocks'][$key]['trend']=D('stock_trend')->where('stock_id='.$stock['stock_id'].' and time <='.time())->order('time')->select();
            if(count($stockarr['stocks'][$key]['trend'])==0){
                unset($stockarr['stocks'][$key]['trend']);
            }else{
                $stockarr['stocks'][$key]['hold']=(int)(D('grouptostock')->where(['group_id'=>session('group.id'),'stock_id'=>$stock['stock_id']])->sum('num_change'));
                $stockarr['stocks'][$key]['current']=$this->getStockBefore($stock['stock_id'],time());
                // $time=D('stock_trend')->where('stock_id='.$stock['stock_id'].' and time <='.time())->max('time');
                // $stockarr['stocks'][$key]['current']=D('stock_trend')->where(['stock_id'=>$stock['stock_id'],'time'=>$time])->find();
                $time=$stockarr['stocks'][$key]['current']['time'];
                $stockarr['stocks'][$key]['last']=$this->getStockBefore($stock['stock_id'],$time-1);
                // $time=D('stock_trend')->where('stock_id='.$stock['stock_id'].' and time<'.$time)->max('time');
                // $stockarr['stocks'][$key]['last']=D('stock_trend')->where(['stock_id'=>$stock['stock_id'],'time'=>$time])->find();
            }
            if($count<=count($stockarr['stocks'][$key]['trend'])){
                $count=count($stockarr['stocks'][$key]['trend']);
            }
        }
        $stockarr['count']=$count;
        return $stockarr;
    }
    public function update(){
        if(IS_POST){
            $sum=(float)0;
            foreach ($_POST as $id => $change) {
                if(!empty($change)){
                    if(-(int)$change > (int)(D('grouptostock')->where(['group_id'=>session('group.id'),'stock_id'=>$id])->sum('num_change')))
                        $this->error('你当前账上的股票数量不足',U('stock/index'));
                    $sum+=(float)($this->getStockBefore($id,time())['price'])*(float)($change);
                }
            }
            if($sum>$this->getMoneyLeft(session('group.id'))){
                $this->error('你的现金不足。',U('stock/index'));
            }else{
                foreach ($_POST as $id => $change) {
                    if(!empty($change))
                        D('grouptostock')->data(['group_id'=>session('group.id'),'stock_id'=>$id,'num_change'=>(int)($change),'trend_time'=>$this->getStockBefore($id,time())['time'],'time'=>time()])->add();
                }
                $this->changeMoney(session('group.id'),-$sum);
                $this->success('操作成功。',U('stock/index'));
            }
        }
    }
}