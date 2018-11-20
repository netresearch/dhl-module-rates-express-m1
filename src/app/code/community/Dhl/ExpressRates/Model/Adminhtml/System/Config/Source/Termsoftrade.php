<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Termsoftrade
 *
 * @package Dhl\ExpressRates\Model\Adminhtml
 * @author  Andreas Müller <andreas.mueller@netreseach.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Termsoftrade
{
    const TOD_DDP = 'DDP';

    const TOD_DDU = 'DDU';

    /**
     * Options getter
     *
     * @return mixed[]
     */
    public function toOptionArray()
    {
        $optionArray = array();

        $options = $this->toArray();
        foreach ($options as $value => $label) {
            $optionArray[] = array('value' => $value, 'label' => $label);
        }

        return $optionArray;
    }

    /**
     * Get options
     *
     * @return mixed[]
     */
    public function toArray()
    {
        return array(
            self::TOD_DDU => Mage::helper('dhl_expressrates/data')->__('Customer pays duties and taxes (DDU)'),
            self::TOD_DDP => Mage::helper('dhl_expressrates/data')->__('I will pay duties and taxes (DTP)'),
        );
    }
}
