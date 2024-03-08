<?php
/**
 * @project php-helper
 * @class   Desens
 * @description 数据脱敏助手类（例如，手机号码、电子邮箱等）
 * @author  Sinda
 * @email   sinda@srcker.com
 * @time    2021/8/19 2:48 上午
 */

namespace srcker\helper;

class Desensitize
{


    /**
     * 手机号码脱敏
     *
     * @param string $mobile 手机号码
     * @param string $holder 脱敏占位符
     * @return string|false 脱敏后的手机号码，如果输入无效则返回 false
     * @author Sinda
     * @email  sinda@srcker.com
     * @time   2022/4/1 01:35:59
     */
    public static function mobile($mobile='', $holder='****')
    {
        if(preg_match("/^1[3456789]\d{9}$/", $mobile)){
            // 开始脱敏手机号码
            return substr_replace($mobile, $holder, 3, 4);
        }else{
            return false;
        }
    }

    /**
     *  电子邮箱脱敏
     *
     * @param string $email 电子邮箱地址
     * @param string $holder 脱敏占位符
     * @return string 脱敏后的电子邮箱地址
     * @author Sinda
     * @email  sinda@srcker.com
     * @time   2022/4/1 01:35:59
     */
    public static function email($email='', $holder='****')
    {
        $parts = explode('@', $email);
        $username = $parts[0];
        $domain = $parts[1];

        // 获取用户名的长度
        $usernameLength = strlen($username);
        
        // 隐藏用户名中间部分
        $maskedUsername = substr($username, 0, 1) . str_repeat('*', $usernameLength - 2) . substr($username, -1);
        
        // 保留域名
        $maskedDomain = $domain;
        
        return $maskedUsername . '@' . $maskedDomain;
    }


    /**
     * 车牌号脱敏函数
     *
     * @param string $plateNumber 车牌号码
     * @return string 脱敏后的车牌号码
     * @author Sinda
     * @email  sinda@srcker.com
     */
    public static function carLicense($plateNumber)
    {
        // 定义正则表达式模式
        $pattern = '/^(.{2}).*(.{1})$/u';
            
        // 如果车牌号码格式不正确，则返回原始车牌号码
        if (!preg_match($pattern, $plateNumber)) {
            return $plateNumber;
        }

        // 使用正则替换匹配的部分为星号
        return preg_replace($pattern, '$1***$2', $plateNumber);
    }

    /**
     * 姓名脱敏
     *
     * @param string $name 姓名
     * @param string $holder 脱敏占位符
     * @return string 脱敏后的姓名
     * @author Sinda
     * @email  sinda@srcker.com
     */
    public static function name($name='', $holder='*'){
        return substr_replace($name, $holder, 0, 1);
    }


    /**
     * 身份证号码脱敏
     *
     * @param string $number 身份证号码
     * @param int $start 开始脱敏的位置（从0开始）
     * @param int $length 脱敏的长度
     * @param string $holder 脱敏占位符
     * @return string|false 脱敏后的身份证号码，如果输入无效则返回 false
     * @author Sinda
     * @email  sinda@srcker.com
     * @time   2022/4/1 01:43:37
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


    /**
     * 自定义字符串脱敏
     *
     * @param string $string 待脱敏的字符串
     * @param int $start 开始脱敏的位置（从0开始）
     * @param int $length 脱敏的长度
     * @param string $holder 脱敏占位符
     * @return string 脱敏后的字符串
     * @author Sinda
     * @email  sinda@srcker.com
     */
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

