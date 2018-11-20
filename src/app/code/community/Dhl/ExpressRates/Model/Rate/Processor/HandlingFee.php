<?php
/**
 * See LICENSE.md for license details.
 */

use Dhl\Express\Model\Data\ShippingProducts;
use Mage_Shipping_Model_Carrier_Abstract as AbstractCarrier;

/**
 * Dhl_ExpressRates_Model_Rate_Processor_HandlingFee
 *
 * @package Dhl\ExpressRates\Model\Rate
 * @author  Andreas Müller <andreas.mueller@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Rate_Processor_HandlingFee implements Dhl_ExpressRates_Model_Rate_RateProcessorInterface
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
     * @var ShippingProducts
     */
    protected $shippingProducts;

    /**
     * Dhl_ExpressRates_Model_Rate_Processor_HandlingFee constructor.
     *
     * @throws Mage_Core_Model_Store_Exception
     */
    public function __construct()
    {
        $this->moduleConfig = Mage::getSingleton('dhl_expressrates/config');
        $this->store = Mage::app()->getStore();
        $this->shippingProducts = new ShippingProducts();
    }

    /**
     * @inheritdoc
     */
    public function processMethods(array $methods, $request = null)
    {
        /** @var Mage_Shipping_Model_Rate_Result_Method $method */
        foreach ($methods as $method) {
            // Calculate fee depending on shipping type
            $price = $this->calculatePrice(
                $method->getData('price'),
                $this->getHandlingType($method),
                $this->getHandlingFee($method)
            );

            $method->setPrice($price);
            $method->setData('cost', $price);
        }

        return $methods;
    }

    /**
     * Returns the configured handling type depending on the shipping type.
     *
     * @param Mage_Shipping_Model_Rate_Result_Method $method The rate method
     *
     * @return string
     */
    protected function getHandlingType(Mage_Shipping_Model_Rate_Result_Method $method)
    {
        // Calculate fee depending on shipping type
        if ($this->isDomesticShipping($method)) {
            return $this->moduleConfig->getDomesticHandlingType($this->store->getId());
        }

        return $this->moduleConfig->getInternationalHandlingType($this->store->getId());
    }

    /**
     * Returns the configured handling fee depending on the shipping type.
     *
     * @param Mage_Shipping_Model_Rate_Result_Method $method The rate method
     *
     * @return float
     */
    protected function getHandlingFee(Mage_Shipping_Model_Rate_Result_Method $method)
    {
        // Calculate fee depending on shipping type
        if ($this->isDomesticShipping($method)) {
            return $this->moduleConfig->getDomesticHandlingFee($this->store->getId());
        }

        return $this->moduleConfig->getInternationalHandlingFee($this->store->getId());
    }

    /**
     * Returns whether the given method applies to domestic shipping or not.
     *
     * @param Mage_Shipping_Model_Rate_Result_Method $method The rate method
     *
     * @return bool
     */
    protected function isDomesticShipping(Mage_Shipping_Model_Rate_Result_Method $method)
    {
        return \in_array(
            $method->getData('method'),
            $this->shippingProducts->getProductsDomestic(),
            true
        );
    }

    /**
     * Calculates the shipping price altered by the handling type aqnd fee.
     *
     * @param float $amount The total price of the rated shipment for the product
     * @param string $handlingType The handling type determining the type of calculation to do
     * @param float $handlingFee The handling fee to apply to the amount
     *
     * @return float
     */
    protected function calculatePrice($amount, $handlingType, $handlingFee)
    {
        if ($handlingType === AbstractCarrier::HANDLING_TYPE_PERCENT) {
            $amount += $amount * $handlingFee / 100.0;
        } else {
            $amount += $handlingFee;
        }

        return $amount < 0.0 ? 0.0 : $amount;
    }
}
