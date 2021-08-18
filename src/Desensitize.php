<?php
/**
 * @project php-helper
 * @class   Desens
 * @author  Sinda
 * @email   sinda@srcker.com
 * @time    2021/8/19 2:48 上午
 */

namespace srcker\helper;

class Desensitize
{

    public static function mobile($mobile='',$holder='****')
    {
        if(preg_match("/^1[3456789]\d{9}$/", $mobile)){
            // 开始脱敏手机号码
            return substr_replace($mobile, $holder, 3, 4);
        }else{
            return false;
        }
    }


    public static function name($name='',$holder='*'){
        return substr_replace($name, $holder, 0, 1);
    }


    public static function custom($string, $start = 0, $length = 0, $holder = '*'){
        if(empty($string) || empty($length) || empty($re)) return $string;
        $end = $start + $length;
        $len = mb_strlen($string);
        $arr = array();
        for($i=0; $i<$len; $i++) {
            if($i>=$start && $i<$end)
                $arr[] = $holder;
            else
                $arr[] = mb_substr($string, $i, 1);
        }
        return implode('',$arr);
    }


}