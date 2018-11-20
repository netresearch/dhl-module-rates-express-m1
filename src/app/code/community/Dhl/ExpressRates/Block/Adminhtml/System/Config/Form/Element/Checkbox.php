<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Block_Adminhtml_System_Config_Form_Field_Checkbox
 *
 * Implementation of a checkbox boolean input element that works inside the Magento system configuration.
 *
 * @package Dhl\ExpressRates\Block\Adminhtml
 */
class Dhl_ExpressRates_Block_Adminhtml_System_Config_Form_Element_Checkbox extends Varien_Data_Form_Element_Checkbox
{
    const PSEUDO_POSTFIX = '_pseudo'; // used to create the hidden input id.

    /**
     * @return string
     */
    public function getElementHtml()
    {
        /** @var string|Mage_Core_Model_Config_Element $value */
        $value = $this->getData('value');
        $this->setIsChecked((bool)(string)$value);
        $this->setData('after_element_html', $this->getSecondaryLabelHtml() . $this->getJsHtml());

        return parent::getElementHtml();
    }

    /**
     * @return string
     */
    public function getButtonLabel()
    {
        $label = isset($this->getData('field_config')->button_label)
            ? (string)$this->getData('field_config')->button_label
            : '';

        return $label;
    }

    /**
     * Add a hidden input whose value is kept in sync with the checked status of the checkbox.
     *
     * @return string
     */
    protected function getJsHtml()
    {
        $html = '<input type="hidden" id="%s" value="%s"/>
        <script>
            (function() {
                var checkbox = document.getElementById("%s");
                var hidden = document.getElementById("%s");
                /** Make the hidden input the submitted one. **/
                hidden.name = checkbox.name;
                checkbox.name = "";
                /**
                 * keep the hidden input value in sync with the checkbox. We also update the checkbox value because
                 * it may be needed by the core.
                 * 
                 * @see module-backend/view/adminhtml/templates/system/shipping/applicable_country.phtml
                 **/
                checkbox.addEventListener("change", function (event) {
                    checkbox.value = hidden.value = event.target.checked ? "1" : "0";
                });    
            })();   
        </script>';

        return sprintf(
            $html,
            $this->getHtmlId() . self::PSEUDO_POSTFIX,
            $this->getIsChecked() ? '1' : '0',
            $this->getHtmlId(),
            $this->getHtmlId() . self::PSEUDO_POSTFIX
        );
    }

    /**
     * @return string
     */
    protected function getSecondaryLabelHtml()
    {
        $html = '<label for="%s" class="admin__field-label">%s</label>';

        return sprintf(
            $html,
            $this->getHtmlId(),
            $this->getButtonLabel()
        );
    }
}
