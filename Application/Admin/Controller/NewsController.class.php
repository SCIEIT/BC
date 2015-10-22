<?php
namespace Admin\Controller;
use Think\Controller;
class NewsController extends BaseController {
    public function index(){
    	$this->initialize('公告修改');
    	$this->assign('news',D('news')->where(['news_id'=>1])->getField('news_content'));
    	$this->display();
    }
    public function update(){
    	if(IS_POST){
            D('news')->where(['news_id'=>1])->save(['news_content'=>I('post.content'),'news_time'=>time()]);
            $this->success('成功更新',U('news/index'),1);
        }
    }
    public function instruction(){
        if(IS_POST){
            D('news')->where(['news_id'=>2])->save(['news_content'=>I('post.content'),'news_time'=>time()]);
            $this->success('成功更新',U('news/instruction'),1);
        }else{
            $this->initialize('免责声明');
            $this->assign('news',D('news')->where(['news_id'=>2])->getField('news_content'));
            $this->display();
        }
    }
    public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }
}