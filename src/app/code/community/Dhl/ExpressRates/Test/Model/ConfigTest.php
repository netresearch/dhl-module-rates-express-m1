<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Test_Model_ConfigTest
 *
 * @package Dhl\ExpressRates\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Test_Model_ConfigTest extends \EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     */
    public function autoloadIsEnabled()
    {
        Mage::app()->getStore()->setConfig(\Dhl_ExpressRates_Model_Config::CONFIG_XML_PATH_AUTOLOAD_ENABLED, '0');

        $this->assertFalse(Mage::getSingleton('dhl_expressrates/config')->isAutoloadEnabled());
    }

    /**
     * @test
     */
    public function autoloadIsDisabled()
    {
        Mage::app()->getStore()->setConfig(\Dhl_ExpressRates_Model_Config::CONFIG_XML_PATH_AUTOLOAD_ENABLED, '1');

        $this->assertTrue(Mage::getSingleton('dhl_expressrates/config')->isAutoloadEnabled());
    }

    /**
     * @test
     * @loadFixture express
     */
    public function getCarrierTitle()
    {
        $carrier = Mage::getSingleton('dhl_expressrates/carrier_express');

        $carrier->setData('store', 1);
        $carrierTitle = $carrier->getConfigData('title');
        $this->assertInternalType('string', $carrierTitle);
        $this->assertSame('Express', $carrierTitle);
        $errorMsg = $carrier->getConfigData('specificerrmsg');
        $this->assertInternalType('string', $errorMsg);
        $this->assertSame('This shipping method is currently unavailable.', $errorMsg);

        $carrier->setData('store', 2);
        $carrierTitle = $carrier->getConfigData('title');
        $this->assertInternalType('string', $carrierTitle);
        $this->assertSame('Fast', $carrierTitle);
        $errorMsg = $carrier->getConfigData('specificerrmsg');
        $this->assertInternalType('string', $errorMsg);
        $this->assertSame('meow.', $errorMsg);
    }
}
