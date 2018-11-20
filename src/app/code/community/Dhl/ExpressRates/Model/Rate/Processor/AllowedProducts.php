<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Rate_Processor_AllowedProducts
 *
 * @package Dhl\ExpressRates\Model\Rate
 * @author  Andreas Müller <andreas.mueller@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Rate_Processor_AllowedProducts
    implements Dhl_ExpressRates_Model_Rate_RateProcessorInterface
{
    /**
     * @var Dhl_ExpressRates_Model_Config
     */
    protected $moduleConfig;

    /**
     * @var Mage_Core_Model_Store
     */
    protected $store;

    /**
     * Dhl_ExpressRates_Model_Rate_Processor_AllowedProducts constructor.
     *
     * @throws Mage_Core_Model_Store_Exception
     */
    public function __construct()
    {
        $this->moduleConfig = Mage::getSingleton('dhl_expressrates/config');
        $this->store = Mage::app()->getStore();
    }

    /**
     * @inheritdoc
     */
    public function processMethods(array $methods, Mage_Shipping_Model_Rate_Request $request = null)
    {
        $result = array();
        foreach ($methods as $method) {
            if ($this->isEnabledProduct($method)) {
                $result[] = $method;
            }
        }

        return $result;
    }

    /**
     * Returns whether the product is enabled in the configuration or not.
     *
     * @param Mage_Shipping_Model_Rate_Result_Method $method The rate method
     *
     * @return bool
     */
    protected function isEnabledProduct(Mage_Shipping_Model_Rate_Result_Method $method)
    {
        $storeId = $this->store->getId();
        $allowedDomestic      = $this->moduleConfig->getAllowedDomesticProducts($storeId);
        $allowedInternational = $this->moduleConfig->getAllowedInternationalProducts($storeId);
        $allowedProducts      = array_merge($allowedDomestic, $allowedInternational);

        return \in_array($method->getData('method'), $allowedProducts, true);
    }
}
