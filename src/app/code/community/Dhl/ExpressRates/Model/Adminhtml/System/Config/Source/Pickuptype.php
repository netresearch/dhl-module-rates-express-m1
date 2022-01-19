<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Pickuptype
 *
 * @package Dhl\ExpressRates\Model\Adminhtml
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Pickuptype
{
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return array(
            array('value' => '1', 'label' => Mage::helper('dhl_expressrates/data')->__('Regularly scheduled pickup')),
            array(
                'value' => '0',
                'label' => Mage::helper('dhl_expressrates/data')->__('Ad hoc pickup or service point drop-off')
            ),
        );
    }
}
