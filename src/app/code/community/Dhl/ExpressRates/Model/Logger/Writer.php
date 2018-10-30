<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Logger_Writer
 *
 * This class solely exists for backwards compatibility to Mage_Core < 1.6.0.3
 * As of 1.6.0.3 (CE 1.8), Magento comes with its own wrapper model.
 *
 * @package   Dhl\ExpressRates\Model
 * @author    Benjamin Heuer <benjamin.heuer@netresearch.de>
 * @author    Christoph Aßmann <christoph.assmann@netresearch.de>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      http://www.netresearch.de/
 *
 * @codeCoverageIgnore Not testable due to core logging implementation.
 */
class Dhl_ExpressRates_Model_Logger_Writer
{
    /**
     * Log wrapper
     *
     * @param string $message
     * @param int $level
     * @param string $file
     * @param bool $forceLog
     * @return void
     */
    public function log($message, $level = null, $file = '', $forceLog = false)
    {
        Mage::log($message, $level, $file, $forceLog);
    }

    /**
     * Log exception wrapper
     *
     * @param Exception $e
     * @return void
     */
    public function logException(Exception $e)
    {
        Mage::logException($e);
    }
}
