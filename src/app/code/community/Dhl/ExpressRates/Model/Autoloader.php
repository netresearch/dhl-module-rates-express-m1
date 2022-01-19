<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Autoloader
 *
 * @package Dhl\ExpressRates\Model
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Autoloader
{
    /**
     * Order of autoloaders gets shuffled if the same autoloader is registered
     * more than once. Remember state to avoid this.
     *
     * @var bool
     */
    protected $_isRegistered = false;

    /**
     * Register autoloader in order to locate the extension libraries.
     *
     * To make sure the autoloader gets registered only once, use registration
     * with registered check.
     * @see registerAutoload()
     */
    public static function register()
    {
        if (!Mage::getModel('dhl_expressrates/config')->isAutoloadEnabled()) {
            return;
        }

        /** @var Dhl_ExpressRates_Helper_Autoloader $autoloader */
        $autoloader = Mage::helper('dhl_expressrates/autoloader');

        $autoloader->addNamespace(
            "Psr\\", // prefix
            sprintf('%s/Dhl/ExpressRates/Psr/', Mage::getBaseDir('lib'))
        );

        $autoloader->addNamespace(
            "Dhl\\Express\\", // prefix
            sprintf('%s/Dhl/ExpressRates/SdkApiExpress/', Mage::getBaseDir('lib'))
        );

        $autoloader->register();
    }

    /**
     * Register autoloader with registered check.
     */
    public function registerAutoload()
    {
        if (!$this->_isRegistered) {
            static::register();
            $this->_isRegistered = true;
        }
    }
}
