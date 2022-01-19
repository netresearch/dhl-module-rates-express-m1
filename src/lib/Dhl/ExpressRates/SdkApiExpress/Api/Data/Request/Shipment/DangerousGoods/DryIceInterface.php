<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Api\Data\Request\Shipment\DangerousGoods;

/**
 * Dry Ice Interface.
 *
 * @api
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
interface DryIceInterface
{
    /**
     * @return string
     */
    public function getContentId();

    /**
     * @return string
     */
    public function getUNCode();

    /**
     * @return float
     */
    public function getWeight();
}
