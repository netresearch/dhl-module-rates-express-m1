<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Internationalproducts
 *
 * @package Dhl\ExpressRates\Model\Adminhtml
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Internationalproducts
{
    const DELIMITER = ';';

    /**
     * @var Dhl_ExpressRates_Model_Data_ShippingProductNames
     */
    protected $shippingProductNames;

    /**
     * Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Internationalproducts constructor.
     */
    public function __construct()
    {
        $this->shippingProductNames = Mage::getSingleton('dhl_expressrates/data_shippingProductNames');
    }

    /**
     * @inheritdoc
     */
    public function toOptionArray()
    {
        $options = $this->shippingProductNames->getProductNamesInternational();

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
