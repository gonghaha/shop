<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/5
 * Time: 10:01
 */
class AdminController extends PlatformController
{
    function loginAction(){
        require CURRENT_VIEW_PATH.'login.html';
    }

    public function captchaAction(){
        $captche = new Captcha();
        $captche->generate();
    }

    function checkAction(){
//        $t_captcha = new Captcha();
//        if (!$t_captcha->captchacheck($_POST['captcha'])){
//            $this->_jump('index.php?p=back&c=Admin&a=login','验证码错误',2);
//        }
        $admin_name = $_POST['username'];
        $admin_pass = $_POST['password'];
        $m_admin = Factory::M('AdminModel');
        if ($admin_info = $m_admin->check($admin_name,$admin_pass)){
            $_SESSION['admin']=$admin_info;
            $this->_jump('index.php?p=back&c=Manage&a=index');
        }else{
            $this->_jump('index.php?p=back&c=Admin&a=login','存在错误',3);
        }
    }
    function logoutAction(){
        unset($_SESSION['admin']);
        $this->_jump('index.php?p=back&c=Admin&a=login');
    }
}