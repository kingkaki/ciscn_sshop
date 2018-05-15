<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\captchaModel;


class userCtrl extends \core\mypro
{
   	public function index()
	//个人信息页面
	{
		if(!loggedin()){
			jump('/user/login/');
		}else{
			$user = $_SESSION['user'];
			$this->assign('user',$user);
			$this->display('user.html');
		}
		
	}
	
	public function test()
	{
		$captcha = new captchaModel();
		if(empty($_POST)){	
			$captcha->init();
			$src = $captcha->src;
			$ques = $captcha->ques;
			$this->assign('src',$src);
			$this->assign('ques',$ques);
			$this->display('captcha.html');
		}else{
			$captcha_x = post('captcha_x');
			$captcha_y = post('captcha_y');
			dp($captcha->check($captcha_x,$captcha_y));
		}

	}
    

    public function change()
    //修改密码
    {
		if(!isset($_SESSION)){
			session_start();
		}
		if(!loggedin()){
			jump('/user/login/');
		}else if(!empty($_POST)){
			$this->display('change.html');
			$model = new userModel();
			$user = $_SESSION['user'];
			$old_password = post('old_password');
			$new_password = post('new_password');
			$new_password_repeat = post('new_password_repeat');
			if($new_password!==$new_password_repeat){
				dp('repeat password error');				
			}
			$data['username'] = $user['username'];
			$data['password'] = $old_password;
			if(!$model->getOne($data)){//验证密码是否正确
				dp('password error');
			}
			$data['password'] = $new_password;
			$data['id'] = $user['id'];
			if($model->setPass($data)){
				session_destroy();
				jump('/login/');
			}
		}else{
			$this->assign('user',$_SESSION['user']);
			$this->display('change.html');
		}

    }


}