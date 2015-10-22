<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends BaseController {
	private $encryptionMethod = "AES-256-CBC";

	/**
	 * @var string md5 hash of the latter md5..
	 */
	private $iniVector = "182918371849181\0";
	/**
	 * @var string md5 of the string SCIEIT12345
	 */
	private $password = "73e79fb6c34a9dee4e8134dee0e8d1cb";
    public function index($Module='User',$Controller='index',$Action='index',$error=null){
    	$url=U($Module.'/'.$Controller.'/'.$Action);
        if(session('user.id')&&session('group.id')){
    		redirect($url);
    	}
    	$this->initialize('登陆');
        $this->cookieLogin($url);
        $this->assign('url',$url);
    	$this->assign('errorMsg',$error);
    	$this->display();
    }
    public function logout(){
    	session(null);
    	cookie('userMobile',null);
    	cookie('userPassword',null);
    	$this->success('成功登出',U('index/index'),3);
    }
    private function cookieLogin($url=false){
    	if(!$url){
    		$url=U('User/index/index');
    	}
    	if(cookie('userMobile')){
    		$mobile=cookie('userMobile');
    		$password=$this->decrypt(cookie('userPassword'));
    		$this->checkData(['user_mobile'=>$mobile,'user_password'=>$password]);
    		redirect($url);
    	}
    }
    private function getInfo($infoArr){
    	$userInfo=D('users')->where(['user_mobile'=>$infoArr['user_mobile'],'user_password'=>$infoArr['user_password']])->find();
    	if(empty($userInfo)){
    		return false;
    	}
    	$result=D('groupstousers')->join('groups ON groups.group_id = groupstousers.group_id')->where(['user_id'=>$userInfo['user_id']])->find();
    	return array_merge($userInfo,$result);
    }
    private function checkData($info){
    	if($userInfo=$this->getInfo($info)){
    		session('user.id',$userInfo['user_id']);
    		session('user.name',$userInfo['user_name']);
    		session('user.role',$userInfo['role']);
    		session('user.mobile',$info['user_mobile']);
    		session('user.password',$this->encrypt($info['user_password']));
    		session('group.id',$userInfo['group_id']);
    		session('group.name',$userInfo['group_name']);
    	}else{
    		cookie('userMobile',null);
    		cookie('userPassword',null);
    		redirect(U('Login/index',['error'=>'用户名或密码错误']));
    	}
    }
    public function Login(){
        $url=I('post.url');
    	if(!$url){
    		$url=U('User/index/index');
    	}
    	if(($mobile=I('post.user_mobile'))&&($password=I('post.user_password'))){
    		$this->checkData(['user_mobile'=>$mobile,'user_password'=>$password]);
    		if(I('post.remember')=='on'){
    			cookie('userMobile',$mobile,3600000);
    			cookie('userPassword',$this->encrypt($password),3600000);
    		}
            if(D('users')->where(['user_id'=>session('user.id')])->getField('instruction_read')=='0'){
                redirect(U('user/index/instruction'));
            }
    		redirect($url);
    	}else{
    		redirect(U('Login/index',['error'=>'请填写用户名和密码']));
    	}
    }
    public function encrypt($data)
    {
        return openssl_encrypt($data, $this->encryptionMethod, $this->password, false,$this->iniVector);
    }

    public function decrypt($data)
    {
        return openssl_decrypt($data, $this->encryptionMethod, $this->password,false,$this->iniVector);
    }
}