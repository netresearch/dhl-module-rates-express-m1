<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Shippingoptiondisplay
 *
 * @package Dhl\ExpressRates\Model\Adminhtml
 * @author  Andreas Müller <andreas.mueller@netreseach.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Shippingoptiondisplay
{
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return array(
            array('value' => '0', 'label' => Mage::helper('dhl_expressrates/data')->__('Cost only')),
            array(
                'value' => '1',
                'label' => Mage::helper('dhl_expressrates/data')
                    ->__('Cost and estimated delivery dates')
            ),
        );
    }
}
