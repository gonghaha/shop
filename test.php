<?php
/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/7
 * Time: 10:23
 */
ini_set('session.save_handler','user');
ini_set('session.gc_divisor','1');
function userSessionBegin(){
    echo '<br>begin';
    $link = mysql_connect('localhost','root','root');
    mysql_query('use shop');
}
function userSessionEnd(){
    echo '<br>End';
}
function userSessionRead($session_id){
    $sql = "select session_content from `session` WHERE session_id='$session_id'";
    $result = mysql_query($sql);
    if ($row = mysql_fetch_assoc($result)){
        return $row['session_content'];
    }else{
        return '';
    }

}
function userSessionWrite($session_id,$session_content){
    echo '<br>write';
//    $sql = "insert into `session` VALUES ('session_id','session_content') ON DUPLICATE KEY UPDATE";
    $sql = "replace into `session` VALUES ('$session_id','$session_content',unix_timestamp())";
//    $sql = "insert into `session` VALUES ('124','5131')";
    mysql_query($sql);
}
function userSessionDelete($session_id){
    $sql = "delete from `session` WHERE '$session_id' = session_id";
    echo '<br>Delete';
    return mysql_query($sql);
}
function userSessionGC($max_lefttime){
    $sql = "delete from `session` WHERE last_time < unix_timestamp() - $max_lefttime";
    echo '<br>GC';
    return mysql_query($sql);
}
session_set_save_handler(
    'userSessionBegin',
    'userSessionEnd',
    'userSessionRead',
    'userSessionWrite',
    'userSessionDelete',
    'userSessionGC'
);
session_start();

//$_SESSION['doge']='ddddd';
//$_SESSION['dsa']='534156';
//print_r($_SESSION);

















