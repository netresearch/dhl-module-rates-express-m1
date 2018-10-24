<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Test_Model_AutoloaderTest
 *
 * @package Dhl\ExpressRates\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Test_Model_AutoloaderTest extends \EcomDev_PHPUnit_Test_Case
{
    /**
     * unset module autoloader to assert it being registered properly again (or not)
     */
    private static function unregisterAutoload()
    {
        $autoloadFunctions = spl_autoload_functions();
        foreach ($autoloadFunctions as $autoloadFunction) {
            if (!is_array($autoloadFunction)) {
                continue;
            }

            if ($autoloadFunction[0] instanceof \Dhl_ExpressRates_Helper_Autoloader) {
                spl_autoload_unregister($autoloadFunction);
                break;
            }
        }

        $autoloader = Mage::getSingleton('dhl_expressrates/autoloader');
        \EcomDev_Utils_Reflection::setRestrictedPropertyValue($autoloader, '_isRegistered', false);
    }

    protected function setUp()
    {
        self::unregisterAutoload();

        // reset front controller to have event dispatched
        \EcomDev_Utils_Reflection::setRestrictedPropertyValue(Mage::app(), '_frontController', null);
        Mage::unregister('controller');

        parent::setUp();
    }

    /**
     * reinit autoload according to actual config settings
     */
    public static function tearDownAfterClass()
    {
        self::unregisterAutoload();
        Mage::app()->getStore()->resetConfig();

        Mage::getSingleton('dhl_expressrates/autoloader')->registerAutoload();

        parent::tearDownAfterClass();
    }

    /**
     * @test
     */
    public function assertAutoloaderIsRegistered()
    {
        Mage::app()->getStore()->setConfig(Dhl_ExpressRates_Model_Config::CONFIG_XML_PATH_AUTOLOAD_ENABLED, '1');

        Mage::app()->getFrontController();
        $this->assertEventDispatched('controller_front_init_before');

        $isRegistered = false;
        $autoloadFunctions = spl_autoload_functions();

        foreach ($autoloadFunctions as $autoloadFunction) {
            if (!is_array($autoloadFunction)) {
                continue;
            }

            if ($autoloadFunction[0] instanceof \Dhl_ExpressRates_Helper_Autoloader) {
                $isRegistered = true;
                break;
            }
        }

        $this->assertTrue($isRegistered);
    }

    /**
     * @test
     */
    public function assertAutoloaderIsNotRegistered()
    {
        Mage::app()->getStore()->setConfig(Dhl_ExpressRates_Model_Config::CONFIG_XML_PATH_AUTOLOAD_ENABLED, '0');

        Mage::app()->getFrontController();
        $this->assertEventDispatched('controller_front_init_before');

        $isRegistered = false;
        $autoloadFunctions = spl_autoload_functions();

        foreach ($autoloadFunctions as $autoloadFunction) {
            if (!is_array($autoloadFunction)) {
                continue;
            }

            if ($autoloadFunction[0] instanceof \Dhl_ExpressRates_Helper_Autoloader) {
                $isRegistered = true;
                break;
            }
        }

        $this->assertFalse($isRegistered);
    }
}
