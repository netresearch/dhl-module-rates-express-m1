<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Class Dhl_ExpressRates_Test_Model_Loger_MageTest
 *
 * @package Dhl\ExpressRates\Test
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Test_Model_Logger_MageTest extends \EcomDev_PHPUnit_Test_Case
{
    /**
     * Returns a logger instance.
     *
     * @return \Dhl_ExpressRates_Model_Logger_Mage|\PHPUnit_Framework_MockObject_MockObject
     */
    private function getLoggerMock()
    {
        $loggerMock = $this->getMockBuilder('Dhl_ExpressRates_Model_Logger_Mage')
            ->setMethods(array('interpolate'))
            ->setConstructorArgs(array(
                new \Mage_Core_Model_Logger()
            ))
            ->getMock();

        return $loggerMock;
    }

    /**
     * Tests if module configuration log level is set ERROR.
     *
     * @test
     */
    public function isHandlingError()
    {
        /** @var \Dhl_ExpressRates_Model_Config|\PHPUnit_Framework_MockObject_MockObject $moduleConfigMock */
        $moduleConfigMock = $this->getMockBuilder('Dhl_ExpressRates_Model_Config')
            ->setMethods(array('isLoggingEnabled', 'getLogLevel'))
            ->getMock();

        $moduleConfigMock->expects(self::exactly(6))
            ->method('isLoggingEnabled')
            ->with(self::anything())
            ->willReturn(true);

        $moduleConfigMock->expects(self::exactly(6))
            ->method('getLogLevel')
            ->willReturn(\Zend_Log::ERR);

        $loggerMock = $this->getLoggerMock();
        $loggerMock->setModuleConfig($moduleConfigMock);

        // Only ERROR and CRITICAL should come to this point
        $loggerMock->expects(self::exactly(2))
            ->method('interpolate')
            ->with(self::equalTo('PASS THROUGH MESSAGE'))
            ->willReturnSelf();

        $loggerMock->critical('PASS THROUGH MESSAGE');
        $loggerMock->error('PASS THROUGH MESSAGE');

        $loggerMock->info('INFO MESSAGE');
        $loggerMock->notice('NOTICE MESSAGE');
        $loggerMock->warning('WARNING MESSAGE');
        $loggerMock->debug('DEBUG MESSAGE');
    }

    /**
     * Tests if module configuration log level is set INFO.
     *
     * @test
     */
    public function isHandlingInfo()
    {
        /** @var \Dhl_ExpressRates_Model_Config|\PHPUnit_Framework_MockObject_MockObject $moduleConfigMock */
        $moduleConfigMock = $this->getMockBuilder('Dhl_ExpressRates_Model_Config')
            ->setMethods(array('isLoggingEnabled', 'getLogLevel'))
            ->getMock();

        $moduleConfigMock->expects(self::exactly(6))
            ->method('isLoggingEnabled')
            ->with(self::anything())
            ->willReturn(true);

        $moduleConfigMock->expects(self::exactly(6))
            ->method('getLogLevel')
            ->willReturn(\Zend_Log::INFO);

        $loggerMock = $this->getLoggerMock();
        $loggerMock->setModuleConfig($moduleConfigMock);

        // All but not DEBUG should come to this point
        $loggerMock->expects(self::exactly(5))
            ->method('interpolate')
            ->with(self::equalTo('PASS THROUGH MESSAGE'))
            ->willReturnSelf();

        $loggerMock->critical('PASS THROUGH MESSAGE');
        $loggerMock->error('PASS THROUGH MESSAGE');
        $loggerMock->info('PASS THROUGH MESSAGE');
        $loggerMock->notice('PASS THROUGH MESSAGE');
        $loggerMock->warning('PASS THROUGH MESSAGE');

        $loggerMock->debug('DEBUG MESSAGE');
    }

    /**
     * Tests if module configuration log level is set DEBUG.
     *
     * @test
     */
    public function isHandlingDebug()
    {
        /** @var \Dhl_ExpressRates_Model_Config|\PHPUnit_Framework_MockObject_MockObject $moduleConfigMock */
        $moduleConfigMock = $this->getMockBuilder('Dhl_ExpressRates_Model_Config')
            ->setMethods(array('isLoggingEnabled', 'getLogLevel'))
            ->getMock();

        $moduleConfigMock->expects(self::exactly(6))
            ->method('isLoggingEnabled')
            ->with(self::anything())
            ->willReturn(true);

        $moduleConfigMock->expects(self::exactly(6))
            ->method('getLogLevel')
            ->willReturn(\Zend_Log::DEBUG);

        $loggerMock = $this->getLoggerMock();
        $loggerMock->setModuleConfig($moduleConfigMock);

        // Everything should reach this method
        $loggerMock->expects(self::exactly(6))
            ->method('interpolate')
            ->with(self::equalTo('PASS THROUGH MESSAGE'))
            ->willReturnSelf();

        $loggerMock->critical('PASS THROUGH MESSAGE');
        $loggerMock->error('PASS THROUGH MESSAGE');
        $loggerMock->info('PASS THROUGH MESSAGE');
        $loggerMock->notice('PASS THROUGH MESSAGE');
        $loggerMock->warning('PASS THROUGH MESSAGE');
        $loggerMock->debug('PASS THROUGH MESSAGE');
    }
}
