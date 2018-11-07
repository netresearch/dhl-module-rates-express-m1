<?php
/**
 * See LICENSE.md for license details.
 */

use Dhl\Express\Model\Data\ShippingProducts;

/**
 * Dhl_ExpressRates_Model_Rate_Processor_FreeShipping
 *
 * @package Dhl\ExpressRates\Model\Rate
 * @author  Andreas Müller <andreas.mueller@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Rate_Processor_FreeShipping
    implements Dhl_ExpressRates_Model_Rate_RateProcessorInterface
{
    /**
     * The module configuration.
     *
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
     * Constructor.
     *
     */
    public function __construct()
    {
        $this->moduleConfig = Mage::getSingleton('dhl_expressrates/config');
        $this->store = Mage::app()->getStore();
        $this->shippingProducts = new ShippingProducts();
    }

    /**
     * @param Mage_Shipping_Model_Rate_Result_Method[] $methods
     * @param Mage_Shipping_Model_Rate_Request $request
     * @return Mage_Shipping_Model_Rate_Result_Method[]
     *
     * @throws Mage_Core_Model_Store_Exception
     */
    public function processMethods(array $methods, $request = null)
    {
        if ($request === null) {
            return $methods;
        }

        /** @var Mage_Shipping_Model_Rate_Request $request */
        $productsSubTotal = $this->getBaseSubTotalInclTax($request);
        $domesticBaseSubTotal = $this->moduleConfig->getDomesticFreeShippingSubTotal($request->getStoreId());
        $intlBaseSubTotal = $this->moduleConfig->getInternationalFreeShippingSubTotal($request->getStoreId());

        /** @var Mage_Shipping_Model_Rate_Result_Method $method */
        foreach ($methods as $method) {
            if ($this->isDomesticShipping($method)
                && $this->moduleConfig->isDomesticFreeShippingEnabled($request->getStoreId())
                && $this->isEnabledDomesticProduct($method)
            ) {
                $configuredSubTotal = $domesticBaseSubTotal;
            } elseif (!$this->isDomesticShipping($method)
                      && $this->moduleConfig->isInternationalFreeShippingEnabled($request->getStoreId())
                      && $this->isEnabledInternationalProduct($method)
            ) {
                $configuredSubTotal = $intlBaseSubTotal;
            } else {
                continue;
            }

            if ($productsSubTotal >= $configuredSubTotal) {
                $method->setPrice(0.0);
                $method->setCost(0.0);
            }
        }

        return $methods;
    }

    /**
     * Returns the base sub total value including tax. Checks if the value of virtual products should
     * be included in the sum.
     *
     * @param Mage_Shipping_Model_Rate_Request $request The rate request
     *
     * @return float
     */
    protected function getBaseSubTotalInclTax(Mage_Shipping_Model_Rate_Request $request)
    {
        if ($this->moduleConfig->isFreeShippingVirtualProductsIncluded($request->getStoreId())) {
            return $request->getBaseSubtotalInclTax();
        }

        $baseSubTotal = 0.0;

        if ($request->getAllItems()) {
            /** @var Mage_Sales_Model_Quote_Item $item */
            foreach ($request->getAllItems() as $item) {
                if (!$item->getProduct()->isVirtual()) {
                    $baseSubTotal += $item->getBasePriceInclTax();
                }
            }
        }

        return $baseSubTotal;
    }

    /**
     * Returns whether the given method applies to domestic shipping or not.
     *
     * @param Mage_Shipping_Model_Rate_Result_Method $method The rate method
     * @return bool
     */
    protected function isDomesticShipping(Mage_Shipping_Model_Rate_Result_Method $method)
    {
        return \in_array(
            $method->getMethod(),
            $this->shippingProducts->getProductsDomestic(),
            true
        );
    }

    /**
     * Returns whether the product is enabled in the configuration or not.
     *
     * @param Mage_Shipping_Model_Rate_Result_Method $method The rate method
     * @return bool
     */
    protected function isEnabledDomesticProduct(Mage_Shipping_Model_Rate_Result_Method $method)
    {
        return \in_array(
            $method->getData('method'),
            $this->moduleConfig->getDomesticFreeShippingProducts($this->store->getId()),
            true
        );
    }

    /**
     * Returns whether the product is enabled in the configuration or not.
     *
     * @param Mage_Shipping_Model_Rate_Result_Method $method The rate method
     *
     * @return bool
     */
    protected function isEnabledInternationalProduct(Mage_Shipping_Model_Rate_Result_Method $method)
    {
        return \in_array(
            $method->getData('method'),
            $this->moduleConfig->getInternationalFreeShippingProducts($this->store->getId()),
            true
        );
    }
}
