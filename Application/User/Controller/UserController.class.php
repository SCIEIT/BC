<?php
namespace User\Controller;
use Think\Controller;
class UserController extends BaseController {
    private function changePassword($where,$password){
        return D('users')->where($where)->save(['user_password'=>$password]);
    }
    private function getInfo($infoArr){
    	$userInfo=D('users')->where(['user_mobile'=>$infoArr['user_mobile'],'user_password'=>$infoArr['user_password']])->find();
    	if(empty($userInfo)){
    		return false;
    	}
    	$result=D('groupstousers')->join('groups ON groups.group_id = groupstousers.group_id')->where(['user_id'=>$userInfo['user_id']])->find();
    	return array_merge($userInfo,$result);
    }
    public function password($error=null){
        if(IS_POST){
            if($_POST['new_password_1']!=$_POST['new_password_2']){
                redirect(U('user/password',['error'=>'两次密码不一致']));
            }else if(empty($_POST['new_password_1'])||strlen($_POST['new_password_1'])<6){
                redirect(U('user/password',['error'=>'密码过短']));
            }else{
                $password=$_POST['user_password'];
                if($info=$this->getInfo(['user_mobile'=>session('user.mobile'),'user_password'=>$password])){
                    if($this->changePassword(['user_id'=>$info['user_id']],$_POST['new_password_1'])){
                        $this->success('成功更改密码，即将登出',U('home/login/logout'));
                    }else{
                        redirect(U('user/password',['error'=>'数据上传失败，请重试。']));
                    }
                }else{
                    redirect(U('user/password',['error'=>'密码错误']));
                }
            }
        }else{
            $this->initialize('更改密码');
            $this->assign('errorMsg',$error);
            $this->display();
        }
    }
}