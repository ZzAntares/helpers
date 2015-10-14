<?php

/**
 * This file is part of the Helpers library.
 *
 * @copyright 2015 César Antáres <zzantares@gmail.com>
 * @license http://opensource.org/licenses/MIT The MIT License.
 */

if (!function_exists('number_to_letter')) {
    function number_to_letter($number)
    {
        $numberToLetter = new ZzAntares\Helpers\Converters\NumberToLetter();
        return $numberToLetter->parse($number);
    }
}

if (!function_exists('in_array_all')) {
    function in_array_all($needles, $haystack)
    {
        return !array_diff($needles, $haystack);
    }
}
