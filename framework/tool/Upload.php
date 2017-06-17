<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/13
 * Time: 16:28
 */
class Upload
{
    private $_max_size;
    private $_type_map;
    private $_allow_ext_list;
    private $_allow_mime_list;
    private $_upload_path;
    private $_prefix;

    private $_error;
    public function getErrror(){
        return $this->_error;
    }

    public function __construct()
    {
        $this->_max_size = 1024*1024*10;
        $this->_type_map = array(
            '.png'  =>  array('image/png','image/x-png'),
            '.jpg'  =>  array('image/jepg','image/pjepg'),
            '.jpeg' =>  array('image/jpeg','image/pjepg'),
            '.gif'   =>  array('image/gif')
        );
        $this->_allow_ext_list = array('.png','.jpg','.jpeg','.gif');
        $allow_mime_list = array();
        foreach ($this->_allow_ext_list as $value){
            $allow_mime_list = array_merge($allow_mime_list,$this->_type_map[$value]);
        }
        $this->_allow_mime_list = array_unique($allow_mime_list);
        $this->_upload_path = './';
        $this->_prefix = '';
    }

    public function __set($name, $value)
    {
        $allow_set_list = array('_upload_path','_prefix','_allow_ext_list','_max_size');
        if (substr($name,0,1)!=='_'){
            $name = '_'.$name;
        }
        $this->$name = $value;
        // TODO: Implement __set() method.
    }
    public function uploadOne($tep_file)
    {
        if ($tep_file['error'] != 0) {
            $this->_error = '文件上传错误';
            return false;
        }
        if ($tep_file['size'] > $this->_max_size) {
            $this->_error = '文件过大';
            return false;
        }
        $ext = strtolower(strrchr($tep_file['name'], '.'));
        if (!in_array($ext,$this->_allow_ext_list)){
            $this->_error = '文件非法1';
            return false;
        }
        if (!in_array($tep_file['type'],$this->_allow_mime_list)){
            $this->_error = '文件不合法';
            return false;
        }
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo -> file($tep_file['tmp_name']);
        if (!in_array($mime_type,$this->_allow_mime_list)){
            $this->_error = '文件非法2';
            return false;
        }

        $subdir = date('YmdH').'/';
        if (!is_dir($this->_upload_path.$subdir)){
            mkdir($this->_upload_path.$subdir);
        }

        $upload_filename = uniqid($this->_prefix,true).$ext;
        if (move_uploaded_file($tep_file['tmp_name'],$this->_upload_path.$subdir.$upload_filename)){
            return $subdir.$upload_filename;
        }else{
            $this->_error = '移动失败';
            return false;
        }
    }



}