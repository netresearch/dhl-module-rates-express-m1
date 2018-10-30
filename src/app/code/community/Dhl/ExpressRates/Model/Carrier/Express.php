<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Carrier_Express
 *
 * @package Dhl\ExpressRates\Model
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Carrier_Express
    extends Mage_Shipping_Model_Carrier_Abstract
    implements Mage_Shipping_Model_Carrier_Interface
{
    const CODE = 'dhlexpress';

    /**
     * @var string
     */
    protected $_code = self::CODE;

    /**
     * @var Dhl_ExpressRates_Model_Config
     */
    protected $moduleConfig;

    /**
     * @var Mage_Core_Model_Logger
     */
    protected $logWriter;

    /**
     * Dhl_ExpressRates_Model_Carrier_Express constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->moduleConfig = Mage::getModel('dhl_expressrates/config');
        $this->logWriter = Mage::getModel('core/logger');
    }


    /**
     * @inheritDoc
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        $store = $request->getStoreId();
        $username = $this->moduleConfig->getUsername($store);
        $password = $this->moduleConfig->getPassword($store);
        $accountNumber = $this->moduleConfig->getAccountNumber($store);

        $logger = new Dhl_ExpressRates_Model_Logger_Mage($this->logWriter);
        $factory = new Dhl\Express\Webservice\SoapServiceFactory();
        $client = $factory->createRateService($username, $password, $logger);

        //create dummy request
        $date = new DateTime('now');
        $readyTime = $date->modify('+2 day');
        $requestBuilder = new Dhl\Express\RequestBuilder\RateRequestBuilder();

        $requestBuilder->setShipperAccountNumber($accountNumber);
        $requestBuilder->setRecipientAddress(
            $request->getDestCountryId(),
            $request->getDestPostcode(),
            $request->getDestCity(),
            array(substr($request->getDestStreet(), 0, 35))
        );
        $requestBuilder->setShipperAddress(
            $request->getCountryId(),
            $request->getPostcode(),
            $request->getCity()
        );
        $requestBuilder->setIsUnscheduledPickup(true);
        $requestBuilder->setTermsOfTrade('DDU');
        $requestBuilder->addPackage(
            '123456',
            $request->getPackageWeight(),
            'KG',
            20,
            10,
            10,
            'CM',
            true
        );
        $requestBuilder->setContentType('NON_DOCUMENTS');
        $requestBuilder->setReadyAtTimestamp($readyTime);
        $requestBuilder->setIsValueAddedServicesRequested(false);
        $requestBuilder->setNextBusinessDayIndicator(false);

        $request = $requestBuilder->build();
        $result = Mage::getModel('shipping/rate_result');
        try {
            $rates = $client->collectRates($request);
            /** @todo(nr): Map rates to Magento Rate objects and append to rate result. */
        } catch(\Dhl\Express\Exception\ExpressApiException $exception) {
            $error = Mage::getModel('shipping/rate_result_error');
            $error->setCarrier(self::CODE);
            $error->setCarrierTitle($this->getConfigData('title'));
            $error->setErrorMessage($this->getConfigData('specificerrmsg'));
            $result->append($error);
        }

        return $result;
    }

    /**
     * This is only used in sales rules.
     * @see \Mage_SalesRule_Model_Rule_Condition_Address::getValueSelectOptions
     *
     * todo(nr): return the methods enabled via config ("offered products")
     * @link https://bugs.nr/DHLEX-16
     *
     * @inheritDoc
     */
    public function getAllowedMethods()
    {
        // code => title
        return array();
    }

}
