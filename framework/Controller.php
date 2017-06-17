<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/4
 * Time: 21:23
 */
class Controller
{
    protected function _initContentType(){
        header('Content-Type:text/html; charset=utf-8');
    }
    public function __construct()
    {
        $this->_initContentType();
    }
    protected function _jump($url,$info=NULL,$wait){
        if ($info==NULL){
         header('Location:'.$url);
        }else{
         header("Refresh:$wait; URL=$url");
         echo $info;
        }
        die;
    }
}