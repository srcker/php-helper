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
    public static function mobile($mobile='', $holder=' **** ')
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
     * 姓名脱敏
     *
     * @param string $name 姓名
     * @param string $holder 脱敏占位符
     * @return string 脱敏后的姓名
     * @author Sinda
     * @email  sinda@srcker.com
     */
    public static function name($name='', $holder='*'){

        // 获取姓名的长度
        $nameLength = mb_strlen($name, 'UTF-8');
            
        // 如果长度小于等于1，则不做脱敏处理
        if ($nameLength <= 1) {
            return $name;
        }

        // 获取第一个字符
        $firstChar = mb_substr($name, 0, 1, 'UTF-8');

        // 剩余字符使用星号替换
        $maskedPart = str_repeat($holder, $nameLength - 1);

        // 返回脱敏后的姓名
        return $firstChar . $maskedPart;
        
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
     * 密码脱敏
     * 直接替换为 *******
     * @param string $password 密码
     * @return string 脱敏后的密码
     */
    public static function password($password)
    {
        return str_repeat('*', 7);
    }

    /**
     * 中国大陆车牌脱敏
     * 普通车牌（格式：粤B12345）显示前2位和后1位，新能源车牌显示前3位和后2位，中间替换为 *
     * @param string $plateNumber 车牌号
     * @return string 脱敏后的车牌号
     */
    public static function carLicense($plateNumber)
    {
        $length = mb_strlen($plateNumber, 'UTF-8');
        if ($length == 7) {
            // 普通车牌
            return mb_substr($plateNumber, 0, 2, 'UTF-8') . str_repeat('*', 4) . mb_substr($plateNumber, -1, 1, 'UTF-8');
        } elseif ($length == 8) {
            // 新能源车牌
            return mb_substr($plateNumber, 0, 3, 'UTF-8') . str_repeat('*', 3) . mb_substr($plateNumber, -2, 2, 'UTF-8');
        }
        return $plateNumber;
    }

    /**
     * 银行卡号脱敏
     * 显示前6位和后4位，中间替换为 *
     * @param string $bankCard 银行卡号
     * @return string 脱敏后的银行卡号
     */
    public static function bankCard($bankCard)
    {
        return substr($bankCard, 0, 6) . str_repeat('*', strlen($bankCard) - 10) . substr($bankCard, -4);
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

