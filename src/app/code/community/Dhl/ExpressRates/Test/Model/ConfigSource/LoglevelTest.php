<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Test_Model_ConfigSource_LoglevelTest
 *
 * @package Dhl\ExpressRates\Test
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Test_Model_ConfigSource_LoglevelTest extends \EcomDev_PHPUnit_Test_Case
{
    /**
     * @test
     */
    public function getOptions()
    {
        $source = Mage::getSingleton('dhl_expressrates/adminhtml_system_config_source_loglevel');
        $options = $source->toOptionArray();

        $validLevels = array(
            \Zend_Log::EMERG,
            \Zend_Log::ALERT,
            \Zend_Log::CRIT,
            \Zend_Log::ERR,
            \Zend_Log::WARN,
            \Zend_Log::NOTICE,
            \Zend_Log::INFO,
            \Zend_Log::DEBUG,
        );

        foreach ($options as $option) {
            $this->assertArrayHasKey('value', $option);
            $this->assertArrayHasKey('label', $option);

            $this->assertInternalType('int', $option['value']);
            $this->assertInternalType('string', $option['label']);

            $this->assertTrue(in_array($option['value'], $validLevels));
        }
    }
}
