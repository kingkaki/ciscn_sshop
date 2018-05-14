<?php
namespace core\lib;
use core\lib\conf;

class route{
    public $ctrl;
    public $action;

    public function __construct(){
        /*
        隐藏index.php
        获取url参数
        返回对应控制器和方法
        */

        if(isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI']!= '/' ){
            $path = $_SERVER['REQUEST_URI'];
            $patharr = explode('/',trim($path,'/'));
            //处理图片等静态文件
            if($patharr[0]==='upload')
            {
                header('content-type:image/jpg;');
                echo file_get_contents(APP.$_SERVER['REQUEST_URI']);
                exit();
            }
            if(isset($patharr[0])){
                $this->ctrl = $patharr[0];
            }
            unset($patharr[0]);
            if (isset($patharr[1])){
                $this->action = $patharr[1];
                // $this->action = substr($patharr[1],0,strrpos($patharr[1],'?'));
                // p($patharr[1]);exit();
                unset($patharr[1]);
            }else{
                $this->action = conf::get('ACTION','route');
            }
            // $count = count($patharr)+2;
            // for($i=2;$i<$count;$i+=2){
            //     if(isset($patharr[$i+1])){
            //         $_GET[$patharr[$i]] = $patharr[$i+1];
            //     }                
            // }

            // p($_GET);
            //多余部分转化为参数

        }else{
            $this->ctrl = conf::get('CTRL','route');
            $this->action = conf::get('ACTION','route');
        }



    }
}