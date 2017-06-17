<?php
/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/8
 * Time: 22:29
 */
interface I_DAO{
    public function query($sql);
    public function getOne();
    public function getRow();
    public function getAll();
    public function escapeString();
}