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
     * @param int $length 生成字符长度
     * @return string 随机生成的字符
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2020/10/31 02:33:18
     */
    public static function random(int $length = 16): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $str    = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 随机生成数字字符转
     * @param $length int 生成字符长度
     * @return string 随机生成的数字字符
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:39
     */
    public static function randomInt(int $length = 16): string
    {
        $chars = '0123456789';
        $str    = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

}