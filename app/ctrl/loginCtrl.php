<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\picUploadModel;

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
		if(!empty($_POST)){
			$data['username'] = post('username');
			$data['password'] = post('password');
			$model = new userModel();
			$res = $model->getOne($data);
			session_start();
			$_SESSION['user'] = $res; 
			jump('/user/');
			exit();
		}
		
		$this->display('login.html');
	}


}