<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Block_Adminhtml_System_Config_CustomInformation
 *
 * @package Dhl\ExpressRates\Block
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Block_Adminhtml_System_Config_Custominformation
    extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * Init template.
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if (!$this->getTemplate()) {
            $this->setTemplate('dhl_expressrates/system/config/custominformation.phtml');
        }

        return $this;
    }

    /**
     * Returns the rendered template.
     *
     * @param \Varien_Data_Form_Element_Abstract $element
     *
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }

    /**
     * Returns the current module version.
     *
     * @return string
     */
    public function getModuleVersion()
    {
        /** @var Dhl_ExpressRates_Helper_Data $helper */
        $helper = Mage::helper('dhl_expressrates');
        return $helper->getModuleVersion();
    }

    /**
     * Returns the logo image URL.
     *
     * @return string
     */
    public function getLogoUrl()
    {
        return Mage::getDesign()->getSkinUrl('images/dhl_expressrates/logo.svg');
    }
}
