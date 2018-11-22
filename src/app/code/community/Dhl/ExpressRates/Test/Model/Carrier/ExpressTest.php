<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Test_Model_Carrier_ExpressTest
 *
 * @package Dhl\ExpressRates\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Test_Model_Carrier_ExpressTest extends \EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     * @loadFixture express
     */
    public function collectRates()
    {
        $carrier = Mage::getSingleton('dhl_expressrates/carrier_express');
        $carrier->setData('store', 'store_one');
        $rateRequest = Mage::getModel('shipping/rate_request');
        $this->assertFalse($carrier->collectRates($rateRequest));
    }

    /**
     * @test
     */
    public function getAllowedMethods()
    {
        $carrier = Mage::getSingleton('dhl_expressrates/carrier_express');
        $allowedMethods = $carrier->getAllowedMethods();
        $this->assertInternalType('array', $allowedMethods);

        foreach ($allowedMethods as $methodCode => $methodTitle) {
            $this->assertInternalType('string', $methodCode);
            $this->assertInternalType('string', $methodTitle);

            $this->assertNotEmpty($methodCode);
            $this->assertNotEmpty($methodTitle);
        }
    }
}
