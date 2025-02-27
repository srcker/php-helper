<?php
/**
 * @project php-helper
 * @class   Time
 * @author  Sinda
 * @email   sinda@srcker.com
 * @time    2020/10/31 2:19 上午
 */

namespace srcker\helper;


class Time
{
    /**
     * 返回今日开始和结束的时间戳
     * @return array
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:43
     */
    public static function today(): array
    {
        list($y, $m, $d) = explode('-', date('Y-m-d'));
        return [
            mktime(0, 0, 0, $m, $d, $y),
            mktime(23, 59, 59, $m, $d, $y)
        ];
    }

    /**
     * 返回昨日开始和结束的时间戳
     * @return array
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:43
     */
    public static function yesterday(): array
    {
        $yesterday = date('d') - 1;
        return [
            mktime(0, 0, 0, date('m'), $yesterday, date('Y')),
            mktime(23, 59, 59, date('m'), $yesterday, date('Y'))
        ];
    }

    /**
     * 返回本周开始和结束的时间戳
     * @return array
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:43
     */
    public static function week(): array
    {
        list($y, $m, $d, $w) = explode('-', date('Y-m-d-w'));
        if($w == 0) $w = 7; //修正周日的问题
        return [
            mktime(0, 0, 0, $m, $d - $w + 1, $y), mktime(23, 59, 59, $m, $d - $w + 7, $y)
        ];
    }

    /**
     * 返回上周开始和结束的时间戳
     * @return array
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:43
     */
    public static function lastWeek(): array
    {
        $timestamp = time();
        return [
            strtotime(date('Y-m-d', strtotime("last week Monday", $timestamp))),
            strtotime(date('Y-m-d', strtotime("last week Sunday", $timestamp))) + 24 * 3600 - 1
        ];
    }

    /**
     * 返回本月开始和结束的时间戳
     * @return array
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:43
     */
    public static function month(): array
    {
        list($y, $m, $t) = explode('-', date('Y-m-t'));
        return [
            mktime(0, 0, 0, $m, 1, $y),
            mktime(23, 59, 59, $m, $t, $y)
        ];
    }

    /**
     * 返回上个月开始和结束的时间戳
     * @return array
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:43
     */
    public static function lastMonth(): array
    {
        $y = date('Y');
        $m = date('m');
        $begin = mktime(0, 0, 0, $m - 1, 1, $y);
        $end = mktime(23, 59, 59, $m - 1, date('t', $begin), $y);

        return [$begin, $end];
    }

    /**
     * 返回今年开始和结束的时间戳
     * @return array
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:43
     */
    public static function year(): array
    {
        $y = date('Y');
        return [
            mktime(0, 0, 0, 1, 1, $y),
            mktime(23, 59, 59, 12, 31, $y)
        ];
    }

    /**
     * 返回去年开始和结束的时间戳
     * @return array
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:43
     */
    public static function lastYear(): array
    {
        $year = date('Y') - 1;
        return [
            mktime(0, 0, 0, 1, 1, $year),
            mktime(23, 59, 59, 12, 31, $year)
        ];
    }


    /**
     * 获取几天前零点到现在/昨日结束的时间戳
     * @param int $day 天数
     * @param bool $now 返回现在或者昨天结束时间戳
     * @return array
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:43
     */
    public static function dayToNow(int $day = 1, bool $now = true): array
    {
        $end = time();
        if (!$now) {
            list($foo, $end) = self::yesterday();
        }

        return [
            mktime(0, 0, 0, date('m'), date('d') - $day, date('Y')),
            $end
        ];
    }

    /**
     * 返回几天前的时间戳
     * @param int $day
     * @return int
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:44
     */
    public static function daysAgo(int $day = 1): int
    {
        $nowTime = time();
        return $nowTime - self::daysToSecond($day);
    }

    /**
     * 返回几天后的时间戳
     * @param int $day
     * @return int
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:44
     */
    public static function daysAfter(int $day = 1): int
    {
        $nowTime = time();
        return $nowTime + self::daysToSecond($day);
    }

    /**
     * 天数转换成秒数
     * @param int $day
     * @return float|int
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:44
     */
    public static function daysToSecond(int $day = 1): float|int
    {
        return $day * 86400;
    }

    /**
     * 周数转换成秒数
     * @param int $week
     * @return float|int
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:44
     */
    public static function weekToSecond(int $week = 1): float|int
    {
        return self::daysToSecond() * 7 * $week;
    }


    /**
     * 获取指定年月的开始和结束时间戳
     * @param int $y 年份
     * @param int $m 月份
     * @return array (开始时间,结束时间)
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:44
     */
    public static function monthToSecond(int $y = 0, int $m = 0): array
    {
        $y = $y ? $y : date('Y');
        $m = $m ? $m : date('m');
        $d = date('t', strtotime($y.'-'.$m));

        return  [
            strtotime($y.'-'.$m),
            mktime(23,59,59,$m,$d,$y)
        ];
    }


    /**
     * 友好时间显示
     * @param $time
     * @return false|string 2.5小时前 2天前 3月前 2020-01-01 12:00:00
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:44
     */
    public static function friendlyDate($time = NULL): false|string
    {
        $text = '';
        $time = $time === NULL || $time > time() ? time() : intval($time);
        $t = time() - $time; //时间差 （秒）
        $y = date('Y', $time)-date('Y', time());//是否跨年
        switch($t){
            case $t == 0:
                $text = '刚刚';
                break;
            case $t < 60:
                $text = $t . '秒前'; // 一分钟内
                break;
            case $t < 60 * 60:
                $text = floor($t / 60) . '分钟前'; //一小时内
                break;
            case $t < 60 * 60 * 24:
                $text = floor($t / (60 * 60)) . '小时前'; // 一天内
                break;
            case $t < 60 * 60 * 24 * 3:
                $text = floor($time/(60*60*24)) ==1 ?'昨天 ' . date('H:i', $time) : '前天 ' . date('H:i', $time) ; //昨天和前天
                break;
            case $t < 60 * 60 * 24 * 30:
                $text = date('m月d日 H:i', $time); //一个月内
                break;
            case $t < 60 * 60 * 24 * 365&&$y==0:
                $text = date('m月d日', $time); //一年内
                break;
            default:
                $text = date('Y年m月d日', $time); //一年以前
                break;
        }
        return $text;
    }


    /**
     * 获取毫秒时间戳
     * @return float
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:45
     */
    public static function msectime(): float
    {
        list($msec, $sec) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }


}