<?php
namespace Admin\Controller;
use Think\Controller;
class TestController extends BaseController {
    public function index(){
    	$this->initialize('题目列表');
    	$this->assign('questions',D('questions')->select());
    	$this->display();
    }
    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }
    public function delete(){
    	if(IS_GET){
    		if($id=I('get.questionid')){
    			$result=D('questions')->delete($id);
    			$this->ajaxReturn($result);
    		}
    	}else{
    		$this->ajaxReturn('wrong');
    		redirect(U('test/index'));
    	}
    }
    public function update(){
    	if(IS_POST){
    		if($id=I('post.question_id')){
    			D('questions')->delete($id);
    		}
    		if(D('questions')->data($_POST)->add()){
    			echo true;
    		}
    	}else{
    		$this->ajaxReturn(false);
    	}
    }
}