<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/12
 * Time: 20:42
 */
class GoodModel extends Model
{
    public function insertGoods($data)
    {
        $secape_data = $this->_escapeStringAll($data);
        $data['create_admin_id'] = $_SESSION['admin']['admin_id'];
        $sql = sprintf("insert into `goods` VALUES (NULL ,%s,%f,'',%s,%s,%d,%d,%d,%s)",
            $secape_data['goods_name'], $data['shop_price'], $secape_data['goods_image_ori'], $secape_data['goods_desc'], $secape_data['goods_number'], $secape_data['is_on_sale'], $secape_data['goods_admin_id'], $secape_data['goods_promote']);
        return $this->_dao->query($sql);
    }


}