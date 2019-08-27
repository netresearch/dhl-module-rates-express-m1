<?php
/**
 * See LICENSE.md for license details.
 */

use Dhl\Express\Api\Data\ShippingProductsInterface as ShippingProducts;

/**
 * Dhl_ExpressRates_Model_Data_ShippingProducts
 *
 * @package  Dhl\Express\Model
 * @author   Andreas Müller <andreas.mueller@netresearch.de>
 * @license  https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Data_ShippingProducts
{
    protected $productsInternational = array(
        ShippingProducts::CODE_INTERNATIONAL_WORLDWIDE_DUTYFREE_OUTSIDE_EU,
        ShippingProducts::CODE_INTERNATIONAL_12_00_DUTYFREE,
        ShippingProducts::CODE_INTERNATIONAL_WORLDWIDE_DUTYFREE_WITHIN_EU,
        ShippingProducts::CODE_INTERNATIONAL_12_00_DUTIABLE,
        ShippingProducts::CODE_INTERNATIONAL_WORLDWIDE_DUTIABLE,
        ShippingProducts::CODE_INTERNATIONAL_ECONOMY_SELECT_H,
        ShippingProducts::CODE_INTERNATIONAL_ECONOMY_SELECT_W
    );

    protected $productsDomestic = array(
        ShippingProducts::CODE_DOMESTIC_12_00,
        ShippingProducts::CODE_DOMESTIC
    );

    /**
     * @return string[]
     */
    public function getProductsInternational()
    {
        return $this->productsInternational;
    }

    /**
     * @return string[]
     */
    public function getProductsDomestic()
    {
        return $this->productsDomestic;
    }
}
