<?php
/**
 * See LICENSE.md for license details.
 */
use Dhl\Express\Api\Data\ShippingProductsInterface;

/**
 * Class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_InternationalProducts
 *
 * @package Dhl\ExpressRates\Model\Adminhtml
 * @author  Andreas Müller <andreas.mueller@netreseach.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Internationalproducts
{
    const DELIMITER = ';';

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $options = ShippingProductsInterface::PRODUCT_NAMES_INTERNATIONAL;

        return array_map(
            function ($label, $value) {
                $value = implode(self::DELIMITER, $value);
                return array(
                    'value' => $value,
                    'label' => $label,
                );
            },
            array_keys($options),
            $options
        );
    }
}
