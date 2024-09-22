<?php
/**
 * @project php-helper
 * @class   Validate 验证器
 * @author  Sinda
 * @email   sinda@srcker.com
 * @time    2022/3/27 5:45 PM
 */

namespace srcker\helper;

class Validate
{


    /**
     * Filter_var 规则
     * @var array
     */
    private static $filter = [
        'email'   => FILTER_VALIDATE_EMAIL,
        'ip'      => [FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6],
        'integer' => FILTER_VALIDATE_INT,
        'url'     => FILTER_VALIDATE_URL,
        'macAdder' => FILTER_VALIDATE_MAC,
        'float'   => FILTER_VALIDATE_FLOAT,
    ];

    /**
     * 内置正则验证规则
     * @var array
     */
    private static $defaultRegex = [
        'alphaDash'   => '/^[A-Za-z0-9\-\_]+$/',
        'chs'         => '/^[\x{4e00}-\x{9fa5}]+$/u',
        'chsAlpha'    => '/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u',
        'chsAlphaNum' => '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u',
        'chsDash'     => '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9\_\-]+$/u',
        'mobile'      => '/^1[3-9][0-9]\d{8}$/',
        'idCard'      => '/(^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$)|(^[1-9]\d{5}\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{2}$)/',
        'zip'         => '/\d{6}/',
    ];



    /**
     * 验证某个字段的值只能是汉字
     * @param $str
     * @return false|int|null
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:33:36
     */
    public static function chs($str)
    {
        return preg_match(self::$defaultRegex['chs'],$str);
    }


    /**
     * 验证某个字段的值只能是
     * 汉字、字母
     * @param $str
     * @return false|int|null
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:33:36
     */
    public static function chsAlpha($str)
    {
        return preg_match(self::$defaultRegex['chsAlpha'],$str);
    }


    /**
     * 验证某个字段的值只能是
     * 汉字、字母和数字
     * @param $str
     * @return false|int|null
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:33:36
     */
    public static function chsAlphaNum($str)
    {
        return preg_match(self::$defaultRegex['chsAlphaNum'],$str);
    }

    /**
     * 验证某个字段的值只能是
     * 汉字、字母、数字和下划线_及破折号-
     * @param $str
     * @return false|int|null
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:33:36
     */
    public static function chsDash($str)
    {
        return preg_match(self::$defaultRegex['chsDash'],$str);
    }

    /**
     * 验证某个字段的值是否为
     * 字母和数字，下划线_及破折号-
     * @param $str
     * @return false|int|null
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:33:36
     */
    public static function alphaDash($str)
    {
        return preg_match(self::$defaultRegex['chsDash'],$str);
    }


    /**
     * 验证是否为邮政编码
     * @param $str
     * @return false|int|null
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:33:36
     */
    public static function zip($str)
    {
        return preg_match(self::$defaultRegex['zip'],$str);
    }


    /**
     * 验证是否为手机号码
     * @param $str
     * @return false|int|null
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:33:36
     */
    public static function mobile($str)
    {
        return preg_match(self::$defaultRegex['mobile'],$str);
    }


    /**
     * 验证身份证号码
     * @param $str
     * @return false|int|null
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:33:28
     */
    public static function idCard($str)
    {
        return preg_match(self::$defaultRegex['idCard'],$str);
    }


    /**
     * 验证字段值是否为有效邮箱格式
     * @param $str
     * @return mixed
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:37:27
     */
    public static function email($str)
    {
        return filter_var($str,self::$filter['email']);
    }

    /**
     * 验证某个字段的值是否为有效的URL地址
     * @param $str
     * @return mixed
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:37:27
     */
    public static function url($str)
    {
        return filter_var($str,self::$filter['url']);
    }



    /**
     * 验证某个字段的值是否为有效的IP地址
     * @param $str
     * @return mixed
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2022/3/27 19:37:27
     */
    public static function ip($str)
    {
        return filter_var($str,self::$filter['ip']);
    }


}