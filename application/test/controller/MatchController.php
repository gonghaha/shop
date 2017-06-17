<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/4
 * Time: 17:13
 */
//require './framework/Controller.php';
class MatchController extends Controller
{
    public function listAction(){
//        require './framework/Factory.php';
        $m_match = Factory::M('MatchModel');
        $match_list = $m_match->getList();
        require CURRENT_VIEW_PATH.'match_list_v.html';
    }
    public function removeAction(){
        echo 'beishanchule';
    }
}