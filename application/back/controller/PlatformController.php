<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/9
 * Time: 21:41
 */
class PlatformController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_checkLogin();
        $this->_initSession();
    }
    protected function _initSession(){
        new SessionDB();
    }
    protected function _checkLogin(){
        $white_list = array(
            'Admin' =>array('login','check','captcha')
        );
        if (isset($white_list[CONTROLLER])){
            if (in_array(ACTION,$white_list[CONTROLLER])){
                return;
            }
        }
        new  SessionDB();
        if (!$_SESSION['admin']){
            $this->_jump('index.php?p=back&c=Admin&a=login');
        }
    }
}