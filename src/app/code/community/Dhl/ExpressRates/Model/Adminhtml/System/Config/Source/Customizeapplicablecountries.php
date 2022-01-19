<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Customizeapplicablecountries
 *
 * @package Dhl\ExpressRates\Model\Backend\Config\Source
 * @link https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Customizeapplicablecountries
{
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return array(
            array(
                'value' => '0',
                'label' => Mage::helper('dhl_expressrates/data')->__('Use default countries from General > Country')
            ),
            array(
                'value' => '1',
                'label' => Mage::helper('dhl_expressrates/data')->__('Create a customized country list')
            ),
        );
    }
}
