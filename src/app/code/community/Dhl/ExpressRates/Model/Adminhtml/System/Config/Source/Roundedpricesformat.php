<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Roundedpricesformat
 *
 * @package Dhl\ExpressRates\Model\Adminhtml
 * @author  Andreas Müller <andreas.mueller@netreseach.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Roundedpricesformat
{
    /**
     * No rounding key.
     */
    const DO_NOT_ROUND = 'no_rounding';

    /**
     * Full price key.
     */
    const FULL_PRICE = 'full_price';

    /**
     * Static decimal key.
     */
    const STATIC_DECIMAL = 'static_decimal';
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => self::DO_NOT_ROUND,
                'label' => Mage::helper('dhl_expressrates/data')->__('Don\'t round prices')
            ),
            array(
                'value' => self::FULL_PRICE,
                'label' => Mage::helper('dhl_expressrates/data')->__('Round to a whole number (ex. 1 or 37)')
            ),
            array(
                'value' => self::STATIC_DECIMAL,
                'label' =>Mage::helper('dhl_expressrates/data')-> __('Round to a specific decimal value (ex. 99 cents)')
            ),
        );
    }
}
