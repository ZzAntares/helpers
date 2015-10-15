<?php

/**
 * This file is part of the Helpers library.
 *
 * @copyright 2015 César Antáres <zzantares@gmail.com>
 * @license http://opensource.org/licenses/MIT The MIT License.
 */

namespace ZzAntares\Helpers\Converters;

class NumberToLetterTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->numberToLetter = new NumberToLetter();
    }

    public function testNumberToLetterWithIntegers()
    {
        $expected = 'Doce mil quinientos cuarenta';

        $this->assertEquals($expected, $this->numberToLetter->parse('12540'));
        $this->assertEquals($expected, $this->numberToLetter->parse(12540));
    }

    public function testNumberToLetterWithDecimal()
    {
        $expected = 'Ciento veintitrés con ochocientos noventa y uno';

        $this->assertEquals($expected, $this->numberToLetter->parse('123.891'));
        $this->assertEquals($expected, $this->numberToLetter->parse(123.891));
    }

    public function testNumberToLetterWithIntegerUnit()
    {
        $expected = 'Novecientos treinta pesos 90';

        $this->assertEquals(
            $expected,
            $this->numberToLetter->parse('930.90', false, '', 'pesos')
        );
    }

    public function testNumberToLetterWithCents()
    {
        $expected = 'Novecientos treinta pesos con noventa centavos';

        $this->assertEquals(
            $expected,
            $this->numberToLetter->parse('930.90', true, 'con', 'pesos', 'centavos')
        );
    }
}
