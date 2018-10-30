<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Rate_CheckoutProvider
 *
 * @package Dhl\ExpressRates\Model\Rate
 * @author  Andreas Müller <andreas.mueller@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Rate_CheckoutProvider
{
    /**
     * @var Dhl_ExpressRates_Model_Webservice_RateAdapter
     */
    protected $rateAdapter;

    /**
     * Dhl_ExpressRates_Model_Rate_CheckoutProvider constructor.
     */
    public function __construct()
    {
        $this->rateAdapter = Mage::getModel('dhl_expressrates/webservice_rateAdapter');
    }

    /**
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     * @throws Mage_Core_Exception
     */
    public function getRates(Mage_Shipping_Model_Rate_Request $request)
    {
        $methods = $this->rateAdapter->getRates($request);
        /** @var Mage_Shipping_Model_Rate_Result $rateResult */
        $rateResult = Mage::getModel('shipping/rate_result');

        foreach ($methods as $method) {
            $rateResult->append($method);
        }

        if (empty($methods)) {
           Mage::throwException(
               Mage::helper('dhl_expressrates/data')->__('No rates returned from API.')
           );
        }

        return $rateResult;
    }
}
