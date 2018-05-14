<?php
namespace app\model;

use core\lib\model;

class userModel extends model
{
    public $table = 'user';
    public $page_table = 'page';

	public function addOne($data)
    {
        $sql = $this->prepare("INSERT INTO ".$this->table."(`username`,`password`,`last_ip`,`is_admin`) VALUES (?,?,?,?)");
        return $sql->execute(array($data['username'],$data['password'],$data['last_ip'],$data['is_admin']));
        
    }

    public function addAvatar($id,$path)
    {
        $sql = $this->prepare("UPDATE `".$this->table."` SET `avatar`=? WHERE `id`=?");
        return $sql->execute(array($path,$id));
    }

	public function getOne($data)
    {
        $sql = $this->prepare("SELECT * FROM ".$this->table." WHERE `username`= ? AND `password`= ? limit 0,1");
        //dp(array($data['username'],md5($data['password'])));
        $sql->execute(array($data['username'],md5($data['password'])));
        $res = $sql->fetchAll();
        
        foreach ($res as $r) {
                return $r;
        }	
        
    }

    public function getGuestbookById($id)
    {
        $sql = $this->prepare("SELECT * FROM ".$this->page_table." WHERE `userid`= ? ");
        $sql->execute(array($id));
        $res = $sql->fetchAll();
        return $res;

    }

}