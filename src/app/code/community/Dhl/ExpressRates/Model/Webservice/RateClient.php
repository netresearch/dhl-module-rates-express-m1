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
 * @author Paul Siedler <paul.siedler@netresearch.de>
 * @copyright 2018 Netresearch GmbH & Co. KG
 * @link http://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Webservice_RateClient
{
    /**
     * @var Dhl_ExpressRates_Model_Config
     */
    protected $moduleConfig;

    /**
     * @var Dhl_ExpressRates_Model_Logger_Writer
     */
    protected $logWriter;

    /**
     * Dhl_ExpressRates_Model_Webservice_RateClient constructor.
     */
    public function __construct()
    {
        $this->moduleConfig = Mage::getModel('dhl_expressrates/config');
        $this->logWriter = Mage::getModel('dhl_expressrates/logger_writer');
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
        $logger = new Dhl_ExpressRates_Model_Logger_Mage($this->logWriter);
        $factory = new Dhl\Express\Webservice\SoapServiceFactory();
        $rateService = $factory->createRateService(
            $this->moduleConfig->getUserName($store),
            $this->moduleConfig->getPassword($store),
            $logger
        );

        return $rateService->collectRates($request);
    }
}
