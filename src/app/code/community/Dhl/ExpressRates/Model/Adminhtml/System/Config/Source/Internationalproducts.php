<?php
/**
 * See LICENSE.md for license details.
 */
use Dhl\Express\Model\Data\ShippingProductNames;

/**
 * Class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Internationalproducts
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
     * @var ShippingProductNames
     */
    protected $shippingProductNames;

    /**
     * Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Internationalproducts constructor.
     */
    public function __construct()
    {
        $this->shippingProductNames = new ShippingProductNames();
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
