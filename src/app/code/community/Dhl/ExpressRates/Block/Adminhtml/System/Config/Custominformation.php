<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Block_Adminhtml_System_Config_CustomInformation
 *
 * @category Dhl
 * @package  Dhl_ExpressRates
 * @author   Rico Sonntag <rico.sonntag@netresearch.de>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     http://www.netresearch.de/
 */
class Dhl_ExpressRates_Block_Adminhtml_System_Config_Custominformation extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * @param \Varien_Data_Form_Element_Abstract $element
     *
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $skinPath = Mage::getDesign()->getSkinBaseUrl(array('_area'=>'adminhtml'));
        $logoUrl  = $skinPath . 'images/dhl_expressrates/logo.svg';

        /** @var Dhl_ExpressRates_Helper_Data $helper */
        $helper = Mage::helper('dhl_expressrates');

        $moduleVersion = $helper->getModuleVersion();

        return <<<HTML
<div class="dhl-express-custom-info">
    <header>
        <img src="{$logoUrl}">
        <p class="info">Version {$moduleVersion}</p>
    </header>
    <div class="container">
        <div class="row">
            <div class="col col-l-7 col-xl-8 content">
                <p>Our DHL Express Rates at Checkout extension provides real-time DHL Express shipping quotes based on
                    your customer’s cart details and shipping address. You can also customize the price displayed to the
                    customer by automatically including insurance and a markup of your choosing.</p>
                <p>To get started:</p>
                <ol>
                    <li>
                        You must have a valid DHL Express business account<br/>
                        <small>If you don’t have an account or your account is with another DHL division,
                            <a href="https://mydhl.express.dhl/index/en.html" target="_blank">please contact DHL Express</a> to establish or expand your
                            relationship
                        </small>
                    </li>
                    <li>
                        Your DHL Express business account must be configured for API access<br/>
                        <small>If you didn’t discuss this with your account representative when you set up your account, please
                        consult them to enable your API access</small>
                    </li>
                </ol>
                <p>Also note, this extension will only display rates. It won’t produce shipping labels, schedule courier
                    pickups, or integrate tracking data to your store. Please use your current processes to book your
                    shipments with DHL Express or discuss available options with your account representative.</p>
            </div>
            <div class="col col-l-5 col-xl-4">
                <aside>
                    <div class="section">
                        <h3>DHL & Magento</h3>
                        <p>Having issues configuring the extension? Contact your DHL Express account
                                representative who will facilitate technical assistance.</p>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
HTML;
    }
}
