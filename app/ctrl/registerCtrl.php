<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\captchaModel;

class registerCtrl extends \core\mypro
{

	public function index()
	//注册账号
	{
		$captcha = new captchaModel();
		
		
		if(!empty($_POST)){	
			$captcha_x = post('captcha_x');
			$captcha_y = post('captcha_y');
			if(!$captcha->check($captcha_x,$captcha_y)){
				dp("captcha error!");
			}
			$username = post('username');
			$password1 = post('password');
			$password2 = post('repeat_password');
			$mail = post('mail');
			if($password1 !== $password2){
				p('两次密码不一致');				
			}
			else if(!empty($username) && !empty($password1))
			{
				$data['username'] = $username;
				$data['password'] = $password1;
				$data['mail'] = $mail;
				$data['integral'] = 100;
				$model = new userModel();
				$res = $model->addOne($data);
				if($res){
					p("success!");
				}else{
					p("fault");
				}

			}else{
				p("username or password cant be blank!");
			}
		}else{
			$captcha->init();
			$src = $captcha->src;
			$ques = $captcha->ques;
			$this->assign('src',$src);
			$this->assign('ques',$ques);
			$this->display("register.html");
		}
		
	}
}