<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/4
 * Time: 12:22
 */
class Factory
{
    private function __construct()
    {
    }
    private function __clone()
    {
        // TODO: Implement __clone() method.
    }
    /**
     * @param $model_name string
     * @return object
     */
    private static $model_list = array();
    public static function M($model_name){
        if (!isset(self::$model_list[$model_name])){
            self::$model_list[$model_name] = new $model_name;
        }
        return self::$model_list[$model_name];
    }
}
