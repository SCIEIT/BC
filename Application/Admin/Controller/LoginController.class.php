<?php
namespace Admin\Controller;
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
    public function index($error=null){
    	if(IS_POST){
    		if(($adminid=I('post.admin_id'))&&($password=I('post.admin_password'))){
    			$this->checkData(['admin_id'=>$adminid,'admin_password'=>$password]);
    			if(I('post.remember')=='on'){
    				cookie('adminid',$adminid,360000);
    				cookie('adminpassword',$this->encrypt($password),360000);
    			}
    			redirect(U('index/index'));
    		}else{
    			redirect(U('Login/index',['error'=>'请填写用户名和密码']));
    		}
    	}else{
    		$this->initialize('管理员登陆');
    		$this->cookieLogin();
    		$this->assign('errorMsg',$error);
    		$this->display();
    	}
    }
    private function cookieLogin(){
    	if(cookie('adminid')){
    		$adminid=cookie('adminid');
    		$password=$this->decrypt(cookie('adminpassword'));
    		$this->checkData(['admin_id'=>$adminid,'admin_password'=>$password]);
    		redirect(U('index/index'));
    	}
    }
    private function checkData($info){
    	if($userInfo=D('admins')->where($info)->find()){
    		session('admin.id',$userInfo['admin_id']);
    		session('admin.name',$userInfo['admin_name']);
    		session('admin.password',$this->encrypt($userInfo['admin_password']));
    	}else{
            cookie('adminid',null);
            cookie('adminpassword',null);
    		redirect(U('Login/index',['error'=>'用户名或密码错误']));
    	}
    }
    public function logout(){
    	session('admin.id',null);
    	session('admin.name',null);
    	session('admin.password',null);
    	setcookie("adminid", "", time()-3600);
        setcookie("adminpassword", "", time()-3600);
    	$this->success('成功登出',U('home/index/index'),3);
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