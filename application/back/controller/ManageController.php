<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/5
 * Time: 17:57
 */
class ManageController extends PlatformController
{
    public function indexAction(){
        require CURRENT_VIEW_PATH.'index.html';
    }
    public function topAction(){
        require CURRENT_VIEW_PATH.'top.html';
    }
    public function menuAction(){
        require CURRENT_VIEW_PATH.'menu.html';
    }
    public function mainAction(){
        require CURRENT_VIEW_PATH.'main.html';
    }
    public function dragAction(){
        require CURRENT_VIEW_PATH.'drag.html';
    }
}
