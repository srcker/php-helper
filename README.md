# srcker/helper

常用函数库

# 安装
> composer require srcker/helper

```php
use srcker/helper/Time; // 时间工具
use srcker/helper/Str; // 字符串工具
use srcker/helper/Validate; // 常用格式验证
use srcker/helper/Desensitize; // 数据脱敏
```

# 使用

## 时间工具
```php
use srcker/helper/Time
```
方法

- 返回今日开始和结束的时间戳
```php
Time::today()
// 返回今天凌晨00:00:00 23:59:59 的时间戳数组
```


- 返回昨日开始和结束的时间戳
```php
Time::yesterday()
```

- 返回本周开始和结束的时间戳
```php
Time::week()
```

- 返回上周开始和结束的时间戳
```php
Time::lastWeek()
```

- 返回本月开始和结束的时间戳
```php
Time::month()
```

- 返回上个月开始和结束的时间戳
```php
Time::lastMonth()
```

- 返回今年开始和结束的时间戳
```php
Time::year()
```

- 返回去年开始和结束的时间戳
```php
Time::lastYear()
```

- 获取几天前零点到现在/昨日结束的时间戳
```php
/**
* 获取几天前零点到现在/昨日结束的时间戳
* @param int $day 天数
* @param bool $now 返回现在或者昨天结束时间戳
* @return array
*/
Time::dayToNow($day = 1, $now = true)
```

- 返回几天前的时间戳
```php
/**
* 返回几天前的时间戳
* @param int $day
* @return int
*/
Time::daysAgo($day = 1)
```

- 返回几天后的时间戳
```php
/**
* 返回几天后的时间戳
* @param int $day
* @return int
*/
Time::daysAfter($day = 1)
```

- 天数转换成秒数
```php
/**
* 天数转换成秒数
* @param int $day
* @return int
*/
Time::daysToSecond($day = 1)
```

- 周数转换成秒数
```php
/**
* 周数转换成秒数
* @param int $week
* @return int
*/
Time::weekToSecond($week = 1)
```

- 获取指定年月的开始和结束时间戳
```php
/**
* 获取指定年月的开始和结束时间戳
* @param int $y 年份
* @param int $m 月份
* @return array(开始时间,结束时间)
*/
Time::monthToSecond($y = 0, $m = 0)
```

- 友好时间显示
```php

// 一般用户评论列表啥的
// 输入参数为unix时间戳 返回为string类型
// 返回内容如（刚刚、几天前、几分钟前、几周前等）

/**
* 友好时间显示
* @param int $time
* @return false|string
*/
Time::friendlyDate($time = NULL)
```

- 获取当前时间戳（毫秒）
```php
Time::msectime($y = 0, $m = 0)
```


## 字符串函数
```php
use srcker/helper/Str
```
方法

- 随机生成字符串
```php
/**
 * @param int $length 长度
 * @param false $isNumber 是否为纯数字
 */
Str::random($length = 16,$isNumber = false)
```



## 数据脱敏
```php
use srcker/helper/Desensitize
```
方法

- 手机号码脱敏
```php
/**
 * @param $mobile 手机号码
 * @param $holder 占位符 默认为 ****
 * 默认为 188****1234 如把$holder（第二参数）换位 xxxx 则会返回 188xxxx1234
 */
Desensitize::mobile($mobile='',$holder='****')
```



- 身份证号码脱敏
```php
/**
 * @param $number 身份证号码
 * @param $start 开始第几位脱敏 0开始算
 * @param $length 脱敏长度
 * @param $holder 脱敏占位符
 * @return false|string
 */
Desensitize::idCard($number='', $start = 6, $length = 14, $holder = '*')
```


