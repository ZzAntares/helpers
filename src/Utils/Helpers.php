<?php

/**
 * This file is part of the Helpers library.
 *
 * @copyright 2015 César Antáres <zzantares@gmail.com>
 * @license http://opensource.org/licenses/MIT The MIT License.
 */

namespace ZzAntares\Helpers\Utils;

class Helpers
{
    /**
     * Given an associative array with entries, each of one consisting of keys
     * 'date' and 'rate', found the most recent one and returns it.
     *
     * @return float
     */
    public function mostRecentEntry($entries)
    {
        $entries = $this->parseEntries($entries);

        $pivot = null;
        foreach ($entries as $entry) {
            if (!$pivot or $pivot['date']->lte($entry['date'])) {
                $pivot = $entry;
            }
        }

        return $pivot;
    }

    /**
     * Given an array of entries each consisting of an array of the form:
     *   ['12-12-2012', '12.12345']
     *
     * It gives back an array of the form:
     *   ['date' => Carbon, 'rate' => float]
     *
     * Thus the result array will be easier to manipulate.
     *
     * @param array $entries
     *
     * @return array
     */
    public function parseEntries($entries)
    {
        $items = [];
        foreach ($entries as $entry) {
            $items[] = [
                'date' => \Carbon\Carbon::parse($entry[0]),
                'rate' => round(floatval($entry[1]), 4),
            ];
        }

        return $items;
    }


    /**
     * Given a NodeList iterates on it to found nodes with actual value inside,
     * and gives them back in an array.
     *
     * @param DOMNodeList $nodes The list of nodes to prune.
     *
     * @return array
     */
    public function parseNodes($nodes)
    {
        $elements = [];
        foreach ($nodes as $child) {
            if (trim($child->nodeValue)) {
                $elements[] = $child->nodeValue;
            }
        }

        return $elements;
    }
}
