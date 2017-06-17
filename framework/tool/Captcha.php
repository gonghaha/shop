<?php

/**
 * Created by PhpStorm.
 * User: chaochao
 * Date: 2017/6/10
 * Time: 13:36
 */
class Captcha
{
    public function generate($code_len = 4){
        $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZ123456789';
        $chars_len = strlen($chars);
        $code = '';
        for ($i = 0;$i<4;$i++){
            $rand_index = mt_rand(0,$chars_len-1);
            $code .=$chars[$rand_index];
        }

        @session_start();
        $_SESSION['captcha_code'] = $code;

        $bg_file = TOOL_PATH.'captcha/captcha_bg'.mt_rand(1,5).'.jpg';

        $img = imagecreatefromjpeg($bg_file);
        $str_color = mt_rand(0,2) ==1 ? imagecolorallocate($img,0,0,0) : imagecolorallocate($img,255,255,255);

        $font = 5;
        $img_width = imagesx($img);
        $img_height = imagesy($img);

        $font_width = imagefontwidth($font);
        $font_height = imagefontheight($font);

        $code_width = $font_width*$code_len;
        $code_height = $font_height;

        $x = ($img_width-$code_width)/2;
        $y = ($img_height-$code_height)/2;

        imagestring($img,$font,$x,$y,$code,$str_color);
        header('Content-Type:image/jepg');
        imagejpeg($img);
        imagedestroy($img);
    }
    public function captchacheck($request_code){
        @session_start();
        $result = isset($request_code)&&isset($_SESSION['captcha_code'])&&(strcasecmp($_SESSION['captcha_code'],$request_code) ==0);
        unset($_SESSION['captcha_code']);
        return $result;
    }


}















