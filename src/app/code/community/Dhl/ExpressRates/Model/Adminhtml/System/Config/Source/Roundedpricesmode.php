<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Roundedpricesmode
 *
 * @package Dhl\ExpressRates\Model\Adminhtml
 * @author  Andreas Müller <andreas.mueller@netreseach.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Roundedpricesmode
{
    /**
     * Round up key.
     */
    const ROUND_UP = 'round_up';

    /**
     * Round off key.
     */
    const ROUND_OFF = 'round_off';

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return array(
            array('value' => self::ROUND_UP,  'label' => Mage::helper('dhl_expressrates/data')->__('Round up')),
            array('value' => self::ROUND_OFF, 'label' => Mage::helper('dhl_expressrates/data')->__('Round down')),
        );
    }
}
