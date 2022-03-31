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


    /**
     * 手机号码脱敏
     * @param $mobile
     * @param $holder
     * @return array|false|string|string[]
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/4/1 01:35:59
     */
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


    /**
     * 身份证号码脱敏
     * @param string $number 身份证号码
     * @param int $start 开始第几位脱敏 0开始算
     * @param int $length 脱敏长度
     * @param string $holder 脱敏占位符
     * @return false|string
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/4/1 01:43:37
     */
    public static function idCard($number='', $start = 6, $length = 14, $holder = '*')
    {
        if (empty($number) || mb_strlen($number) != 18){
            return false;
        }
        $arr = [];
        for($i=0; $i<18; $i++) {
            if($i>=$start && $i<$length){
                $arr[] = $holder;
            }else{
                $arr[] = mb_substr($number, $i, 1);
            }
        }
        return implode('', $arr);
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