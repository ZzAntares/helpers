<?php

/**
 * This file is part of the Helpers library.
 *
 * @copyright 2015 César Antáres <zzantares@gmail.com>
 * @license http://opensource.org/licenses/MIT The MIT License.
 */

namespace ZzAntares\Helpers\Converters;

use Mockery;
use ZzAntares\Helpers\Converters\ExchangeRates;

class ExchangeRatesTest extends \PHPUnit_Framework_TestCase
{
    public function testMxnToUsdConversion()
    {
        $converter = Mockery::mock(ExchangeRates::class)->makePartial();
        $converter->shouldReceive('usdMxn')
            ->andReturn(16.4694)
            ->getMock();

        $this->assertEquals(32.9388, $converter->fromUsd(2)->toMxn());
    }
}
