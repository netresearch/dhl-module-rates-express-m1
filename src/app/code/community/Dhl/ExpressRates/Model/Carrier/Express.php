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
     * @var Dhl_ExpressRates_Model_Rate_CheckoutProvider
     */
    protected $rateProvider;

    /**
     * Dhl_ExpressRates_Model_Carrier_Express constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->moduleConfig = Mage::getModel('dhl_expressrates/config');
        $this->logWriter = Mage::getModel('core/logger');
        $this->rateProvider = Mage::getModel('dhl_expressrates/rate_checkoutProvider');
    }

    /**
     * @inheritDoc
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        /** @var  Mage_Shipping_Model_Rate_Result $result */
        $result = Mage::getModel('shipping/rate_result');
        try {
            $rates = $this->rateProvider->getRates($request);
            /** @todo(nr): Map rates to Magento Rate objects and append to rate result. */
        } catch(Exception $exception){
            $result = Mage::getModel('shipping/rate_result');
            /** @var Mage_Shipping_Model_Rate_Result_Error $error */
            $error = Mage::getModel('shipping/rate_result_error');
            $logger = new Dhl_ExpressRates_Model_Logger_Mage($this->logWriter);

            $logger->error($exception->getMessage());
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
