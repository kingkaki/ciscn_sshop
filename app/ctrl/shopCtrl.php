<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\commoditysModel;

class shopCtrl extends \core\mypro
{

    public function index()
	{
		$page = get('page',1,'int');
		$model = new commoditysModel();
		$commoditys = $model->page($page);
		$this->assign('commoditys',$commoditys);
		$this->assign('page',$page);
		$this->display('shop.html');
	}

	// public function test()  //加商品用的。。
	// {
	// 	$data['name'] = $this->generate(6);
	// 	$data['desc'] = $this->generate(20);
	// 	$data['amount'] = rand(20,1000);
	// 	$data['price'] = rand(10,500);
	// 	$model = new commoditysModel();
	// 	$model->addOne($data);
	// }


	// private function generate( $length = 8 ) { 
	// // 密码字符集，可任意添加你需要的字符 
	// $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; 
	// $password = ''; 
	// for ( $i = 0; $i < $length; $i++ ) 
	// { 
	// 	$password .= $chars[ mt_rand(0, strlen($chars) - 1) ]; 
	// } 
	// 	return $password; 
	// } 


}