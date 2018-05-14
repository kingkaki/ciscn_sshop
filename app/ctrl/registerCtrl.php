<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\picUploadModel;

class registerCtrl extends \core\mypro
{

	public function index()
	//注册账号
	{
		$this->display("register.html");
		if(!empty($_POST)){		
			$username = post('username');
			$password1 = post('password');
			$password2 = post('repeat_password');
			if($password1 !== $password2){
				p('两次密码不一致');				
			}
			else if(!empty($username) && !empty($password1))
			{
				$data['username'] = $username;
				$data['password'] = md5($password1);
				$data['last_ip'] = $_SERVER["REMOTE_ADDR"];
				$data['is_admin'] = 0;
				$model = new userModel();
				$res = $model->addOne($data);
				if($res){
					p("注册成功！");
				}else{
					p("注册失败");
				}

			}else{
				p("username or password cant be blank!");
			}
		}
		
	}
}