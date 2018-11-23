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

    public function tearDown()
    {
        $this->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        parent::tearDown();
    }

    /**
     * Tests if module configuration log level is set ERROR.
     *
     * @test
     * @loadFixture express
     */
    public function loggingEnabledWithLogLevelError()
    {
        // store 2 logs only ERROR and more severe
        $this->setCurrentStore(2);

        $debugMessage = 'DEBUG';
        $infoMessage = 'INFO';
        $noticeMessage = 'NOTICE';
        $warningMessage = 'WARNING';

        $errorMessage = 'ERROR';
        $criticalMessage = 'CRITICAL';
        $alertMessage = 'ALERT';
        $emergencyMessage = 'EMERGENCY';

        $logWriter = new Dhl_ExpressRates_Test_Fake_LogWriter();
        $logger = new Dhl_ExpressRates_Model_Logger_Mage($logWriter);

        $logger->debug($debugMessage);
        $logger->info($infoMessage);
        $logger->notice($noticeMessage);
        $logger->warning($warningMessage);
        $logger->error($errorMessage);
        $logger->critical($criticalMessage);
        $logger->alert($alertMessage);
        $logger->emergency($emergencyMessage);

        $this->assertFalse($logWriter->hasRecord($debugMessage));
        $this->assertFalse($logWriter->hasRecord($infoMessage));
        $this->assertFalse($logWriter->hasRecord($noticeMessage));
        $this->assertFalse($logWriter->hasRecord($warningMessage));

        $this->assertTrue($logWriter->hasRecord($errorMessage));
        $this->assertTrue($logWriter->hasRecord($criticalMessage));
        $this->assertTrue($logWriter->hasRecord($alertMessage));
        $this->assertTrue($logWriter->hasRecord($emergencyMessage));
    }

    /**
     * Tests if module configuration log level is set ERROR.
     *
     * @test
     * @loadFixture express
     */
    public function loggingDisabled()
    {
        // store 1 logs only EMERGENCY
        $this->setCurrentStore(1);

        $debugMessage = 'DEBUG';
        $infoMessage = 'INFO';
        $noticeMessage = 'NOTICE';
        $warningMessage = 'WARNING';

        $errorMessage = 'ERROR';
        $criticalMessage = 'CRITICAL';
        $alertMessage = 'ALERT';
        $emergencyMessage = 'EMERGENCY';

        $logWriter = new Dhl_ExpressRates_Test_Fake_LogWriter();
        $logger = new Dhl_ExpressRates_Model_Logger_Mage($logWriter);

        $logger->debug($debugMessage);
        $logger->info($infoMessage);
        $logger->notice($noticeMessage);
        $logger->warning($warningMessage);
        $logger->error($errorMessage);
        $logger->critical($criticalMessage);
        $logger->alert($alertMessage);
        $logger->emergency($emergencyMessage);

        $this->assertFalse($logWriter->hasRecord($debugMessage));
        $this->assertFalse($logWriter->hasRecord($infoMessage));
        $this->assertFalse($logWriter->hasRecord($noticeMessage));
        $this->assertFalse($logWriter->hasRecord($warningMessage));
        $this->assertFalse($logWriter->hasRecord($errorMessage));
        $this->assertFalse($logWriter->hasRecord($criticalMessage));
        $this->assertFalse($logWriter->hasRecord($alertMessage));
        $this->assertTrue($logWriter->hasRecord($emergencyMessage));
    }
}
