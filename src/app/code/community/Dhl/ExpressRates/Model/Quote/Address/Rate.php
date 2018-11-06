<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Quote_Address_Rate
 *
 * @package Dhl\ExpressRates\Model
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Quote_Address_Rate extends Mage_Sales_Model_Quote_Address_Rate
{
    /**
     * {@inheritdoc}
     */
    public function importShippingRate(Mage_Shipping_Model_Rate_Result_Abstract $rate)
    {
        $addressRate = parent::importShippingRate($rate);

        if ($rate instanceof Mage_Shipping_Model_Rate_Result_Method) {
            $addressRate->setDeliveryDate($rate->getDeliveryDate());
        }

        return $addressRate;
    }
}
