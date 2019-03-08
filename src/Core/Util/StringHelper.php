<?php
namespace Framework\Core\Util;

class StringHelper
{
    public static function endsWith($string, $test)
    {
        $stringLength = strlen($string);
        $testLength = strlen($test);

        if ($testLength > $stringLength)
            return false;

        return substr_compare($string, $test, $stringLength - $testLength, $testLength) === 0;
    }
}