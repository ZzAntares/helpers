<?php

/**
 * This file is part of the Helpers library.
 *
 * @copyright 2015 César Antáres <zzantares@gmail.com>
 * @license http://opensource.org/licenses/MIT The MIT License.
 */

namespace ZzAntares\Helpers\Converters;

class NumberToLetter
{
    public function parse(
        $number,
        $parseDecimal = true,
        $joinWith = 'con',
        $integerUnit = '',
        $decimalUnit = ''
    ) {
        if (!is_numeric($number)) {
            throw \InvalidArgumentException("Not a number.");
        }

        $numbers = explode('.', $number);
        $string = $numbers[0];

        if (strlen($string) > 12) {
            throw \InvalidArgumentException("Can't convert 12 digits or more.");
        }

        $text = $this->translate($string);

        if (!empty($integerUnit)) {
            $text .= ' ' . $integerUnit;
        }

        if (isset($numbers[1])) {
            $decimal = $parseDecimal ? $this->translate($numbers[1]) : $numbers[1];

            if (!empty($joinWith)) {
                $joinWith .= ' ';
            }

            $text .= ' ' . $joinWith . $decimal;

            if (!empty($decimalUnit)) {
                $text .= ' ' . $decimalUnit;
            }
        }

        return ucfirst($text);
    }

    private function translate($numberString)
    {
        settype($numberString, 'string');
        $digitsLeft = strlen($numberString) % 3;
        $text = '';

        if ($digitsLeft != 0) {
            $digitsLeft = 3 - $digitsLeft;
        }

        for ($f = 1; $f <= $digitsLeft; ++$f) {
            $text .= '0';
        }

        $numberString = $text . $numberString;

        if (strlen($numberString) <= 3
            and $numberString[0] == 0
            and $numberString[1] == 0
            and $numberString[2] == 0
        ) {
            $resu = 'cero';
        } else {
            $cad1 = substr($numberString, strlen($numberString) - 3, 3);
            $resu = $this->transform($cad1);
        }

        if (strlen($numberString) > 3) {
            $resu2 = '';
            $cad2 = substr($numberString, strlen($numberString) - 6, 3);

            if ($cad2[0] == 0 and $cad2[1] == 0 and $cad2[2] == 1) {
                $resu2 = 'mil ';
            } elseif ($cad2[0] != 0 || $cad2[1] != 0 || $cad2[2] != 0) {
                $resu2 = $this->transform($cad2, 2) . 'mil ';
            }

            $resu = $resu2 . $resu;
        }

        if (strlen($numberString) > 6) {
            $resu2 = '';
            $cad3 = substr($numberString, strlen($numberString) - 9, 3);

            if ($cad3[0] == '0' and $cad3[1] == '0' and $cad3[2] == 1) {
                $resu2 = 'un millón ';
            } elseif ($cad3[0] != 0 || $cad3[1] != 0 || $cad3[2] != 0) {
                $resu2 = $this->transform($cad3, 2) . 'millones ';
            }

            $resu = $resu2 . $resu;
        }

        if (strlen($numberString) > 9) {
            $resu2 = '';
            $cad4 = substr($numberString, strlen($numberString) - 12, 3);

            if ($cad4[0] == '0' and $cad4[1] == '0' and $cad4[2] == 1) {
                if ($cad3[0] == 0 and $cad3[1] == 0 and $cad3[2] == 0) {
                    $resu2 = 'mil millones ';
                } else {
                    $resu2 = 'mil ';
                }
            } else {
                $resu2 = $this->transform($cad4, 2) . 'mil millones ';
            }

            $resu = $resu2 . $resu;
        }

        return trim($resu);
    }

    private function transform($number, $index = 1)
    {
        $text = '';

        if ($number[0] == 1 and $number[1] == 0 and $number[2] == 0) {
            return 'cien ';
        }

        switch ($number[0]) {
            case 1:
                $text .= 'ciento ';
                break;

            case 2:
                $text .= 'doscientos ';
                break;

            case 3:
                $text .= 'trescientos ';
                break;

            case 4:
                $text .= 'cuatrocientos ';
                break;

            case 5:
                $text .= 'quinientos ';
                break;

            case 6:
                $text .= 'seiscientos ';
                break;

            case 7:
                $text .= 'setecientos ';
                break;

            case 8:
                $text .= 'ochocientos ';
                break;

            case 9:
                $text .= 'novecientos ';
                break;
        }

        switch ($number[1]) {
            case 3:
                $text .= 'treinta ';
                break;

            case 4:
                $text .= 'cuarenta ';
                break;

            case 5:
                $text .= 'cincuenta ';
                break;

            case 6:
                $text .= 'sesenta ';
                break;

            case 7:
                $text .= 'setenta ';
                break;

            case 8:
                $text .= 'ochenta ';
                break;

            case 9:
                $text .= 'noventa ';
                break;
        }

        if ($number[2] >= 0 and $number[1] == 1) {
            switch ($number[1] . $number[2]) {
                case 10:
                    $text .= 'diez ';
                    break;

                case 11:
                    $text .= 'once ';
                    break;

                case 12:
                    $text .= 'doce ';
                    break;

                case 13:
                    $text .= 'trece ';
                    break;

                case 14:
                    $text .= 'catorce ';
                    break;

                case 15:
                    $text .= 'quince ';
                    break;

                case 16:
                    $text .= 'dieciseis ';
                    break;

                case 17:
                    $text .= 'diecisiete ';
                    break;

                case 18:
                    $text .= 'dieciocho ';
                    break;

                case 19:
                    $text .= 'diecinueve ';
                    break;
            }

            return $text;
        }

        if ($number[2] >= 0 and $number[1] == 2) {
            switch ($number[1] . $number[2]) {
                case 20:
                    $text .= 'veinte ';
                    break;

                case 21:
                    if ($index == 1) {
                        $text .= 'veintiuno ';
                    } else {
                        $text .= 'veintiun ';
                    }
                    break;

                case 22:
                    $text .= 'veintidos ';
                    break;

                case 23:
                    $text .= 'veintitrés ';
                    break;

                case 24:
                    $text .= 'veinticuatro ';
                    break;

                case 25:
                    $text .= 'veinticinco ';
                    break;

                case 26:
                    $text .= 'veintiseis ';
                    break;

                case 27:
                    $text .= 'veintisiete ';
                    break;

                case 28:
                    $text .= 'veintiocho ';
                    break;

                case 29:
                    $text .= 'veintinueve ';
                    break;
            }

            return $text;
        }
        if ($number[2] != 0 and $number[1] != 0) {
            if ($number[0] > 0 || $number[1] > 0) {
                $text .= 'y ';
            }
        }

        if ($number[1] != 1) {
            switch ($number[2]) {
                case 1:
                    if ($index == 1) {
                        $text .= 'uno ';
                    } else {
                        $text .= 'un ';
                    }
                    break;

                case 2:
                    $text .= 'dos ';
                    break;

                case 3:
                    $text .= 'tres ';
                    break;

                case 4:
                    $text .= 'cuatro ';
                    break;

                case 5:
                    $text .= 'cinco ';
                    break;

                case 6:
                    $text .= 'seis ';
                    break;

                case 7:
                    $text .= 'siete ';
                    break;

                case 8:
                    $text .= 'ocho ';
                    break;

                case 9:
                    $text .= 'nueve ';
                    break;
            }
        }

        return $text;
    }
}
