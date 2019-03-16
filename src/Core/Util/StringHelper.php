<?php
namespace Core\Util;

/**
 * Contains commonly used string functions.
 */
class StringHelper
{
    /**
     * Checks if a string ends with a given string.
     *
     * @param string $string The full string.
     * @param string $test The test string that we want to find out if it's at the end.
     * @return boolean Whether the string ends with a given string.
     */
    public static function endsWith($string, $test)
    {
        $stringLength = strlen($string);
        $testLength = strlen($test);

        if ($testLength > $stringLength)
            return false;

        return substr_compare($string, $test, $stringLength - $testLength, $testLength) === 0;
    }
}