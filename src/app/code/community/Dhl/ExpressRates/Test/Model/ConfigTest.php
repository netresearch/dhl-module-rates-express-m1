<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Test_Model_ConfigTest
 *
 * @package Dhl\ExpressRates\Test
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Test_Model_ConfigTest extends \EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     */
    public function autoloadIsDisabled()
    {
        Mage::app()->getStore()->setConfig(\Dhl_ExpressRates_Model_Config::CONFIG_XML_PATH_AUTOLOAD_ENABLED, '0');

        $this->assertFalse(Mage::getSingleton('dhl_expressrates/config')->isAutoloadEnabled());
    }

    /**
     * @test
     */
    public function autoloadIsEnabled()
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

    /**
     * @test
     * @loadFixture express
     */
    public function getAccountSettings()
    {
        $config = Mage::getModel('dhl_expressrates/config');

        $this->assertSame('123456789', $config->getAccountNumber('store_one'));
        $this->assertSame('123456', $config->getAccountNumber('store_two'));

        $this->assertSame('foo', $config->getUsername('store_one'));
        $this->assertSame('bar', $config->getUsername('store_two'));

        // save encrypted password in config
        $passwordOne = '5ecReTf00';
        $passwordTwo = '5ecReT84r';
        $passwordPath = sprintf(
            '%s/%s/%s',
            \Dhl_ExpressRates_Model_Config::CONFIG_SECTION,
            \Dhl_ExpressRates_Model_Config::CONFIG_GROUP,
            \Dhl_ExpressRates_Model_Config::CONFIG_FIELD_PASSWORD
        );
        Mage::app()->getStore('store_one')->setConfig($passwordPath, Mage::helper('core')->encrypt($passwordOne));
        Mage::app()->getStore('store_two')->setConfig($passwordPath, Mage::helper('core')->encrypt($passwordTwo));

        // assert password gets read decrypted via config model
        $this->assertSame($passwordOne, $config->getPassword('store_one'));
        $this->assertSame($passwordTwo, $config->getPassword('store_two'));
    }

    /**
     * @test
     * @loadFixture express
     */
    public function getLogSettings()
    {
        $config = Mage::getModel('dhl_expressrates/config');
        $loggingEnabled = $config->isLoggingEnabled('store_one');
        $this->assertFalse($loggingEnabled);
        $loggingEnabled = $config->isLoggingEnabled('store_two');
        $this->assertTrue($loggingEnabled);

        $logLevel = $config->getLogLevel('store_one');
        $this->assertSame(\Zend_Log::EMERG, $logLevel);
        $logLevel = $config->getLogLevel('store_two');
        $this->assertSame(\Zend_Log::ERR, $logLevel);
    }
}
