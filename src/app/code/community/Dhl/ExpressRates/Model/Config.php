<?php
/**
 * See LICENSE.md for license details.
 */

/**
 * Dhl_ExpressRates_Model_Config
 *
 * @package Dhl\ExpressRates\Model
 * @author  Rico Sonntag <rico.sonntag@netresearch.de>
 * @license https://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link    https://www.netresearch.de/
 */
class Dhl_ExpressRates_Model_Config
{
    const CONFIG_XML_PATH_AUTOLOAD_ENABLED = 'dhl_expressrates/dev/autoload_enabled';
    const CONFIG_SECTION = 'carriers';
    const CONFIG_GROUP = 'dhlexpress';
    const CONFIG_FIELD_ENABLE_LOGGING = 'logging';
    const CONFIG_FIELD_LOGLEVEL = 'loglevel';
    const CONFIG_FIELD_ACCOUNT_NUMBER = 'accountnumber';
    const CONFIG_FIELD_USERNAME = 'username';
    const CONFIG_FIELD_PASSWORD = 'password';
    const CONFIG_FIELD_TITLE = 'title';
    const CONFIG_FIELD_SPECIFIC_ERR_MSG = 'specificerrmsg';

    /**
    * Wrap store config access.
    *
    * @param string $field
    * @param mixed $store
    * @return mixed
    */
    protected function getStoreConfig($field, $store = null)
    {
        $path = sprintf('%s/%s/%s', self::CONFIG_SECTION, self::CONFIG_GROUP, $field);
        return Mage::getStoreConfig($path, $store);
    }

    /**
     * Wrap store config access.
     *
     * @param string $field
     * @param mixed $store
     * @return bool
     */
    protected function getStoreConfigFlag($field, $store = null)
    {
        $path = sprintf('%s/%s/%s', self::CONFIG_SECTION, self::CONFIG_GROUP, $field);
        return Mage::getStoreConfigFlag($path, $store);
    }

    /**
     * Check if custom autoloader should be registered.
     *
     * @return bool
     */
    public function isAutoloadEnabled()
    {
        return Mage::getStoreConfigFlag(self::CONFIG_XML_PATH_AUTOLOAD_ENABLED);
    }

    /**
     * @param mixed $store
     * @return bool
     */
    public function isLoggingEnabled($store = null)
    {
        return $this->getStoreConfigFlag(self::CONFIG_FIELD_ENABLE_LOGGING, $store);
    }

    /**
     * @param mixed $store
     * @return int
     */
    public function getLogLevel($store = null)
    {
        // NOTE: (int) null eq. 0 eq. \Zend_Log::EMERG
        return (int) $this->getStoreConfig(self::CONFIG_FIELD_LOGLEVEL, $store);
    }

    /**
     * Get the account number.
     *
     * @param mixed $store
     * @return string
     */
    public function getAccountNumber($store = null)
    {
        return (string) $this->getStoreConfig(self::CONFIG_FIELD_ACCOUNT_NUMBER, $store);
    }

    /**
     * Get the username.
     *
     * @param mixed $store
     * @return string
     */
    public function getUsername($store = null)
    {
        return (string) $this->getStoreConfig(self::CONFIG_FIELD_USERNAME, $store);
    }

    /**
     * Get the password.
     *
     * @param mixed $store
     * @return string
     */
    public function getPassword($store = null)
    {
        return (string) $this->getStoreConfig(self::CONFIG_FIELD_PASSWORD, $store);
    }

    /**
     * @param mixed $store
     * @return string
     */
    public function getTitle($store = null)
    {
        return (string) $this->getStoreConfig(self::CONFIG_FIELD_TITLE, $store);
    }

    /**
     * @param mixed $store
     * @return string
     */
    public function getSpecificErrorMessage($store = null)
    {
        return (string)$this->getStoreConfig(self::CONFIG_FIELD_SPECIFIC_ERR_MSG, $store);
    }
}
