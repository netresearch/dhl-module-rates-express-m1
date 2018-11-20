<?php
/**
 * See LICENSE.md for license details.
 */

use Varien_Data_Form_Element_Checkboxes as Checkboxes;

/**
 * Class Dhl_ExpressRates_Model_Data_Form_Element_Checkboxset
 *
 * Implementation of a checkbox set input element that works inside the Magento system configuration and mimics a
 * multiselect, concatenating the values of all selected options separated with a comma inside a hidden input.
 *
 * @package Dhl\ExpressRates\Model
 */
class Dhl_ExpressRates_Block_Adminhtml_System_Config_Form_Element_Checkboxset extends Checkboxes
{
    /**
     * @return string
     */
    public function getElementHtml()
    {
        $this->setData('value', $this->filterUnavailableValues());
        $this->setData('after_element_html', $this->getAfterHtml());

        return parent::getElementHtml();
    }

    /**
     * Add a hidden input whose value is kept in sync with the checked status of the checkboxes
     *
     * @return string
     */
    protected function getAfterHtml()
    {
        $html = '<input type="hidden" id="%s" value="%s"/>
        <script>
            (function() {
                var checkboxes = document.querySelectorAll("[name=\'%s\']");
                var hidden = document.getElementById("%s");
                /** Make the hidden input the submitted one. **/
                hidden.name = checkboxes.item(0).name;

                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].name = "";
                    var values = hidden.value.split(",");
                    if (values.indexOf(checkboxes[i].value) !== -1) {
                        checkboxes[i].checked = true;
                    }
                    /** keep the hidden input value in sync with the checkboxes. **/
                    checkboxes[i].addEventListener("change", function (event) {
                        var checkbox = event.target;
                        var values = hidden.value.split(",");
                        var valueAlreadyIncluded = values.indexOf(checkbox.value) !== -1; 
                        if (checkbox.checked && !valueAlreadyIncluded) {
                            values.push(checkbox.value);
                        } else if (!checkbox.checked && valueAlreadyIncluded) {
                            values.splice(values.indexOf(checkbox.value), 1)
                        }
                        hidden.value = values.filter(Boolean).join();
                    });
                }
            })();
        </script>';

        return sprintf(
            $html,
            $this->getHtmlId(),
            $this->getData('value'),
            $this->getName(),
            $this->getHtmlId()
        );
    }

    /**
     * Remove previously selected values whose option is not available any more.
     *
     * @return string
     */
    protected function filterUnavailableValues()
    {
        $values = explode(',', $this->getData('value'));
        $availableValues = array_map(
            function ($value) {
                return $value['value'];
            },
            $this->getData('values')
        );

        return implode(',', array_intersect($values, $availableValues));
    }
}
