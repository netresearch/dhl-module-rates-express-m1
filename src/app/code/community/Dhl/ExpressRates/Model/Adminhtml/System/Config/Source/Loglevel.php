<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Loglevel
 *
 * @package Dhl\ExpressRates\Model\Adminhtml
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Loglevel
{
    /**
     * Options getter
     *
     * @return mixed[][]
     */
    public function toOptionArray()
    {
        $optionArray = array();

        $options = $this->toArray();
        foreach ($options as $value => $label) {
            $optionArray[]= array('value' => $value, 'label' => $label);
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
            \Zend_Log::ERR   => Mage::helper('dhl_expressrates/data')->__('Log errors only'),
            \Zend_Log::DEBUG => Mage::helper('dhl_expressrates/data')->__('Log all API activities'),
        );
    }
}
