<?php
namespace app\model;

use core\lib\model;

class commoditysModel extends model
{
    public $table = 'commoditys';
    public $shopcar = 'shopcar';


    public function all()
    {
        return $this->query('SELECT * FROM '.$this->table);
    }



    public function getOne($id)
    {
        $sql = $this->prepare("SELECT * FROM ".$this->table." WHERE `id`= ? ");
        $sql->execute(array($id));
        $res = $sql->fetchAll();

        foreach ($res as $r) {
				return $r;
        }
    }

    public function getShopcarById($userid)
    {
        $sql = $this->prepare("SELECT b.name,b.desc,b.amount,b.price FROM ".$this->shopcar." a JOIN ".$this->table." b ON a.commodityid=b.id WHERE userid= ?");
        $sql->execute(array($userid));
        $res = $sql->fetchAll();
        return $res;
        
    }

    public function addOne($data)
    {
        // $sql = $this->prepare("INSERT INTO ".$this->table."(`userid`,`title`,`content`,`create_time`) VALUES (?,?,?,?)");
        // return $sql->execute(array($data['id'],$data['title'],$data['content'],$data['createtime']));
        
    }

    public function delOne($id)
    {
        $sql = $this->prepare("DELETE FROM `".$this->table."` WHERE `id`=?");
        // p($sql);exit();
        $ret = $sql->execute(array($id));
        if($ret !== false){
            return true;
        }else{
            return false;
        }
    }



}