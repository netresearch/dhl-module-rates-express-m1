<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Test_Model_ModuleSetupTest
 *
 * @package Dhl\ExpressRates\Test
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Test_Model_ModuleSetupTest extends \EcomDev_PHPUnit_Test_Case_Config
{
    /**
     * @test
     */
    public function aliases()
    {
        $this->assertGroupedClassAlias(
            'models',
            'dhl_expressrates/carrier_express',
            'Dhl_ExpressRates_Model_Carrier_Express'
        );

        $this->assertGroupedClassAlias(
            'blocks',
            'dhl_expressrates/adminhtml_system_config_custominformation',
            'Dhl_ExpressRates_Block_Adminhtml_System_Config_Custominformation'
        );

        $this->assertGroupedClassAlias(
            'helpers',
            'dhl_expressrates/data',
            'Dhl_ExpressRates_Helper_Data'
        );
    }

    /**
     * @test
     */
    public function layoutUpdates()
    {
        $this->assertLayoutFileDefined('adminhtml', 'dhl_expressrates.xml');
    }

    /**
     * @test
     */
    public function defaultValues()
    {
        $this->assertDefaultConfigValue('dhl_expressrates/dev/autoload_enabled', '1');

        $this->assertDefaultConfigValue('carriers/dhlexpress/active', '0');
        $this->assertDefaultConfigValue('carriers/dhlexpress/title', 'DHL Express');
    }

    /**
     * @test
     */
    public function librariesAreLoaded()
    {
        $this->assertEventObserverDefined(
            'global',
            'controller_front_init_before',
            'dhl_expressrates/observer_autoload',
            'registerAutoload'
        );

        $logger = new \Psr\Log\NullLogger();
        $this->assertInstanceOf('\Psr\Log\LoggerInterface', $logger);

        $shipperAddress = new \Dhl\Express\Model\Request\Rate\ShipperAddress('US', '89109', 'Las Vegas');
        $this->assertInstanceOf('\Dhl\Express\Api\Data\Request\Rate\ShipperAddressInterface', $shipperAddress);
    }
}
