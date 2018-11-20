<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Block_Adminhtml_System_Config_Form_Field_Radioset
 *
 * Implementation of a radioset input element that works inside the Magento system configuration.
 *
 * @package Dhl\ExpressRates\Block\Adminhtml
 */
class Dhl_ExpressRates_Block_Adminhtml_System_Config_Form_Element_Radioset extends Varien_Data_Form_Element_Radios
{
    /**
     * @return string
     */
    public function getElementHtml()
    {
        $this->setDefaultValue();
        $this->setData('after_element_html', $this->getJsHtml());
        $this->setData('separator', '<br/>');

        return parent::getElementHtml();
    }

    /**
     * Add a hidden input whose value is kept in sync with the checked status of the checkbox.
     *
     * @return string
     */
    protected function getJsHtml()
    {
        return <<<HTML
<input type="hidden"
       id="{$this->getHtmlId()}"
       class="{$this->getData('class')}"
       name="{$this->getName()}"
       value="{$this->getData('value')}"/>
<script>
    (function() {
        var radios = document.querySelectorAll("input[type='radio'][name='{$this->getName()}']");
        var hidden = document.getElementById("{$this->getId()}");

        for (var i = 0; i < radios.length; i++) {
            radios[i].setAttribute('style', 'margin-right: 5px');
            if (radios[i].type === "radio") {
                radios[i].name += "[pseudo]";

                // Keep the hidden input value in sync with the radio inputs. We also create a change event for the
                // hidden input because core functionality might listen for it (and the original radio inputs will not
                // report the correct ID).
                //
                // @see module-backend/view/adminhtml/templates/system/shipping/applicable_country.phtml
                radios[i].addEventListener("change", function (event) {
                    event.stopPropagation();
                    hidden.value = event.target.value;

                    var newEvent = document.createEvent("HTMLEvents");
                    newEvent.initEvent("change", false, true);
                    hidden.dispatchEvent(newEvent);
                });
            }
        }
    })();
</script>
HTML;
    }

    /**
     * If no value is set in the database or config.xml, select the first option.
     */
    protected function setDefaultValue()
    {
        if ($this->getData('value') === false) {
            $options = $this->getData('values');
            if (isset($options[0]['value'])) {
                $this->setData('value', $options[0]['value']);
            }
        }
    }
}
