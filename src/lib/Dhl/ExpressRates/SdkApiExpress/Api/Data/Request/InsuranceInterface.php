<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Api\Data\Request;

/**
 * Insurance Interface.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
interface InsuranceInterface
{
    /**
     * Returns the value of the insurance.
     *
     * @return float
     */
    public function getValue();

    /**
     * Returns the currency code.
     *
     * @return string
     */
    public function getCurrencyCode();
}
