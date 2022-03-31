<?php
/**
 * @project php-helper
 * @class   Str
 * @author  Sinda
 * @email   sinda@srcker.com
 * @time    2020/10/31 2:28 上午
 */

namespace srcker\helper;


class Str
{


    /**
     * 随机生成字符转
     * @param int $length
     * @param false $isNumber
     * @return string
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2020/10/31 02:33:18
     */
    public static function random($length = 16,$isNumber = false) {
        if($isNumber){
            $chars = '0123456789';
        }else{
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        }
        $str    = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }




}