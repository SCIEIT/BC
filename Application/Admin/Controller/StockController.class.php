<?php
namespace Admin\Controller;
use Think\Controller;
class StockController extends BaseController {
    public function index($page=1){
    	$this->initialize('股票首页');
    	$stockarr=D('stock')->page($page,'3')->select();
        if(count($stockarr)<3){
            $this->assign('pageMax',true);
        }
    	foreach ($stockarr as $key=>$stock) {
    		$stockarr[$key]['trend']=D('stock_trend')->where(['stock_id'=>$stock['stock_id']])->order('time')->select();
    	}
        $this->assign('page',$page);
    	$this->assign('stocks',$stockarr);
    	$this->display();
    }
    public function update(){
    	if(IS_POST){
    		foreach ($_POST as $id=>$stock) {
    			D('stock')->where(['stock_id'=>$id])->save(['stock_name'=>$stock['name'],'stock_bg'=>$stock['bg']]);
    			D('stock_trend')->where(['stock_id'=>$id])->delete();
    			foreach ($stock['trend'] as $year) {
    				$date=strtotime($year['time'].' '.$year['date']);
    				D('stock_trend')->add(['stock_id'=>$id,'time'=>$date,'price'=>$year['price'],'news'=>$year['news']]);
    			}
    		}
    		$this->success('更新成功',U('stock/index'),1);
    	}
    }
    public function delete($id,$time=null){
    	if(IS_GET){
    		if(isset($time)){
    			D('stock_trend')->where(['stock_id'=>$id,'time'=>$time])->delete();
    		}else{
    			D('stock')->where(['stock_id'=>$id])->delete();
    			D('stock_trend')->where(['stock_id'=>$id])->delete();
    		}
    		$this->success('删除成功',U('stock/index'),1);
    	}
    }
    public function add($id=null){
    	if(IS_GET){
    		if(!empty($id)){
    			D('stock_trend')->add(['stock_id'=>$id,'time'=>'0000000000','price'=>0,'news'=>'新建新闻']);
    		}else{
    			D('stock')->add(['stock_name'=>'新建股票','stock_bg'=>'empty']);
    		}
    		$this->success('添加成功',U('stock/index'),1);
    	}
    }
}