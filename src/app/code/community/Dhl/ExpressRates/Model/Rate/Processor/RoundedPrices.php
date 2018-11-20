<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Rate_Processor_RoundedPrices
 *
 * @package Dhl\ExpressRates\Model\Rate
 * @author  Andreas Müller <andreas.mueller@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Rate_Processor_RoundedPrices implements Dhl_ExpressRates_Model_Rate_RateProcessorInterface
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
     * Dhl_ExpressRates_Model_Rate_Processor_RoundedPrices constructor.
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
        foreach ($methods as $method) {
            $method->setPrice(
                $this->roundPrice($method->getPrice())
            );
        }

        return $methods;
    }

    /**
     * Round a given price on the basis of the internal module configuration.
     *
     * @param float $price
     * @return float
     */
    protected function roundPrice($price)
    {
        $storeId = $this->store->getId();
        $format = $this->moduleConfig->getRoundedPricesFormat($storeId);
        // Do not round
        if ($format === Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Roundedpricesformat::DO_NOT_ROUND) {
            return $price;
        }

        // Price should be rounded to a given decimal value
        if ($format === Dhl_ExpressRates_Model_Adminhtml_System_Config_Source_Roundedpricesformat::STATIC_DECIMAL) {
            if ($this->moduleConfig->roundUp($storeId)) {
                $roundedPrice = $this->roundUpToStaticDecimal($price);
            } else {
                $roundedPrice = $this->roundOffToStaticDecimal($price);
            }

            return $roundedPrice;
        }

        // Price should be rounded to the next integral number.
        return $this->moduleConfig->roundUp($storeId) ? ceil($price) : floor($price);
    }

    /**
     * Round given price down to a configured decimal value.
     *
     * @param float $price
     * @return float
     */
    protected function roundOffToStaticDecimal($price)
    {
        $roundedDecimal = $this->moduleConfig->getRoundedPricesStaticDecimal($this->store->getId());
        $decimal = $price - floor($price);

        if ($decimal === $roundedDecimal) {
            return $price;
        }

        if ($decimal < $roundedDecimal) {
            $roundedPrice = floor($price) - 1 + $roundedDecimal;
            return $roundedPrice < 0 ? 0 : floor($price) - 1 + $roundedDecimal;
        }

        return floor($price) + $roundedDecimal;
    }

    /**
     * Round given price up to a configured decimal value.
     *
     * @param float $price
     * @return float
     */
    protected function roundUpToStaticDecimal($price)
    {
        $roundedDecimal = $this->moduleConfig->getRoundedPricesStaticDecimal($this->store->getId());
        $decimal = $price - floor($price);

        if ($decimal === $roundedDecimal) {
            return $price;
        }

        if ($decimal < $roundedDecimal) {
            return floor($price) + $roundedDecimal;
        }

        return ceil($price) + $roundedDecimal;
    }
}
