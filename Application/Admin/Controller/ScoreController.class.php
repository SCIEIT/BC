<?php
namespace Admin\Controller;
use Think\Controller;
class ScoreController extends BaseController {
    public function index($page=1){
        if(IS_POST){
            $groupid=$_POST['groupid'];
            foreach ($_POST['question'] as $id => $score) {
                D('grouptoquestion')->where(['group_id'=>$groupid,'question_id'=>$id])->setField('question_score',$score);
            }
        }
    	$this->initialize('题目批改');
        $arr=$this->new_reader($page);
        $groupid=$arr['group_id'];
        $isgroup=$arr['is_group'];
        $count=count(D('groups')->join('groupstousers on groupstousers.group_id=groups.group_id')->join('users on users.user_id=groupstousers.user_id')->join('grouptoquestion on groups.group_id=grouptoquestion.group_id')->join('questions on questions.question_id=grouptoquestion.question_id')->where('instruction_read=1 and questions.choice_num=0 and char_length(grouptoquestion.question_ans)>0')->group('groups.group_id')->select());
        $ansArr=D('grouptoquestion')->join('questions on grouptoquestion.question_id=questions.question_id')->where('questions.choice_num=0 and grouptoquestion.group_id='.$groupid)->field(['*','grouptoquestion.question_ans'])->select();
        // if(empty($ansArr)){
        //     redirect(U('score/index',['page'=>$page+1]));
        // }
        $this->assign('questions',$ansArr);
        $this->assign('groupid',$groupid);
        $this->assign('isgroup',$isgroup);
        $this->assign('page',$page);
        $this->assign('count',$count);
    	$this->display();
    }
    public function new_reader($page){
        return D('groups')->join('groupstousers on groupstousers.group_id=groups.group_id')->join('users on users.user_id=groupstousers.user_id')->join('grouptoquestion on groups.group_id=grouptoquestion.group_id')->join('questions on questions.question_id=grouptoquestion.question_id')->where('instruction_read=1 and questions.choice_num=0 and char_length(grouptoquestion.question_ans)>0')->group('groups.group_id')->page($page,1)->find();
    }
}