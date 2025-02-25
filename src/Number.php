<?php
/**
 * @project php-helper
 * @package srcker\helper
 * @class   Number.php
 * @author  Sinda
 * @email   sinda@srcker.com
 * @time    2025/2/25
 */

namespace srcker\helper;

use NumberFormatter;
use RuntimeException;

class Number
{
    /**
     * The current default locale.
     *
     * @var string
     */
    protected static string $locale = 'en';

    /**
     * The current default currency.
     *
     * @var string
     */
    protected static string $currency = 'USD';

    /**
     * 格式化数字
     *
     * @param int|float $number 需要格式化的数字
     * @param ?int $precision 小数点后的精度，默认为null
     * @param ?int $maxPrecision 最大小数点后的精度，默认为null
     * @param ?string $locale 本地化设置，默认为null
     * @return false|string 格式化后的数字字符串，如果格式化失败则返回false
     */
    public static function format(int|float $number, ?int $precision = null, ?int $maxPrecision = null, ?string $locale = null): false|string
    {
        static::ensureIntlExtensionIsInstalled();

        $formatter = new NumberFormatter($locale ?? static::$locale, NumberFormatter::DECIMAL);

        if (! is_null($maxPrecision)) {
            $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $maxPrecision);
        } elseif (! is_null($precision)) {
            $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
        }

        return $formatter->format($number);
    }

    /**
     * 将数字拼写成文字形式
     *
     * @param int|float $number 需要拼写的数字
     * @param ?string $locale 本地化设置，默认为null
     * @param ?int $after 当数字小于等于此值时直接格式化
     * @param ?int $until 当数字大于等于此值时直接格式化
     * @return false|string 拼写后的文字字符串，如果格式化失败则返回false
     */
    public static function spell(int|float $number, ?string $locale = null, ?int $after = null, ?int $until = null): false|string
    {
        static::ensureIntlExtensionIsInstalled();

        if (! is_null($after) && $number <= $after) {
            return static::format($number, locale: $locale);
        }

        if (! is_null($until) && $number >= $until) {
            return static::format($number, locale: $locale);
        }

        $formatter = new NumberFormatter($locale ?? static::$locale, NumberFormatter::SPELLOUT);

        return $formatter->format($number);
    }

    /**
     * 将数字转换为序数词形式
     *
     * @param int|float $number 需要转换的数字
     * @param ?string $locale 本地化设置，默认为null
     * @return string 序数词形式的数字字符串
     */
    public static function ordinal(int|float $number, ?string $locale = null): string
    {
        static::ensureIntlExtensionIsInstalled();

        $formatter = new NumberFormatter($locale ?? static::$locale, NumberFormatter::ORDINAL);

        return $formatter->format($number);
    }

    /**
     * 将数字拼写成序数词形式
     *
     * @param int|float $number 需要拼写的数字
     * @param string|null $locale 本地化设置，默认为null
     * @return string 拼写的序数词形式的数字字符串
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 12:00
     */
    public static function spellOrdinal(int|float $number, ?string $locale = null): string
    {
        static::ensureIntlExtensionIsInstalled();

        $formatter = new NumberFormatter($locale ?? static::$locale, NumberFormatter::SPELLOUT);

        $formatter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, '%spellout-ordinal');

        return $formatter->format($number);
    }

    /**
     * 计算并格式化百分比
     *
     * @param int|float $number 需要格式化的数字
     * @param int $precision 小数点后的精度，默认为0
     * @param ?int $maxPrecision 最大小数点后的精度，默认为null
     * @param ?string $locale 本地化设置，默认为null
     * @return false|string 格式化后的百分比字符串，如果格式化失败则返回false
     */
    public static function percentage(int|float $number, int $precision = 0, ?int $maxPrecision = null, ?string $locale = null): false|string
    {
        static::ensureIntlExtensionIsInstalled();

        $formatter = new NumberFormatter($locale ?? static::$locale, NumberFormatter::PERCENT);

        if (! is_null($maxPrecision)) {
            $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, $maxPrecision);
        } else {
            $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
        }

        return $formatter->format($number / 100);
    }

    /**
     * 格式化货币值
     *
     * @param int|float $number 要格式化的货币数值
     * @param string $in 货币代码，默认为空字符串
     * @param ?string $locale 本地化语言环境，默认为null
     * @param ?int $precision 小数点后的精度，默认为null
     * @return false|string 格式化后的货币字符串或false
     */
    public static function currency(int|float $number, string $in = '', ?string $locale = null, ?int $precision = null): false|string
    {
        static::ensureIntlExtensionIsInstalled();

        $formatter = new NumberFormatter($locale ?? static::$locale, NumberFormatter::CURRENCY);

        if (! is_null($precision)) {
            $formatter->setAttribute(NumberFormatter::FRACTION_DIGITS, $precision);
        }

        return $formatter->formatCurrency($number, ! empty($in) ? $in : static::$currency);
    }

    /**
     * 将字节数转换为人类可读的文件大小格式
     *
     * @param int|float $bytes 文件大小的字节数
     * @param int $precision 显示的小数位数
     * @param int|null $maxPrecision 最大小数位数限制
     * @return string 格式化后的文件大小字符串
     */
    public static function fileSize(int|float $bytes, int $precision = 0, ?int $maxPrecision = null): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        for ($i = 0; ($bytes / 1024) > 0.9 && ($i < count($units) - 1); $i++) {
            $bytes /= 1024;
        }

        return sprintf('%s %s', static::format($bytes, $precision, $maxPrecision), $units[$i]);
    }

    /**
     * 将数字缩写为人类可读的格式
     *
     * @param int|float $number 要缩写的数字
     * @param int $precision 缩写后的小数精度
     * @param int|null $maxPrecision 缩写后允许的最大小数精度
     * @return false|string 缩写后的数字字符串，如果失败则返回false
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:57
    */
    public static function abbreviate(int|float $number, int $precision = 0, ?int $maxPrecision = null): false|string
    {
        return static::forHumans($number, $precision, $maxPrecision, abbreviate: true);
    }

    /**
     * 将数字格式化为人类可读的形式
     * @param int|float $number 要格式化的数字
     * @param int $precision 小数点后的精度
     * @param int|null $maxPrecision 最大精度
     * @param bool $abbreviate 是否缩写数字（例如，使用K, M代替 thousand, million）
     * @return false|string 格式化后的字符串，如果失败则返回false
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:54
     */
    public static function forHumans(int|float $number, int $precision = 0, ?int $maxPrecision = null, bool $abbreviate = false): false|string
    {
        return static::summarize($number, $precision, $maxPrecision, $abbreviate ? [
            3 => 'K',
            6 => 'M',
            9 => 'B',
            12 => 'T',
            15 => 'Q',
        ] : [
            3 => ' thousand',
            6 => ' million',
            9 => ' billion',
            12 => ' trillion',
            15 => ' quadrillion',
        ]);
    }

    /**
     * Convert the number to its human-readable equivalent.
     *
     * @param  int|float  $number
     * @param  int  $precision
     * @param  int|null  $maxPrecision
     * @param  array  $units
     * @return string|false
     */
    protected static function summarize(int|float $number, int $precision = 0, ?int $maxPrecision = null, array $units = []): false|string
    {
        if (empty($units)) {
            $units = [
                3 => 'K',
                6 => 'M',
                9 => 'B',
                12 => 'T',
                15 => 'Q',
            ];
        }

        switch (true) {
            case floatval($number) === 0.0:
                return $precision > 0 ? static::format(0, $precision, $maxPrecision) : '0';
            case $number < 0:
                return sprintf('-%s', static::summarize(abs($number), $precision, $maxPrecision, $units));
            case $number >= 1e15:
                return sprintf('%s'.end($units), static::summarize($number / 1e15, $precision, $maxPrecision, $units));
        }

        $numberExponent = floor(log10($number));
        $displayExponent = $numberExponent - ($numberExponent % 3);
        $number /= pow(10, $displayExponent);

        return trim(sprintf('%s%s', static::format($number, $precision, $maxPrecision), $units[$displayExponent] ?? ''));
    }

    /**
     * 将数字限制在指定的最小值和最大值之间
     *
     * @param  int|float  $number
     * @param  int|float  $min
     * @param  int|float  $max
     * @return int|float
     */
    public static function clamp(int|float $number, int|float $min, int|float $max): float|int
    {
        return min(max($number, $min), $max);
    }

    /**
     * 将给定的数字分割成指定步长的区间对
     *
     * @param  int|float  $to
     * @param  int|float  $by
     * @param  int|float  $offset
     * @return array
     */
    public static function pairs(int|float $to, int|float $by, int|float $offset = 1): array
    {
        $output = [];

        for ($lower = 0; $lower < $to; $lower += $by) {
            $upper = $lower + $by;

            if ($upper > $to) {
                $upper = $to;
            }

            $output[] = [$lower + $offset, $upper];
        }

        return $output;
    }

    /**
     * 去除数字末尾的小数零
     *
     * @param  int|float  $number
     * @return int|float
     */
    public static function trim(int|float $number)
    {
        return json_decode(json_encode($number));
    }

    /**
     * 使用指定的本地化设置执行给定的回调函数
     *
     * @param  string  $locale
     * @param  callable  $callback
     * @return mixed
     */
    public static function withLocale(string $locale, callable $callback)
    {
        $previousLocale = static::$locale;

        static::useLocale($locale);

        return self::tap($callback(), fn () => static::useLocale($previousLocale));
    }

    /**
     * 使用指定的货币代码执行给定的回调函数
     *
     * @param  string  $currency
     * @param  callable  $callback
     * @return mixed
     */
    public static function withCurrency(string $currency, callable $callback): mixed
    {
        $previousCurrency = static::$currency;

        static::useCurrency($currency);

        return self::tap($callback(), fn() => static::useCurrency($previousCurrency));
    }

    /**
     * 设置当前的本地化设置
     * @param string $locale
     * @return void
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:54
     */
    public static function useLocale(string $locale): void
    {
        static::$locale = $locale;
    }

    /**
     * 设置当前的默认货币代码
     * @param string $currency
     * @return void
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:54
     */
    public static function useCurrency(string $currency): void
    {
        static::$currency = $currency;
    }

    /**
     * 获取当前的默认本地化设置
     * @return string
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:53
     */
    public static function defaultLocale(): string
    {
        return static::$locale;
    }

    /**
     * 获取当前的默认货币代码
     * @return string
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:53
     */
    public static function defaultCurrency(): string
    {
        return static::$currency;
    }

    /**
     * 确保intl扩展已安装
     * @return void
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 11:53
     */
    protected static function ensureIntlExtensionIsInstalled(): void
    {
        if (! extension_loaded('intl')) {
            $method = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
            throw new RuntimeException('The "intl" PHP extension is required to use the ['.$method.'] method.');
        }
    }


    /**
     * tap
     * @param $value
     * @param $callback
     * @return mixed
     * @author  Sinda
     * @email   sinda@srcker.com
     * @time    2025/2/25 12:05
     */
    private static function tap($value, $callback = null)
    {
        if (is_null($callback)) {
            return new $value;
        }
        $callback($value);
        return $value;
    }

}
