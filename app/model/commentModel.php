<?php
namespace app\model;

use core\lib\model;

class commentModel extends model
{
    private $table = 'comment';
    private $user_table = 'page';
    public function addOne($data)
    {
        $sql = $this->prepare("INSERT INTO ".$this->table."(`userid`,`pageid`,`content`,`create_time`) VALUES (?,?,?,?)");
        return $sql->execute(array($data['userid'],$data['pageid'],$data['content'],$data['create_time']));
        
    }

    public function getcomments($id)
    {
        $sql = $this->prepare("SELECT * FROM ".$this->table." WHERE `pageid`= ? ");
        $sql->execute(array($id));
        $res = $sql->fetchAll();
        return $res;
    }

    public function getPageid($id)
    {
        $sql = $this->prepare("SELECT * FROM ".$this->table." WHERE `id`= ? ");
        $sql->execute(array($id));
        $res = $sql->fetchAll();
        foreach ($res as $r) {    
            return $r['pageid'];
        }
    }

    public function getUserByComment($id)
    {
        $sql = $this->prepare("SELECT b.userid FROM ".$this->table." AS a JOIN ".$this->user_table." AS b ON a.pageid = b.id where a.id ='".$id."'");
        $sql->execute(array($id));
        $res = $sql->fetchAll();
        //dp($res);
        foreach ($res as $r) {    
            return $r['userid'];
        }
    }

    public function delOne($id)
    {
        $sql = $this->prepare("DELETE FROM ".$this->table." WHERE  `id` = ?");
        return $sql->execute(array($id));
    }
}