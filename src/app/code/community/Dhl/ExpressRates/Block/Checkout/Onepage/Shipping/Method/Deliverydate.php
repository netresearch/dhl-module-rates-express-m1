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
     * @return string
     */
    public function getEstimatedDeliveryDates()
    {
        $quote           = $this->getQuote();
        $shippingAddress = $quote->getShippingAddress();

        $jsonData = [];

        /** @var Dhl_ExpressRates_Model_Quote_Address_Rate $rate */
        foreach ($shippingAddress->getGroupedAllShippingRates() as $groupRates) {
            foreach ($groupRates as $rate) {
                if ($rate->getCarrier() !== 'dhlexpress') {
                    continue;
                }

                $jsonData[] = [
                    'code'          => $rate->getCode(),
                    'delivery_date' => $rate->getDeliveryDate(),
                ];
            }
        }

        return Zend_Json::encode($jsonData);
    }
}
