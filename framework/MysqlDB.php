<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/5/31
 * Time: 10:03
 */
class MysqlDB
{
    public $host;
    public $port;
    public $username;
    public $password;
    public $charset;
    public $dbname;
    private $resource;
//    private static $instance;
    private static $link;
    private function __construct($config){
        $this->host = isset($config['host'])?$config['host']:'localhost';
        $this->port = isset($config['port'])?$config['port']:'3306';
        $this->username = isset($config['username'])?$config['username']:'root';
        $this->password = isset($config['password'])?$config['password']:'root';
        $this->charset = isset($config['charset'])?$config['charset']:'utf8';
        $this->dbname = isset($config['dbname'])?$config['dbname']:'chaochao';
        $this->connect();
        $this->setCharset();
        $this->selectDB();
    }
    public function connect(){
        $this->resource = mysql_connect("$this->host:$this->port","$this->username","$this->password") or die('连接数据库失败');
        return $this->resource;
//        $link = new mysqli();
//        $link->connect("$this->host","$this->username","$this->password","$this->dbname","$this->port");
    }
    public function setCharset(){
//        mysql_set_charset("$this->charset",$this->resource);
        $this->query("set names $this->charset");
    }
    public function selectDB(){
//        mysql_select_db("$this->dbname",$this->resource);
        $this->query("use $this->dbname");
    }
    public function query($sql){
        if (!$result = mysql_query($sql,$this->resource)){
            echo ("<br>执行失败。");
            echo "<br>失败的sql语句为：".$sql;
            echo "<br>出错信息为：".mysql_error();
            echo "<br>出错序号为：".mysql_errno();
            die();
        }
        return $result;
    }
    public function getAll($sql){
        $result = $this->query($sql);
        $arr = array();
        while ($rec = mysql_fetch_assoc($result)){
            $arr[] = $rec;
        }
        return $arr;
    }
    public function getRow($sql){
        $result = $this->query($sql);
//        $rec = array();
        while ($rec2 = mysql_fetch_assoc($result)){
            return $rec2;
        };
        return false;
    }
    public function getOne($sql){
        $result = $this->query($sql);
        $rec = mysql_fetch_row($result);
        if ($rec===false){
            return false;
        }
        return $rec[0];
    }
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
    static function getNew($config){
        if (!isset(self::$link)){
            self::$link = new self($config);
        }
        return self::$link;
    }
    public function escapeString($data){
        return "'".mysql_real_escape_string($data,$this->resource)."'";
    }
}



