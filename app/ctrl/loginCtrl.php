<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\captchaModel;

class loginCtrl extends \core\mypro
{

    public function index()
	{	
		if(!isset($_SESSION)){
			session_start();
		}
		if(isset($_SESSION['user'])){
			jump('/user/');
		}
		$captcha = new captchaModel();
		if(!empty($_POST)){
			$data['username'] = post('username');
			$data['password'] = post('password');
			$captcha_x = post('captcha_x');
			$captcha_y = post('captcha_y');
			if(!$captcha->check($captcha_x,$captcha_y))			{
				dp("captchar error!");
			}
			$model = new userModel();
			$res = $model->getOne($data);
			session_start();
			$_SESSION['user'] = $res; 
			jump('/user/');
			exit();
		}
		$captcha->init();
		$src = $captcha->src;
		$ques = $captcha->ques;
		$this->assign('src',$src);
		$this->assign('ques',$ques);
		$this->display('login.html');
	}


}