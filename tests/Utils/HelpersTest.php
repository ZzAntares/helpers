<?php

/**
 * This file is part of the Helpers library.
 *
 * @copyright 2015 César Antáres <zzantares@gmail.com>
 * @license http://opensource.org/licenses/MIT The MIT License.
 */

namespace ZzAntares\Helpers\Utils;

use Mockery;
use Carbon\Carbon;

class HelpersTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->helpers = new Helpers();
    }

    public function testParseEntries()
    {
        $entries = [
            ['30-12-2015', '16.67890'],
            ['18-01-2016', '17.07593'],
            ['27-01-2016', '18.28014'],
        ];

        $entries = $this->helpers->parseEntries($entries);
        $this->assertCount(3, $entries);
        $this->assertContainsOnly('array', $entries);

        foreach ($entries as $entry) {
            $this->assertInstanceOf(Carbon::class, $entry['date']);
            $this->assertInternalType('double', $entry['rate']);
        }
    }

    public function testMostRecentEntry()
    {
        $entries = [
            ['30-12-2015', '16.67890'],
            ['18-01-2016', '17.07593'],
            ['27-01-2016', '18.28014'],
        ];

        $recent = $this->helpers->mostRecentEntry($entries);

        $this->assertInstanceOf(Carbon::class, $recent['date']);
        $this->assertInternalType('double', $recent['rate']);
        $this->assertEquals(Carbon::parse($entries[2][0]), $recent['date']);
    }

    public function testParseNodes()
    {
        $leo = Mockery::mock(DOMNode::class);
        $leo->nodeValue = '    ';

        $raph = Mockery::mock(DOMNode::class);
        $raph->nodeValue = '28-02-2016';

        $mickey = Mockery::mock(DOMNode::class);
        $mickey->nodeValue = '   ';

        $donnie = Mockery::mock(DOMNode::class);
        $donnie->nodeValue = '18.31495';

        $nodes = [$leo, $raph, $mickey, $donnie];
        $nodes = $this->helpers->parseNodes($nodes);

        $this->assertCount(2, $nodes);
        $this->assertEquals(['28-02-2016', '18.31495'], $nodes);
    }
}
