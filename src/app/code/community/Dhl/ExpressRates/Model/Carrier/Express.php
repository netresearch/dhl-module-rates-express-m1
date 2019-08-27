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
     * @var Dhl_ExpressRates_Model_Data_ShippingProductNames
     */
    protected $productNames;

    /**
     * @var Dhl_ExpressRates_Model_Rate_CheckoutProvider
     */
    protected $rateProvider;

    /**
     * @var Dhl_ExpressRates_Model_Config
     */
    protected $config;

    /**
     * Init dependencies.
     */
    protected function _construct()
    {
        parent::_construct();

        $this->productNames = Mage::getSingleton('dhl_expressrates/data_shippingProductNames');
        $this->rateProvider = Mage::getSingleton('dhl_expressrates/rate_checkoutProvider');
        $this->config = Mage::getSingleton('dhl_expressrates/config');
    }

    /**
     * @inheritDoc
     */
    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!$this->getConfigFlag('active')) {
            return false;
        }

        return $this->rateProvider->getRates($request);
    }

    /**
     * This is only used in sales rules.
     * @see \Mage_SalesRule_Model_Rule_Condition_Address::getValueSelectOptions
     *
     * @inheritDoc
     */
    public function getAllowedMethods()
    {
        $allowedCodes = array_merge(
            $this->config->getAllowedDomesticProducts(),
            $this->config->getAllowedInternationalProducts()
        );
        $result = array();
        foreach ($allowedCodes as $code) {
            $result[$code] = $this->productNames->getProductNameForCode($code);
        }

        return $result;
    }

    /**
     * Determine whether zip-code is required for the country of destination
     *
     * @param string|null $countryId
     * @return bool
     */
    public function isZipCodeRequired($countryId = null)
    {
        return true;
    }

    /**
     * Check if city option required
     *
     * @return boolean
     */
    public function isCityRequired()
    {
        return true;
    }
}
