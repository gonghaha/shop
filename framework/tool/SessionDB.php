<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/7
 * Time: 18:13
 */
class SessionDB
{
    private $_dao;

    public function __construct()
    {
//        ini_set('session.save_handler','user');
        ini_set('session.gc_divisor','100');
        session_set_save_handler(
            array($this,'userSessionBegin'),
            array($this,'userSessionEnd'),
            array($this,'userSessionRead'),
            array($this,'userSessionWrite'),
            array($this,'userSessionDelete'),
            array($this,'userSessionGC')
        );
        @session_start();
    }

    public function userSessionBegin(){
        $config = $GLOBALS['config']['db'];
        $this->_dao = MysqlDB::getNew($config);
    }
    public function userSessionEnd(){
        return true;
    }
    public function userSessionRead($sess_id){
        $sql = "select session_content From `session` WHERE session_id='$sess_id'";
        $result = $this->_dao->getOne($sql);
        if ($result){
            return $result;
        }else{
            return '';
        }
    }
    public function userSessionWrite($sess_id,$sess_content){
        $sql = "REPLACE INTO `session` VALUES ('$sess_id','$sess_content',unix_timestamp())";
        return $this->_dao->query($sql);
    }
    public function userSessionDelete($sess_id){
        $sql = "DELETE FROM `session` WHERE session_id='$sess_id'";
        return $this->_dao->query($sql);
    }
    public function userSessionGC($max_lifetime){
        $sql = "DELETE FROM `session` WHERE last_time<unix_timestamp()-$max_lifetime";
        return $this->_dao->query($sql);
    }
}