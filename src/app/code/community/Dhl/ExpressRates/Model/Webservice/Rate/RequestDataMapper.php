<?php
/**
 * See LICENSE.md for license details.
 */

use Dhl\Express\Model\Request\Rate\ShipmentDetails;

/**
 * Class Dhl_ExpressRates_Model_Webservice_Rate_RequestDataMapper
 *
 * @package Dhl\ExpressRates\Webservice\Rate
 * @link https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Webservice_Rate_RequestDataMapper
{
    /**
     * @var Dhl_ExpressRates_Model_Config
     */
    private $moduleConfig;

    /**
     * @var Dhl\Express\RequestBuilder\RateRequestBuilder
     */
    private $requestBuilder;

    /**
     * @var Dhl_ExpressRates_Model_Rate_PickupTime
     */
    private $pickupTime;

    /**
     * Dhl_ExpressRates_Model_Webservice_Rate_RequestDataMapper constructor.
     */
    public function __construct()
    {
        $this->moduleConfig   = Mage::getSingleton('dhl_expressrates/config');
        $this->requestBuilder = new Dhl\Express\RequestBuilder\RateRequestBuilder();
        $this->pickupTime     = Mage::getSingleton('dhl_expressrates/rate_pickupTime');
    }

    /**
     * Maps the available application data to the DHL Express specific request object
     *
     * @param Mage_Shipping_Model_Rate_Request $request The rate request
     *
     * @return \Dhl\Express\Model\RateRequest
     * @throws Mage_Core_Exception
     */
    public function mapRequest(Mage_Shipping_Model_Rate_Request $request)
    {
        $this->requestBuilder->setShipperAddress(
            $request->getData('country_id'),
            $request->getData('postcode'),
            $request->getData('city')
        );

        $destinationPostcode = $request->getDestPostcode();
        $destinationCity     = $request->getDestCity();

        if (empty($destinationPostcode)) {
            Mage::throwException('The recipient postal code is missing, which is required to calculate rates');
        }

        if (empty($destinationCity)) {
            Mage::throwException('The recipient city is missing, which is required to calculate rates');
        }

        $this->requestBuilder->setRecipientAddress(
            $request->getDestCountryId(),
            $destinationPostcode,
            $destinationCity,
            array(substr($request->getDestStreet(), 0, 35))
        );

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
            ->setReadyAtTimestamp($this->pickupTime->getReadyAtTimestamp($request->getStoreId()))
            ->setShipperAccountNumber($this->moduleConfig->getAccountNumber($request->getStoreId()));

        if ($this->moduleConfig->isInsured($request->getStoreId()) &&
            $request->getPackagePhysicalValue() >= $this->moduleConfig->insuranceFromValue($request->getStoreId())
        ) {
            /** @var Mage_Directory_Model_Currency $baseCurrency*/
            $baseCurrency = $request->getBaseCurrency();

            $this->requestBuilder->setInsurance(
                $request->getPackagePhysicalValue(),
                $baseCurrency->getCurrencyCode()
            );
        }

        return $this->requestBuilder->build();
    }

    /**
     * Calculate the total weight of the package by adding the individual weight of the items in the quote to the
     * configured packaging weight.
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     *
     * @return float
     */
    protected function calculatePackageWeight(Mage_Shipping_Model_Rate_Request $request)
    {
        $itemWeight      = (float) $request->getPackageWeight();
        $packagingWeight = $this->moduleConfig->getPackagingWeight($request->getStoreId());

        return $itemWeight + $packagingWeight;
    }
}
