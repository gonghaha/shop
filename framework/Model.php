<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/4
 * Time: 12:15
 */
class Model
{
    protected $_dao;
    protected function _initDAO(){
        $config = $GLOBALS['config']['db'];
        $this->_dao = MysqlDB::getNew($config);
    }
    public function __construct()
    {
        $this->_initDAO();
    }
    protected function _escapeStringAll($data){
        foreach ($data as $key =>$value){
            $data[$key] = $this->_dao->escapeString($value);
        }
        return $data;
    }
}