<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Upload as Upload;
class UserController extends BaseController {
    public function usrlist(){
        var_dump(strtotime('2015-10-25 24:00'));
        var_dump(Date('y-m-d H:i',strtotime('2015-10-25 24:00')));
        $this->initialize('选手管理');
        $resultarr=D('groups')->select();
        foreach ($resultarr as $key => $group) {
            $resultarr[$key]['member']=D('users')->join('groupstousers on groupstousers.user_id=users.user_id')->where(['groupstousers.group_id'=>$group['group_id']])->select();
        }
        var_dump($resultarr);
        $this->assign('userlist',$resultarr);
    }
    public function upload(){
        if(!IS_POST){
            $this->initialize('名单上传');
            $this->display();
        }else{
            $upload = new Upload();// 实例化上传类
            $upload->maxSize   =     3145728;// 设置附件上传大小
            $upload->exts      =     array('xlsx','xls');// 设置附件上传类型
            $upload->rootPath  =     './Public/Upload/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $upload->saveName = '';
            $upload->autoSub = false;
            // 上传文件 
            $info   =   $upload->upload();
            $file=$info[0];
            if(!$info) {// 上传错误提示错误信息
                $this->error($upload->getError());
            }else{// 上传成功
                $this->readExcel('./Public/Upload/'.$file['savename']);
                @unlink ('./Public/Upload/'.$file['savename']);
            }
        }
    }
    public function readExcel($path){
        header("Content-type: text/html; charset=utf-8"); 
        // require(COMMON_PATH.'Extensions/PHPExcel.class.php');
        import("Org.Util.PHPExcel"); 
        import("Org.Util.PHPExcel.IOFactory.php");
        $PHPExcel = new \PHPExcel(); 
        $Excel=\PHPExcel_IOFactory::load($path);
        $Sheet=$Excel->getSheet(0);
        foreach ($Sheet->getRowIterator() as $row) {
            $arr=[];
            foreach ($row->getCellIterator() as $cell) {
                $arr[]=$cell->getValue();
            }
            preg_match("/\d{11}/", $arr[0] ,$mobile);
            $mobile=$mobile[0];
            $name=$arr[1];
            $is_group=$arr[2];
            $district=$arr[3];
            if(!empty($arr)&&!empty($arr[1])){
                if(D('users')->where(['user_mobile'=>$mobile])->count()==0){
                    $user_id=D('users')->add(['user_mobile'=>$mobile,'user_password'=>$mobile,'user_name'=>$name,'instuction_read'=>0]);
                    $group_id=D('groups')->add(['goup_name'=>'新小组','is_group'=>$is_group]);
                    D('groupstousers')->add(['user_id'=>$user_id,'group_id'=>$group_id]);
                    D('grouptoasset')->add(['group_id'=>$group_id,'asset_id'=>1,'amount'=>1000000]);
                    D('grouptodistrict')->add(['group_id'=>$group_id,'district_id'=>$district]);
                    echo '添加成功：'.$mobile.'<br/>';
                    ob_flush();
                    flush();
                }else{
                    $user_id=D('users')->where(['user_mobile'=>$mobile])->getField('user_id');
                    $group_id=D('groupstousers')->where(['user_id'=>$user_id])->getField('group_id');
                    if(D('grouptodistrict')->where(['group_id'=>$group_id,'district_id'=>$district])->count()>0){
                    }else{
                        D('grouptodistrict')->add(['group_id'=>$group_id,'district_id'=>$district]);
                    }
                    D('groups')->where(['group_id'=>$group_id])->save(['is_group'=>$is_group]);
                    echo '跳过：'.$mobile.'<br/>';
                    ob_flush();
                    flush();
                }
            }
        }
    }
}