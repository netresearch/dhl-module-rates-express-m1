<?php
/**
 * See LICENSE.md for license details.
 */

use Dhl\Express\Model\Data\ShippingProductNames;

/**
 * Class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Domesticproducts
 *
 * @package Dhl\ExpressRates\Model\Adminhtml
 * @author  Andreas Müller <andreas.mueller@netreseach.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Domesticproducts
{
    const DELIMITER = ';';

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $productNames = new ShippingProductNames();
        $options = $productNames->getProductNamesDomestic();

        return array_map(
            function ($value, $label) {
                $value = implode(self::DELIMITER, $value);
                return array(
                    'value' => $value,
                    'label' => $label,
                );
            },
            $options,
            array_keys($options)
        );
    }
}
