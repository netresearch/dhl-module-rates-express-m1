<?php
/**
 * See LICENSE.md for license details.
 */

use Mage_Shipping_Model_Rate_Request;
use Mage_Shipping_Model_Rate_Result_Method;

/**
 * Dhl_ExpressRates_Model_Rate_RateProcessorInterface
 *
 * @package Dhl\ExpressRates\Model\Rate
 * @author  Andreas Müller <andreas.mueller@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
interface Dhl_ExpressRates_Model_Rate_RateProcessorInterface
{
    /**
     * @param Mage_Shipping_Model_Rate_Result_Method[] $methods
     * @param Mage_Shipping_Model_Rate_Request|null $request
     * @return Mage_Shipping_Model_Rate_Result_Method[]
     */
    public function processMethods(array $methods, $request = null);
}