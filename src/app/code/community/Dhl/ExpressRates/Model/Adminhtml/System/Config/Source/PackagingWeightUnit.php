<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_PackagingWeightUnit
 *
 * @package Dhl\ExpressRates\Model\Adminhtml
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_PackagingWeightUnit
{
    const UOM_KG_LOWER = 'kgs';
    const UOM_LB_LOWER = 'lbs';

    /**
     * Options getter
     *
     * @return mixed[][]
     */
    public function toOptionArray()
    {
        $optionArray = array();
        $options     = $this->toArray();

        foreach ($options as $value => $label) {
            $optionArray[] = array(
                'value' => $value,
                'label' => $label,
            );
        }

        return $optionArray;
    }

    /**
     * Get options in "key-value" format
     *
     * @return string[]
     */
    public function toArray()
    {
        return array(
            self::UOM_KG_LOWER => Mage::helper('dhl_expressrates/data')->__('Kilograms'),
            self::UOM_LB_LOWER => Mage::helper('dhl_expressrates/data')->__('Pounds'),
        );
    }
}
