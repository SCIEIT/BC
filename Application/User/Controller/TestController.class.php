<?php
namespace User\Controller;
use Think\Controller;
class TestController extends BaseController {
    public function index(){
    	$this->initialize(session('group.name').'的题目');
    	$mcarr=D('questions')->where('choice_num>0')->select();
    	$sqarr=D('questions')->where(['choice_num'=>0])->select();
    	foreach ($mcarr as $key=>$mc) {
    		if(D('grouptoquestion')->where(['group_id'=>session('group.id'),'question_id'=>$mc['question_id']])->Count()==1){
    			$mcarr[$key]['question_ans']=D('grouptoquestion')->where(['group_id'=>session('group.id'),'question_id'=>$mc['question_id']])->getField('question_ans');
    		}else{
    			unset($mcarr[$key]['question_ans']);
    		}
    	}
    	foreach ($sqarr as $key=>$sq) {
    		if(D('grouptoquestion')->where(['group_id'=>session('group.id'),'question_id'=>$sq['question_id']])->Count()==1){
    			$sqarr[$key]['question_ans']=D('grouptoquestion')->where(['group_id'=>session('group.id'),'question_id'=>$sq['question_id']])->getField('question_ans');
    		}else{
    			unset($sqarr[$key]['question_ans']);
    		}
    	}
    	$this->assign('MCQ',$mcarr);
    	$this->assign('SQ',$sqarr);
    	$this->display();
    }
    public function submit(){
        $deadline=D('settings')->where(['key'=>'QuestionDeadline'])->getField('value');
        if(time()>$deadline){
            $this->error('以超过提交时间:'.date("Y年m月d日  h:ia",$deadline),U('test/index'),4);
        }
    	if(IS_POST){
    		foreach ($_POST as $question_id => $answer) {
    			if(D('grouptoquestion')->where(['group_id'=>session('group.id'),'question_id'=>$question_id])->Count()==0){
    				D('grouptoquestion')->add(['group_id'=>session('group.id'),'question_id'=>$question_id,'question_ans'=>$answer]);
    			}else{
    				D('grouptoquestion')->where(['group_id'=>session('group.id'),'question_id'=>$question_id])->save(['question_ans'=>$answer]);
    			}
    		}
    		$this->success('成功保存',U('test/index'),2);
    	}
    }
}