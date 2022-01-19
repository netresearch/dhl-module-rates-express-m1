<?php
/**
 * See LICENSE.md for license details.
 */

use Dhl\Express\Api\Data\ShippingProductsInterface as ShippingProducts;

/**
 * Dhl_ExpressRates_Model_Data_ShippingProductNames
 *
 * @package  Dhl\Express\Model
 * @license  https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Data_ShippingProductNames
{
    /**
     * International Express product names
     */
    protected $productNamesInternational = array(
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
            ShippingProducts::CODE_INTERNATIONAL_ECONOMY_SELECT_W,
        )
    );

    /**
     * Domestic Express product names
     */
    protected $productNamesDomestic = array(
        'EXPRESS DOMESTIC' => array(
            ShippingProducts::CODE_DOMESTIC
        ),
        'EXPRESS DOMESTIC 12:00' => array(
            ShippingProducts::CODE_DOMESTIC_12_00
        ),
    );

    /**
     * @return string[][]
     */
    public function getProductNamesInternational()
    {
        return $this->productNamesInternational;
    }

    /**
     * @return string[][]
     */
    public function getProductNamesDomestic()
    {
        return $this->productNamesDomestic;
    }

    /**
     * @param string $code
     * @return string
     */
    public function getProductNameForCode($code)
    {
        $allNames = array_merge($this->getProductNamesInternational(), $this->getProductNamesDomestic());
        foreach ($allNames as $name => $codes) {
            if (in_array($code, $codes, true)) {
                return $name;
            }
        }

        return '';
    }
}
