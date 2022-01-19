<?php
/**
 * See LICENSE.md for license details.
 */

use Dhl\Express\Api\Data\RateRequestInterface;
use Dhl\Express\Api\Data\RateResponseInterface;

/**
 * Class Dhl_ExpressRates_Model_Webservice_RateClient
 *
 * @package Dhl\ExpressRates\Model|Webservice
 * @link https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Webservice_RateClient
{
    /**
     * @var Dhl_ExpressRates_Model_Config
     */
    protected $moduleConfig;

    /**
     * @var Dhl_ExpressRates_Model_Logger_Mage
     */
    protected $logger;

    /**
     * Dhl_ExpressRates_Model_Webservice_RateClient constructor.
     */
    public function __construct()
    {
        /** @var Mage_Core_Model_Logger $logWriter */
        $logWriter = Mage::getSingleton('core/logger');
        $this->logger = new Dhl_ExpressRates_Model_Logger_Mage($logWriter);
        $this->moduleConfig = Mage::getSingleton('dhl_expressrates/config');
    }

    /**
     * @param RateRequestInterface $request
     * @return RateResponseInterface
     * @throws Mage_Core_Model_Store_Exception
     * @throws \Dhl\Express\Exception\RateRequestException
     * @throws \Dhl\Express\Exception\SoapException
     */
    public function performRatesRequest(RateRequestInterface $request)
    {
        $store = Mage::app()->getStore()->getId();
        $factory = new Dhl\Express\Webservice\SoapServiceFactory();
        $rateService = $factory->createRateService(
            $this->moduleConfig->getUsername($store),
            $this->moduleConfig->getPassword($store),
            $this->logger
        );

        return $rateService->collectRates($request);
    }
}
