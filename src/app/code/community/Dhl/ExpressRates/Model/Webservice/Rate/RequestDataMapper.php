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
    private $moduleConfig;

    public function __construct()
    {
        $this->moduleConfig = Mage::getModel('dhl_expressrates/config');
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
        $requestBuilder = new Dhl\Express\RequestBuilder\RateRequestBuilder();

        $requestBuilder->setShipperAddress(
            $request->getCountryId(),
            $request->getPostcode(),
            $request->getCity()
        );

        $postCode = $request->getDestPostcode();
        $city = $request->getDestCity();
        if (empty($postCode)) {
            Mage::throwException(
                Mage::helper('dhl_expressrates/data')
                    ->__('The recipient postal code is missing, which is required to calculate rates')
            );
        }

        if (empty($city)) {
            Mage::throwException(
                Mage::helper('dhl_expressrates/data')
                    ->__('The recipient city is missing, which is required to calculate rates')
            );
        }

        $requestBuilder->setRecipientAddress(
            $request->getDestCountryId(),
            $request->getDestPostcode(),
            $request->getDestCity(),
            array(substr($request->getDestStreet(), 0, 35))
        );

        /*$requestBuilder->addPackage(
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

        $requestBuilder
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
            $requestBuilder->setInsurance(
                $request->getPackagePhysicalValue(),
                $request->getBaseCurrency()->getCurrencyCode()
            );
        }
        */


        // work with dummy data
        $date = new DateTime('now');
        $readyTime = $date->modify('+1 day');

        $requestBuilder->setShipperAccountNumber($this->moduleConfig->getAccountNumber($request->getStoreId()));
        $requestBuilder->setShipperAddress(
            $request->getCountryId(),
            $request->getPostcode(),
            $request->getCity()
        );
        $requestBuilder->setIsUnscheduledPickup(true);
        $requestBuilder->setTermsOfTrade('DDP');
        $requestBuilder->addPackage('1', $this->calculatePackageWeight($request),'KG', 20, 10, 10,'CM', true);
        $requestBuilder->setContentType('NON_DOCUMENTS');
        $requestBuilder->setReadyAtTimestamp($readyTime);
        $requestBuilder->setIsValueAddedServicesRequested(false);
        $requestBuilder->setNextBusinessDayIndicator(false);
        return $requestBuilder->build();
    }

    /**
     * Calculate the total weight of the package by adding the individiual weight of the items in the quote to the
     * configured packaging weight.
     *
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return float
     */
    private function calculatePackageWeight(Mage_Shipping_Model_Rate_Request $request)
    {
        $itemWeight = (float)$request->getPackageWeight();
        #$packagingWeight = $this->moduleConfig->getPackagingWeight($request->getWebsiteId());
        $packagingWeight = 1.02;

        return $itemWeight + $packagingWeight;
    }
}
