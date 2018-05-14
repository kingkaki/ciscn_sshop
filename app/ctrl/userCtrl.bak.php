<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\picUploadModel;

class userCtrl extends \core\mypro
{
	public function index()
	//显示自己的留言
	{
		if(!loggedin()){
			jump('/user/login/');
		}else{
			$user = $_SESSION['user'];
			$this->assign('user',$user);
			$userid = $user['id'];
			$model = new userModel();
			$data = $model->getGuestbookById($userid);
			//var_dump($data);
			$this->assign('data',$data);
			$this->display('user.html');
		}
		
	}

	public function login()
	//显示自己的留言
	{	
		if(!isset($_SESSION)){
			session_start();
		}
		if(isset($_SESSION['user'])){
			jump('/user/index/');
		}
		if(!empty($_POST)){
			$data['username'] = post('username');
			$data['password'] = post('password');
			$model = new userModel();
			$res = $model->getOne($data);
			session_start();
			$_SESSION['user'] = $res; 
			jump('/user/index/');
			exit();
		}
		
		$this->display('login.html');
	}

	public function logout()
	{
		session_start();
		session_destroy();
		jump('/');
	}

	// public function test()
	// {
	// 	$pic = new picUploadModel();
	// 	dp($pic->upload_path);
	// }

	public function uploadavatar()
	{
		$userid = post('userid',0,'int');
		$avatar = post('avatar');
		//dp($userid);
		if($userid && auth($userid) && !$_FILES['avatar']['error'])
		{
			$file = $_FILES['avatar'];
			$upload = new picUploadModel();
			$pic_path = $upload->upload($file);
			if($pic_path)
			{
				$model = new userModel();
				$model->addAvatar($userid,$pic_path);

				jump('/user/index/');

			}else{
				p('uplaod fault');
			}
			

		}
	}

	public function register()
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