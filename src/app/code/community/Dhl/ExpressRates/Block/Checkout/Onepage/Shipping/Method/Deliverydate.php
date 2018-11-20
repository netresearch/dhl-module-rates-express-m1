<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Block_Checkout_Onepage_Shipping_Method_Service
 *
 * @package Dhl\ExpressRates\Block
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Block_Checkout_Onepage_Shipping_Method_Deliverydate extends Mage_Checkout_Block_Onepage_Abstract
{
    /**
     * @return string   Json-encoded array of rate code and delivery date string pairs
     */
    public function getEstimatedDeliveryDates()
    {
        $quote           = $this->getQuote();
        $shippingAddress = $quote->getShippingAddress();
        $groupRates      = $shippingAddress->getGroupedAllShippingRates();
        $jsonData        = array();

        if (isset($groupRates[Dhl_ExpressRates_Model_Carrier_Express::CODE])) {
            /** @var \Mage_Sales_Model_Quote_Address_Rate $rate */
            foreach ($groupRates[Dhl_ExpressRates_Model_Carrier_Express::CODE] as $rate) {
                $jsonData[] = array(
                    'code'          => $rate->getCode(),
                    'delivery_date' => $rate->getMethodDescription(),
                );
            }
        }

        return Zend_Json::encode($jsonData);
    }
}
