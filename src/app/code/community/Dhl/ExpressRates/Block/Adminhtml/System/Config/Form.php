<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Block_Adminhtml_System_Config_Form
 *
 * @package Dhl\ExpressRates\Block
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Block_Adminhtml_System_Config_Form extends Mage_Adminhtml_Block_System_Config_Form
{
    const BASE_PATH = 'dhl_expressrates/adminhtml_system_config_form_element';

    /**
     * Method override to add custom field types.
     *
     * Use this class as frontend model for the system config section in which you want to make the custom field types
     * available. Be careful when overriding the frontend model of sections you do not own.
     *
     * @return string[]
     */
    protected function _getAdditionalElementTypes()
    {
        $result = array(
            'dhl_radioset' => Mage::getConfig()->getBlockClassName(self::BASE_PATH . '_radioset'),
            'dhl_checkboxset' => Mage::getConfig()->getBlockClassName(self::BASE_PATH . '_checkboxset'),
            'dhl_checkbox' => Mage::getConfig()->getBlockClassName(self::BASE_PATH . '_checkbox'),
        );

        return array_merge($result, parent::_getAdditionalElementTypes());
    }
}
