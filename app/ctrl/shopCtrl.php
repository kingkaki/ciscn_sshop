<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\commoditysModel;

class shopCtrl extends \core\mypro
{

    public function index()
	{
		$model = new commoditysModel();
		$commoditys = $model->all();
		$this->assign('commoditys',$commoditys);
		$this->display('shop.html');
	}


}