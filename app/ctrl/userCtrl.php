<?php
namespace app\ctrl;
use app\model\guestbookModel;
use app\model\commentModel;

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
    

    public function change()
    //修改密码
    {

    }


}