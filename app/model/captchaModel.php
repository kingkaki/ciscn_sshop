<?php
namespace app\model;

use core\lib\conf;
class captchaModel
{

    public $ques;
    public $src;
    public function __construct(){
        if(!isset($_SESSION)){
            session_start();
        }
        $dir =  APP.conf::get('CAP_JPGS','upload');
        $jpgs = scandir($dir);
        $num = array_rand($jpgs);
        $jpg = $jpgs[$num];
        $this->src = conf::get('CAP_JPGS','upload').$jpg;
        $filename = "ans".substr($jpg,4, strlen($jpg)-8).".txt";
        $filedir = APP.conf::get('CAP_ANS','upload').$filename;
        $myfile = fopen($filedir, "r");

        $len1 = fgets($myfile);
        $len2 = fgets($myfile);
        $len3 = fgets($myfile);
        $len4 = fgets($myfile);
        $len5 = fgets($myfile);
        $len6 = fgets($myfile);
        fclose($myfile);

        $_SESSION["pos_x_1"]=substr($len1,14);
        $_SESSION["pos_y_1"]=substr($len2,14);
        $_SESSION["width_x_1"]=substr($len3,16);
        $_SESSION["width_y_1"]=substr($len4,17);
        $this->ques=substr($len6,11);
        
    }


}