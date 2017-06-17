<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/7
 * Time: 21:41
 */

/*
 * 框架初始化
 */
class Framework
{
    public static function run(){
        static::_initPathConst();
        static::_initConfig();
        static::_initDispatchParam();
        static::_initPlatformPath();
        static::_userAutoLoad();
        static::_dispatch();
    }

    private static function _initPathConst(){
        define('ROOT_PATH',getcwd().'/');
        define('APPLICATION_PATH',ROOT_PATH.'application/');
        define('FRAMEWORK_PATH',ROOT_PATH.'framework/');
        define('TOOL_PATH',FRAMEWORK_PATH.'tool/');
        define('CONFIG_PATH',APPLICATION_PATH.'config/');
//        define('CURRENT_VIEW_PATH',APPLICATION_PATH.'back/view/');
    }

    private static function _initDispatchParam(){
        $default_platform =$GLOBALS['config']['app']['default_platform'];
        define('PLATFORM',isset($_GET['p'])?$_GET['p']:$default_platform);

        $default_control = $GLOBALS['config'][PLATFORM]['default_controller'];
        define('CONTROLLER',isset($_GET['c']) ? $_GET['c'] : $default_control);

        $default_action=$GLOBALS['config'][PLATFORM]['default_action'];
        define('ACTION',isset($_GET['a']) ? $_GET['a'] : $default_action);
    }

    private static function _initPlatformPath(){
        define('CURRENT_CONTROLLER_PATH',APPLICATION_PATH.PLATFORM.'/controller/');
        define('CURRENT_MODEL_PATH',APPLICATION_PATH.PLATFORM.'/model/');
        define('CURRENT_VIEW_PATH',APPLICATION_PATH.PLATFORM.'/view/');
    }

    public static function userAutoload($class_name){
        $framework_class_list = array(
            'Controller'    =>FRAMEWORK_PATH. 'Controller.php',
            'Factory'       =>FRAMEWORK_PATH. 'Factory.php',
            'Model'         =>FRAMEWORK_PATH. 'Model.php',
            'MysqlDB'       =>FRAMEWORK_PATH. 'MysqlDB.php',
            'SessionDB'     =>TOOL_PATH.'SessionDB.php',
            'Captcha'       =>TOOL_PATH.'Captcha.php',
            'Upload'        =>TOOL_PATH.'Upload.php'
        );
        if (isset($framework_class_list[$class_name])){
            require $framework_class_list[$class_name];
        }
        elseif(substr($class_name,-10)=='Controller'){
            require CURRENT_CONTROLLER_PATH.$class_name.'.php';
        }
        elseif (substr($class_name,-5)=='Model'){
            require CURRENT_MODEL_PATH.$class_name.'.php';
        }
    }

    protected static function _userAutoLoad(){
        spl_autoload_register(array(__CLASS__,'userAutoLoad'));
    }

    private static function _dispatch(){
        $control_name=CONTROLLER.'Controller';
        $action_name = ACTION."Action";
        $controller = new $control_name();
        $controller->$action_name();
    }
    private static function _initConfig(){
        $GLOBALS['config'] = require CONFIG_PATH.'application.config.php';
    }
}