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
     * @var Dhl_ExpressRates_Model_Logger_Mage
     */
    protected $logger;

    /**
     * @var Dhl_ExpressRates_Model_Config
     */
    protected $moduleConfig;

    /**
     * @var Dhl_ExpressRates_Model_Webservice_RateAdapter
     */
    protected $rateAdapter;

    /**
     * @var Dhl_ExpressRates_Model_Rate_RateProcessorInterface[]
     */
    protected $rateProcessors = array();

    /**
     * Dhl_ExpressRates_Model_Rate_CheckoutProvider constructor.
     */
    public function __construct()
    {
        /** @var Mage_Core_Model_Logger $logWriter */
        $logWriter = Mage::getSingleton('core/logger');
        $this->logger = new Dhl_ExpressRates_Model_Logger_Mage($logWriter);
        $this->moduleConfig = Mage::getSingleton('dhl_expressrates/config');
        $this->rateAdapter = Mage::getSingleton('dhl_expressrates/webservice_rateAdapter');
        $this->rateProcessors = array(
            Mage::getSingleton('dhl_expressrates/rate_processor_allowedProducts'),
            Mage::getSingleton('dhl_expressrates/rate_processor_handlingFee'),
            Mage::getSingleton('dhl_expressrates/rate_processor_roundedPrices'),
            Mage::getSingleton('dhl_expressrates/rate_processor_freeShipping'),
        );
    }

    /**
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result
     */
    public function getRates(Mage_Shipping_Model_Rate_Request $request)
    {
        /** @var Mage_Shipping_Model_Rate_Result $rateResult */
        $rateResult = Mage::getModel('shipping/rate_result');

        try {
            $methods = $this->rateAdapter->getRates($request);
            if (empty($methods)) {
                Mage::throwException('No rates returned from API.');
            }

            foreach ($this->rateProcessors as $rateProcessor) {
                $methods = $rateProcessor->processMethods($methods, $request);
            }

            foreach ($methods as $method) {
                $rateResult->append($method);
            }
        } catch (Mage_Core_Exception $exception) {
            $this->logger->error($exception->getMessage());

            /** @var Mage_Shipping_Model_Rate_Result_Error $error */
            $error = Mage::getModel('shipping/rate_result_error');
            $error->setData('carrier', Dhl_ExpressRates_Model_Carrier_Express::CODE);
            $error->setData('carrier_title', $this->moduleConfig->getTitle($request->getStoreId()));
            $error->setData('error_message', $this->moduleConfig->getSpecificErrorMessage($request->getStoreId()));
            $rateResult->append($error);
        }

        return $rateResult;
    }
}
