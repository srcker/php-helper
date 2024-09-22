<?php
namespace srcker\helper;


class idCard{

    /**
     * 验证身份证号码是否合法
     * @param string $idCard 身份证号码
     * @return bool 合法返回 true，不合法返回 false
     */
    public static function isValid($idCard)
    {
        $idCard = strtoupper($idCard); // 将字母转换为大写
        $idCardLength = strlen($idCard);

        // 判断长度是否正确
        if ($idCardLength != 18) {
            return false;
        }

        // 验证前17位是否是数字
        if (!preg_match('/^\d{17}(\d|X)$/', $idCard)) {
            return false;
        }

        // 验证校验码
        $weight = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        $validate = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];

        $sum = 0;
        for ($i = 0; $i < 17; $i++) {
            $sum += intval($idCard[$i]) * $weight[$i];
        }

        $mod = $sum % 11;

        return $validate[$mod] === $idCard[17];
    }

    /**
     * 通过身份证号码获取出生日期
     * @param string $idCard 身份证号码
     * @return string 生日，格式为 YYYY-MM-DD
     */
    public static function getBirthday($idCard)
    {
        return substr($idCard, 6, 4) . '-' . substr($idCard, 10, 2) . '-' . substr($idCard, 12, 2);
    }

    /**
     * 通过身份证号码获取年龄
     * @param string $idCard 身份证号码
     * @return int 年龄
     */
    public static function getAge($idCard)
    {
        $birthYear = substr($idCard, 6, 4);
        $birthMonth = substr($idCard, 10, 2);
        $birthDay = substr($idCard, 12, 2);

        $currentYear = date('Y');
        $currentMonth = date('m');
        $currentDay = date('d');

        $age = $currentYear - $birthYear;
        if ($currentMonth < $birthMonth || ($currentMonth == $birthMonth && $currentDay < $birthDay)) {
            $age--;
        }

        return $age;
    }

    /**
     * 通过身份证号码获取出生年份
     * @param string $idCard 身份证号码
     * @return string 出生年份
     */
    public static function getYear($idCard)
    {
        return substr($idCard, 6, 4);
    }

    /**
     * 通过身份证号码获取出生月份
     * @param string $idCard 身份证号码
     * @return string 出生月份
     */
    public static function getMonth($idCard)
    {
        return substr($idCard, 10, 2);
    }

    /**
     * 通过身份证号码获取出生日期的天
     * @param string $idCard 身份证号码
     * @return string 出生天
     */
    public static function getDay($idCard)
    {
        return substr($idCard, 12, 2);
    }

    /**
     * 通过身份证号码获取性别
     * @param string $idCard 身份证号码
     * @return int 性别，'1男' 或 '2女'
     */
    public static function getGender($idCard)
    {
        $genderCode = substr($idCard, 16, 1);
        return ($genderCode % 2 == 0) ? 2 : 1;
    }

    /**
     * 通过身份证号码获取地区信息（前6位表示地区）
     * @param string $idCard 身份证号码
     * @return string 地区码
     */
    public static function getArea($idCard)
    {
        // 身份证前6位表示地区，可以通过自定义映射来获取详细的地区信息。
        // 实际应用中，这里应该使用地区码表，这里仅返回前6位地区码。
        return substr($idCard, 0, 6);
    }

}

