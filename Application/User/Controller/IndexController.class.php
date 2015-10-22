<?php
namespace User\Controller;
use Think\Controller;
class IndexController extends BaseController {
    public function index(){
    	$this->initialize(session('group.name').'的主页');
    	$this->assign('qp',$this->getProgress());
    	$this->assign('announcement',D('news')->where(['news_id'=>1])->getField('news_content'));
    	$this->assign('stockVal',$this->getStock());
        $this->assign('money',$this->getMoneyLeft(session('group.id')));
        $this->assign('stock',$this->getGroupStock(session('group.id')));
        $this->assign('initcapital',D('settings')->where(['key'=>'InitCapital'])->getField('value'));
    	$this->display();
    }
    private function getProgress(){
    	$result['mc']=D('grouptoquestion')->join('questions on questions.question_id=grouptoquestion.question_id')->where('group_id='.session('group.id').' and questions.choice_num>0')->count('grouptoquestion.question_ans');
    	$result['mctot']=D('questions')->where('choice_num>0')->count('question_id');
    	$result['tot']=D('questions')->count('question_id');
    	$result['gtot']=D('grouptoquestion')->count('question_id');
    	$result['time']=time();
    	$result['deadline']=D('settings')->where(['key'=>'QuestionDeadline'])->getField('value');
    	return $result;
    }
    private function getStock(){
    	$stockarr['stocks']=D('stock')->select();
    	$count=0;
    	foreach ($stockarr['stocks'] as $key=>$stock) {
    		$stockarr['stocks'][$key]['trend']=D('stock_trend')->where('stock_id='.$stock['stock_id'].' and time <='.time())->order('time')->select();
    		if(count($stockarr['stocks'][$key]['trend'])==0){
    			unset($stockarr['stocks'][$key]['trend']);
    		}else{
    			$time=D('stock_trend')->where('stock_id='.$stock['stock_id'].' and time <='.time())->max('time');
    			$stockarr['stocks'][$key]['current']=D('stock_trend')->where(['stock_id'=>$stock['stock_id'],'time'=>$time])->find();
    			$time=D('stock_trend')->where('stock_id='.$stock['stock_id'].' and time<'.$time)->max('time');
    			$stockarr['stocks'][$key]['last']=D('stock_trend')->where(['stock_id'=>$stock['stock_id'],'time'=>$time])->find();
    		}
    		if($count<=count($stockarr['stocks'][$key]['trend'])){
    			$count=count($stockarr['stocks'][$key]['trend']);
    		}
    	}
    	$stockarr['count']=$count;
    	return $stockarr;
    }
    public function instruction(){
        if(IS_POST){
            if($_POST['agree']==false){
                redirect(U('home/login/logout'));
            }else{
                D('users')->where(['user_id'=>session('user.id')])->data(['instruction_read'=>'1'])->save();
                redirect(U('index/index'));
            }
        }else{
            $this->initialize('免责申明');
            $this->assign('content',D('news')->find('2'));
            $this->display();
        }
    }
}