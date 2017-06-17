<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/12
 * Time: 19:17
 */
class GoodsController extends PlatformController
{
    public function addAction(){
        require CURRENT_VIEW_PATH.'goods_add.html';
    }
    public function insertAction(){
        $data['goods_name'] = $_POST['goods_name'];
        $data['shop_price'] = $_POST['shop_price'];
        $data['goods_desc'] = $_POST['goods_desc'];
        $data['goods_number'] = $_POST['goods_number'];
        $data['is_on_sale'] = isset($_POST['is_on_sale']) ? 1:0;
        $data['goods_promote'] = isset($_POST['goods_promote']) ?implode(',',$_POST['goods_promote']):'';
        $m_goods = Factory::M('GoodModel');
        $t_upload = new Upload();
        $t_upload ->upload_path = './web/upload/';
        $t_upload ->prefix = 'goods_ori_';
        if ($result = $t_upload ->uploadOne($_FILES['image_ori'])){
            $data['goods_image_ori'] = $result;
        }
        else{
            $this->_jump('index.php?p=back&c=Goods&a=add',$t_upload->getErrror(),3);
        }
        if ($m_goods->insertGoods($data)){
            $this->_jump('index.php?p=back&c=Goods&a=list');
        }else{
            $this->_jump('index.php?p=back&c=Goods&a=add');
        }

    }
    public function listAction(){
        echo'safa';
    }
}