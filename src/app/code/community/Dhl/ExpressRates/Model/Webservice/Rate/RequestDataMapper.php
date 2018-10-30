<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Model_Webservice_Rate_RequestDataMapper
 *
 * @package Dhl\ExpressRates\Webservice\Rate
 * @author Paul Siedler <paul.siedler@netresearch.de>
 * @copyright 2018 Netresearch GmbH & Co. KG
 * @link http://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Webservice_Rate_RequestDataMapper
{
    /**
     * @var Dhl_ExpressRates_Model_Config
     */
    protected $moduleConfig;

    /**
     * @var Dhl\Express\RequestBuilder\RateRequestBuilder
     */
    protected $requestBuilder;

    /**
     * Dhl_ExpressRates_Model_Webservice_Rate_RequestDataMapper constructor.
     */
    public function __construct()
    {
        $this->moduleConfig = Mage::getSingleton('dhl_expressrates/config');
        $this->requestBuilder = new Dhl\Express\RequestBuilder\RateRequestBuilder();
    }

    /**
     * Maps the available application data to the DHL Express specific request object
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     *
     * @return \Dhl\Express\Model\RateRequest
     * @throws Mage_Core_Exception
     */
    public function mapRequest(Mage_Shipping_Model_Rate_Request $request)
    {
        $this->requestBuilder->setShipperAddress(
            $request->getCountryId(),
            $request->getPostcode(),
            $request->getCity()
        );

        $destPostcode = $request->getDestPostcode();
        $destCity = $request->getDestCity();
        if (empty($destPostcode)) {
            Mage::throwException('The recipient postal code is missing, which is required to calculate rates');
        }

        if (empty($destCity)) {
            Mage::throwException('The recipient city is missing, which is required to calculate rates');
        }

        $this->requestBuilder->setRecipientAddress(
            $request->getDestCountryId(),
            $destPostcode,
            $destCity,
            array(substr($request->getDestStreet(), 0, 35))
        );

        /**
         * @TODO(AMU): Switch to $this->build($request) once the method is fully implemented.
         */
        $this->buildFromDummyData($request);

        return $this->requestBuilder->build();
    }

    /**
     * Calculate the total weight of the package by adding the individiual weight of the items in the quote to the
     * configured packaging weight.
     *
     * @TODO(AMU): Implement and use $this->moduleConfig->getPackagingWeight($request->getWebsiteId()) for packaging
     * weight.
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return float
     */
    protected function calculatePackageWeight(Mage_Shipping_Model_Rate_Request $request)
    {
        $itemWeight = (float)$request->getPackageWeight();
        $packagingWeight = 1.02;

        return $itemWeight + $packagingWeight;
    }

    /**
     * @TODO(AMU): Remove once $this->build is finished.
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     */
    protected function buildFromDummyData(Mage_Shipping_Model_Rate_Request $request)
    {
        $date = new DateTime('now');
        $readyTime = $date->modify('+2 day');

        $this->requestBuilder->setShipperAccountNumber($this->moduleConfig->getAccountNumber($request->getStoreId()));
        $this->requestBuilder->setShipperAddress(
            $request->getCountryId(),
            $request->getPostcode(),
            $request->getCity()
        );
        $this->requestBuilder->setIsUnscheduledPickup(true);
        $this->requestBuilder->setTermsOfTrade('DDP');
        $this->requestBuilder->addPackage(
            '1',
            $this->calculatePackageWeight($request),
            'KG',
            20,
            10,
            10,
            'CM'
        );
        $this->requestBuilder->setContentType('NON_DOCUMENTS');
        $this->requestBuilder->setReadyAtTimestamp($readyTime);
        $this->requestBuilder->setIsValueAddedServicesRequested(false);
        $this->requestBuilder->setNextBusinessDayIndicator(false);
    }

    /**
     * @TODO(AMU): Implement necessary config getters, use pickupTime model to get ReadyAtTimestamp
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     */
    protected function build(Mage_Shipping_Model_Rate_Request $request)
    {
        $this->requestBuilder->addPackage(
            1,
            $this->calculatePackageWeight($request),
            $this->moduleConfig->getWeightUnit($request->getStoreId()),
            1,
            1,
            1,
            $this->moduleConfig->getDimensionsUOM()
        );

        $contentType = $this->moduleConfig
            ->isDutiableRoute($request->getDestCountryId(), $request->getStoreId())
            ? ShipmentDetails::CONTENT_TYPE_NON_DOCUMENTS
            : ShipmentDetails::CONTENT_TYPE_DOCUMENTS;

        $this->requestBuilder
            ->setContentType($contentType)
            ->setIsUnscheduledPickup(!$this->moduleConfig->isRegularPickup($request->getStoreId()))
            ->setTermsOfTrade($this->moduleConfig->getTermsOfTrade($request->getStoreId()))
            ->setIsValueAddedServicesRequested(true)
            ->setNextBusinessDayIndicator(true)
            ->setReadyAtTimestamp($this->pickupTime->getReadyAtTimestamp())
            ->setShipperAccountNumber($this->moduleConfig->getAccountNumber($request->getStoreId()));

        if ($this->moduleConfig->isInsured() &&
            $request->getPackagePhysicalValue() >= $this->moduleConfig->insuranceFromValue()
        ) {
            $this->requestBuilder->setInsurance(
                $request->getPackagePhysicalValue(),
                $request->getBaseCurrency()->getCurrencyCode()
            );
        }
    }
}
