<?php
namespace app\model;

use core\lib\model;

class userModel extends model
{
    public $table = 'user';

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

    public function setPass($data)
    {
        $sql = $this->prepare("UPDATE ".$this->table." SET `password` = ? where `id` = ?");
        //dp($sql);
        return $sql->execute(array(md5($data['password']),$data['id']));
        
    }



}