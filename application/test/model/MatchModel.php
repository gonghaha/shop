<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/4
 * Time: 12:19
 */
//require_once './framework/Model.php';
class MatchModel extends Model
{
    public function getList(){
        $sql = "SELECT t1.t_name as t1_name,m.t1_score,m.t2_score,t2.t_name as t2_name,from_unixtime(m.m_time) AS tim "."FROM `match` AS m LEFT JOIN team AS t1 ON m.t1_id=t1.t_id LEFT JOIN team AS t2 ON m.t2_id=t2.t_id";
        return $this->_dao->getAll($sql);
    }
}