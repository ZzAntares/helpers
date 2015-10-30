<?php

/**
 * This file is part of the Helpers library.
 *
 * @copyright 2015 César Antáres <zzantares@gmail.com>
 * @license http://opensource.org/licenses/MIT The MIT License.
 */

if (!function_exists('number_to_letter')) {
    function number_to_letter(
        $number,
        $parseDecimal = true,
        $joinWith = 'con',
        $integerUnit = '',
        $decimalUnit = ''
    ) {
        $numberToLetter = new ZzAntares\Helpers\Converters\NumberToLetter();

        return $numberToLetter->parse(
            $number,
            $parseDecimal,
            $joinWith,
            $integerUnit,
            $decimalUnit
        );
    }
}

if (!function_exists('in_array_all')) {
    function in_array_all($needles, $haystack)
    {
        return !array_diff($needles, $haystack);
    }
}

if (!function_exists('from_usd_to_mxn')) {
    function from_usd_to_mxn($amount = 1)
    {
        $exchange = new ZzAntares\Helpers\Converters\ExchangeRates();

        return $exchange->fromUsd($amount)->toMxn();
    }
}
