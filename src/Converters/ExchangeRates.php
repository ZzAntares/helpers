<?php

/**
 * This file is part of the Helpers library.
 *
 * @copyright 2015 César Antáres <zzantares@gmail.com>
 * @license http://opensource.org/licenses/MIT The MIT License.
 */

namespace ZzAntares\Helpers\Converters;

class ExchangeRates
{
    /**
     * Bootstraps the currency conversion process, by giving value in MXN will
     * later be converted to another currency, i.e. USD.
     *
     * @param float $amount Amount to be converted.
     * @return this
     */
    public function fromUsd($amount)
    {
        $this->currency = 'usd';
        $this->amount = $amount;

        return $this;
    }

    /**
     * Triggers the exchange conversion of the current quantity to the specified
     * currency.
     *
     * @return float
     */
    public function toMxn()
    {
        $exchangeRate = $this->currency . 'Mxn';

        return $this->amount * $this->$exchangeRate();
    }

    /**
     * Retrieves the exchange rate of the USD specified in MXN as calculated
     * from "http://dof.gob.mx/indicadores.php".
     *
     * @throws RuntimeException When client could not connect to the webserver
     *         at dof.gob.mx and thus USD value could not be retrieved.
     *
     * @return float
     */
    public function usdMxn()
    {
        $url = 'http://dof.gob.mx/indicadores.php';
        $webContent = file_get_contents($url);

        if (!$webContent) {
            throw RuntimeException("Couldn't connect to dof.gob.mx server!");
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($webContent);
        $items = $dom->getElementsByTagName('span');

        foreach ($items as $tag) {
            if (!$tag->hasAttribute('class')) {
                continue;
            }

            if ($tag->getAttribute('class') != 'tituloBloque4') {
                continue;
            }

            if ($tag->nodeValue != 'DOLAR') {
                continue;
            }

            $result = preg_match(
                '/(\d+.\d+)/',
                $tag->parentNode->nodeValue,
                $matches
            );

            return $result ? round(floatval($matches[0]), 4) : false;
        }
    }
}
