<?php
/**
 * See LICENSE.md for license details.
 */
namespace Dhl\Express\Api\Data;

use Dhl\Express\Api\Data\Response\Rate\RateInterface;

/**
 * Rate Response Interface.
 *
 * DTO that carries relevant data for processing the rate result.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
interface RateResponseInterface
{
    /**
     * Returns the rates.
     *
     * @return RateInterface[]
     */
    public function getRates();
}
