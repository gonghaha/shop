<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/5
 * Time: 12:08
 */
class AdminModel extends Model
{
    /**
     * @param $user_name
     * @param $user_pass
     * @return bool
     */
    function check($user_name,$user_pass){
        $admin_name_escape = $this->_dao->escapeString($user_name);
        $admin_pass_escape = $this->_dao->escapeString($user_pass);
         $sql = "select * from `shop_admin` WHERE admin_name=$admin_name_escape AND admin_pass=md5($admin_pass_escape)";
         $row = $this->_dao->getRow($sql);
         return (bool) $row;
    }

}