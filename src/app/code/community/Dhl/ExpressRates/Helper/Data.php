<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Helper class used by the Magento translation system.
 *
 * @category Dhl
 * @package  Dhl_ExpressRates
 * @author   Rico Sonntag <rico.sonntag@netresearch.de>
 * @license  http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link     http://www.netresearch.de/
 */
class Dhl_ExpressRates_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Returns the module version.
     *
     * @return string
     */
    public function getModuleVersion()
    {
        $moduleName = $this->_getModuleName();

        return (string) Mage::getConfig()->getModuleConfig($moduleName)->version;
    }
}
