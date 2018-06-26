<?php
namespace app\ctrl;
use app\model\userModel;
use app\model\commoditysModel;

class seckillCtrl extends \core\mypro
{

    public function index()
	{
        if(empty($_POST)){
            $this->display('seckill.html');
            exit();
        }
        if(!loggedin()){
            jump('/login');
        }
        $id = post('id',0,'int');
        
        if($id){
            $commoditymodel = new commoditysModel();
            $commodityamount = $commoditymodel->getOne($id)['amount'];
            if($commoditymodel->reduceOne($id)){
                $this->assign('success',1);
                $this->display('seckill.html');
            }else{
            $this->assign('success',0);
            $this->display('seckill.html');
            }

        }else{
            $this->assign('success',0);
            $this->display('seckill.html');
        }
        
	}


}