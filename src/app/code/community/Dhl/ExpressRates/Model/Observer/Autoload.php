<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Observer_Autoload
 *
 * @category Dhl
 * @package  Dhl_ExpressRates
 * @author   Rico Sonntag <rico.sonntag@netresearch.de>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     http://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Observer_Autoload
{
    /**
     * Register autoloader when frontend interaction is involved.
     * - event: controller_front_init_before
     *
     * This event is not triggered when module code is run from command line:
     * - shipping module cron task
     * - 3rd party cron tasks
     */
    public function registerAutoload()
    {
        Mage::getSingleton('dhl_expressrates/autoloader')->registerAutoload();
    }
}
