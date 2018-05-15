<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\commoditysModel;
use app\model\shopcarModel;

class shopcarCtrl extends \core\mypro
{

    public function index()
	{
		if(!loggedin()){
			jump('/login/');
		}
		if(empty($_SESSION)){
			session_start();
		}
		$user = $_SESSION['user'];
		$model = new commoditysModel();
		$shopcar = $model->getShopcarById($user['id']);
		$this->assign('shopcar',$shopcar);
		$this->assign('user',$user);
		$this->display('shopcar.html');



    }
    
    public function add()
	{
		if(!loggedin()){
			jump('/login/');
		}
		if(empty($_SESSION)){
			session_start();
		}

		$commodityid = post('id',0,'int');
		$userid = $_SESSION['user']['id'];
		$model = new shopcarModel();
		if($model->addOne($userid,$commodityid)){
			jump('/shopcar/');
		}else{
			dp("add error");
		}



	}


}