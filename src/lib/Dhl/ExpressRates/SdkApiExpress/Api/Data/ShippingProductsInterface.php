<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Api\Data;

/**
 * API Data Interface.
 *
 * @package  Dhl\Express\Api
 * @link     https://www.netresearch.de/
 */
interface ShippingProductsInterface
{
    /**
     * International Express product service codes
     */
    const CODE_INTERNATIONAL_WORLDWIDE_DUTYFREE_OUTSIDE_EU = 'D';
    const CODE_INTERNATIONAL_12_00_DUTYFREE = 'T';
    const CODE_INTERNATIONAL_WORLDWIDE_DUTYFREE_WITHIN_EU = 'U';

    const CODE_INTERNATIONAL_12_00_DUTIABLE = 'Y';
    const CODE_INTERNATIONAL_WORLDWIDE_DUTIABLE = 'P';
    const CODE_INTERNATIONAL_ECONOMY_SELECT_H = 'H';
    const CODE_INTERNATIONAL_ECONOMY_SELECT_W = 'W';

    /**
     * Domestic Express product service codes
     */
    const CODE_DOMESTIC_12_00 = '1';
    const CODE_DOMESTIC = 'N';
}
