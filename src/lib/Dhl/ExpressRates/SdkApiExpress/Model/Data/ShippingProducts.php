<?php
/**
 * See LICENSE.md for license details.
 */

namespace Dhl\Express\Model\Data;

use Dhl\Express\Api\Data\ShippingProductsInterface as Products;

/**
 * Class ShippingProductNames
 *
 * @package  Dhl\Express\Model\Data
 * @author   Andreas Müller <andreas.mueller@netresearch.de>
 * @license  https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     https://www.netresearch.de/
 */
class ShippingProducts
{
    protected $productsInternational = array(
        Products::CODE_INTERNATIONAL_WORLDWIDE_DUTYFREE_OUTSIDE_EU,
        Products::CODE_INTERNATIONAL_12_00_DUTYFREE,
        Products::CODE_INTERNATIONAL_WORLDWIDE_DUTYFREE_WITHIN_EU,
        Products::CODE_INTERNATIONAL_12_00_DUTIABLE,
        Products::CODE_INTERNATIONAL_WORLDWIDE_DUTIABLE,
        Products::CODE_INTERNATIONAL_ECONOMY_SELECT_H,
        Products::CODE_INTERNATIONAL_ECONOMY_SELECT_W
    );
    protected $productsDomestic = array(
        Products::CODE_DOMESTIC_12_00,
        Products::CODE_DOMESTIC
    );

    /**
     * @return array
     */
    public function getProductsInternational()
    {
        return $this->productsInternational;
    }

    /**
     * @return array
     */
    public function getProductsDomestic()
    {
        return $this->productsDomestic;
    }

}
