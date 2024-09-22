# srcker/helper

常用函数库

# 安装
> composer require srcker/helper

```php
use srcker/helper/Time; // 时间工具
use srcker/helper/Str; // 字符串工具
use srcker/helper/Validate; // 常用格式验证
use srcker/helper/Desensitize; // 数据脱敏
use srcker/helper/IdCard; // 身份证工具
```

# 使用

## 时间工具
```php
use srcker\helper\Time;

// 测试今日的开始和结束时间戳
echo "今日开始时间戳: " . Time::today()[0] . "\n"; 
echo "今日结束时间戳: " . Time::today()[1] . "\n";
// 今日开始时间戳: 1695667200
// 今日结束时间戳: 1695753599

// 测试昨日的开始和结束时间戳
echo "昨日开始时间戳: " . Time::yesterday()[0] . "\n";
echo "昨日结束时间戳: " . Time::yesterday()[1] . "\n";
// 昨日开始时间戳: 1695580800
// 昨日结束时间戳: 1695667199

// 测试本周的开始和结束时间戳
echo "本周开始时间戳: " . Time::week()[0] . "\n";
echo "本周结束时间戳: " . Time::week()[1] . "\n";
// 本周开始时间戳: 1695235200
// 本周结束时间戳: 1695753599

// 测试上周的开始和结束时间戳
echo "上周开始时间戳: " . Time::lastWeek()[0] . "\n";
echo "上周结束时间戳: " . Time::lastWeek()[1] . "\n";
// 上周开始时间戳: 1694630400
// 上周结束时间戳: 1695235199

// 测试本月的开始和结束时间戳
echo "本月开始时间戳: " . Time::month()[0] . "\n";
echo "本月结束时间戳: " . Time::month()[1] . "\n";
// 本月开始时间戳: 1693526400
// 本月结束时间戳: 1696118399

// 测试上个月的开始和结束时间戳
echo "上个月开始时间戳: " . Time::lastMonth()[0] . "\n";
echo "上个月结束时间戳: " . Time::lastMonth()[1] . "\n";
// 上个月开始时间戳: 1690848000
// 上个月结束时间戳: 1693526399

// 测试今年的开始和结束时间戳
echo "今年开始时间戳: " . Time::year()[0] . "\n";
echo "今年结束时间戳: " . Time::year()[1] . "\n";
// 今年开始时间戳: 1672531200
// 今年结束时间戳: 1704067199

// 测试去年开始和结束的时间戳
echo "去年开始时间戳: " . Time::lastYear()[0] . "\n";
echo "去年结束时间戳: " . Time::lastYear()[1] . "\n";
// 去年开始时间戳: 1640995200
// 去年结束时间戳: 1672531199

// 测试几天前到现在的时间戳
echo "三天前零点时间戳到现在: " . Time::dayToNow(3)[0] . "\n";
echo "三天前到现在结束时间戳: " . Time::dayToNow(3)[1] . "\n";
// 三天前零点时间戳到现在: 1695408000
// 三天前到现在结束时间戳: 1695732590

// 测试几天前的时间戳
echo "五天前时间戳: " . Time::daysAgo(5) . "\n";
// 五天前时间戳: 1695402590

// 测试几天后的时间戳
echo "两天后时间戳: " . Time::daysAfter(2) . "\n";
// 两天后时间戳: 1695912590

// 测试友好时间显示
$time = time() - 3600; // 一小时前的时间戳
echo "友好时间显示: " . Time::friendlyDate($time) . "\n";
// 友好时间显示: 1小时前

// 测试获取当前毫秒
echo "当前毫秒: " . Time::msectime() . "\n";
// 当前毫秒: 1695732590612
```

## 字符串函数
```php
use srcker/helper/Str

/**
 * 随机生成字符串
 * @param int $length 长度
 * @param false $isNumber 是否为纯数字
 */
Str::random($length = 16,$isNumber = false)
```



## 数据脱敏
```php
use srcker/helper/Desensitize
// 测试示例

echo "中文姓名: " . Desensitize::name('张三丰'); 
// 预期输出: 张**

echo "身份证号: " . Desensitize::idCard('11010519491231002X'); 
// 预期输出: 110************02X

echo "座机号: " . Desensitize::custom('010-12345678', 4, 6); 
// 预期输出: 0101******78

echo "手机号: " . Desensitize::mobile('13812345678'); 
// 预期输出: 138****5678

echo "地址: " . Desensitize::custom('北京市海淀区中关村', 3, 4); 
// 预期输出: 北京市****

echo "电子邮件: " . Desensitize::email('example@example.com'); 
// 预期输出: e******e@example.com

echo "密码: " . Desensitize::password('mysecretpassword'); 
// 预期输出: *******

echo "普通车牌: " . Desensitize::carLicense('粤B12345'); 
// 预期输出: 粤B****5

echo "新能源车牌: " . Desensitize::carLicense('粤BD12345'); 
// 预期输出: 粤BD***45

echo "银行卡号: " . Desensitize::bankCard('6228481234567890123'); 
// 预期输出: 622848******90123

```


- 身份证工具类
```php
use srcker\helper\IdCard;

// 测试身份证号码合法性
$idCardNumber = "11010519491231002X";

echo "身份证号: " . $idCardNumber . "\n";
echo "是否合法: " . (IdCard::isValid($idCardNumber) ? '合法' : '不合法') . "\n"; // 输出: 合法

// 测试获取生日
echo "生日: " . IdCard::getBirthday($idCardNumber) . "\n"; // 输出: 1949-12-31

// 测试获取年龄
echo "年龄: " . IdCard::getAge($idCardNumber) . "\n"; // 输出: 根据当前日期计算出的年龄

// 测试获取出生年份
echo "出生年份: " . IdCard::getYear($idCardNumber) . "\n"; // 输出: 1949

// 测试获取出生月份
echo "出生月份: " . IdCard::getMonth($idCardNumber) . "\n"; // 输出: 12

// 测试获取出生日期的天
echo "出生日期的天: " . IdCard::getDay($idCardNumber) . "\n"; // 输出: 31

// 测试获取性别
echo "性别: " . (IdCard::getGender($idCardNumber) == 1 ? '男' : '女') . "\n"; // 输出: 男

// 测试获取地区码
echo "地区码: " . IdCard::getArea($idCardNumber) . "\n"; // 输出: 110105
```


