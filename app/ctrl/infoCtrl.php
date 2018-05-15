<?php
namespace app\ctrl;
use app\model\userModel;


class infoCtrl extends \core\mypro
{

    public function index()
	{
        $id = get('id',0,'int');
        dp($id);
	}


}