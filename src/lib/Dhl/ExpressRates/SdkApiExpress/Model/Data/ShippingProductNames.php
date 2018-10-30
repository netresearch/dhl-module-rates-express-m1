<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Model\Data;

use Dhl\Express\Api\Data\ShippingProductsInterface as ShippingProducts;

/**
 * ShippingProductNames.
 *
 * @package  Dhl\Express\Model\Data
 * @author   Andreas Müller <andreas.mueller@netresearch.de>
 * @license  https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://www.netresearch.de/
 */
class ShippingProductNames
{
    /**
     * International Express product names
     */
    protected  $productNamesInternational = array(
        'EXPRESS WORLDWIDE' => array(
            ShippingProducts::CODE_INTERNATIONAL_WORLDWIDE_DUTIABLE,
            ShippingProducts::CODE_INTERNATIONAL_WORLDWIDE_DUTYFREE_OUTSIDE_EU,
            ShippingProducts::CODE_INTERNATIONAL_WORLDWIDE_DUTYFREE_WITHIN_EU,
        ),
        'EXPRESS 12:00' => array(
            ShippingProducts::CODE_INTERNATIONAL_12_00_DUTIABLE,
            ShippingProducts::CODE_INTERNATIONAL_12_00_DUTYFREE,
        ),
        'ECONOMY SELECT' => array(
            ShippingProducts::CODE_INTERNATIONAL_ECONOMY_SELECT_H,
            ShippingProducts::CODE_INTERNATIONAL_ECONOMY_SELECT_W
        )
    );

    /**
     * Domestic Express product names
     */
    protected $productNamesDomestic = array(
        'EXPRESS DOMESTIC' => array(ShippingProducts::CODE_DOMESTIC),
        'EXPRESS DOMESTIC 12:00' => array(ShippingProducts::CODE_DOMESTIC_12_00)
    );

    /**
     * @return array
     */
    public function getProductNamesInternational()
    {
        return $this->productNamesInternational;
    }

    /**
     * @return array
     */
    public function getProductNamesDomestic()
    {
        return $this->productNamesDomestic;
    }
}
